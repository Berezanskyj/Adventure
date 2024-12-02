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

    public static function Layout_admin($estruturas, $dados= null){
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
            include("../../core/views/$estrutura.php");
        }
    }

    public static function clienteLogado(){
        //verifica se existe algum cliente com sessao aberta.

        return isset($_SESSION['cliente']);
    }

    public static function adminLogado(){
        //verifica se existe algum admin com sessao aberta.

        return isset($_SESSION['admin']);
    }

    public static function criarToken($num_caracteres = 12){
        //criar hash

        $chars = '01234567890123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle($chars), 0, $num_caracteres);

        
    }

    public static function redirect($rota = ''){
        header("Location:" . BASE_URL . "?a=$rota");
    }

    public static function printData($data){
        if(is_array($data) || is_object($data)){
            echo '<pre>';
            print_r($data);
        } else {
            echo '<pre>';
            echo $data;
        }
    }

};