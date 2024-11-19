<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use core\models\Pedidos;
use PDO;
use Exception;

class Pedido{
    


    public function pagamento_processado()
{
    date_default_timezone_set('America/Sao_Paulo');

    $pedido = new Pedidos();
    $produto = new Produtos();

    $id_usuario = $_SESSION['cliente'];
    $metodo_pagamento = $_POST['metodo_pagamento'];
    $total_pedido = $_SESSION['totalCarrinho'];
    $ids_produtos = array_keys($_SESSION['carrinho']);
    $data_pedido = date('Y/m/d');

    $metodo_pagamento_id = match ($metodo_pagamento) {
        'cartao_credito' => 1,
        'transferencia' => 2,
        'pix' => 3,
        default => throw new Exception('Método de pagamento inválido.')
    };

    try {
        $produtos = $produto->buscarProdutosCarrinho($ids_produtos);

        foreach ($produtos as $prod) {
            $id_produto = $prod->id;
            $quantidade_carrinho = $_SESSION['carrinho'][$id_produto];
            $cor_id = $prod->cor_id;
            $tamanho_id = $prod->tamanho_id;

            $estoque = $produto->listarEstoque($id_produto, $cor_id, $tamanho_id);
            $estoque_disponivel = $estoque[0]->quantidade_disponivel ?? 0;

            if ($estoque_disponivel < $quantidade_carrinho) {
                $_SESSION['erro'] = "Estoque insuficiente para o produto: {$prod->nome}.";
                header("Location: ?a=metodo_pagamento");
                exit;
            }
        }

        $pedido->inserePedido($id_usuario, $data_pedido, $total_pedido);
        $idPedido = $_SESSION['id_pedido'];
        $pedido->inserePagamento($idPedido, $metodo_pagamento_id, 1, $data_pedido);

        foreach ($produtos as $prod) {
            $id_produto = $prod->id;
            $cor_id = $prod->cor_id;
            $tamanho_id = $prod->tamanho_id;
            $quantidade = $_SESSION['carrinho'][$id_produto];
            $preco_unitario = $prod->preco;

            $pedido->insereItensPedidos($idPedido, $id_produto, $cor_id, $tamanho_id, $quantidade, $preco_unitario);
        }

        unset($_SESSION['erro']);
        $_SESSION['sucesso'] = "Pagamento processado com sucesso!";
        header("Location: ?a=metodo_pagamento");
        exit;
    } catch (Exception $e) {
        $_SESSION['erro'] = "Erro ao processar o pagamento: " . $e->getMessage();
        header("Location: ?a=metodo_pagamento");
        exit;
    }
}



}