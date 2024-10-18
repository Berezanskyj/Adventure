<?php

namespace core\controllers;

use core\classes\Database;
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

    public function criar_cliente(){
        //verifica se ja existe algum usuario logado
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $this->index();
            return;
        }

        if($_POST['senha'] !== $_POST['confirma_senha']){
            $_SESSION['erro'] = "As senhas informadas são diferentes.";
            $this->registrar_usuario();
            return;
        }


        //*verifica no db se existe cliente com o mesmo email
        $sql = new Database();
        $paramEmail = [
            ":email" => strtolower(trim($_POST['email'])),
        ];

        $resEmail = $sql->select("SELECT email FROM usuario WHERE email = :email", $paramEmail);

        $paramCpf = [
            ":cpf" => $_POST['cpf'],
        ];


        $resCpf = $sql->select("SELECT cpf FROM usuario WHERE cpf = :cpf", $paramCpf);


        //*se o cliente ja tem cadastro...
        if(count($resEmail) != 0){
            $_SESSION['erro'] = "Já existe uma conta associada a este e-mail.";
            $this->registrar_usuario();
            return;
        }

        //*se o cpf ja existe...
        if(count($resCpf) != 0){
            $_SESSION['erro'] = "Este CPF já está cadastrado.";
            $this->registrar_usuario();
            return;
        }


        
        //*criacao o novo cliente
        $token = Store::criarToken();

        $param = [
            ':nome' => trim($_POST['nome']),
            ':sobrenome' => trim($_POST['sobrenome']),
            ':email' => strtolower(trim($_POST['email'])),
            ':cpf' => $_POST['cpf'],
            ':senha' => password_hash(trim($_POST['senha']), PASSWORD_DEFAULT, ['cost' => 10]),
            ':telefone' => $_POST['telefone'],
            ':nivel_usuario' => 2,
            ':token' => $token,
            ':ativo' => 0 // ou 1 dependendo do que deseja para o usuário novo
        ];
        
        $sql->insert("INSERT INTO usuario (nome, sobrenome, email, cpf, senha, telefone, nivel_usuario, token, ativo)
        VALUES (:nome, :sobrenome, :email, :cpf, :senha, :telefone, :nivel_usuario, :token, :ativo)", $param);

        $lastUserId = $sql->lastInsertId();

        //criar o link token para enviar por email
        $linkToken = "http://localhost:8080/adventure/public/?a=confirmar_token&token=$token";

        header("Location: ?a=registro_endereco&id_usuario=$lastUserId");
        exit;
    }


    public function registro_endereco(){
        Store::Layout([
            'layout/html_header',
            'layout/header',
            'registro_endereco',
            'layout/footer',
            'layout/html_footer',
        ]);

        


    }

    public function criar_endereco(){

        $sql = new Database();

        $result = $sql->select("SELECT id FROM usuario ORDER BY id DESC LIMIT 1;");
        $lastUserId = $result[0]->id;
        echo "O último ID inserido é: " . $lastUserId;

        $param = [
            ':cep' => trim($_POST['cep']),
            ':cidade' => trim($_POST['cidade']),
            ':bairro' => strtolower(trim($_POST['bairro'])),
            ':rua' => $_POST['rua'],
            ':numero' => trim($_POST['numero']),
            ':complemento' => $_POST['complemento'],
            ':apelido' => $_POST['apelido'],
            ':id_usuario' => $lastUserId
        ];
        
        $sql->insert("INSERT INTO enderecos (cep, cidade, bairro, rua, numero, complemento, apelido, id_usuario)
        VALUES (:cep, :cidade, :bairro, :rua, :numero, :complemento, :apelido, :id_usuario)", $param);
    

        die("OK");
    }
}


