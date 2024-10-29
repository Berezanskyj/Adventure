<?php
// Simulando dados do carrinho e do usuário
$total_produtos = 0;
$totalPreco = 0;

if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $quantidade) {
        $total_produtos += $quantidade;
    }
}

$carrinho = isset($carrinho) ? $carrinho : []; // Garante que $carrinho seja um array
$total_rows = count($carrinho);

?>

<link rel="stylesheet" href="assets/css/finalizar-compra.css">

<div class="container">
    <h1>Finalizar Pedido</h1>

    <div class="checkout-container">
        <div class="user-details">
            <h2>Informações do Cliente</h2>
            <p><strong>Nome:</strong> <?= htmlspecialchars($_SESSION['nome']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['usuario']) ?></p>
            <p><strong>Endereço de Entrega:</strong> <?= htmlspecialchars($_SESSION['cep']) ?>, <?= htmlspecialchars($_SESSION['cidade']) ?>, <?= htmlspecialchars($_SESSION['bairro']) ?>, <?= htmlspecialchars($_SESSION['rua']) ?>, <?= htmlspecialchars($_SESSION['numero']) ?>, <?= htmlspecialchars($_SESSION['complemento']) ?> - <?= htmlspecialchars($_SESSION['apelido']) ?></p>
            
            <label>
                <input type="checkbox" id="editar-endereco" onclick="toggleEnderecoForm()">
                Editar Endereço
            </label>
        </div>

        <div class="user-details" id="registrar_endereco" style="display: none;">
            <h2>Registrar outro endereço</h2>
            <input type="text" name="cep" id="cep" placeholder="CEP" required>
            <input type="text" name="cidade" id="cidade" placeholder="Cidade" required>
            <input type="text" name="bairro" id="bairro" placeholder="Bairro" required>
            <input type="text" name="rua" id="rua" placeholder="Rua" required>
            <input type="text" name="numero" id="numero" placeholder="Número" required>
            <input type="text" name="complemento" id="complemento" placeholder="Complemento">
            <input type="text" name="apelido" id="apelido" placeholder="Apelido">
        </div>

        <div class="order-summary">
            <h2>Itens no Pedido</h2>
            <?php
                if (count($carrinho) > 0):
                    foreach ($carrinho as $produto):
                        if (isset($produto['nome'], $produto['quantidade'], $produto['precoTotal'])):
                            $totalPreco += $produto['precoTotal']; // Soma ao total de preços
            ?>
                            <div class="item">
                                <p><strong><?= htmlspecialchars($produto['nome']) ?></strong></p>
                                <p>Quantidade: <?= htmlspecialchars($produto['quantidade']) ?></p>
                                <p>Subtotal: R$ <?= number_format($produto['precoTotal'], 2, ',', '.') ?></p>
                            </div>
            <?php 
                        endif;
                    endforeach;
                else:
                    echo "<p>O carrinho está vazio.</p>";
                endif;
            ?>
        </div>

        <div class="order-summary">
            <h2>Resumo do Pedido</h2>
            <p>Total a Pagar: <span>R$ <?= number_format($totalPreco, 2, ',', '.') ?></span></p>
            <p>Itens: <span><?= $total_produtos ?> produtos</span></p>
        </div>

        <div class="action-buttons">
            <button type="button" class="btn-cancelar-compra" onclick="cancelarCompra()">Cancelar Pedido</button>
            <button type="button" class="btn-finalizar-compra" href="?a=metodo_pagamento" onclick="endereco_alternativo()">Prosseguir para o Pagamento</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    function cancelarCompra(){
        Swal.fire({
            title: 'Pedido Cancelado!',
            text: 'Seu pedido foi cancelado.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '?a=carrinho';
            }
        });
    };
        
</script>
