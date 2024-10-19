<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;

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

    public function formDuvidas(){
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $this->index();
            return;
        } else{
            $email = new EnviarEmail();

            $tipo_produto = $_POST['tipo-produto'];
            $nome_cliente = $_POST['nome_cliente'];
            $email_cliente = $_POST['email_cliente'];
            $duvida = $_POST['duvida'];

            $email->EmailFormularioDuvidas($tipo_produto, $nome_cliente, $email_cliente, $duvida);
            $email->EmailResposta($tipo_produto, $nome_cliente, $email_cliente);

            echo('<script>
            window.location.href = "?a=inicio";
            alert("E-mail enviado com sucesso!");
        </script>');
        }


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
        $cliente = new Clientes();

        if($cliente->verificarEmailRegistrado($_POST['email'])){
            $_SESSION['erro'] = "Já existe uma conta associada a este e-mail.";
            $this->registrar_usuario();
            return;
        }

        if($cliente->verificarCpfRegistrado($_POST['cpf'])){
            $_SESSION['erro'] = "Este CPF já está cadastrado.";
            $this->registrar_usuario();
            return;
        }

        $token = $cliente->registrarCliente();

        //*envio do email para o cliente
        $nome_usuario = $_POST['nome'];
        $email_cliente = strtolower(trim($_POST['email']));
        $nome_usuario = $_POST['nome'];
        $envioEmail = new EnviarEmail();
        $resultado = $envioEmail->EmailConfirmacaoCliente($email_cliente, $nome_usuario, $token);

        if($resultado){
            echo 'Email Enviado';
        } else {
            echo 'erro';
        }

        header("Location: ?a=registro_endereco");
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

        $endereco = new Clientes();


        $endereco->registrarEndereco();

        die("OK");
    }
}


