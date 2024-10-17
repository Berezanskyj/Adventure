<?php

namespace core\controllers;
use core\classes\Store;

class Main{
    

    public function index(){
        


        Store::Layout([
            'layout/html_header',
            'layout/header',
            'inicio',
            'layout/footer',
            'layout/html_footer',
        ]);
    }


    public function loja(){

        //apresenta a pagina da loja

        $dados = [
            'titulo' => APP_NAME,
            
        ];

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'loja',
            'layout/footer',
            'layout/html_footer',
        ], $dados);
    }

    public function sobre(){

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'sobre',
            'layout/footer',
            'layout/html_footer',
        ]);
    }

    public function user_account(){



        //verifica se ja existe algum usuario logado
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'user_account',
            'layout/footer',
            'layout/html_footer',
        ]);
    }

    public function logout(){



        //verifica se ja existe algum usuario logado
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'inicio',
            'layout/footer',
            'layout/html_footer',
        ]);
    }

    public function login(){



        //verifica se ja existe algum usuario logado
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'loja',
            'layout/footer',
            'layout/html_footer',
        ]);
    }

    public function registrar_usuario(){



        //verifica se ja existe algum usuario logado
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'registro_usuario',
            'layout/footer',
            'layout/html_footer',
        ]);
    }

    public function carrinho(){

        //apresenta a pagina do carrinho

        $dados = [
            'titulo' => APP_NAME,
            
        ];

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'carrinho',
            'layout/footer',
            'layout/html_footer',
        ], $dados);
    }
    }