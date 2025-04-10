<?php

namespace core\classes;

use Dompdf\Dompdf;
use Dompdf\Options;

class Graficos{

    public function gerarGraficoBarras($dados): string {
        $largura = 700;
        $altura = 400;
        $margem = 50;
        $espacoEntreBarras = 20;
        $larguraBarra = 40;
    
        // Gera um nome único para o arquivo
        $nomeArquivo = 'grafico_' . uniqid() . '.png';
        $caminhoRelativo = '../../public/admin/assets/images/graphs/' . $nomeArquivo;
    
        // Cria a imagem
        $imagem = imagecreate($largura, $altura);
    
        $fundo = imagecolorallocate($imagem, 255, 255, 255);
        $corBarra = imagecolorallocate($imagem, 100, 149, 237); // azul pastel
        $corTexto = imagecolorallocate($imagem, 0, 0, 0);
        $corEixo = imagecolorallocate($imagem, 180, 180, 180);
    
        $maiorValor = max(array_map(fn($item) => $item->total_vendido, $dados));
    
        // Desenha eixos
        imageline($imagem, $margem, $altura - $margem, $largura - $margem, $altura - $margem, $corEixo);
        imageline($imagem, $margem, $margem, $margem, $altura - $margem, $corEixo);
    
        // Título do gráfico
        imagestring($imagem, 5, ($largura / 2) - 100, 10, "Total vendido por categoria (R$)", $corTexto);
    
        // Legendas do eixo Y (valores)
        $divisoes = 5;
        for ($i = 0; $i <= $divisoes; $i++) {
            $valor = $maiorValor * ($i / $divisoes);
            $y = $altura - $margem - (($altura - 2 * $margem) * ($i / $divisoes));
            imagestring($imagem, 2, 5, $y - 7, 'R$ ' . number_format($valor, 0, ',', '.'), $corTexto);
            imageline($imagem, $margem - 5, $y, $margem, $y, $corTexto); // marcas no eixo Y
        }
    
        // Barras e nomes das categorias
        $x = $margem + $espacoEntreBarras;
        foreach ($dados as $item) {
            $valorFormatado = 'R$ ' . number_format($item->total_vendido, 2, ',', '.');
            $alturaBarra = ($item->total_vendido / $maiorValor) * ($altura - 2 * $margem);
            $y1 = $altura - $margem;
            $y2 = $y1 - $alturaBarra;
    
            // Desenha a barra
            imagefilledrectangle($imagem, $x, $y2, $x + $larguraBarra, $y1, $corBarra);
    
            // Valor no topo da barra
            imagestring($imagem, 2, $x - 5, $y2 - 15, $valorFormatado, $corTexto);
    
            // Nome da categoria na horizontal abaixo
            imagestringup($imagem, 2, $x + 12, $altura - 5, $item->nome_categoria, $corTexto);
    
            $x += $larguraBarra + $espacoEntreBarras;
        }
    
        imagepng($imagem, $caminhoRelativo);
        imagedestroy($imagem);
    
        return realpath($caminhoRelativo);
    }

    public function gerarGraficosStatusPedidos($dados): string {

            $largura = 700;
            $altura = 50 + count($dados) * 50;
            $margem = 100;
        
            $nomeArquivo = 'grafico_pedidos_' . uniqid() . '.png';
            $caminhoRelativo = '../../public/admin/assets/images/graphs/' . $nomeArquivo;
        
            $imagem = imagecreate($largura, $altura);
            $fundo = imagecolorallocate($imagem, 255, 255, 255);
            $corBarra = imagecolorallocate($imagem, 135, 206, 250); // azul pastel
            $corTexto = imagecolorallocate($imagem, 0, 0, 0);
            $corEixo = imagecolorallocate($imagem, 200, 200, 200);
        
            // Obtem o maior valor para proporção
            $maiorValor = max(array_map(fn($item) => $item->total_valor, $dados));
            $y = 40;
        
            foreach ($dados as $item) {
                $larguraBarra = ($item->total_valor / $maiorValor) * ($largura - $margem - 50);
                $valorFormatado = 'R$ ' . number_format($item->total_valor, 2, ',', '.');
                $label = ucfirst($item->status_pedido). " ({$item->total_pedidos})";
        
                // Barra horizontal
                imagefilledrectangle($imagem, $margem, $y - 10, $margem + $larguraBarra, $y + 10, $corBarra);
        
                // Texto à esquerda
                imagestring($imagem, 4, 10, $y - 7, $label, $corTexto);
        
                // Valor à direita da barra
                imagestring($imagem, 4, $margem + $larguraBarra + 10, $y - 7, $valorFormatado, $corTexto);
        
                $y += 50;
            }
        
            imagepng($imagem, $caminhoRelativo);
            imagedestroy($imagem);
        
            return $caminhoRelativo;
        }
        
    

