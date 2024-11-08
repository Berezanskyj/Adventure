<link rel="stylesheet" href="assets/css/metodo_pagamento.css">
<form id="form-pagamento" action="?a=pagamento_processado" method="POST">
    <div class="container">
        <h1>Escolha o Método de Pagamento</h1>

        <div class="payment-options">
            <label>
                <input type="radio" name="metodo_pagamento" value="cartao_credito" onclick="mostrarInfoPagamento('cartao_credito')" checked>
                <div class="option">
                    <img src="assets/images/cartao.svg" alt="Cartão de Crédito">
                    <p>Cartão de Crédito</p>
                </div>
            </label>

            <label>
                <input type="radio" name="metodo_pagamento" value="boleto" onclick="mostrarInfoPagamento('boleto')">
                <div class="option">
                    <img src="assets/images/transferencia-bancaria.png" alt="Boleto">
                    <p>Transferência Bancaria</p>
                </div>
            </label>

            <label>
                <input type="radio" name="metodo_pagamento" value="pix" onclick="mostrarInfoPagamento('pix')">
                <div class="option">
                    <img src="assets/images/pix.svg" alt="Pix">
                    <p>Pix</p>
                </div>
            </label>
        </div>

        <!-- Seções específicas para cada método de pagamento -->
        <div class="payment-info" id="cartao_credito_info">
            <h3>Informações do Cartão de Crédito</h3>
            <label>Número do Cartão</label>
            <input type="text" placeholder="XXXX XXXX XXXX XXXX" name="numero_cartao" id="input_cc_num" required>
            <label>Data de Validade</label>
            <input type="text" placeholder="MM/AA" name="validade_cartao" id="input_cc_date" required>
            <label>CVV</label>
            <input type="text" placeholder="XXX" name="cvv_cartao" id="input_cc_cvv" required>
        </div>

        <div class="payment-info" id="boleto_info">
            <h3>Dados Para Transferência Bancaria</h3>
            <p>Abaixo está os dados para a transferencia.</p>
            <label>Beneficiário <br>
            Fulano de tal tal tal<br><br>
            CNPJ<br>
            XXXXXXXXXXX<br><br>
            Agencia<br>
            1234<br><br>
            Conta Corrente<br>
            12345-6<br><br>
            Banco<br>
            Bradesco</label>
        </div>

        <div class="payment-info" id="pix_info">
            <h3>QR Code Pix</h3>
            <p>Escaneie o QR code abaixo para realizar o pagamento via Pix.</p>
            <img src="assets/images/qrcode.png" alt="QR Code Pix" class="payment-image">
        </div>

        <div class="order-summary">
            <h2>Resumo do Pedido</h2>
            <p>Total a Pagar: <span>R$ <?= number_format($_SESSION['totalCarrinho'], 2, ',', '.') ?></span></p>
        </div>

        <div class="action-buttons">
            <button type="button" class="btn-voltar" onclick="window.location.href='?a=finalizar_compra'">Voltar</button>
            <button type="button" class="btn-continuar" onclick="confirmarPagamento()">Confirmar Pagamento</button>
        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarPagamento() {
        const metodo = document.querySelector('input[name="metodo_pagamento"]:checked').value;
        let Numcartao = document.getElementById('input_cc_num');
        let Datecartao = document.getElementById('input_cc_date');
        let Cvvcartao = document.getElementById('input_cc_cvv');

        if(metodo === "cartao_credito"){
            if(Numcartao.value.trim() == "" || Datecartao.value.trim() == "" || Cvvcartao.value.trim() == ""){
                    Swal.fire({
                    title: 'Por favor, preencha todos os campos',
                    text: 'Você escolheu cartão de crédito.',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
                return; // Sai da função se o campo estiver vazio
            }
            Swal.fire({
            title: 'Método de Pagamento Selecionado',
            text: 'Você escolheu cartão de crédito. Confirma o pagamento?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Sim, confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-pagamento').submit();
            }
        });
        } else {
            Swal.fire({
            title: 'Método de Pagamento Selecionado',
            text: 'Você escolheu '+ metodo +'. Confirma o pagamento?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Sim, confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-pagamento').submit();
            }
        });
        }
        
    }

    function mostrarInfoPagamento(metodo) {
    // Esconde todas as divs de informações de pagamento
    document.getElementById('cartao_credito_info').style.display = 'none';
    document.getElementById('boleto_info').style.display = 'none';
    document.getElementById('pix_info').style.display = 'none';

    // Remove "required" dos campos de cartão de crédito ao trocar o método de pagamento
    const numeroCartao = document.querySelector('#cartao_credito_info input[placeholder="XXXX XXXX XXXX XXXX"]');
    const validadeCartao = document.querySelector('#cartao_credito_info input[placeholder="MM/AA"]');
    const cvvCartao = document.querySelector('#cartao_credito_info input[placeholder="XXX"]');
    
    numeroCartao.removeAttribute('required');
    validadeCartao.removeAttribute('required');
    cvvCartao.removeAttribute('required');

    // Mostra a div correspondente ao método de pagamento selecionado com uma animação
    const selectedDiv = document.getElementById(metodo + '_info');
    selectedDiv.style.display = 'block';
    selectedDiv.classList.add('fade-in');

    // Adiciona "required" aos campos de cartão de crédito se essa opção for selecionada
    if (metodo === 'cartao_credito') {
        numeroCartao.setAttribute('required', 'required');
        validadeCartao.setAttribute('required', 'required');
        cvvCartao.setAttribute('required', 'required');
    }
}
</script>
