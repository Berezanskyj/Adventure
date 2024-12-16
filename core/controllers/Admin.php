<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use core\models\AdminModel;
use Exception;
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
            $email = $_POST['email'];
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

        $vendas = new AdminModel();
        $pedidos = $vendas->listarPedidos();

        Store::printData($pedidos);
        die();
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
}
