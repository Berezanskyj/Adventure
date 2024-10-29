<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use PDO;

class Carrinho
{
    public function adicionar_carrinho()
    {
        // Verifica se o ID do produto está na query string
        if (!isset($_GET['id_produto'])) {
            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;
            return;
        }

        // Define o ID do produto
        $id_produto = $_GET['id_produto'];

        // Inicializa a variável do carrinho
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = []; // Inicializa como um array vazio se não existir
        }

        $carrinho = $_SESSION['carrinho'];

        // Adiciona o produto ao carrinho
        if (isset($carrinho[$id_produto])) {
            $carrinho[$id_produto]++;
        } else {
            $carrinho[$id_produto] = 1;
        }

        $_SESSION['carrinho'] = $carrinho;

        // Calcula o total de produtos no carrinho
        $total_produtos = array_sum($carrinho); // Soma as quantidades
        echo $total_produtos;
    }

    public function remover_produto_carrinho()
    {
        // Busca o id do produto na query string
        $id_produto = $_GET['id_produto'];

        // Verifica se o carrinho existe na sessão
        if (isset($_SESSION['carrinho'][$id_produto])) {
            // Remove o item do carrinho
            unset($_SESSION['carrinho'][$id_produto]);
        }

        // Chama o método carrinho para exibir a página atualizada
        $this->carrinho();
    }

    public function limpar_carrinho()
    {
        // Limpa o carrinho de todos os produtos
        unset($_SESSION['carrinho']);
        header("Location: ?a=carrinho");
    }

    public function carrinho()
    {
        // Verifica se o carrinho existe e se tem produtos
        if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
            $dados = ['carrinho' => []];
        } else {
            $ids = [];

            // Coleta os IDs dos produtos no carrinho
            foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
                array_push($ids, $id_produto);
            }

            $ids = implode(",", $ids);
            $produtos = new Produtos();
            $resultado = $produtos->buscarProdutosIds($ids);

            $dadosTemp = [];

            // Processa cada produto do carrinho
            foreach ($_SESSION['carrinho'] as $id_produto => $quantidadeCarrinho) {
                foreach ($resultado as $produto) {
                    if ($produto->id == $id_produto) {
                        $id_produto = $produto->id;
                        $imagem = $produto->imagem_produto;
                        $nome = $produto->nome_produto;
                        $quantidade = $quantidadeCarrinho;
                        $preco = $produto->preco;
                        $precoTotal = $produto->preco * $quantidade;

                        array_push($dadosTemp, [
                            "id_produto" => $id_produto,
                            "imagem" => $imagem,
                            "nome" => $nome,
                            "quantidade" => $quantidade,
                            "preco" => $preco,
                            "precoTotal" => $precoTotal,
                        ]);
                        break; // Encerra o loop interno para passar para o próximo produto do carrinho
                    }
                }
            }


            //calcular o total
            $totalCarrinho = 0;
            foreach ($dadosTemp as $item) {
                $totalCarrinho += $item['preco'];
            }

            array_push($dadosTemp, $totalCarrinho);

            $dados = [
                'carrinho' => $dadosTemp
            ];
        }

        // Apresenta a página do carrinho
        Store::Layout([
            'layout/html_header',
            'layout/header',
            'carrinho',
            'layout/footer',
            'layout/html_footer',
        ], $dados);
    }

    public function finalizar_compra() 
    {
        
        // Store::printData($_SESSION);
        if(!isset($_SESSION['cliente'])){

            //coloca na sessao um referrer temporario
            $_SESSION['tmp_carrinho'] = true;


            //redirecionar para o login
            Store::redirect('login');
        } else {
            

            Store::redirect('finalizar_compra_resumo');

        }
    }

    public function finalizar_compra_resumo(){

        $cliente = new Clientes();

        $resultado = $cliente->buscarEndereco($_SESSION['cliente']);

        if (is_array($resultado) && !empty($resultado)) {
            $endereco = $resultado[0];  // Acessa o primeiro objeto dentro do array
    
            // Armazena as informações de endereço na sessão
            $_SESSION['cep'] = $endereco->cep;
            $_SESSION['cidade'] = $endereco->cidade;
            $_SESSION['bairro'] = $endereco->bairro;
            $_SESSION['rua'] = $endereco->rua;
            $_SESSION['numero'] = $endereco->numero;
            $_SESSION['complemento'] = $endereco->complemento;
            $_SESSION['apelido'] = $endereco->apelido;
        } else {
            // Caso o endereço não seja encontrado, define valores padrão ou exibe um erro
            $_SESSION['cep'] = '';
            $_SESSION['cidade'] = '';
            $_SESSION['bairro'] = '';
            $_SESSION['rua'] = '';
            $_SESSION['numero'] = '';
            $_SESSION['complemento'] = '';
            $_SESSION['apelido'] = '';
            echo "Endereço não encontrado.";
            die();  // Interrompe a execução caso seja crítico
        }

        $ids = [];

            // Coleta os IDs dos produtos no carrinho
            foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
                array_push($ids, $id_produto);
            }

            $ids = implode(",", $ids);
            $produtos = new Produtos();
            $resultado = $produtos->buscarProdutosIds($ids);

            $dadosTemp = [];

            // Processa cada produto do carrinho
            foreach ($_SESSION['carrinho'] as $id_produto => $quantidadeCarrinho) {
                foreach ($resultado as $produto) {
                    if ($produto->id == $id_produto) {
                        $id_produto = $produto->id;
                        $imagem = $produto->imagem_produto;
                        $nome = $produto->nome_produto;
                        $quantidade = $quantidadeCarrinho;
                        $preco = $produto->preco;
                        $precoTotal = $produto->preco * $quantidade;

                        array_push($dadosTemp, [
                            "id_produto" => $id_produto,
                            "imagem" => $imagem,
                            "nome" => $nome,
                            "quantidade" => $quantidade,
                            "preco" => $preco,
                            "precoTotal" => $precoTotal,
                        ]);
                        break; // Encerra o loop interno para passar para o próximo produto do carrinho
                    }
                }
            }


            //calcular o total
            $totalCarrinho = 0;
            foreach ($dadosTemp as $item) {
                $totalCarrinho += $item['preco'];
            }

            array_push($dadosTemp, $totalCarrinho);

            $dados = [
                'carrinho' => $dadosTemp
            ];

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'finalizar_compra_resumo',
            'layout/footer',
            'layout/html_footer',
        ], $dados);
    }

    public function endereco_alternativo() {
        $post = json_decode(file_get_contents('php://input'), true);
        
        if ($post) {
            $_SESSION['dados_alternativos'] = [
                'cep' => $post['cep'],
                'cidade' => $post['cidade'],
                'bairro' => $post['bairro'],
                'rua' => $post['rua'],
                'numero' => $post['numero'],
                'complemento' => $post['complemento'],
                'apelido' => $post['apelido'],
            ];
            echo json_encode(['status' => 'success', 'message' => 'Dados armazenados com sucesso']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
        }
        exit;
    }


    public function metodo_pagamento(){

        Store::printData($_SESSION);
    }

    
    // [cliente] => 2
    // [usuario] => berezankyj16@gmail.com
    // [nome] => Rafael
    // [sobrenome] => Cardoso
}
