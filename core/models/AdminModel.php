<?php

namespace core\models;
use core\classes\Database;
use core\classes\Store;

class AdminModel{

    public function validar_login($usuario, $senha){
        $sql = new Database();

        $param = [
            ':usuario' => $usuario
        ];

        $sql = new Database();
        $resultado = $sql->select("SELECT * FROM usuario WHERE email = :usuario AND ativo = 1 AND nivel_usuario = 1", $param);


        if(count($resultado) != 1){
            //usuario nao existe
            return false;

        } else {
            //usuario existe
            $usuario = $resultado[0];

            if(!password_verify($senha, $usuario->senha)){
                //usuario existe mas a senha nao corresponde
                return false;
            } else {

                //login valido 
                return $usuario;
            }
        }


    }

}
