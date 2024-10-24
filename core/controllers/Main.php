<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use PDO;

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


    public function loja() {
        // Apresenta a página da loja
        $produtos = new Produtos();
    
        // Listar produtos e verificar se é um array
        $listarProdutos = $produtos->listarProdutos();
    
        // Listar categorias, tamanhos e cores
        $listarCategoria = $produtos->listarCategoria();
        $listarTamanho = $produtos->listarTamanho();
        $listarCor = $produtos->listarCor();
    
        // Preparar um array para armazenar os estoques
        $estoques = [];
    
        // Se listarProdutos for um array e tiver elementos
        if (is_array($listarProdutos) && count($listarProdutos) > 0) {
            foreach ($listarProdutos as $produto) {
                // Obter estoque para cada produto
                $estoque = $produtos->listarEstoque($produto->id, $produto->cor_id, $produto->tamanho_id);
                $estoques[$produto->id] = $estoque; // Armazenar o estoque no array usando o id do produto
            }
        }
    
        // Passar os dados para a view
        Store::Layout([
            'layout/html_header',
            'layout/header',
            'loja',
            'layout/footer',
            'layout/html_footer',
        ], [
            'produtos' => $listarProdutos,
            'categorias' => $listarCategoria,
            'tamanhos' => $listarTamanho,
            'cores' => $listarCor,
            'estoques' => $estoques
        ]);
    }

    public function filtrar_produtos() {
        $produtos = new Produtos();
        
        $categoria = $_POST['id_categoria'] ?? null; // Usa null se não existir
        $tamanho = $_POST['id_tamanho'] ?? null; // Faz o mesmo para tamanho
        $cor = $_POST['id_cor'] ?? null; // E para cor

        $Nomecategoria =
        $Nometamanho =
        $Nomecor =

    
        // if (empty($categoria)) {
        //     // Se categoria está vazia (ou seja, "Todas" foi selecionado)
        //     $categoria = "Todas"; // Aqui você pode fazer o que quiser
        //     $tamanho = "Todas"; // Aqui você pode fazer o que quiser
        //     $cor = "Todas"; // Aqui você pode fazer o que quiser
        // }
        
        $filtro = $produtos->filtrarProduto($categoria, $tamanho, $cor);
        
        // echo '<pre>';
        // print_r('Cat: ' . $categoria . '<br>');
        // print_r('Tam: ' . $tamanho . '<br>');
        // print_r('Cor: ' . $cor . '<br>');
        // print_r($filtro);
        // die();
    
    
        Store::Layout([
            'layout/html_header',
            'layout/header',
            'filtrar_produtos',
            'layout/footer',
            'layout/html_footer',
        ], [
            'categorias' => $categoria,
            'tamanhos' => $tamanho,
            'cores' => $cor,
            'filtros' => $filtro,
        ]);
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

    

    public function login(){



        //verifica se ja existe algum usuario logado
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'login_form',
            'layout/footer',
            'layout/html_footer',
        ]);
    }

    public function login_submit(){
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $this->index();
            return;
        }

        if(!isset($_POST['email']) || 
        !isset($_POST['senha']) || 
        !filter_var(trim($_POST['email']),FILTER_VALIDATE_EMAIL)){
            $_SESSION['erro'] = 'Login Invalido';
            $this->login();
            return;
        }


        $usuario = trim(strtolower($_POST['email']));
        $senha = trim($_POST['senha']);

        $cliente = new Clientes();

        $resultado = $cliente->validar_login($usuario, $senha);

        if(is_bool($resultado)){

            //login invalido
            $_SESSION['erro'] = 'Login inválido';
            $this->login();
            return;
        } else {

            //login valido
            $_SESSION['cliente'] = $resultado->id;
            $_SESSION['usuario'] = $resultado->email;
            $_SESSION['nome'] = $resultado->nome;
            $_SESSION['sobrenome'] = $resultado->sobrenome;

            $this->login();
        }


    }


    public function logout(){
        unset($_SESSION['cliente']);
        unset($_SESSION['usuario']);
        unset($_SESSION['nome']);
        unset($_SESSION['sobrenome']);
        $this->index();
        
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


        header("Location: ?a=registro_endereco");
        exit;

    }

    public function confirmar_email(){

        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        //verificar se existe um token
        if(!isset($_GET['token'])){
            if(Store::clienteLogado()){
                $this->index();
                return;
            }
        }

        $token = $_GET['token'];

        //verifica se o token é valido
        if(strlen($token) != 12){
            if(Store::clienteLogado()){
                $this->index();
                return;
            }
        }

        $cliente = new Clientes();
        $resultado = $cliente->validar_email($token);

        if($resultado){
            Store::Layout([
                'layout/html_header',
                'layout/header',
                'criar_cliente_sucesso',
                'layout/footer',
                'layout/html_footer',
            ]);

        } else {
            Store::Layout([

                'layout/html_header',
                'layout/header',
                'criar_cliente_erro',
                'layout/footer',
                'layout/html_footer',
            ]);

        }




    }


    public function registro_endereco(){
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

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


