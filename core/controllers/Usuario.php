<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Pedidos;
use core\models\Produtos;
use PDO;

class Usuario{
    

    public function user_account(){

        $db = new Clientes();
        $id = $_SESSION['cliente'];

        $usuario = $db->listarClienteID($id);
        $endereco = $db->listarEnderecoCliente($id);

        if(Store::clienteLogado()){
            Store::Layout([
                'layout/html_header',
                'layout/header',
                'user_account',
                'layout/footer',
                'layout/html_footer',
            ], [
                'usuario' => $usuario,
                'endereco' => $endereco
            ]);
        } else {
            Store::redirect('login');
        }

        
    }

    public function user_pedidos() {
        // Store::printData($_SESSION);
        // die();


        $idUsuario = $_SESSION['cliente'];

        $pedidos = new Pedidos();
        $pedido = $pedidos->listarPedidosGeral($idUsuario);
        
        if (Store::clienteLogado()) {
            Store::Layout([
                'layout/html_header',
                'layout/header',
                'user_pedidos',
                'layout/footer',
                'layout/html_footer',
            ], ['pedidos' => $pedido]); // Passa os pedidos com a chave "pedidos"
        } else {
            Store::redirect('login');
        }
    }

    public function user_config(){
        $db = new Clientes();
        $id = $_SESSION['cliente'];

        $usuario = $db->listarClienteID($id);
        $endereco = $db->listarEnderecoCliente($id);

        if(Store::clienteLogado()){
            Store::Layout([
                'layout/html_header',
                'layout/header',
                'user_config',
                'layout/footer',
                'layout/html_footer',
            ], [
                'usuario' => $usuario,
                'endereco' => $endereco
            ]);
        } else {
            Store::redirect('login');
        }
    }


    public function pedido() {
        if (Store::clienteLogado()) {
            $idpedido = $_GET['id'];
    
            $pedidos = new Pedidos();
            $produtos = new Produtos();
    
            $pedido = $pedidos->listarPedidosEspec($idpedido);
            $itens = $pedidos->listarItensPedido($idpedido);
    
            if (!$pedido || !$itens) {
                // Redireciona se o pedido ou itens não existirem
                Store::redirect('user_pedidos');
                return;
            }
    
            $produtosDetalhes = [];
            foreach ($itens as $item) {
                $produtosDetalhes[] = $produtos->buscarProdutosIds($item->produto_id)[0];
            }
    
            // Renderiza o layout com as informações dinâmicas
            Store::Layout([
                'layout/html_header',
                'layout/header',
                'pedido',
                'layout/footer',
                'layout/html_footer',
            ], [
                'pedido' => $pedido[0],
                'itens' => $itens,
                'produtos' => $produtosDetalhes,
            ]);
        } else {
            Store::redirect('login');
        }
    }

    public function atualizar_configuracoes() {
    try {
        $db = new Clientes();
        
        // Obtém os dados do formulário
        $id = $_SESSION['cliente'];


        $usuario = $db->listarClienteID($id);


        $nome = !empty($_POST['nome']) ? $_POST['nome'] : $usuario[0]->nome;
        $sobrenome = !empty($_POST['sobrenome']) ? $_POST['sobrenome'] : $usuario[0]->sobrenome;
        $email = !empty($_POST['email']) ? $_POST['email'] : $usuario[0]->email;
        $cpf = !empty($_POST['cpf']) ? $_POST['cpf'] : $usuario[0]->cpf;
        $telefone = !empty($_POST['telefone']) ? $_POST['telefone'] : $usuario[0]->telefone;

        // Verificar se os dados são válidos (você pode adicionar validações extras aqui)
        // if (empty($nome) || empty($sobrenome) || empty($email) || empty($cpf) || empty($telefone)) {
        //     echo json_encode(["status" => "error", "mensagem" => "Todos os campos devem ser preenchidos."]);
        //     die();
        // }

        // Realiza a atualização dos dados
        $result = $db->alteraDadosInfoPessoal($id, $nome, $sobrenome, $email, $cpf, $telefone);

        if ($result) {
            // Caso a atualização seja bem-sucedida, retornamos sucesso
            echo json_encode([
                'status' => 'success',
                'mensagem' => 'Informações atualizadas com sucesso!'
            ]);
        } else {
            // Se a atualização falhar, retornamos um erro
            throw new Exception("Erro ao atualizar os dados no banco de dados.");
        }
    } catch (Exception $e) {
        // Caso haja algum erro, retornamos uma resposta de erro
        echo json_encode([
            'status' => 'error',
            'mensagem' => $e->getMessage()
        ]);
    }

    die(); // Para garantir que o script pare por aqui
}

    public function atualizar_seguranca(){

        Store::printdata($_POST);


        die("AQUI");
    }
    


}