<?php

namespace App\Http\Controllers;

use App\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    public static function existeUsuario($nickName){

            $existeUsuario = DB::select('exec Seg_ExisteUsuario ?', array($nickName));

            return $existeUsuario[0]->Registros;

    }

    public static function usuarioActivo($nickName){
        $activo = Usuario::where('nickUsuario', $nickName)->where('isActivo', 1)->get();

        return $activo->count();

    }

    public function listarUsuarios(){
        try {
            $usuarios = Usuario::all();
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

    public function validarCredenciales($nickname, $password)
    {
        //return Hash::check($password, $this->passUsuario);
        $myPass = DB::table('tblUsuarios')->select()->where('nickUsuario',$nickname)->get()->first();
        $myPass = $myPass->passUsuario;
        $inputPass = utf8_encode($this->encriptar($password));

        return $myPass == $inputPass;

    }


}
