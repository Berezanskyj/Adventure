

<link rel="stylesheet" href="assets/css/metodo_pagamento.css">

<div class="container">
    <h1>Escolha o Método de Pagamento</h1>

    <div class="payment-options">
        <label>
            <input type="radio" name="metodo_pagamento" value="cartao_credito" checked>
            <div class="option">
                <img src="assets/images/cartao.svg" alt="Cartão de Crédito">
                <p>Cartão de Crédito</p>
            </div>
        </label>

        <label>
            <input type="radio" name="metodo_pagamento" value="boleto">
            <div class="option">
                <img src="assets/images/boleto-logo.svg" alt="Boleto">
                <p>Boleto</p>
            </div>
        </label>

        <label>
            <input type="radio" name="metodo_pagamento" value="pix">
            <div class="option">
                <img src="assets/images/pix.svg" alt="Pix">
                <p>Pix</p>
            </div>
        </label>
    </div>

    <div class="summary">
        <h2>Resumo do Pedido</h2>
        <p>Total a Pagar: <span>R$ 200</span></p>
    </div>

    <div class="action-buttons">
        <button type="button" class="btn-voltar" onclick="window.location.href='?a=finalizar_compra'">Voltar</button>
        <button type="button" class="btn-continuar" onclick="confirmarPagamento()">Confirmar Pagamento</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarPagamento() {
        const metodo = document.querySelector('input[name="metodo_pagamento"]:checked').value;
        Swal.fire({
            title: 'Método de Pagamento Selecionado',
            text: 'Você escolheu ' + metodo + '. Confirma o pagamento?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Sim, confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '?a=pagamento_processado&metodo=' + metodo;
            }
        });
    }
</script>