    public function gerarGraficoTopProdutos(array $dados): string {
        $largura = 600;
        $altura = 300;
        $margem = 40;
        $espacoEntreBarras = 20;
        $larguraBarra = 40;
    
        $nomeArquivo = 'grafico_top_produtos_' . uniqid() . '.png';
        $caminhoRelativo = '../../public/admin/assets/images/graphs/' . $nomeArquivo;
    
        $imagem = imagecreate($largura, $altura);
        imagecolorallocate($imagem, 255, 255, 255); // fundo branco
        $corBarra = imagecolorallocate($imagem, 186, 220, 88); // verde pastel
        $corTexto = imagecolorallocate($imagem, 0, 0, 0);
        $corEixo = imagecolorallocate($imagem, 200, 200, 200);
    
        $maiorValor = max(array_map(fn($item) => $item->total_vendido, $dados));
    
        // Eixos
        imageline($imagem, $margem, $altura - $margem, $largura - $margem, $altura - $margem, $corEixo);
        imageline($imagem, $margem, $margem, $margem, $altura - $margem, $corEixo);
    
        $x = $margem + $espacoEntreBarras;
    
        foreach ($dados as $item) {
            $alturaBarra = ($item->total_vendido / $maiorValor) * ($altura - 2 * $margem);
            $y1 = $altura - $margem;
            $y2 = $y1 - $alturaBarra;
            imagefilledrectangle($imagem, $x, $y2, $x + $larguraBarra, $y1, $corBarra);
    
            // Nome do produto (abreviado)
            $nomeCurto = mb_substr($item->nome_produto, 0, 10) . (mb_strlen($item->nome_produto) > 10 ? '...' : '');
            imagestringup($imagem, 2, $x + 5, $altura - 5, $nomeCurto, $corTexto);
    
            // Total vendido
            imagestring($imagem, 2, $x, $y2 - 15, $item->total_vendido, $corTexto);
    
            $x += $larguraBarra + $espacoEntreBarras;
        }
    
        imagepng($imagem, $caminhoRelativo);
        imagedestroy($imagem);
    
        return $caminhoRelativo;
    }

    public function gerarGraficoPagamentosMetodoStatus(array $dados): string {



        $largura = 700;
        $altura = 350;
        $margem = 50;
        $espacoEntreBarras = 30;
        $larguraBarra = 40;
    
        $nomeArquivo = 'grafico_pagamentos_' . uniqid() . '.png';
        $caminhoRelativo = '../../public/admin/assets/images/graphs/' . $nomeArquivo;
    
        $imagem = imagecreate($largura, $altura);
        imagecolorallocate($imagem, 255, 255, 255); // fundo
        $corBarra = imagecolorallocate($imagem, 52, 152, 219); // azul claro
        $corTexto = imagecolorallocate($imagem, 0, 0, 0);
        $corEixo = imagecolorallocate($imagem, 180, 180, 180);
    
        $maiorValor = max(array_map(fn($item) => $item->valor_total, $dados));
    
        imageline($imagem, $margem, $altura - $margem, $largura - $margem, $altura - $margem, $corEixo); // eixo X
        imageline($imagem, $margem, $margem, $margem, $altura - $margem, $corEixo); // eixo Y
    
        $x = $margem + $espacoEntreBarras;
    
        foreach ($dados as $item) {
            $alturaBarra = ($item->valor_total / $maiorValor) * ($altura - 2 * $margem);
            $y1 = $altura - $margem;
            $y2 = $y1 - $alturaBarra;
    
            imagefilledrectangle($imagem, $x, $y2, $x + $larguraBarra, $y1, $corBarra);
    
            // Nome do método abreviado
            $legenda = strtoupper(mb_substr($item->metodo, 0, 10)) . "       " . mb_substr($item->nome_status, 0, 10);
            imagestringup($imagem, 2, $x + 5, $altura - 5, $legenda, $corTexto);
    
            // Valor total no topo
            $valorFormatado = number_format($item->valor_total, 0, ',', '.');
            imagestring($imagem, 2, $x - 5, $y2 - 15, "R$ " . $valorFormatado, $corTexto);
    
            $x += $larguraBarra + $espacoEntreBarras;
        }
    
        imagepng($imagem, $caminhoRelativo);
        imagedestroy($imagem);
    
        return $caminhoRelativo;
    }

