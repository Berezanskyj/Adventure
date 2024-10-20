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
}