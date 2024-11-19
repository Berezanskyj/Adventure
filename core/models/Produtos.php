<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Produtos
{

    public function listarProdutos()
    {
        $sql = new Database();

        $resultado = $sql->select("SELECT * FROM produtos where visivel = 1");

        return $resultado;
    }

    public function listarCategoria()
    {
        $sql = new Database();

        $resultado = $sql->select("SELECT * FROM produto_categoria");

        return $resultado;
    }

    public function listarTamanho()
    {
        $sql = new Database();

        $resultado = $sql->select("SELECT * FROM produto_tamanho");

        return $resultado;
    }

    public function listarCor()
    {
        $sql = new Database();

        $resultado = $sql->select("SELECT * FROM produto_cores");

        return $resultado;
    }

    public function listarCategoriaEspec($id)
    {
        $sql = new Database();

        $param = [
            ':id' => $id
        ];

        $resultado = $sql->select("SELECT nome_categoria FROM produto_categoria WHERE id = :id", $param);

        if (count($resultado) != 0) {
            return $resultado;
        } else {
            return "Todos";
        }
    }

    public function listarTamanhoEspec($id)
    {
        $sql = new Database();

        $param = [
            ':id' => $id
        ];


        $resultado = $sql->select("SELECT tamanho FROM produto_tamanho WHERE id = :id", $param);

        if (count($resultado) != 0) {
            return $resultado;
        } else {
            return "Todos";
        }
    }

    public function listarCorEspec($id)
    {
        $sql = new Database();

        $param = [
            ':id' => $id
        ];


        $resultado = $sql->select("SELECT cor FROM produto_cores WHERE id = :id", $param);

        if (count($resultado) != 0) {
            return $resultado;
        } else {
            return "Todos";
        }
    }

    public function filtrarProduto($categoria, $tamanho, $cor)
    {
        $bd = new Database();

        // Inicia a consulta SQL com o filtro de visibilidade
        $sql = "SELECT * FROM produtos WHERE visivel = 1";

        // Array para armazenar as condições dinâmicas
        $conditions = [];

        // Adiciona condições apenas se os valores dos filtros não forem "TODOS" ou null
        if ($categoria !== "Todas" && !is_null($categoria)) {
            $conditions[] = "categoria_id = " . intval($categoria);
        }
        if ($tamanho !== "Todos" && !is_null($tamanho)) {
            $conditions[] = "tamanho_id = " . intval($tamanho);
        }
        if ($cor !== "Todas" && !is_null($cor)) {
            $conditions[] = "cor_id = " . intval($cor);
        }

        // Concatena as condições ao SQL apenas se houver alguma
        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }

        // Executa a consulta
        $produtos = $bd->select($sql);

        return $produtos;
    }

    public function buscarCategoria($idCategoria)
    {
        $sql = new Database();

        $param = [
            ':id' => $idCategoria
        ];

        $res = $sql->select("SELECT * FROM produto_categoria WHERE id = :id", $param);

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }
    public function buscarCores($idCores)
    {
        $sql = new Database();

        $param = [
            ':id' => $idCores
        ];

        $res = $sql->select("SELECT * FROM produto_cores WHERE id = :id", $param);

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }
    public function buscarTamanho($idTamanho)
    {
        $sql = new Database();

        $param = [
            ':id' => $idTamanho
        ];

        $res = $sql->select("SELECT * FROM produto_tamanho WHERE id = :id", $param);

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function listarEstoque($id_produto, $id_cor, $id_tamanho)
    {
        $sql = new Database();

        $param = [
            ':produto_id' => $id_produto,  // Changed key to match SQL query
            ':cor_id' => $id_cor,          // Changed key to match SQL query
            ':tamanho_id' => $id_tamanho,  // Changed key to match SQL query
        ];

        $resultado = $sql->select("SELECT quantidade_disponivel FROM estoque WHERE produto_id = :produto_id AND cor_id = :cor_id AND tamanho_id = :tamanho_id", $param);

        return $resultado;
    }

    public function consultaEstoqueGeral($id_produto)
    {


        $sql = new Database();

        $param = [
            ":produto_id" => $id_produto
        ];

        $res = $sql->select("SELECT * FROM estoque WHERE produto_id = :produto_id AND quantidade_disponivel > 0", $param);

        return count($res) != 0 ? true : false;
    }

    public function buscarProdutosIds($ids)
    {


        $sql = new Database();

        return $sql->select("SELECT * from produtos WHERE id IN ($ids)");
    }

    public function buscarProdutosCarrinho($ids)
{
    // Converte os IDs em uma lista separada por vírgula para a consulta SQL
    $ids = implode(',', $ids);

    // Conexão com o banco de dados
    $db = new Database();

    // Consulta SQL
    $sql = "SELECT * FROM produtos WHERE id IN ($ids)";

    // Executa a consulta
    $result = $db->select($sql);

    return $result;
}
}
