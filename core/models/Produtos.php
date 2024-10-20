<?php

namespace core\models;
use core\classes\Database;
use core\classes\Store;

class Produtos {

    public function listarProdutos(){
        $sql = new Database();

        $resultado = $sql->select("SELECT * FROM produtos where visivel = 1");

        return $resultado;

    }

    public function listarCategoria(){
        $sql = new Database();

        $resultado = $sql->select("SELECT * FROM produto_categoria");

        return $resultado;
    }

    public function listarTamanho(){
        $sql = new Database();

        $resultado = $sql->select("SELECT * FROM produto_tamanho");

        return $resultado;
    }

    public function listarCor(){
        $sql = new Database();

        $resultado = $sql->select("SELECT * FROM produto_cores");

        return $resultado;
    }

    public function filtrarProduto($categoria, $tamanho, $cor) {
        $sql = new Database();
    
        // Inicia a consulta SQL
        $query = "SELECT * FROM produtos WHERE visivel = 1";
    
        // Inicializa um array para armazenar as condições
        $conditions = [];
        $params = [];
    
        // Adiciona condições baseadas nos filtros
        if ($categoria !== "null" && !empty($categoria)) {
            $conditions[] = "categoria_id = :categoria";
            $params[':categoria'] = $categoria;
        }
    
        if ($tamanho !== "null" && !empty($tamanho)) {
            $conditions[] = "tamanho_id = :tamanho";
            $params[':tamanho'] = $tamanho;
        }
    
        if ($cor !== "null" && !empty($cor)) {
            $conditions[] = "cor_id = :cor";
            $params[':cor'] = $cor;
        }
    
        // Monta a consulta com base nas condições
        if (!empty($conditions)) {
            $query .= " AND " . implode(' AND ', $conditions);
        }
    
        // Executa a consulta e retorna o resultado
        $resultado = $sql->select($query, $params);
        return $resultado;
    }
    
}