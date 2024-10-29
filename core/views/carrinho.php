<?php

$total_produtos = 0;

if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $quantidade) {
        $total_produtos += $quantidade;
    }
}

$totalPreco = 0; // Inicializa a variável para o preço total
$index = 0;
$carrinho = isset($carrinho) ? $carrinho : []; // Garante que $carrinho seja um array

$total_rows = count($carrinho);

if ($total_rows > 0) {
    foreach ($carrinho as $produto) {
        if ($index < $total_rows - 1) {
            $totalPreco += $produto['precoTotal']; // Soma o subtotal de cada produto
            $index++;
        }
    }
}
?>
<link rel="stylesheet" href="assets/css/carrinho.css">


<div class="container">
    <h1>Seu Carrinho</h1>

    <?php if ($total_rows > 0): ?>
        <!-- Se o carrinho tiver itens, exibe a tabela -->
        <table class="cart-table">
            <thead>
                <tr>
                    <th class="col">ID</th>
                    <th class="col">Imagem</th>
                    <th class="col">Produto</th>
                    <th class="col">Quantidade</th>
                    <th class="col">Preço Unitário</th>
                    <th class="col">Subtotal</th>
                    <th class="col">Ação</th>
                    <th class="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 0;
                foreach ($carrinho as $produto): ?>
                    <?php if ($index < $total_rows - 1): ?>
                        <tr>
                            <!-- Lista dos produtos -->
                            <td class="hover"><?= $produto['id_produto'] ?></td>
                            <td class="hover"><img src="assets/images/produtos/<?= $produto['imagem']?>" width="150px"></td>
                            <td class="hover"><?= $produto['nome'] ?></td>
                            <td class="hover"><?= $produto['quantidade'] ?></td>
                            <td class="hover">R$<?=number_format($produto['preco'], 2, ",", ".")?></td>
                            <td class="hover">R$<?=number_format($produto['precoTotal'], 2, ",", ".")?></td>
                            <td class="hover"><a href="?a=remover_produto_carrinho&id_produto=<?=$produto['id_produto']?>" class="btn-remover">Remover</a></td>
                        </tr>
                    <?php endif; ?>
                    <?php $index++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-summary">
            <h2>Resumo do Pedido</h2>
            <div class="summary-details">
                <p>Total de Itens: <span id="carrinho">Itens: <?= $total_produtos ?></span></p>
                <p>Total a Pagar: <span>R$ <?= number_format($totalPreco, 2, ",", ".") ?></span></p>
            </div>
            <div class="cart-actions">

                <a class="btn-limpar" onclick="limparCarrinho()">Limpar Carrinho</a>
                <a class="btn-finalizar" href="?a=finalizar_compra">Finalizar Compra</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Mensagem de carrinho vazio -->
        
        <script>
            window.onload = function(){
            Swal.fire({
                        title: "Seu carrinho esta vazio",
                        icon: "error",
                        confirmButtonText: "OK",
                        }).then((result) =>{
                            if(result.isConfirmed) {
                                window.location.href = '?a=loja';
                            }
                        })};
        </script>
    <?php endif; ?>

</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
    function limparCarrinho(){
        Swal.fire({
            title: "Você tem certeza?",
            text: "Você não conseguirá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelbuttonText: "Cancelar",
            confirmButtonText: "Sim, deletar!"
                }).then((result) =>{
                    if(result.isConfirmed) {
                        window.location.href = '?a=limpar_carrinho';
                    }
                })
            };
</script>

