const addPedidoButtons = document.querySelectorAll('.add-user');
const pedidoModal = document.getElementById('order-modal');

//capturando valores da modal
const IDPedidoModal = document.getElementById('idPedidoModal');
const idUsuarioModal = document.getElementById('idUsuario');
const NomePedidoModal = document.getElementById('nome_usuario');
const TotalPedidoModal = document.getElementById('total_pedido');
const DataPedidoModal = document.getElementById('data_pedido');
const StatusPedidoModal = document.getElementById('status_pedido');
const MetodoPagamentoModal = document.getElementById('metodo_pagamento');
const StatusPamentoModal = document.getElementById('status_pagamento')
const itensTableBody = document.querySelector('#itens_pedido tbody');


//
const closeModal = document.querySelector('.close-modal');

// Inputs da modal
const inputId = document.getElementById('botao-editar');

console.log(inputId);


// Abrir modal e preencher os campos
addPedidoButtons.forEach((button) => {
    button.addEventListener('click', async () => {
        // Captura os atributos de dados do botão clicado
        const pedidoId = button.getAttribute('data-id');
        const pedidoClienteNome = button.getAttribute('data-nome');
        const statusPedido = button.getAttribute('data-status');
        const totalPedido = button.getAttribute('data-total');
        const dataPedido = button.getAttribute('data-criado');
        const metodoPagamento = button.getAttribute('data-metodo-pagamento');
        const statusPagamento = button.getAttribute('data-status-pagamento');
        const idUsuario = button.getAttribute('data-id-usuario');

        // Preenche os campos da modal
        IDPedidoModal.value = pedidoId;
        NomePedidoModal.value = pedidoClienteNome;
        TotalPedidoModal.value = totalPedido;
        DataPedidoModal.value = dataPedido;
        StatusPedidoModal.value = statusPedido;
        StatusPamentoModal.value = statusPagamento;
        idUsuarioModal.value = idUsuario;

        // Ajuste no método de pagamento
        if (metodoPagamento === 'cartao_credito') {
            MetodoPagamentoModal.value = "Cartão de Crédito";
        } else if (metodoPagamento === 'pix') {
            MetodoPagamentoModal.value = "Pix";
        } else {
            MetodoPagamentoModal.value = "Transferência Bancária";
        }

        // Limpar a tabela antes de preenchê-la com os itens
        itensTableBody.innerHTML = '';

        try {
            // Faz a requisição para buscar os itens do pedido via POST
            const response = await fetch('?a=obterItensPedido', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ idPedido: pedidoId })
            });

            // Converte a resposta para JSON
            const result = await response.json();

            if (result.success) {
                // Preenche a tabela com os itens do pedido
                result.data.forEach(item => {
                    const row = `
                        <tr>
                            <td>${item.item_id}</td>
                            <td>${item.produto_nome}</td>
                            <td>${item.cor_nome || '-'}</td>
                            <td>${item.tamanho_nome || '-'}</td>
                            <td>${item.quantidade}</td>
                            <td>R$${parseFloat(item.preco_unitario).toFixed(2).replace('.', ',')}</td>
                        </tr>
                    `;
                    itensTableBody.insertAdjacentHTML('beforeend', row);
                });
            } else {
                // Exibe mensagem de erro caso o backend não retorne sucesso
                Swal.fire({
                    title: 'Erro!',
                    text: result.message || 'Não foi possível carregar os itens do pedido.',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                });
            }
        } catch (error) {
            // Exibe mensagem de erro caso a requisição falhe
            Swal.fire({
                title: 'Erro inesperado!',
                text: 'Ocorreu um problema ao carregar os itens do pedido. Tente novamente.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
            console.error('Erro na solicitação:', error);
        }

        // Exibe a modal
        pedidoModal.style.display = 'block';
    });
});

// Fechar modal
closeModal.addEventListener('click', () => {
    pedidoModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === pedidoModal) {
        pedidoModal.style.display = 'none';
    }
});

document.getElementById('order-form').addEventListener('submit', async function (event) {
    event.preventDefault(); // Previne o comportamento padrão do formulário

    // Captura os dados do formulário
    const formData = new FormData(this); // Captura todos os campos do formulário, incluindo o arquivo

    // Exibe o SweetAlert com animação de carregamento
    Swal.fire({
        title: 'Aguarde...',
        text: 'Processando sua solicitação.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading(); // Mostra o ícone de carregamento
        }
    });

    try {
        // Faz a requisição AJAX com os dados do formulário
        const response = await fetch('?a=alterar_pedidos', {
            method: 'POST',
            body: formData, // Envia o FormData contendo os arquivos e os campos do formulário
        });

        // Trata a resposta do PHP
        const result = await response.json(); // Garante que a resposta será convertida para JSON

        // Fecha o SweetAlert de carregamento
        Swal.close();

        if (result.success) {
            // Exibe um alerta de sucesso
            Swal.fire({
                title: 'Sucesso!',
                text: 'Pedido atualizado com sucesso!',
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then(() => {
                location.reload(); // Recarrega a página se necessário
            });
        } else {
            // Exibe mensagem de erro do backend
            Swal.fire({
                title: 'Erro!',
                text: result.message || 'Ocorreu um problema ao atualizar o pedido.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
        }
    } catch (error) {
        // Fecha o SweetAlert de carregamento
        Swal.close();

        // Trata erros inesperados (ex.: falha de conexão)
        Swal.fire({
            title: 'Erro inesperado!',
            text: 'Não foi possível processar a solicitação. Tente novamente mais tarde.',
            icon: 'error',
            confirmButtonText: 'Ok',
        });
        console.error('Erro na solicitação:', error);
    }
});


function excluirPedido(id) {
    console.log(id);
    Swal.fire({
        title: "Você tem certeza?",
        text: "Não será possível reverter essa alteração!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6E7881",
        confirmButtonText: "Sim, deletar"
    }).then((result) => {
        if (result.isConfirmed) {
            // Usando $.ajax para fazer a requisição AJAX
            console.log(result.data)
            $.ajax({
                url: "?a=excluir_pedido",  // Ação para excluir o usuário
                type: "GET",
                data: { id: id },  // Enviando o ID do usuário a ser deletado
                success: function(response) {
                    // Se a exclusão for bem-sucedida, exibe a mensagem de sucesso
                    Swal.fire({
                        title: "Pedido Excluído!",
                        text: "O pedido selecionado foi excluído.",
                        icon: "success"
                    }).then(() => {
                        // Recarrega a página após o alerta de sucesso
                        location.reload(); // Recarregar a página
                    });
                },
                error: function() {
                    // Se ocorrer um erro durante a requisição
                    Swal.fire({
                        title: "Erro!",
                        text: "Ocorreu um erro ao tentar excluir o pedido.",
                        icon: "error"
                    });
                }
            });
        }
    });
}