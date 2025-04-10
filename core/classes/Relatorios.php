<?php

namespace core\classes;

use Dompdf\Dompdf;
use Dompdf\Options;
use core\classes\Graficos;
use DateTime;

class Relatorios
{


    public function gerarRelatorioVendasCategoriaComImagem($dados)
    {
        $g = new Graficos();
        $caminhoImagem = $g->gerarGraficoBarras($dados); // Gera o gráfico e obtém o caminho
        $imageBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($caminhoImagem));
        
        // Store::printData($caminhoImagemFormatado);
        // die();
        // Construção da tabela HTML com os dados
        $linhasTabela = '';
        foreach ($dados as $item) {
            $linhasTabela .= '
                <tr>
                    <td>' . htmlspecialchars($item->nome_categoria) . '</td>
                    <td>' . number_format($item->total_itens_vendidos, 0, ',', '.') . '</td>
                    <td>' . number_format($item->quantidade_total, 0, ',', '.') . '</td>
                    <td>R$ ' . number_format($item->total_vendido, 2, ',', '.') . '</td>
                </tr>';
        }

        // Estilo e HTML completo
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: "Segoe UI", sans-serif;
                    color: #2c3e50;
                    padding: 30px;
                    font-size: 12px;
                }
                h2 {
                    text-align: center;
                    color: #34495e;
                    margin-bottom: 20px;
                }
                .grafico {
                    text-align: center;
                    margin-bottom: 30px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                    font-size: 12px;
                }
                th, td {
                    border: 1px solid #ccc;
                    padding: 8px 10px;
                    text-align: center;
                }
                th {
                    background-color: #ecf0f1;
                    color: #2c3e50;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                .info {
                    margin-bottom: 10px;
                    font-size: 14px;
                }
            </style>
        </head>
        <body>
            <h2>Relatório de Vendas por Categoria</h2>
    
            <div class="grafico">
                <img src="' . $imageBase64 . '" alt="Gráfico de Vendas por Categoria">
            </div>
    
            <h3>Resumo Detalhado</h3>
            <table>
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Itens Vendidos</th>
                        <th>Quantidade Total</th>
                        <th>Total Vendido</th>
                    </tr>
                </thead>
                <tbody>
                    ' . $linhasTabela . '
                </tbody>
            </table>
        </body>
        </html>';

        // Geração do PDF
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Segoe UI');

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("relatorio_vendas_categoria.pdf", ["Attachment" => false]);
    }

    public function gerarRelatorioPedidosPorStatusComImagem($dados) {
        // Gera o gráfico e transforma em base64
        $g = new Graficos();
        $caminhoImagem = $g->gerarGraficosStatusPedidos($dados); // função da etapa anterior
        $imagemBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($caminhoImagem));
    
        // Monta o HTML do PDF
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    color: #333;
                }
                h2 {
                    text-align: center;
                    color: #2c3e50;
                    margin-bottom: 20px;
                }
                img {
                    display: block;
                    margin: 20px auto;
                    max-width: 100%;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 30px;
                }
                th, td {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: center;
                }
                th {
                    background-color: #ecf0f1;
                    color: #2c3e50;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
            </style>
        </head>
        <body>
            <h2>Relatório de Pedidos por Status</h2>
            <img src="' . $imagemBase64 . '" alt="Gráfico de Pedidos por Status">
    
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Total de Pedidos</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>';
    
        foreach ($dados as $item) {
            $html .= '
                    <tr>
                        <td>' . ucfirst($item->status_pedido) . '</td>
                        <td>' . $item->total_pedidos . '</td>
                        <td>R$ ' . number_format($item->total_valor, 2, ',', '.') . '</td>
                    </tr>';
        }
    
        $html .= '
                </tbody>
            </table>
        </body>
        </html>';
    
        // Gera o PDF com Dompdf
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
    
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("relatorio_pedidos_status.pdf", ["Attachment" => false]);
    }

    public function gerarRelatorioTopProdutosMaisVendidos(array $dados) {
        // Gera gráfico e transforma em base64
        $g = new Graficos();
        $caminhoImagem = $g->gerarGraficoTopProdutos($dados); // função abaixo
        $imagemBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($caminhoImagem));
    
        // HTML do relatório
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    color: #333;
                }
                h2 {
                    text-align: center;
                    color: #2c3e50;
                    margin-bottom: 20px;
                }
                img {
                    display: block;
                    margin: 20px auto;
                    max-width: 100%;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 30px;
                }
                th, td {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: center;
                }
                th {
                    background-color: #ecf0f1;
                    color: #2c3e50;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
            </style>
        </head>
        <body>
            <h2>Top 5 Produtos Mais Vendidos</h2>
            <img src="' . $imagemBase64 . '" alt="Gráfico dos Produtos Mais Vendidos">
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Total Vendido</th>
                        <th>Receita Total</th>
                    </tr>
                </thead>
                <tbody>';
    
        foreach ($dados as $item) {
            $html .= '
                    <tr>
                        <td>' . htmlspecialchars($item->nome_produto) . '</td>
                        <td>' . $item->total_vendido . '</td>
                        <td>R$ ' . number_format($item->receita_total, 2, ',', '.') . '</td>
                    </tr>';
        }
    
        $html .= '
                </tbody>
            </table>
        </body>
        </html>';
    
        // Geração do PDF
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
    
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("relatorio_top_produtos.pdf", ["Attachment" => false]);
    }

    public function gerarRelatorioPagamentosPorMetodoStatus(array $dados) {
        $g = new Graficos();
        $caminhoImagem = $g->gerarGraficoPagamentosMetodoStatus($dados);
        $imagemBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($caminhoImagem));
    
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    color: #2c3e50;
                }
                h2 {
                    text-align: center;
                    color: #34495e;
                    margin-bottom: 20px;
                }
                img {
                    display: block;
                    margin: 20px auto;
                    max-width: 90%;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 30px;
                }
                th, td {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: center;
                }
                th {
                    background-color: #ecf0f1;
                    color: #2c3e50;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
            </style>
        </head>
        <body>
            <h2>Relatório de Pagamentos por Método e Status</h2>
            <img src="' . $imagemBase64 . '" alt="Gráfico de Pagamentos por Método">
            <table>
                <thead>
                    <tr>
                        <th>Método</th>
                        <th>Status</th>
                        <th>Total Transações</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>';
    
        foreach ($dados as $item) {
            $html .= '
                    <tr>
                        <td>' . htmlspecialchars($item->metodo) . '</td>
                        <td>' . htmlspecialchars($item->nome_status) . '</td>
                        <td>' . $item->total_transacoes . '</td>
                        <td>R$ ' . number_format($item->valor_total, 2, ',', '.') . '</td>
                    </tr>';
        }
    
        $html .= '
                </tbody>
            </table>
        </body>
        </html>';
    
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
    
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("relatorio_pagamentos_metodo_status.pdf", ["Attachment" => false]);
    }

    public function gerarRelatorioClientesQueMaisGastaram(array $dados) {
        $g = new Graficos();
        $caminhoImagem = $g->gerarGraficoClientesMaisGastaram($dados);
        $imagemBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($caminhoImagem));
    
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    color: #2c3e50;
                }
                h2 {
                    text-align: center;
                    color: #34495e;
                    margin-bottom: 20px;
                }
                img {
                    display: block;
                    margin: 20px auto;
                    max-width: 90%;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 30px;
                }
                th, td {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: center;
                }
                th {
                    background-color: #ecf0f1;
                    color: #2c3e50;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
            </style>
        </head>
        <body>
            <h2>Relatório de Clientes que Mais Gastaram</h2>
            <img src="' . $imagemBase64 . '" alt="Gráfico de Clientes">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Total de Pedidos</th>
                        <th>Total Gasto</th>
                    </tr>
                </thead>
                <tbody>';
    
        foreach ($dados as $item) {
            $nomeCompleto = htmlspecialchars($item->nome . ' ' . $item->sobrenome);
            $html .= '
                    <tr>
                        <td>' . $nomeCompleto . '</td>
                        <td>' . htmlspecialchars($item->email) . '</td>
                        <td>' . $item->total_pedidos . '</td>
                        <td>R$ ' . number_format($item->valor_total_gasto, 2, ',', '.') . '</td>
                    </tr>';
        }
    
        $html .= '
                </tbody>
            </table>
        </body>
        </html>';
    
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
    
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("relatorio_clientes_gastos.pdf", ["Attachment" => false]);
    }

    public function gerarRelatorioEstoqueDetalhado(array $dados) {
        $g = new Graficos();
        $caminhoImagem = $g->gerarGraficoEstoque($dados);
        $imagemBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($caminhoImagem));
    
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    color: #2c3e50;
                }
                h2 {
                    text-align: center;
                    color: #34495e;
                    margin-bottom: 20px;
                }
                img {
                    display: block;
                    margin: 20px auto;
                    max-width: 90%;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 30px;
                }
                th, td {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: center;
                }
                th {
                    background-color: #ecf0f1;
                    color: #2c3e50;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
            </style>
        </head>
        <body>
            <h2>Relatório de Estoque por Produto, Cor e Tamanho</h2>
            <img src="' . $imagemBase64 . '" alt="Gráfico de Estoque">
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Cor</th>
                        <th>Tamanho</th>
                        <th>Quantidade Disponível</th>
                    </tr>
                </thead>
                <tbody>';
    
        foreach ($dados as $item) {
            $html .= '
                    <tr>
                        <td>' . htmlspecialchars($item->nome_produto) . '</td>
                        <td>' . htmlspecialchars($item->cor) . '</td>
                        <td>' . htmlspecialchars($item->tamanho) . '</td>
                        <td>' . $item->quantidade_disponivel . '</td>
                    </tr>';
        }
    
        $html .= '
                </tbody>
            </table>
        </body>
        </html>';
    
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
    
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("relatorio_estoque.pdf", ["Attachment" => false]);
    }

    public function gerarRelatorioPedidosPorMes(array $dados) {
        $g = new Graficos();
        $caminhoImagem = $g->gerarGraficoPedidosMes($dados);
        $imagemBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($caminhoImagem));
        
        function mesPorExtenso(string $anoMes): string {
            $meses = [
                '01' => 'Janeiro',   '02' => 'Fevereiro', '03' => 'Março',
                '04' => 'Abril',     '05' => 'Maio',      '06' => 'Junho',
                '07' => 'Julho',     '08' => 'Agosto',    '09' => 'Setembro',
                '10' => 'Outubro',   '11' => 'Novembro',  '12' => 'Dezembro',
            ];
        
            [$ano, $mes] = explode('-', $anoMes);
            return $meses[$mes] . ' de ' . $ano;
        }


        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    color: #2c3e50;
                }
                h2 {
                    text-align: center;
                    color: #34495e;
                    margin-bottom: 20px;
                }
                img {
                    display: block;
                    margin: 20px auto;
                    max-width: 90%;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 30px;
                }
                th, td {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: center;
                }
                th {
                    background-color: #ecf0f1;
                    color: #2c3e50;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
            </style>
        </head>
        <body>
            <h2>Relatório de Pedidos por Mês</h2>
            <img src="' . $imagemBase64 . '" alt="Gráfico de Pedidos por Mês">
            <table>
                <thead>
                    <tr>
                        <th>Mês</th>
                        <th>Total de Pedidos</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>';
    
        foreach ($dados as $item) {
            $html .= '
                    <tr>
                        <td>' . mesPorExtenso($item->mes) . '</td>
                        <td>' . $item->total_pedidos . '</td>
                        <td>R$ ' . number_format($item->valor_total, 2, ',', '.') . '</td>
                    </tr>';
        }
    
        $html .= '
                </tbody>
            </table>
        </body>
        </html>';
    
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
    
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("relatorio_pedidos_mes.pdf", ["Attachment" => false]);
    }
    
    
    
    
}
