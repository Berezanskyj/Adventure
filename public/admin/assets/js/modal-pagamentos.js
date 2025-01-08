const registerStatusModal = document.getElementById("register-modal");
const changeOrderStatusModal = document.getElementById("change-order-modal")


function abrirModal() {
    if (registerStatusModal) {
        registerStatusModal.style.display = "block";
    } else {
        console.error("Elemento 'register-modal' não encontrado!");
    }
}

function fecharModal() {
    if (registerStatusModal) {
        registerStatusModal.style.display = "none";
    }
}

function abrirChangeModal(pedido, metodo) {
    const changeOrderStatusModal = document.getElementById('change-order-modal');

    if (changeOrderStatusModal) {
        const pedidoInput = document.getElementById('pedido');
        const metodoInput = document.getElementById('metodo');

        if (pedidoInput && metodoInput) {
            pedidoInput.value = pedido;
            metodoInput.value = metodo;
        } else {
            console.error("Campos de pedido ou método não encontrados!");
        }

        changeOrderStatusModal.style.display = "block";
    } else {
        console.error("Elemento 'change-order-modal' não encontrado!");
    }
}

function fecharChangeModal() {
    if (changeOrderStatusModal) {
        changeOrderStatusModal.style.display = "none";
    }
}


function registerStatus() {
    const nomeStatus = document.getElementById('nomeStatusModal').value; // Pega o valor do input corretamente

    $.ajax({
        url: '?a=criar_status_pagamento',
        type: 'POST',
        data: { nome: nomeStatus }, // Envia o valor correto
        success: function (response) {
            console.log("Resposta: ", response);

            Swal.fire({
                title: 'Sucesso!',
                text: 'Status de pagamento cadastrado com sucesso.',
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then(() => {
                location.reload(); // Recarrega a página após o alerta de sucesso
            });
        },
        error: function (error) {
            console.error("Erro ao criar status de pagamento:", error);

            Swal.fire({
                title: 'Erro.',
                text: 'Erro ao registrar status. Tente novamente.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
        }
    });
}

function changePaymentStatus() {

    const status = document.getElementById('status_pagamento').value;
    const pedido = document.getElementById('pedido').value;

    $.ajax({
        url: '?a=editar_pagamento',
        type: 'POST',
        data: { 
            status: status,
            pedido: pedido
        },
        success: function (response) {
            console.log("Resposta: ", response);

            Swal.fire({
                title: 'Sucesso!',
                text: 'Status do pagamento atualizado com sucesso.',
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then(() => {
                location.reload(); // Recarrega a página após o alerta de sucesso
            });
        },
        error: function (error) {
            console.error("Erro ao atualizar status de pagamento:", error);

            Swal.fire({
                title: 'Erro.',
                text: 'Erro ao atualizar status. Tente novamente.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
        }
    });

}




















document.addEventListener("DOMContentLoaded", () => {
    // Seleciona todos os elementos com o id "status"
    const statusElements = document.querySelectorAll("#statusPagamento");

    // Itera sobre os elementos encontrados
    statusElements.forEach((element) => {
        const statusText = element.textContent.trim().toLowerCase(); // Obtém o texto do status

        // Remove classes existentes antes de adicionar a nova
        element.classList.remove("success", "danger", "warning", "sent", "primary");

        // Aplica a classe correspondente ao status
        if (statusText === "recusado") {
            element.classList.add("recusado");
        } else if (statusText === "pago") {
            element.classList.add("pago");
        } else if (statusText === "em processamento") {
            element.classList.add("em_processamento");
        } else if (statusText === "cancelado") {
            element.classList.add("cancelado");
        } else if (statusText === "reembolsado") {
            element.classList.add("reembolsado");
        } else if (statusText === "pendente") {
            element.classList.add("warning");
        }





    });
});