    public function gerarGraficoClientesMaisGastaram(array $dados): string {
        $largura = 800;
        $altura = 400;
        $margem = 60;
        $espacoEntreBarras = 25;
        $larguraBarra = 40;
    
        $nomeArquivo = 'grafico_clientes_' . uniqid() . '.png';
        $caminhoRelativo = '../../public/admin/assets/images/graphs/' . $nomeArquivo;
    
        $imagem = imagecreate($largura, $altura);
        imagecolorallocate($imagem, 255, 255, 255); // fundo branco
        $corBarra = imagecolorallocate($imagem, 46, 204, 113); // verde claro
        $corTexto = imagecolorallocate($imagem, 0, 0, 0);
        $corEixo = imagecolorallocate($imagem, 180, 180, 180);
    
        $maiorValor = max(array_map(fn($item) => $item->valor_total_gasto, $dados));
    
        // Eixos
        imageline($imagem, $margem, $altura - $margem, $largura - $margem, $altura - $margem, $corEixo); // eixo X
        imageline($imagem, $margem, $margem, $margem, $altura - $margem, $corEixo); // eixo Y
    
        $x = $margem + $espacoEntreBarras;
    
        foreach ($dados as $item) {
            $alturaBarra = ($item->valor_total_gasto / $maiorValor) * ($altura - 2 * $margem);
            $y1 = $altura - $margem;
            $y2 = $y1 - $alturaBarra;
    
            imagefilledrectangle($imagem, $x, $y2, $x + $larguraBarra, $y1, $corBarra);
    
            // Nome encurtado (primeiro nome)
            $legenda = strtoupper(mb_substr($item->nome, 0, 10));
            imagestringup($imagem, 2, $x + 5, $altura - 5, $legenda, $corTexto);
    
            // Valor total gasto no topo
            $valorFormatado = number_format($item->valor_total_gasto, 0, ',', '.');
            imagestring($imagem, 2, $x - 5, $y2 - 15, "R$ " . $valorFormatado, $corTexto);
    
            $x += $larguraBarra + $espacoEntreBarras;
        }
    
        imagepng($imagem, $caminhoRelativo);
        imagedestroy($imagem);
    
        return $caminhoRelativo;
    }

    public function gerarGraficoEstoque(array $dados): string {
        $largura = 800;
        $altura = 400;
        $margem = 60;
        $espacoEntreBarras = 25;
        $larguraBarra = 40;
    
        $nomeArquivo = 'grafico_estoque_' . uniqid() . '.png';
        $caminhoRelativo = '../../public/admin/assets/images/graphs/' . $nomeArquivo;
    
        $imagem = imagecreate($largura, $altura);
        imagecolorallocate($imagem, 255, 255, 255); // fundo branco
        $corBarra = imagecolorallocate($imagem, 52, 152, 219); // azul
        $corTexto = imagecolorallocate($imagem, 0, 0, 0);
        $corEixo = imagecolorallocate($imagem, 180, 180, 180);
    
        $maiorValor = max(array_map(fn($item) => $item->quantidade_disponivel, $dados));
    
        imageline($imagem, $margem, $altura - $margem, $largura - $margem, $altura - $margem, $corEixo); // eixo X
        imageline($imagem, $margem, $margem, $margem, $altura - $margem, $corEixo); // eixo Y
    
        $x = $margem + $espacoEntreBarras;
    
        foreach ($dados as $item) {
            $alturaBarra = ($item->quantidade_disponivel / $maiorValor) * ($altura - 2 * $margem);
            $y1 = $altura - $margem;
            $y2 = $y1 - $alturaBarra;
    
            imagefilledrectangle($imagem, $x, $y2, $x + $larguraBarra, $y1, $corBarra);
    
            $label = strtoupper(mb_substr($item->nome_produto, 0, 10));
            imagestringup($imagem, 2, $x + 5, $altura - 5, $label, $corTexto);
            imagestring($imagem, 2, $x, $y2 - 15, $item->quantidade_disponivel, $corTexto);
    
            $x += $larguraBarra + $espacoEntreBarras;
        }
    
        imagepng($imagem, $caminhoRelativo);
        imagedestroy($imagem);
    
        return $caminhoRelativo;
    }

    public function gerarGraficoPedidosMes(array $dados): string {
        $largura = 800;
        $altura = 400;
        $margem = 60;
        $espacoEntreBarras = 25;
        $larguraBarra = 40;
    
        $nomeArquivo = 'grafico_pedidos_mes_' . uniqid() . '.png';
        $caminhoRelativo = '../../public/admin/assets/images/graphs/' . $nomeArquivo;
    
        $imagem = imagecreate($largura, $altura);
        imagecolorallocate($imagem, 255, 255, 255); // fundo branco
        $corBarra = imagecolorallocate($imagem, 26, 188, 156); // verde água
        $corTexto = imagecolorallocate($imagem, 0, 0, 0);
        $corEixo = imagecolorallocate($imagem, 180, 180, 180);
    
        $maiorValor = max(array_map(fn($item) => $item->total_pedidos, $dados));
    
        imageline($imagem, $margem, $altura - $margem, $largura - $margem, $altura - $margem, $corEixo); // eixo X
        imageline($imagem, $margem, $margem, $margem, $altura - $margem, $corEixo); // eixo Y
    
        $x = $margem + $espacoEntreBarras;
    
        foreach ($dados as $item) {
            $alturaBarra = ($item->total_pedidos / $maiorValor) * ($altura - 2 * $margem);
            $y1 = $altura - $margem;
            $y2 = $y1 - $alturaBarra;
    
            imagefilledrectangle($imagem, $x, $y2, $x + $larguraBarra, $y1, $corBarra);
    
            imagestringup($imagem, 2, $x + 5, $altura - 5, $item->mes, $corTexto);
            imagestring($imagem, 2, $x, $y2 - 15, $item->total_pedidos, $corTexto);
    
            $x += $larguraBarra + $espacoEntreBarras;
        }
    
        imagepng($imagem, $caminhoRelativo);
        imagedestroy($imagem);
    
        return $caminhoRelativo;
    }
    
    
    
    
    
}



