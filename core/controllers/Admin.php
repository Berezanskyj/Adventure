<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use core\models\AdminModel;
use Exception;
use PDOException;
use PDO;

class Admin
{
    public function index()
    {
        if (!Store::adminLogado()) {
            $this->admin_login();
            return;
        }


        $vendas = new AdminModel();

        $nivel_usuario = $vendas->verificaUsuario($_SESSION['admin']);

        // if($nivel_usuario != 1){
        //     $this->admin_login();
        //     return;
        // }

        // die();

        // Obter os dados
        $totalVenda = $vendas->totalVendas();
        $totalEstoque = $vendas->totalEstoque();
        $totalClientes = $vendas->totalClientes();
        $pedidos = $vendas->listarPedidosRecentes();

        // Store::printData($teste);
        // die();

        // Store::printData($totalClientes);
        // Store::printData($totalEstoque);
        // Store::printData($totalVenda);

        // die();

        //verifica se já existe algum admin logado


        // Passar os dados para o layout
        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/home',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'totalVenda' => $totalVenda,
            'totalEstoque' => $totalEstoque,
            'totalClientes' => $totalClientes,
            'pedidos' => $pedidos,
        ]);
    }


    public function admin_login()
    {
        if (Store::adminLogado()) {
            $this->index();
            return;
        }

        //apresenta o login
        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/login',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ]);
    }

    public function login_admin_submit()
    {



        if (Store::adminLogado()) {
            $this->index();
            return;
        }



        if (
            !isset($_POST['username']) ||
            !isset($_POST['password']) ||
            !filter_var(trim($_POST['username']), FILTER_VALIDATE_EMAIL)
        ) {
            $_SESSION['erro'] = 'Login Invalido';
            $this->admin_login();
            return;
        }




        $usuario = trim(strtolower($_POST['username']));
        $senha = trim($_POST['password']);

        $admin = new AdminModel();

        $resultado = $admin->validar_login($usuario, $senha);


        if (is_bool($resultado)) {

            //login invalido
            $_SESSION['erro'] = 'Login inválido';
            $this->admin_login();
            return;
        } else {

            //login valido
            $_SESSION['admin'] = $resultado->id;
            $_SESSION['usuario_admin'] = $resultado->email;
            $_SESSION['nome_admin'] =     $resultado->nome;
            $_SESSION['sobrenome_admin'] = $resultado->sobrenome;
            $_SESSION['cpf_admin'] = $resultado->cpf;
            $_SESSION['telefone_admin'] = $resultado->telefone;
            $_SESSION['data_cadastro_admin'] = date('d/m/Y', strtotime($resultado->data_criacao));

            // die('AQUI');
            header("Location: ?a=index");
        }
    }

    public function logout()
    {
        unset($_SESSION['admin']);
        unset($_SESSION['usuario_admin']);
        unset($_SESSION['nome_admin']);
        unset($_SESSION['sobrenome_admin']);
        unset($_SESSION['cpf_admin']);
        unset($_SESSION['telefone_admin']);
        unset($_SESSION['data_cadastro_admin']);
        $this->index();
    }

    public function usuario_admin()
    {

        $u = new AdminModel();


        $usuarios = $u->listarClientes();


        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/usuario',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'usuarios' => $usuarios,
        ]);
    }

    public function detalhes_usuario()
    {

        // Store::printData($_GET);
        // die();

        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/detalhes_usuario',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ]);
    }

    public function editar_usuario()
    {
        try {
            // Receber os dados do POST
            $id = $_POST['id'];
            $nome = $_POST['name'];
            $sobrenome = $_POST['surname'];
            $email = strtolower(trim($_POST['email']));
            $cpf = $_POST['cpf'];
            $telefone = $_POST['telefone'];

            // Modelo para acessar o banco
            $usuario = new AdminModel();

            // Tenta atualizar os dados
            $alterar = $usuario->editarCliente($id, $nome, $sobrenome, $email, $cpf, $telefone);


            // Retorna sucesso ou falha com base no resultado
            if ($alterar) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Usuário atualizado com sucesso.',
                    'data' => $_POST
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Não foi possível atualizar o usuário.',
                    'data' => $_POST,
                ]);
            }
        } catch (Exception $e) {
            // Captura e exibe o erro no formato JSON
            echo json_encode([
                'success' => false,
                'message' => 'Ocorreu um erro ao tentar atualizar o usuário.',
                'data' => $_POST
            ]);
        }
        exit;
    }


    public function excluir_usuario()
    {
        try {


            $id = $_GET['id'];

            $usuario = new AdminModel();

            // Tenta atualizar os dados
            $inativar = $usuario->inativarCliente($id);

            if ($inativar) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Usuário atualizado com sucesso.',
                    'data' => $_GET
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Não foi possível atualizar o usuário.',
                    'data' => $_GET,
                ]);
            }
        } catch (Exception $e) {
            // Captura e exibe o erro no formato JSON
            echo json_encode([
                'success' => false,
                'message' => 'Ocorreu um erro ao tentar atualizar o usuário.',
                'data' => $_GET
            ]);
        }
        exit;
    }

    public function pedidos()
    {
        

        $vendas = new AdminModel();

        // Obter os dados
        $totalVenda = $vendas->totalVendas();
        $totalEstoque = $vendas->totalEstoque();
        $totalClientes = $vendas->totalClientes();
        $pedidos = $vendas->listarPedidos();


        // Store::printData($itens);

        // die();


        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/pedidos',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'totalVenda' => $totalVenda,
            'totalEstoque' => $totalEstoque,
            'totalClientes' => $totalClientes,
            'pedidos' => $pedidos,
        ]);
    }

    public function alterar_pedidos()
{
    try {
        if (isset($_FILES['anexos']) && $_FILES['anexos']['error'] === UPLOAD_ERR_OK) {
            $arquivo = $_FILES['anexos'];
        } else {
            $arquivo = null; // Caso não tenha anexo
        }

        $email = new EnviarEmail();
        $model = new AdminModel();

        // Dados do pedido
        $id_pedido = $_POST['id'];
        $usuario = $_POST['idUsuario'];
        $nomeCompletoUsuario = $_POST['nome_usuario'];
        $statusPedido = ucwords($_POST['status_pedido']);
        $totalPedido = $_POST['total_pedido'];
        $dataPedido = $_POST['data_pedido'];
        $metodoPagamento = $_POST['metodo_pagamento'];
        $statusPagamento = $_POST['status_pagamento'];
        $mensagem = $_POST['mensagem'];

        // Verificando se os dados necessários estão presentes
        if (empty($id_pedido) || empty($usuario) || empty($statusPedido) || empty($totalPedido)) {
            throw new Exception('Dados obrigatórios não fornecidos.');
        }

        $itens = $model->itens_pedidos($id_pedido);
        $Pegaremail = $model->emailUsuario($usuario);
        if (empty($Pegaremail)) {
            throw new Exception('Usuário não encontrado.');
        }
        $emailCliente = $Pegaremail[0]->email;

        // Atualizando status do pedido e pagamento
        $atualizaStatusPedido = $model->atualizaStatusPedido($id_pedido, $statusPedido);
        $atualizaStatusPagamento = $model->atualizaStatusPagamento($id_pedido, $statusPagamento);

        if (empty($atualizaStatusPedido) || empty($atualizaStatusPagamento)) {
            throw new Exception('Falha ao atualizar status do pedido ou pagamento.');
        }

        $statusPedidoAtualizado = $atualizaStatusPedido[0]->status_pedido;
        $statusPagamentoAtualizado = $atualizaStatusPagamento[0]->status_pagamento_id;

        // Corrigir status do pagamento
        $statusPagamentoCorrigido = match ($statusPagamentoAtualizado) {
            "1" => "Pendente",
            "2" => "Em Processamento",
            "3" => "Pago",
            "4" => "Recusado",
            "6" => "Cancelado",
            default => "Reembolsado",
        };

        // Chamar a função de envio de e-mail com anexo
        $envia = $email->enviarEmailProdutos(
            $nomeCompletoUsuario,
            ucwords($statusPedidoAtualizado),
            $statusPagamentoCorrigido,
            $mensagem,
            $emailCliente,
            $itens,
            $id_pedido,
            $metodoPagamento,
            $dataPedido,
            $totalPedido,
            $arquivo // Passando o anexo aqui
        );

        ob_clean();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        header('Content-Type: application/json; charset=UTF-8'); // Define o cabeçalho para JSON

        // Se tudo foi bem-sucedido, retorna um sucesso
        echo json_encode([
            'success' => true,
            'message' => 'Pedido atualizado com sucesso!',
            'data' => [
                'id_pedido' => $id_pedido,
                'status_pedido' => $statusPedido,
                'mensagem' => $mensagem,
            ],
        ]);
    } catch (Exception $e) {
        // Caso ocorra qualquer erro, captura e retorna a mensagem de erro
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao atualizar pedido.',
            'error' => $e->getMessage(), // Retorna a mensagem de erro específica
        ]);
    }
    exit;
}

    public function obterItensPedido()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPedido = $_POST['idPedido'];
            $vendas = new AdminModel();
            $itens = $vendas->itens_pedidos($idPedido);

            echo json_encode(['success' => true, 'data' => $itens]);
            exit;
        }

        echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
        exit;
    }

    public function excluir_pedido()
    {
        try {


            $id = $_GET['id'];


            $pedido = new AdminModel();

            // Tenta atualizar os dados
            $inativar = $pedido->inativarPedido($id);

            if ($inativar) {
                echo json_encode([
                    'success' => true,
                    'message' => 'pedido atualizado com sucesso.',
                    'data' => $_GET
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Não foi possível atualizar o pedido.',
                    'data' => $_GET,
                ]);
            }
        } catch (Exception $e) {
            // Captura e exibe o erro no formato JSON
            echo json_encode([
                'success' => false,
                'message' => 'Ocorreu um erro ao tentar atualizar o pedido.',
                'data' => $_GET
            ]);
        }
        exit;
    }

    public function ativar_pedido()
    {
        try {


            $id = $_GET['id'];


            $pedido = new AdminModel();

            // Tenta atualizar os dados
            $inativar = $pedido->ativarPedido($id);

            if ($inativar) {
                echo json_encode([
                    'success' => true,
                    'message' => 'pedido atualizado com sucesso.',
                    'data' => $_GET
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Não foi possível atualizar o pedido.',
                    'data' => $_GET,
                ]);
            }
        } catch (Exception $e) {
            // Captura e exibe o erro no formato JSON
            echo json_encode([
                'success' => false,
                'message' => 'Ocorreu um erro ao tentar atualizar o pedido.',
                'data' => $_GET
            ]);
        }
        exit;
    }

    public function pedidos_cancelados()
    {

        $vendas = new AdminModel();

        // Obter os dados
        $totalVenda = $vendas->totalVendas();
        $totalEstoque = $vendas->totalEstoque();
        $totalClientes = $vendas->totalClientes();
        $pedidos = $vendas->listarPedidosCancelados();


        // Store::printData($itens);

        // die();


        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/pedidos_cancelados',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'totalVenda' => $totalVenda,
            'totalEstoque' => $totalEstoque,
            'totalClientes' => $totalClientes,
            'pedidos' => $pedidos,
        ]);
    }

    public function pagamentos()
    {

        $db = new AdminModel();

        $pagamento = $db->listarPagamentos();
        $statusPagamento = $db->listarStatusPagamento();

        // Store::printData($pagamento);

        // die();



        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/pagamentos',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'pagamento' => $pagamento,
            'status' => $statusPagamento
        ]);
    }

    public function registrar_usuario()
    {
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];
        $nivel_usuario = $_POST['nivel_usuario'];


        $usuario = new AdminModel();

        try {
            $cadastrar = $usuario->cadastrarUsuario($nome, $sobrenome, $email, $cpf, $telefone, $senha, $nivel_usuario);

            Store::printData($cadastrar);
            // echo $cadastrar;

            if ($cadastrar == 'E-mail já cadastrado') {
                echo json_encode([
                    'status' => 'success',
                    'success' => true,
                    'message' => 'Usuario cadastrado com sucesso.',
                ]);
                http_response_code(200); // Cadastro bem-sucedido
            } else {
                echo json_encode([
                    'status' => 'error',
                    'error' => true,
                    'message' => 'Não foi possível cadastrar o usuario.',
                ]);
                http_response_code(400); // Define o status HTTP como erro (Bad Request)
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function criar_status_pagamento()
    {
        $nome = $_POST['nome'];

        $db = new AdminModel();

        $pagamento = $db->cadastrarStatusPagamento(strtolower(trim(str_replace(' ', '_', $nome))));

        if ($pagamento == 'Status já cadastrado') {
            echo json_encode([
                'status' => 'success',
                'success' => true,
                'message' => 'Usuario cadastrado com sucesso.',
            ]);
            http_response_code(200); // Cadastro bem-sucedido
        } else {
            echo json_encode([
                'status' => 'error',
                'error' => true,
                'message' => 'Não foi possível cadastrar o usuario.',
                'data' => $nome,
                'requisicao' => $_POST
            ]);
            http_response_code(400); // Define o status HTTP como erro (Bad Request)
        }
    }

    public function editar_pagamento()
    {

        $status = $_POST['status'];
        $pedido = $_POST['pedido'];

        // Status já está atualizado

        $db = new AdminModel();


        $atualizar = $db->atualizarPagamento($pedido, $status);



        if ($atualizar == 'Status já está atualizado') {
            echo json_encode([
                'status' => 'success',
                'success' => true,
                'message' => 'Pagamento atualizado com sucesso.',
            ]);
            http_response_code(200); // Cadastro bem-sucedido
        } else {
            echo json_encode([
                'status' => 'error',
                'error' => true,
                'message' => 'Não foi possível atualizar o pagamento.',
            ]);
            http_response_code(400); // Define o status HTTP como erro (Bad Request)
        }
    }

    public function produtos_categorias()
    {

        $db = new AdminModel();
        $categorias = $db->listarCategorias();



        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/categorias',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'categoria' => $categorias,
        ]);
        // die('AQIUO');
    }

    public function criar_categoria_produto()
    {

        $categoria = $_POST['categoria'];



        $db = new AdminModel();


        $cadastrar = $db->cadastrarCategoria($categoria);

        if ($cadastrar == 'Categoria já existe') {
            echo json_encode([
                'status' => 'success',
                'success' => true,
                'message' => 'Categoria cadastrada com sucesso.',
            ]);
            http_response_code(200); // Cadastro bem-sucedido
        } else {
            echo json_encode([
                'status' => 'error',
                'error' => true,
                'message' => 'Não foi possível cadastrar a categoria.',
            ]);
            http_response_code(400); // Define o status HTTP como erro (Bad Request)
        }
    }

    public function editar_categoria_produto()
    {
        $categoria = ucfirst($_POST['categoria']);
        $id = $_POST['id'];

        $db = new AdminModel();

        $atualizar = $db->alterarCategoria($id, $categoria);

        if ($atualizar == 'Categoria já está atualizado') {
            echo json_encode([
                'status' => 'success',
                'success' => true,
                'message' => 'Categoria cadastrada com sucesso.',
            ]);
            http_response_code(200); // Cadastro bem-sucedido
        } else {
            echo json_encode([
                'status' => 'error',
                'error' => true,
                'message' => 'Não foi possível cadastrar a categoria.',
            ]);
            http_response_code(400); // Define o status HTTP como erro (Bad Request)
        }
    }



    //* ==========================================

    public function produtos_tamanhos()
    {

        $db = new AdminModel();
        $tamanhos = $db->listarTamanhos();



        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/tamanhos',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'tamanho' => $tamanhos,
        ]);
        // die('AQIUO');
    }

    public function criar_tamanho_produto()
    {

        $tamanho = $_POST['tamanho'];



        $db = new AdminModel();


        $cadastrar = $db->cadastrarTamanho($tamanho);

        if ($cadastrar == 'Tamanho já existe') {
            echo json_encode([
                'status' => 'success',
                'success' => true,
                'message' => 'Tamanho cadastrado com sucesso.',
            ]);
            http_response_code(200); // Cadastro bem-sucedido
        } else {
            echo json_encode([
                'status' => 'error',
                'error' => true,
                'message' => 'Não foi possível cadastrar o Tamanho.',
            ]);
            http_response_code(400); // Define o status HTTP como erro (Bad Request)
        }
    }

    public function editar_tamanho_produto()
    {
        $categoria = ucfirst($_POST['tamanho']);
        $id = $_POST['id'];

        $db = new AdminModel();

        $atualizar = $db->alteraTamanho($id, $categoria);

        if ($atualizar == 'Tamanho já está atualizado') {
            echo json_encode([
                'status' => 'success',
                'success' => true,
                'message' => 'Tamanho cadastrado com sucesso.',
            ]);
            http_response_code(200); // Cadastro bem-sucedido
        } else {
            echo json_encode([
                'status' => 'error',
                'error' => true,
                'message' => 'Não foi possível cadastrar o tamanho.',
            ]);
            http_response_code(400); // Define o status HTTP como erro (Bad Request)
        }
    }

    public function produtos_cores()
    {

        $db = new AdminModel();
        $cores = $db->listarCores();



        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/produtos_cores',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'cor' => $cores,
        ]);
        // die('AQIUO');
    }

    public function criar_cor_produto()
    {

        $tamanho = $_POST['categoria'];



        $db = new AdminModel();


        $cadastrar = $db->cadastrarCor($tamanho);

        if ($cadastrar == 'Tamanho já existe') {
            echo json_encode([
                'status' => 'success',
                'success' => true,
                'message' => 'Tamanho cadastrado com sucesso.',
            ]);
            http_response_code(200); // Cadastro bem-sucedido
        } else {
            echo json_encode([
                'status' => 'error',
                'error' => true,
                'message' => 'Não foi possível cadastrar o Tamanho.',
            ]);
            http_response_code(400); // Define o status HTTP como erro (Bad Request)
        }
    }

    public function editar_cor_produto()
    {
        $categoria = ucfirst($_POST['categoria']);
        $id = $_POST['id'];

        $db = new AdminModel();

        $atualizar = $db->alteracor($id, $categoria);

        if ($atualizar == 'Tamanho já está atualizado') {
            echo json_encode([
                'status' => 'success',
                'success' => true,
                'message' => 'Tamanho cadastrado com sucesso.',
            ]);
            http_response_code(200); // Cadastro bem-sucedido
        } else {
            echo json_encode([
                'status' => 'error',
                'error' => true,
                'message' => 'Não foi possível cadastrar o tamanho.',
            ]);
            http_response_code(400); // Define o status HTTP como erro (Bad Request)
        }
    }

    public function gerencia_produtos()
    {

        $db = new AdminModel();

        $produtos = $db->buscarProdutos();

        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/gerencia_produtos',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'produto' => $produtos
        ]);
        // die('AQIUO');
    }

    public function cadastro_produtos()
    {

        $db = new AdminModel();

        $categoria = $db->listarCategorias();
        $cor = $db->listarCores();
        $tamanho = $db->listarTamanhos();

        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/cadastro_produtos',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'categoria' => $categoria,
            'cor' => $cor,
            'tamanho' => $tamanho
        ]);
        // die('AQIUO');
    }

    public function processa_cadastro_produto()
    {
        ob_clean();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        header('Content-Type: application/json; charset=UTF-8'); // Define o cabeçalho para JSON

        function converterPrecoParaDecimal($preco)
        {
            $preco = trim(str_replace('R$', '', $preco));
            $preco = str_replace('.', '', $preco);
            $preco = str_replace(',', '.', $preco);
            return (float) $preco;
        }

        if (!isset($_POST['nome_produto'], $_POST['descricao'], $_POST['preco'], $_POST['categoria'], $_POST['tamanho'], $_POST['cor'], $_FILES['imagem'])) {
            echo json_encode(["status" => "error", "mensagem" => "Preencha todos os campos obrigatórios."]);
            exit;
        }

        $db = new AdminModel();

        $nome = $_POST['nome_produto'];
        $descricao = $_POST['descricao'];
        $preco = converterPrecoParaDecimal($_POST['preco']);
        $categoria = $_POST['categoria'];
        $tamanho = $_POST['tamanho'];
        $cor = $_POST['cor'];
        $imagem = $_FILES['imagem']['name'];
        $visivel = $_POST['visivel'];

        $diretorio = "../../public/assets/images/produtos/";

        // Valida imagem
        if (!isset($_FILES['imagem']) || $_FILES['imagem']['name'] == "") {
            echo json_encode(["status" => "error", "mensagem" => "É obrigatório enviar uma imagem."]);
            exit;
        }

        $imagem = $_FILES['imagem'];
        $nomeArquivo = basename($imagem['name']);
        $caminhoFinal = $diretorio . $nomeArquivo;
        $tipoArquivo = strtolower(pathinfo($caminhoFinal, PATHINFO_EXTENSION));

        $formatosPermitidos = ['jpg', 'jpeg', 'png', 'tiff', 'jfif', 'webp'];

        if (!in_array($tipoArquivo, $formatosPermitidos)) {
            echo json_encode(["status" => "error", "mensagem" => "Formato de imagem não permitido. Use JPG, JPEG, PNG, TIFF, JFIF ou WEBP."]);
            exit;
        }

        if ($imagem['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(["status" => "error", "mensagem" => "Erro no upload: " . $imagem['error']]);
            exit;
        }

        // Garante que o diretório existe
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        if (!move_uploaded_file($imagem['tmp_name'], $caminhoFinal)) {
            echo json_encode(["status" => "error", "mensagem" => "Erro ao salvar a imagem no servidor."]);
            exit;
        }

        // Insere no banco de dados
        $cadastra = $db->cadastrarProduto($nome, $descricao, $preco, $categoria, $tamanho, $cor, $nomeArquivo, $visivel);

        if ($cadastra) {
            echo json_encode(["status" => "success", "mensagem" => "Produto cadastrado com sucesso!"]);
        } else {
            echo json_encode(["status" => "error", "mensagem" => "Erro ao cadastrar produto no banco de dados."]);
        }
    }

    public function edita_cadastro_produto()
    {
        ob_clean();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        header('Content-Type: application/json; charset=UTF-8');

        function converterPrecoParaDecimall($preco)
        {
            $preco = trim(str_replace('R$', '', $preco));
            $preco = str_replace('.', '', $preco);
            $preco = str_replace(',', '.', $preco);
            return (float) $preco;
        }

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo json_encode(["status" => "error", "mensagem" => "ID do produto não encontrado."]);
            exit;
        }
        $id = (int) $_GET['id'];

        if (!isset($_POST['nome_produto'], $_POST['descricao'], $_POST['preco'], $_POST['categoria'], $_POST['tamanho'], $_POST['cor'], $_POST['visivel'])) {
            echo json_encode(["status" => "error", "mensagem" => "Preencha todos os campos obrigatórios."]);
            exit;
        }

        $db = new AdminModel();

        $nome = $_POST['nome_produto'];
        $descricao = $_POST['descricao'];
        $preco = converterPrecoParaDecimall($_POST['preco']);
        $categoria = $_POST['categoria'];
        $tamanho = $_POST['tamanho'];
        $cor = $_POST['cor'];
        $visivel = $_POST['visivel'];

        $diretorio = "../../public/assets/images/produtos/";

        // Verifica se o usuário enviou uma nova imagem
        if (!empty($_FILES['imagem']['name'])) {
            $imagem = $_FILES['imagem'];
            $nomeArquivo = time() . "_" . basename($imagem['name']); // Evita nomes duplicados
            $caminhoFinal = $diretorio . $nomeArquivo;
            $tipoArquivo = strtolower(pathinfo($caminhoFinal, PATHINFO_EXTENSION));

            $formatosPermitidos = ['jpg', 'jpeg', 'png', 'tiff', 'jfif', 'webp'];
            if (!in_array($tipoArquivo, $formatosPermitidos)) {
                echo json_encode(["status" => "error", "mensagem" => "Formato de imagem não permitido. Use JPG, JPEG, PNG, TIFF, JFIF ou WEBP."]);
                exit;
            }

            if (!move_uploaded_file($imagem['tmp_name'], $caminhoFinal)) {
                echo json_encode(["status" => "error", "mensagem" => "Erro ao salvar a imagem no servidor."]);
                exit;
            }

            // Remove a imagem antiga, se existir
            if (!empty($_POST['imagem_atual']) && file_exists($diretorio . $_POST['imagem_atual'])) {
                unlink($diretorio . $_POST['imagem_atual']);
            }
        } else {
            // Se nenhuma nova imagem for enviada, mantém a anterior
            $nomeArquivo = $_POST['imagem_atual'];
        }

        // Atualiza o produto no banco de dados
        $edita = $db->editarProduto($nome, $descricao, $preco, $categoria, $tamanho, $cor, $nomeArquivo, $visivel, $id);

        if ($edita) {
            echo json_encode(["status" => "success", "mensagem" => "Produto atualizado com sucesso!"]);
        } else {
            echo json_encode(["status" => "error", "mensagem" => "Erro ao atualizar produto no banco de dados."]);
        }
    }

    public function inativar_produto()
    {
        ob_clean();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        header('Content-Type: application/json; charset=UTF-8'); // Define o cabeçalho para JSON
        // Verifica se o ID foi enviado
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            echo json_encode([
                "status" => "error",
                "mensagem" => "ID do produto não informado."
            ]);
            exit;
        }

        $id = intval($_POST['id']); // Garante que o ID seja um número inteiro válido
        $db = new AdminModel();

        // Chama a função do modelo para inativar o produto
        $inativado = $db->inativarProduto($id);

        if ($inativado) {
            echo json_encode([
                "status" => "success",
                "mensagem" => "Produto inativado com sucesso!"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "mensagem" => "Erro ao inativar o produto. Tente novamente."
            ]);
        }

        exit;
    }

    public function ativar_produto()
    {
        ob_clean();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        header('Content-Type: application/json; charset=UTF-8'); // Define o cabeçalho para JSON
        // Verifica se o ID foi enviado
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            echo json_encode([
                "status" => "error",
                "mensagem" => "ID do produto não informado."
            ]);
            exit;
        }

        $id = intval($_POST['id']); // Garante que o ID seja um número inteiro válido
        $db = new AdminModel();

        // Chama a função do modelo para inativar o produto
        $ativado = $db->ativarProduto($id);

        if ($ativado) {
            echo json_encode([
                "status" => "success",
                "mensagem" => "Produto ativado com sucesso!"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "mensagem" => "Erro ao ativar o produto. Tente novamente."
            ]);
        }

        exit;
    }

    public function editar_produtos()
    {

        $id = $_GET['id'];

        $db = new AdminModel();

        $categoria = $db->listarCategorias();
        $cor = $db->listarCores();
        $tamanho = $db->listarTamanhos();
        $produto = $db->listarProdutoEspecifico($id);

        // echo "<br> Categoria <br>";
        //     Store::printData($categoria);
        //     echo "<br> COR <br>";
        //     Store::printData($cor);
        //     echo "<br> tamanho <br>";
        //     Store::printData($tamanho); 
        //     echo "<br> produto <br>";
        //     Store::printData($produto);
        //     die();

        Store::Layout_admin([
            'admin/layout/html_header',
            'admin/layout/header',
            'admin/editar_produtos',
            'admin/layout/footer',
            'admin/layout/html_footer',
        ], [
            'categoria' => $categoria,
            'cor' => $cor,
            'tamanho' => $tamanho,
            'produto' => $produto[0]
        ]);
    }
}
