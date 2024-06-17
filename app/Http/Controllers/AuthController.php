<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class AuthController extends Controller
{


    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'nickname' => 'required|string',
            'password' => 'required|string',
        ]);

        $nickname = $request->nickname;
        $password = $request->password;

        if (UsersController::existeUsuario($nickname) != 0) {
            if (UsersController::usuarioActivo($nickname) > 0) {
                $cripPass =  $this->obtenerCifrado($password);
                $auth = User::where('nickUsuario', $nickname)->where('passUsuario', $cripPass)->first();

                if ($auth) {
                    Auth::login($auth);
                    $user = Auth::user();
                    $tkn = $user->createToken('XploreInspApi')->accessToken;
                    $result = new \stdClass();
                    $result->access_token = $tkn;
                    $result->idUsuario = $user->idUsuario;
                    $result->idPerfil = $user->idPerfil;
                    $result->nomUsuario = $user->nomUsuario;
                    $result->lastLogin = $user->lastLogin;

                    $res = new \stdClass();
                    $res->user = $result;
                    return response()->json(
                        [
                            'error' => 0,
                            'data' => $res
                            ,
                        ],
                        200
                    );
                } else {
                    return response()->json([
                        'error' => 1,
                        'message' => 'Las credenciales que ha ingresado no son correctas.'
                    ], 401);
                }
            } else {
                return response()->json([
                    'error' => 1,
                    'message' => 'Su usuario se encuentra inactivo. Comuníquese con el departamento de IT para resolver el conflicto.'
                ], 401);
            }


        } else {
            return response()->json([
                'error' => 1,
                'message' => 'Autenticación no encontrada.'
            ], 401);
        }

    }

    private function obtenerCifrado($psswd)
    {
        $httpClient = new Client(['verify' => false]);
        $res = $httpClient->get('https://appconductores.xplorerentacar.com/mod.ajax/encriptar.php?password=' . $psswd);
        return json_decode($res->getBody());
    }

    public function logout(Request $request)
    {
        try {

            $request->user()->token()->revoke();

            return response()->json([
                'error' => 0,
                'message' => 'Successfully logged out'],
                200);
        } catch (Exception $ex) {
            return response()->json([
                'error' => 1,
                'message' => $ex->getMessage()],
                500);
        }

    }


}
