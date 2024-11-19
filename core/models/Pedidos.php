<?php

namespace core\models;
use core\classes\Database;
use core\classes\Store;
use Exception;

class Pedidos {

    public function inserePedido($id_usuario, $data_pedido, $total_pedido)
{
    $sql = new Database();

    $param = [
        ':id_usuario' => $id_usuario,
        ':data_pedido' => $data_pedido,
        ':total_pedido' => $total_pedido,
    ];

    try {
        // Realiza a inserção
        $sql->insert(
            "INSERT INTO pedidos (id_usuario, data_pedido, status_pedido, total_pedido) 
            VALUES (:id_usuario, :data_pedido, 'pendente', :total_pedido);", 
            $param
        );

        // Obtém o ID gerado
        $lastId = $sql->lastInsertId();

        $_SESSION['id_pedido'] = $lastId;

        return $lastId;
    } catch (Exception $e) {
        throw new Exception('Erro ao inserir pedido: ' . $e->getMessage());
    }
}

    public function inserePagamento($pedidoid, $metodo_pagamento_id, $status_pagamento_id, $data_pagamento)
{
    // Instancia o objeto de conexão ao banco de dados
    $sql = new Database();

    // Parâmetros para a consulta
    $param = [
        ':pedidoid' => $pedidoid,
        ':metodo' => $metodo_pagamento_id,
        ':status' => $status_pagamento_id,
        ':data' => $data_pagamento
    ];

    try {
        // Inserção no banco de dados
        $sql->insert(
            "INSERT INTO pagamento (pedido_id, metodo_pagamento_id, status_pagamento_id, data_pagamento) 
            VALUES (:pedidoid, :metodo, :status, :data)", 
            $param
        );

        return true;
    } catch (Exception $e) {
        // Captura e relança o erro
        throw new Exception('Erro ao inserir pagamento: ' . $e->getMessage());
        return false;
    }
}

public function insereItensPedidos($pedido_id, $produto_id, $cor_id, $tamanho_id, $quantidade, $precoUnitario)
{
    $sql = new Database();

    $param = [
        ':pedido_id' => $pedido_id,
        ':produto_id' => $produto_id,
        ':cor_id' => $cor_id,
        ':tamanho_id' => $tamanho_id,
        ':quantidade' => $quantidade,
        ':precoUnitario' => $precoUnitario,
    ];

    try {
        $sql->insert(
            "INSERT INTO itens_pedidos (pedido_id, produto_id, cor_id, tamanho_id, quantidade, preco_unitario) 
            VALUES (:pedido_id, :produto_id, :cor_id, :tamanho_id, :quantidade, :precoUnitario)",
            $param
        );

        return true;

    } catch (Exception $e) {
        throw new Exception('Erro ao inserir itens_pedido: ' . $e->getMessage());
    }
}

public function removerPedido($idPedido){

    $sql = new Database();

    $param = [
        ':id' => $idPedido,
    ];

    $sql->delete("DELETE FROM pedidos where id = :id", $param);
    $sql->delete("DELETE FROM itens_pedidos where pedido_id = :id", $param);

}



    
}