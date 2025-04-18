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

            ob_clean();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        header('Content-Type: application/json; charset=UTF-8'); // Define JSON no cabeçalho
        
            $email = new EnviarEmail();

            $tipo_produto = $_POST['tipo-produto'];
            $nome_cliente = $_POST['nome_cliente'];
            $email_cliente = $_POST['email_cliente'];
            $duvida = $_POST['duvida'];

            $email->EmailFormularioDuvidas($tipo_produto, $nome_cliente, $email_cliente, $duvida);
            $email->EmailResposta($tipo_produto, $nome_cliente, $email_cliente);

            echo json_encode([
                "status" => "success",
                "mensagem" => "Produto ativado com sucesso!"
            ]);
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

    public function detalhes_produto() {
        // Recuperar o ID do produto
        $id = $_GET['id'];
    
        // Instância do modelo Produtos
        $produto = new Produtos();
    
        // Consultar detalhes do produto
        $atributos = $produto->consultaEstoquePorID($id);
        $res = $produto->retornarProdutoPorID($id);
    
        // Verificar se o produto existe
        if (empty($res)) {
            die('Produto não encontrado.');
        }
    
        // Inicializar os detalhes do produto
        $produto_detalhes = [
            'cores' => [],
            'tamanhos' => [],
        ];
    
        // Processar atributos para cores e tamanhos
        foreach ($atributos as $item) {
            // Adicionar cor
            $cor = $produto->buscarCores($item->cor_id);
            if (!empty($cor) && !in_array($cor[0]->cor, $produto_detalhes['cores'])) {
                $produto_detalhes['cores'][] = $cor[0]->cor;
            }
    
            // Adicionar tamanho
            $tamanho = $produto->buscarTamanho($item->tamanho_id);
            if (!empty($tamanho) && !in_array($tamanho[0]->tamanho, $produto_detalhes['tamanhos'])) {
                $produto_detalhes['tamanhos'][] = $tamanho[0]->tamanho;
            }
        }

        $cat = $produto->buscarCategoria($res[0]->categoria_id);
    
        // Enviar dados para sessão
        $_SESSION['nome_produto_det'] = $res[0]->nome_produto;
        $_SESSION['img_produto_det'] = $res[0]->imagem_produto;
        $_SESSION['id_produto_det'] = $id;
        $_SESSION['desc_produto_det'] = $res[0]->descricao;
        $_SESSION['valor_produto_det'] = $res[0]->preco;
        $_SESSION['categoria_produto_det'] = $cat[0]->nome_categoria;
        $_SESSION['cores_produto_det'] = implode(', ', $produto_detalhes['cores']);
        $_SESSION['tamanhos_produto_det'] = implode(', ', $produto_detalhes['tamanhos']);
    
        // Carregar o layout
        Store::Layout([
            'layout/html_header',
            'layout/header',
            'detalhes_produto',
            'layout/footer',
            'layout/html_footer',
        ]);
    }

    public function personalizacao_produto()
    {
        $id_produto = $_GET['id'];
    
        $produto = new Produtos();
    
        // Consultar os atributos do produto
        $atributos = $produto->consultaEstoquePorID($id_produto);

        $prod = $produto->retornarProdutoPorID($id_produto);

        $_SESSION['nome_produto_det'] = $prod[0]->nome_produto;
        $_SESSION['desc_produto_det'] = $prod[0]->descricao;
        $_SESSION['valor_produto_det'] = $prod[0]->preco;
        $_SESSION['imagem_produto_det'] = $prod[0]->imagem_produto;
    
        // Dados principais do produto (exemplo apenas do primeiro item)
        $produto_detalhes = [
            'id' => $atributos[0]->produto_id ?? null,
            'cores' => [],
            'tamanhos' => []
        ];
    
        // Buscar cores e tamanhos para o produto
        foreach ($atributos as $item) {
            // Adicionar cor, se não estiver já listada
            $cor = $produto->buscarCores($item->cor_id);
            if (!empty($cor) && !in_array($cor[0]->cor, $produto_detalhes['cores'])) {
                $produto_detalhes['cores'][] = $cor[0]->cor;
            }
    
            // Adicionar tamanho, se não estiver já listado
            $tamanho = $produto->buscarTamanho($item->tamanho_id);
            if (!empty($tamanho) && !in_array($tamanho[0]->tamanho, $produto_detalhes['tamanhos'])) {
                $produto_detalhes['tamanhos'][] = $tamanho[0]->tamanho;
            }
        }
    
        // Enviar dados para a view
        Store::Layout([
            'layout/html_header',
            'layout/header',
            'personalizacao_produto',
            'layout/footer',
            'layout/html_footer',
        ], [
            'produto_detalhes' => $produto_detalhes,
        ]);
    }

    public function filtrar_produtos() {
        $produtos = new Produtos();
    
        // Retrieve filter criteria from POST data
        $categoria = $_POST['id_categoria'] ?? "TODOS";  // Default to "TODOS" if not set
        $tamanho = $_POST['id_tamanho'] ?? "TODOS";      // Default to "TODOS" if not set
        $cor = $_POST['id_cor'] ?? "TODOS";              // Default to "TODOS" if not set

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
    
        // Fetch filtered products
        $filtro = $produtos->filtrarProduto($categoria, $tamanho, $cor);
        
        // List specific data
        $categoriaNome = $produtos->listarCategoriaEspec($categoria);
        $tamanhoNome = $produtos->listarTamanhoEspec($tamanho);
        $corNome = $produtos->listarCorEspec($cor);

        $nomecat = $categoriaNome[0]->nome_categoria ?? "Todas";
        $nomecor = $corNome[0]->cor ?? "Todas";
        $nometam = $tamanhoNome[0]->tamanho ?? "Todos";
        
        $_SESSION['categoria'] = $nomecat;
        $_SESSION['cor'] = $nomecor;
        $_SESSION['tamanho'] = $nometam;
        
        // Exibindo os valores
        // echo '<pre>';
        // print_r($_SESSION);      // Exibe o nome da cor
        // die();
    
        // Display layout with filters and filtered products
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
            'estoques' => $estoques
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
            $_SESSION['nome'] =     $resultado->nome;
            $_SESSION['sobrenome'] = $resultado->sobrenome;
            $_SESSION['cpf'] = $resultado->cpf;
            $_SESSION['telefone'] = $resultado->telefone;
            $_SESSION['data_cadastro'] = date('d/m/Y', strtotime($resultado->data_criacao));


            $resEndereco = $cliente->buscarEndereco($_SESSION['cliente']);
            $endereco = $resEndereco[0];

            $_SESSION['rua'] = $endereco->rua;
            $_SESSION['numero'] = $endereco->numero;
            $_SESSION['cidade'] = $endereco->cidade;
            $_SESSION['cep'] = $endereco->cep;
            $_SESSION['bairro'] = $endereco->bairro;
            $_SESSION['apelido'] = $endereco->apelido;
            $_SESSION['complemento'] = $endereco->complemento;

            if(isset($_SESSION['tmp_carrinho'])){
                unset($_SESSION['tmp_carrinho']);
                Store::redirect('finalizar_compra_resumo');
            } else {
                Store::redirect();
            }
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

        $id = $cliente->registrarCliente();

        $dados = $cliente->listarClienteID($id);

        $nome = $dados[0]->nome;
        $sobrenome = $dados[0]->sobrenome;
        $email = $dados[0]->email;
        $cpf = $dados[0]->cpf;
        $telefone = $dados[0]->telefone;





        $_SESSION['nome'] = $nome;
        $_SESSION['sobrenome'] = $sobrenome;
        $_SESSION['email'] = $email;
        $_SESSION['cpf'] = $cpf;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['id'] = $id;





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

    public function email_enviado(){
        Store::Layout([
            'layout/html_header',
            'layout/header',
            'email_enviado',
            'layout/footer',
            'layout/html_footer',
        ]);
    }

    public function criar_endereco(){

        


        $cep = $_POST['cep'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $apelido = $_POST['apelido'];
        $idUsuario = $_SESSION['id'];
        
        $endereco = new Clientes();


        $token = $endereco->registrarEndereco($cep, $cidade, $bairro, $rua, $numero, $complemento, $apelido, $idUsuario);


        // //*envio do email para o cliente
        $nome_usuario = $_SESSION['nome'];
        $email_cliente = strtolower(trim($_SESSION['email']));
        $envioEmail = new EnviarEmail();
        $envioEmail->EmailConfirmacaoCliente($email_cliente, $nome_usuario, $token[0]->token);

        $this->email_enviado();

    }

    public function recuperar_senha(){


        Store::Layout([
            'layout/html_header',
            'layout/header',
            'recuperar_senha',
            'layout/footer',
            'layout/html_footer',
        ]);
    }


    public function verificar_email(){

        $cliente = new Clientes();
        $email = $_POST['email'];

        
        

        $registro = $cliente->verificarClienteRegistrado($email);

        if($registro){
            Store::redirect('recuperar_senha_submit');
            $_SESSION['email-recupera'] = $email;
        } else {
            $_SESSION['erro'] = "Usuario não encontrado";
            $this->recuperar_senha();
            return;
        }

        // Store::Layout([
        //     'layout/html_header',
        //     'layout/header',
        //     'recuperar_senha',
        //     'layout/footer',
        //     'layout/html_footer',
        // ]);
    }

    public function recuperar_senha_submit(){
        $cliente = new Clientes();
        $email = $_SESSION['email-recupera'];
        $enviarEmail = new EnviarEmail();
        
        // Verifique se a senha foi enviada e não está vazia
        if (!empty($_POST['senha'])) {
            $senha = $_POST['senha'];
        
            // Chama a função recuperar_senha apenas se a senha foi fornecida
            $res = $cliente->recuperar_senha($email, $senha);

            $enviarEmail->EmailRecuperarSenha($email);
        
            // Debugging: Imprime dados para verificar o fluxo
            Store::Layout([
                'layout/html_header',
                'layout/header',
                'recuperar_senha_sucesso',
                'layout/footer',
                'layout/html_footer',
            ]);
        } else {
            // Se não houver senha no POST, apenas carrega a página
            Store::Layout([
                'layout/html_header',
                'layout/header',
                'recuperar_senha_submit',
                'layout/footer',
                'layout/html_footer',
            ]);
        }
        
    }
}


