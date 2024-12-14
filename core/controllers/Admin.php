<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use core\models\AdminModel;
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
            'totalClientes' => $totalClientes
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
}
