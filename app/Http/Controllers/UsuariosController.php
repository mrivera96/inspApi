<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    public static function existeUsuario($nickName){

            $existeUsuario = DB::select('exec Seg_ExisteUsuario ?', array($nickName));


            return $existeUsuario[0]->Registros;

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
