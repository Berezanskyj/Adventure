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


        $res = $sql->select("SELECT pedidos.id AS pedido_id, usuario.id AS usuario_id, CONCAT(usuario.nome, ' ', usuario.sobrenome) AS nome_usuario, pedidos.data_pedido, pedidos.status_pedido, pedidos.total_pedido, pedidos.data_criacao, pedidos.data_atualizacao, GROUP_CONCAT(CONCAT('ID: ', itens_pedidos.id, ', Produto: ', produtos.nome_produto, ', Cor: ', produto_cores.cor, ', Tamanho: ', produto_tamanho.tamanho, ', Quantidade: ', itens_pedidos.quantidade, ', Preço Unitário: ', FORMAT(itens_pedidos.preco_unitario, 2)) SEPARATOR '; ') AS itens_pedido, metodo_pagamento.metodo AS metodo_pagamento, status_pagamento.id AS status_pagamento_id, status_pagamento.nome_status AS status_pagamento FROM pedidos JOIN usuario ON pedidos.id_usuario = usuario.id LEFT JOIN itens_pedidos ON pedidos.id = itens_pedidos.pedido_id LEFT JOIN produtos ON itens_pedidos.produto_id = produtos.id LEFT JOIN produto_cores ON itens_pedidos.cor_id = produto_cores.id LEFT JOIN produto_tamanho ON itens_pedidos.tamanho_id = produto_tamanho.id LEFT JOIN pagamento ON pedidos.id = pagamento.pedido_id LEFT JOIN metodo_pagamento ON pagamento.metodo_pagamento_id = metodo_pagamento.id LEFT JOIN status_pagamento ON pagamento.status_pagamento_id = status_pagamento.id WHERE pedidos.status_pedido != 'cancelado' GROUP BY pedidos.id ORDER BY pedidos.id;");


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

        $res = $sql->select("SELECT pedidos.id AS pedido_id, CONCAT(usuario.nome, ' ', usuario.sobrenome) AS nome_usuario, pedidos.data_pedido, pedidos.status_pedido, pedidos.total_pedido, pedidos.data_criacao, pedidos.data_atualizacao FROM pedidos JOIN usuario ON pedidos.id_usuario = usuario.id ORDER BY pedidos.data_pedido ASC LIMIT 5;");

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

    public function listarCategorias()
    {
        $sql = new Database();
        $res = $sql->select("SELECT * FROM produto_categoria");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function cadastrarCategoria($categoria)
    {
        $sql = new Database();
        $param = [
            ':nome_categoria' => $categoria,
        ];

        $verificar = $sql->select("SELECT * FROM produto_categoria WHERE nome_categoria = :nome_categoria", $param);

        if (count($verificar) != 0) {
            echo "Categoria já existe";
            return false;
        } else {
            $sql->insert("INSERT INTO produto_categoria (nome_categoria) VALUES (:nome_categoria)", $param);

            $verificar = $sql->select("SELECT * FROM produto_categoria WHERE nome_categoria = :nome_categoria", $param);

            return true;
        }
    }

    public function alterarCategoria($id, $nome)
    {
        $sql = new Database();
        $param = [
            ':id' => $id,
            ':nome_categoria' => $nome,
        ];

        $param2 = [
            ':id' => $id,
        ];

        $verificar = $sql->select("SELECT nome_categoria FROM produto_categoria WHERE id = :id", $param2);

        $dados = $verificar[0]->nome_categoria;

        if (isset($dados) || $dados != $nome) {
            $sql->update("UPDATE produto_categoria SET nome_categoria = :nome_categoria WHERE id = :id", $param);
            return true;
        } else {
            echo "Categoria já está atualizado";
        }
    }




    public function listarTamanhos()
    {
        $sql = new Database();
        $res = $sql->select("SELECT * FROM produto_tamanho");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function cadastrarTamanho($tamanho)
    {
        $sql = new Database();
        $param = [
            ':tamanho' => $tamanho,
        ];

        $verificar = $sql->select("SELECT * FROM produto_tamanho WHERE tamanho = :tamanho", $param);

        if (count($verificar) != 0) {
            echo "Tamanho já existe";
            return false;
        } else {
            $sql->insert("INSERT INTO produto_tamanho (tamanho) VALUES (:tamanho)", $param);

            $verificar = $sql->select("SELECT * FROM produto_tamanho WHERE tamanho = :tamanho", $param);

            return true;
        }
    }


    public function alteraTamanho($id, $nome)
    {
        $sql = new Database();
        $param = [
            ':id' => $id,
            ':tamanho' => $nome,
        ];

        $param2 = [
            ':id' => $id,
        ];

        $verificar = $sql->select("SELECT tamanho FROM produto_tamanho WHERE id = :id", $param2);

        $dados = $verificar[0]->tamanho;

        if (isset($dados) || $dados != $nome) {
            $sql->update("UPDATE produto_tamanho SET tamanho = :tamanho WHERE id = :id", $param);
            return true;
        } else {
            echo "Tamanho já está atualizado";
        }
    }

    public function listarCores()
    {
        $sql = new Database();
        $cores = $sql->select("SELECT * FROM produto_cores");

        if (count($cores) != 0) {
            return $cores;
        } else {
            return false;
        }
    }

    public function cadastrarcor($cor)
    {
        $sql = new Database();
        $param = [
            ':cor' => $cor,
        ];

        $verificar = $sql->select("SELECT * FROM produto_cores WHERE cor = :cor", $param);

        if (count($verificar) != 0) {
            echo "cor já existe";
            return false;
        } else {
            $sql->insert("INSERT INTO produto_cores (cor) VALUES (:cor)", $param);

            $verificar = $sql->select("SELECT * FROM produto_cores WHERE cor = :cor", $param);

            return true;
        }
    }


    public function alteracor($id, $nome)
    {
        $sql = new Database();
        $param = [
            ':id' => $id,
            ':cor' => $nome,
        ];

        $param2 = [
            ':id' => $id,
        ];

        $verificar = $sql->select("SELECT cor FROM produto_cores WHERE id = :id", $param2);

        $dados = $verificar[0]->cor;

        if (isset($dados) || $dados != $nome) {
            $sql->update("UPDATE produto_cores SET cor = :cor WHERE id = :id", $param);
            return true;
        } else {
            echo "cor já está atualizado";
        }
    }

    public function buscarProdutos()
    {
        $sql = new Database();

        $produtos = $sql->select("SELECT p.id, p.nome_produto, p.descricao, p.preco, c.nome_categoria, t.tamanho, co.cor, p.imagem_produto, p.visivel, p.data_criacao, p.data_atualizacao FROM produtos p JOIN produto_categoria c ON p.categoria_id = c.id JOIN produto_tamanho t ON p.tamanho_id = t.id JOIN produto_cores co ON p.cor_id = co.id;");

        if (count($produtos) != 0) {
            return $produtos;
        } else {
            return false;
        }
    }

    public function cadastrarProduto($nome, $descricao, $preco, $categoria, $tamanho, $cor, $imagem, $visivel)
    {
        $sql = new Database();

        $param = [
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':categoria' => $categoria,
            ':tamanho' => $tamanho,
            ':cor' => $cor,
            ':imagem' => $imagem,
            ':visivel' => $visivel,
        ];

        $sql->insert("INSERT INTO produtos (nome_produto, descricao, preco, categoria_id, tamanho_id, cor_id, imagem_produto, visivel) VALUES (:nome, :descricao, :preco, :categoria, :tamanho, :cor, :imagem, :visivel)", $param);

        return true;
    }

    public function editarProduto($nome, $descricao, $preco, $categoria, $tamanho, $cor, $imagem, $visivel, $id)
    {
        $sql = new Database();

        $param = [
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':categoria' => $categoria,
            ':tamanho' => $tamanho,
            ':cor' => $cor,
            ':imagem' => $imagem,
            ':visivel' => $visivel,
            ':id' => $id
        ];

        $sql->update("UPDATE produtos SET nome_produto = :nome, descricao = :descricao, preco = :preco, categoria_id = :categoria, tamanho_id = :tamanho, cor_id = :cor, imagem_produto = :imagem, visivel = :visivel WHERE id = :id", $param);

        return true;
    }

    public function inativarProduto($id)
    {
        $sql = new Database();

        $param = [
            ':id' => $id,
        ];

        $sql->update("UPDATE produtos SET visivel = 0 WHERE id = :id;", $param);

        return true;
    }

    public function ativarProduto($id)
    {
        $sql = new Database();

        $param = [
            ':id' => $id,
        ];

        $sql->update("UPDATE produtos SET visivel = 1 WHERE id = :id;", $param);

        return true;
    }

    public function listarProdutoEspecifico($id)
    {

        $db = new Database();

        $param = [
            ':id' => $id,
        ];

        $sql = $db->select("SELECT p.id, p.nome_produto, p.descricao, p.preco, c.nome_categoria, t.tamanho, co.cor, p.imagem_produto, p.visivel, p.data_criacao, p.data_atualizacao FROM produtos p JOIN produto_categoria c ON p.categoria_id = c.id JOIN produto_tamanho t ON p.tamanho_id = t.id JOIN produto_cores co ON p.cor_id = co.id WHERE p.id = :id;", $param);

        return $sql;
    }


    public function listarStatusPagamentoPedido($id)
    {
        $sql = new Database();


        $param = [
            ":id" => $id,
        ];

        $sql->select("SELECT p.id AS id_pedido, sp.nome_status AS status_pagamento  FROM pagamento p JOIN status_pagamento sp ON p.status_pagamento_id = sp.id WHERE p.pedido_id = :id", $param);


        return $sql;
    }

    public function listarEstoque()
    {
        $sql = new Database();

        $prod = $sql->select("SELECT estoque.produto_id AS id_produto, produtos.nome_produto, produto_cores.id AS id_cor, produto_cores.cor AS nome_cor, produto_tamanho.id AS id_tamanho, produto_tamanho.tamanho AS nome_tamanho, estoque.quantidade_disponivel, produtos.imagem_produto, produtos.visivel AS status_produto FROM estoque JOIN produtos ON estoque.produto_id = produtos.id JOIN produto_cores ON estoque.cor_id = produto_cores.id JOIN produto_tamanho ON estoque.tamanho_id = produto_tamanho.id ORDER BY estoque.produto_id ASC");

        return $prod;
    }

    public function entrada_estoque($id_produto, $id_cor, $id_tamanho, $qtd)
    {
        $sql = new Database();

        $param = [
            ':id_produto' => $id_produto,
            ':idCor' => $id_cor,
            ':idTamanho' => $id_tamanho,
            ':tipo' => 'entrada',
            ':qtd' => $qtd
        ];

        $sql->insert(
            "INSERT INTO movimentacoes_estoque (produto_id, cor_id, tamanho_id, tipo_movimentacao, quantidade, data_movimentacao, data_criacao, data_atualizacao) 
            VALUES (:id_produto, :idCor, :idTamanho, :tipo, :qtd, NOW(), NOW(), NOW())",
            $param
        );

        return true;
    }

    public function saida_estoque($id_produto, $id_cor, $id_tamanho, $qtd)
    {
        $sql = new Database();

        $param = [
            ':id_produto' => $id_produto,
            ':idCor' => $id_cor,
            ':idTamanho' => $id_tamanho,
            ':tipo' => 'saida',
            ':qtd' => $qtd
        ];

        $sql->insert(
            "INSERT INTO movimentacoes_estoque (produto_id, cor_id, tamanho_id, tipo_movimentacao, quantidade, data_movimentacao, data_criacao, data_atualizacao) 
            VALUES (:id_produto, :idCor, :idTamanho, :tipo, :qtd, NOW(), NOW(), NOW())",
            $param
        );

        return true;
    }






    public function rel_vendas_cat(){

        $db = new Database();

        $resp = $db->select("SELECT pc.nome_categoria, COUNT(ip.id) AS total_itens_vendidos, SUM(ip.quantidade) AS quantidade_total, SUM(ip.quantidade * ip.preco_unitario) AS total_vendido FROM itens_pedidos ip JOIN produtos p ON ip.produto_id = p.id JOIN produto_categoria pc ON p.categoria_id = pc.id GROUP BY pc.nome_categoria ORDER BY total_vendido DESC;");

        return $resp;

    }

    public function rel_resumo_ped_status(){

        $db = new Database();

        $resp = $db->select("SELECT status_pedido, COUNT(*) AS total_pedidos, SUM(total_pedido) AS total_valor FROM pedidos GROUP BY status_pedido ORDER BY total_valor DESC;");

        return $resp;

    }

    public function rel_top_produtos(){

        $db = new Database();

        $resp = $db->select("SELECT p.nome_produto, SUM(ip.quantidade) AS total_vendido, SUM(ip.quantidade * ip.preco_unitario) AS receita_total FROM itens_pedidos ip JOIN produtos p ON ip.produto_id = p.id GROUP BY p.id ORDER BY total_vendido DESC LIMIT 5;");

        return $resp;

    }

    public function rel_pag_met_status(){

        $db = new Database();

        $resp = $db->select("SELECT mp.metodo, sp.nome_status, COUNT(pag.id) AS total_transacoes, SUM(pe.total_pedido) AS valor_total FROM pagamento pag JOIN metodo_pagamento mp ON pag.metodo_pagamento_id = mp.id JOIN status_pagamento sp ON pag.status_pagamento_id = sp.id JOIN pedidos pe ON pag.pedido_id = pe.id GROUP BY mp.metodo, sp.nome_status ORDER BY valor_total DESC;");

        return $resp;

    }

    public function rel_cli_mais_compram(){

        $db = new Database();

        $resp = $db->select("SELECT u.nome, u.sobrenome, u.email, COUNT(pe.id) AS total_pedidos, SUM(pe.total_pedido) AS valor_total_gasto FROM usuario u JOIN pedidos pe ON u.id = pe.id_usuario GROUP BY u.id ORDER BY valor_total_gasto DESC LIMIT 10;");

        return $resp;

    }

    public function rel_estoque_atual(){

        $db = new Database();

        $resp = $db->select("SELECT p.nome_produto, pc.cor, pt.tamanho, e.quantidade_disponivel FROM estoque e JOIN produtos p ON e.produto_id = p.id JOIN produto_cores pc ON e.cor_id = pc.id JOIN produto_tamanho pt ON e.tamanho_id = pt.id ORDER BY p.nome_produto;");

        return $resp;

    }

    public function rel_vendas_mes(){

        $db = new Database();

        $resp = $db->select("SELECT DATE_FORMAT(p.data_pedido, '%Y-%m') AS mes, COUNT(p.id) AS total_pedidos, SUM(p.total_pedido) AS valor_total FROM pedidos p GROUP BY mes ORDER BY mes DESC;");

        return $resp;

    }
}
