<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use PDO;

class Carrinho{

    public function adicionar_carrinho() {

        // Busca o ID do produto na query string
        $id_produto = $_GET['id_produto'];
    
        // Inicializa a variável do carrinho
        $carrinho = [];
    
        // Verifica se já existe um carrinho na sessão
        if (isset($_SESSION['carrinho'])) {
            $carrinho = $_SESSION['carrinho'];
        }
    
        // Adiciona o produto ao carrinho
        if (isset($carrinho[$id_produto])) {
            // Verifica se o valor atual é um número inteiro
            if (is_int($carrinho[$id_produto])) {
                // Incrementa a quantidade
                $carrinho[$id_produto]++;
            } else {
                // Se for um array ou outro tipo, inicializa a quantidade
                $carrinho[$id_produto] = 1;
            }
        } else {
            // Se o produto ainda não está no carrinho, adiciona com a quantidade 1
            $carrinho[$id_produto] = 1;
        }
    
        // Atualiza os dados do carrinho na sessão
        $_SESSION['carrinho'] = $carrinho;
    
        // Calcula o total de produtos no carrinho
        $total_produtos = 0;
        foreach ($carrinho as $produto_quantidade) {
            if (is_int($produto_quantidade)) {
                $total_produtos += $produto_quantidade;
            }
        }
    
        // Exibe o total de produtos
        echo $total_produtos;
    }

    public function limpar_carrinho(){
        
        //limpa o carrinho de todos os produtos

        $_SESSION['carrinho'] = [];

    }
    

    public function carrinho(){
        
        //apresenta a pagina do carrinho
        
        $dados = [
            'titulo' => APP_NAME,
            
        ];
        
        Store::Layout([
            'layout/html_header',
            'layout/header',
            'carrinho',
            'layout/footer',
            'layout/html_footer',
        ], $dados);
    }

}

