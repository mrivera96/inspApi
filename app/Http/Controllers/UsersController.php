<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public static function existeUsuario($nickName){

            $existeUsuario = DB::select('exec Seg_ExisteUsuario ?', array($nickName));

            return $existeUsuario[0]->Registros;

    }

    public static function usuarioActivo($nickName){
        $activo = User::where('nickUsuario', $nickName)->where('isActivo', 1)->get();

        return $activo->count();

    }

    public function list(): \Illuminate\Http\JsonResponse
    {
        try {
            $usuarios = User::all();
            return response()->json([
                'error' => 0,
                'data' => $usuarios],
                200);
        }catch (Exception $ex){
            return response()->json([
                'error' => 1,
                'data' => $ex->getMessage()],
                500);
        }
    }

    public function validarCredenciales($nickname, $password): bool
    {
        //return Hash::check($password, $this->passUsuario);
        $myPass = DB::table('tblUsuarios')->select()->where('nickUsuario',$nickname)->get()->first();
        $myPass = $myPass->passUsuario;
        $inputPass = utf8_encode($this->encriptar($password));

        return $myPass == $inputPass;

    }


}
