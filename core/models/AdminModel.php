<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;
use Exception;
use PDOException;

class AdminModel
{

    public function validar_login($usuario, $senha)
    {
        $sql = new Database();

        $param = [
            ':usuario' => $usuario
        ];

        $sql = new Database();
        $resultado = $sql->select("SELECT * FROM usuario WHERE email = :usuario AND ativo = 1 AND nivel_usuario = 1", $param);


        if (count($resultado) != 1) {
            //usuario nao existe
            return false;
        } else {
            //usuario existe
            $usuario = $resultado[0];

            if (!password_verify($senha, $usuario->senha)) {
                //usuario existe mas a senha nao corresponde
                return false;
            } else {

                //login valido 
                return $usuario;
            }
        }
    }

    public function totalVendas()
    {
        $sql = new Database();


        $res = $sql->select("SELECT IFNULL(ROUND(SUM(total_pedido)), 0) AS total_vendas FROM pedidos WHERE status_pedido = 'entregue';");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function totalEstoque()
    {
        $sql = new Database();


        $res = $sql->select("SELECT IFNULL(SUM(quantidade_disponivel), 0) AS total_estoque FROM estoque;");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function totalClientes()
    {
        $sql = new Database();


        $res = $sql->select("SELECT COUNT(*) AS novos_clientes FROM usuario WHERE MONTH(data_criacao) = MONTH(CURDATE()) - 1 AND YEAR(data_criacao) = YEAR(CURDATE())");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function listarPedidos()
    {
        $sql = new Database();


        $res = $sql->select("SELECT pedidos.id AS pedido_id, usuario.id AS usuario_id, CONCAT(usuario.nome, ' ', usuario.sobrenome) AS nome_usuario, pedidos.data_pedido, pedidos.status_pedido, pedidos.total_pedido, pedidos.data_criacao, pedidos.data_atualizacao, GROUP_CONCAT(CONCAT('ID: ', itens_pedidos.id, ', Produto: ', produtos.nome_produto, ', Cor: ', produto_cores.cor, ', Tamanho: ', produto_tamanho.tamanho, ', Quantidade: ', itens_pedidos.quantidade, ', Preço Unitário: ', FORMAT(itens_pedidos.preco_unitario, 2)) SEPARATOR '; ') AS itens_pedido, metodo_pagamento.metodo AS metodo_pagamento, status_pagamento.id AS status_pagamento FROM pedidos JOIN usuario ON pedidos.id_usuario = usuario.id LEFT JOIN itens_pedidos ON pedidos.id = itens_pedidos.pedido_id LEFT JOIN produtos ON itens_pedidos.produto_id = produtos.id LEFT JOIN produto_cores ON itens_pedidos.cor_id = produto_cores.id LEFT JOIN produto_tamanho ON itens_pedidos.tamanho_id = produto_tamanho.id LEFT JOIN pagamento ON pedidos.id = pagamento.pedido_id LEFT JOIN metodo_pagamento ON pagamento.metodo_pagamento_id = metodo_pagamento.id LEFT JOIN status_pagamento ON pagamento.status_pagamento_id = status_pagamento.id WHERE pedidos.status_pedido != 'cancelado' GROUP BY pedidos.id ORDER BY pedidos.id;");

        return $res;
    }

    public function listarPedidosCancelados()
    {
        $sql = new Database();


        $res = $sql->select("SELECT pedidos.id AS pedido_id, usuario.id AS usuario_id, CONCAT(usuario.nome, ' ', usuario.sobrenome) AS nome_usuario, pedidos.data_pedido, pedidos.status_pedido, pedidos.total_pedido, pedidos.data_criacao, pedidos.data_atualizacao, GROUP_CONCAT(CONCAT('ID: ', itens_pedidos.id, ', Produto: ', produtos.nome_produto, ', Cor: ', produto_cores.cor, ', Tamanho: ', produto_tamanho.tamanho, ', Quantidade: ', itens_pedidos.quantidade, ', Preço Unitário: ', FORMAT(itens_pedidos.preco_unitario, 2)) SEPARATOR '; ') AS itens_pedido, metodo_pagamento.metodo AS metodo_pagamento, status_pagamento.id AS status_pagamento FROM pedidos JOIN usuario ON pedidos.id_usuario = usuario.id LEFT JOIN itens_pedidos ON pedidos.id = itens_pedidos.pedido_id LEFT JOIN produtos ON itens_pedidos.produto_id = produtos.id LEFT JOIN produto_cores ON itens_pedidos.cor_id = produto_cores.id LEFT JOIN produto_tamanho ON itens_pedidos.tamanho_id = produto_tamanho.id LEFT JOIN pagamento ON pedidos.id = pagamento.pedido_id LEFT JOIN metodo_pagamento ON pagamento.metodo_pagamento_id = metodo_pagamento.id LEFT JOIN status_pagamento ON pagamento.status_pagamento_id = status_pagamento.id WHERE pedidos.status_pedido = 'cancelado' GROUP BY pedidos.id ORDER BY pedidos.id;");

        return $res;
    }

    public function itens_pedidos($idPedido)
    {
        $sql = new Database();

        $param = [
            ':id' => $idPedido
        ];

        $res = $sql->select("SELECT itens_pedidos.produto_id AS item_id, produtos.nome_produto AS produto_nome, produto_cores.cor AS cor_nome, produto_tamanho.tamanho AS tamanho_nome, itens_pedidos.quantidade, itens_pedidos.preco_unitario FROM itens_pedidos LEFT JOIN produtos ON itens_pedidos.produto_id = produtos.id LEFT JOIN produto_cores ON itens_pedidos.cor_id = produto_cores.id LEFT JOIN produto_tamanho ON itens_pedidos.tamanho_id = produto_tamanho.id WHERE itens_pedidos.pedido_id = :id;", $param);

        return $res;
    }
    public function listarPedidosRecentes()
    {
        $sql = new Database();

        $res = $sql->select("SELECT pedidos.id AS pedido_id, CONCAT(usuario.nome, ' ', usuario.sobrenome) AS nome_usuario, pedidos.data_pedido, pedidos.status_pedido, pedidos.total_pedido, pedidos.data_criacao, pedidos.data_atualizacao FROM pedidos JOIN usuario ON pedidos.id_usuario = usuario.id ORDER BY pedidos.data_pedido DESC LIMIT 5;");

        return $res;
    }

    public function listarClientes()
    {
        $sql = new Database();

        $res = $sql->select("SELECT * FROM usuario WHERE ativo = 1");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function editarCliente($id, $nome, $sobrenome, $email, $cpf, $telefone)
    {

        try {


            $sql = new Database();

            $param = [
                ':id' => $id,
                ':nome' => $nome,
                ':sobrenome' => $sobrenome,
                ':email' => $email,
                ':cpf' => $cpf,
                ':telefone' => $telefone,
            ];

            $res = $sql->update("UPDATE usuario SET nome = :nome, sobrenome = :sobrenome, email = :email, cpf = :cpf, telefone = :telefone, data_atualizacao = NOW() WHERE id = :id", $param);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function inativarCliente($id)
    {

        try {


            $sql = new Database();

            $param = [
                ':id' => $id,
            ];

            $res = $sql->update("UPDATE usuario SET ativo = 0, data_atualizacao = NOW() WHERE id = :id", $param);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function emailUsuario($id)
    {
        $sql = new Database();


        $param = [
            ':id' => $id,
        ];

        $res = $sql->select("SELECT email FROM usuario WHERE id = :id", $param);

        return $res;
    }

    public function atualizaStatusPedido($id_pedido, $status)
    {
        $sql = new Database();

        $param = [
            ':id_pedido' => $id_pedido,
            ':status' => $status,
        ];

        $res = $sql->update("UPDATE pedidos SET status_pedido = :status, data_atualizacao = NOW() WHERE id = :id_pedido", $param);

        $param2 = [
            ':id_pedido' => $id_pedido,
        ];

        $res = $sql->select("SELECT status_pedido FROM pedidos WHERE id = :id_pedido", $param2);

        return $res;
    }

    public function atualizaStatusPagamento($id_pedido, $status)
    {
        $sql = new Database();

        $param = [
            ':id_pedido' => $id_pedido,
            ':status' => $status,
        ];

        $res = $sql->update("UPDATE pagamento SET status_pagamento_id = :status, data_atualizacao = NOW() WHERE pedido_id = :id_pedido", $param);

        $param2 = [
            ':id_pedido' => $id_pedido,
        ];

        $res = $sql->select("SELECT status_pagamento_id FROM pagamento WHERE pedido_id = :id_pedido", $param2);

        return $res;
    }


    public function inativarPedido($id)
    {
        try {


            $sql = new Database();

            $param = [
                ':id' => $id,
            ];

            $res = $sql->update("UPDATE pedidos SET status_pedido = 'cancelado', data_atualizacao = NOW() WHERE id = :id", $param);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    public function ativarPedido($id)
    {
        try {


            $sql = new Database();

            $param = [
                ':id' => $id,
            ];

            $res = $sql->update("UPDATE pedidos SET status_pedido = 'pendente', data_atualizacao = NOW() WHERE id = :id", $param);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function cadastrarUsuario($nome, $sobrenome, $email, $cpf, $senha, $telefone, $nivel)
    {
        // Instancia o objeto da classe de banco de dados
        $sql = new Database();

        $paramCheck = [
            ':email' => trim(strtolower($email)),
        ];

        // Define os parâmetros para o SQL
        $param = [
            ':nome' => $nome,
            ':sobrenome' => $sobrenome,
            ':email' => trim(strtolower($email)), // Normaliza o email para minúsculas e remove espaços extras
            ':cpf' => $cpf,
            ':senha' => password_hash(trim($senha), PASSWORD_DEFAULT, ['cost' => 10]), // Criptografa a senha
            ':telefone' => $telefone,
            ':nivel_usuario' => $nivel,
            ':token' => NULL, // Token nulo por padrão
            ':ativo' => 1     // Ativa o usuário por padrão
        ];

        try {
            // Verifica se o e-mail já existe no banco de dados
            $res = $sql->select("SELECT * FROM usuario WHERE email = :email", $paramCheck);

            if (count($res) != 0) {
                echo ("E-mail já cadastrado");
            } else {

                // Tenta executar o comando SQL com os parâmetros
                $sql->insert("INSERT INTO usuario (nome, sobrenome, email, cpf, telefone, senha, nivel_usuario, token, ativo) VALUES (:nome, :sobrenome, :email, :cpf, :telefone, :senha, :nivel_usuario, :token, :ativo )", $param);

                $verifica = $sql->select("SELECT * FROM usuario WHERE email = :email", $paramCheck);

                if (count($verifica) != 0) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            // Captura o erro e o registra ou exibe
            error_log('Erro ao cadastrar usuário: ' . $e->getMessage());
            return false;
        }
    }

    public function verificaUsuario($id)
    {
        $sql = new Database();

        $param = [
            ':id' => $id
        ];


        $res = $sql->select("SELECT nivel_usuario FROM usuario WHERE id = :id", $param);

        return $res;
    }

    public function listarPagamentos()
    {

        $sql = new Database();

        $res = $sql->select("SELECT pagamento.id AS pagamento_id, pagamento.pedido_id, status_pagamento.nome_status AS status_pagamento, metodo_pagamento.metodo AS metodo_pagamento FROM pagamento JOIN status_pagamento ON pagamento.status_pagamento_id = status_pagamento.id JOIN metodo_pagamento ON pagamento.metodo_pagamento_id = metodo_pagamento.id;");


        return $res;
    }

    public function listarStatusPagamento()
    {
        $sql = new Database();

        $res = $sql->select("SELECT * FROM status_pagamento;");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function cadastrarStatusPagamento($status)
    {
        $sql = new Database();
        $param = [
            ':nome_status' => strtolower(trim($status))
        ];

        // Verifica se o status já existe
        $res = $sql->select("SELECT * FROM status_pagamento WHERE nome_status = :nome_status", $param);

        if (count($res) != 0) {
            echo "Status já cadastrado";
            return false;
        } else {
            // Corrigindo a inserção
            $sql->insert("INSERT INTO status_pagamento (nome_status) VALUES (:nome_status)", $param);

            // Verifica se foi inserido com sucesso
            $verifica = $sql->select("SELECT * FROM status_pagamento WHERE nome_status = :nome_status", $param);

            return count($verifica) != 0;
        }
    }


    public function atualizarPagamento($pedido, $status)
    {
        $sql = new Database();
        $param = [
            ':pedido_id' => $pedido,
            ':status_pagamento_id' => $status
        ];

        $verif = $sql->select("SELECT * FROM pagamento WHERE status_pagamento_id = :status_pagamento_id AND pedido_id = :pedido_id", $param);

        $dados = $verif[0]->status_pagamento_id;

        if ($dados != $status) {

            $sql->update("UPDATE pagamento SET status_pagamento_id = :status_pagamento_id WHERE pedido_id = :pedido_id;", $param);

            return true;
        } else {
            echo "Status já está atualizado";
        }
    }
}
