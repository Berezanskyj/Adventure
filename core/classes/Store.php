<?php

namespace core\classes;
use Exception;

class Store{
    

    public static function Layout($estruturas, $dados= null){
        //* Verifica se o parametro passado é um array
        
        if(!is_array($estruturas)){
            throw new Exception("Parametro invalido");
        }

        //variaveis
        if(!empty($dados) && is_array($dados)){
            extract($dados);
        }

        //* Apresentar as views da aplicacao
        foreach($estruturas as $estrutura){
            include("../core/views/$estrutura.php");
        }
    }

    public static function clienteLogado(){
        //verifica se existe algum cliente com sessao aberta.

        return isset($_SESSION['cliente']);
    }

    public static function criarToken($num_caracteres = 12){
        //criar hash

        $chars = '01234567890123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle($chars), 0, $num_caracteres);

        
    }

};