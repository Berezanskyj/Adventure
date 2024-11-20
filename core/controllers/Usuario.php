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

        if(Store::clienteLogado()){
            Store::Layout([
                'layout/html_header',
                'layout/header',
                'user_account',
                'layout/footer',
                'layout/html_footer',
            ]);
        } else {
            Store::redirect('login');
        }

        
    }

    public function user_pedidos() {


        $idUsuario = $_SESSION['id'];

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

        if(Store::clienteLogado()){
            Store::Layout([
                'layout/html_header',
                'layout/header',
                'user_config',
                'layout/footer',
                'layout/html_footer',
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
    


}