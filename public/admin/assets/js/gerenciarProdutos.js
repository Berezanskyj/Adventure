function cadastrarProduto() {
    window.location.href = "?a=cadastro_produtos"
}

function editarProduto() {
    let produtoId = event.target.getAttribute("data-id");
    window.location.href = "?a=editar_produtos&id=" + produtoId;
}


$(document).ready(function () {
    inativarProduto(); // Ativa os eventos corretamente ao carregar a página
    ativarProduto();
});

function inativarProduto() {
    $(document).on("click", ".botao-inativar", async function () {
        let produtoId = $(this).data("id");

        const confirmacao = await Swal.fire({
            title: "Tem certeza?",
            text: "Deseja inativar este produto?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sim, inativar!",
            cancelButtonText: "Cancelar"
        });

        if (!confirmacao.isConfirmed) return;

        try {
            const response = await $.ajax({
                url: "?a=inativar_produto",
                type: "POST",
                data: { id: produtoId },
                dataType: "json" // Informa que a resposta já é JSON
            });

            await Swal.fire({
                icon: response.status === "success" ? "success" : "error",
                title: response.status === "success" ? "Sucesso!" : "Erro!",
                text: response.mensagem,
                confirmButtonColor: response.status === "success" ? "#28a745" : "#d33"
            });

            if (response.status === "success") location.reload(); // Recarrega a página em caso de sucesso
        } catch (error) {
            console.error("Erro na requisição AJAX:", error);
            Swal.fire({
                icon: "error",
                title: "Erro!",
                text: "Erro inesperado na requisição. Tente novamente.",
                confirmButtonColor: "#d33"
            });
        }
    });
}

function ativarProduto() {
    $(document).on("click", ".botao-ativar", async function () {
        let produtoId = $(this).data("id");

        const confirmacao = await Swal.fire({
            title: "Tem certeza?",
            text: "Deseja ativar este produto?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sim, ativar!",
            cancelButtonText: "Cancelar"
        });

        if (!confirmacao.isConfirmed) return;

        try {
            const response = await $.ajax({
                url: "?a=ativar_produto",
                type: "POST",
                data: { id: produtoId },
                dataType: "json" // Informa que a resposta já é JSON
            });

            await Swal.fire({
                icon: response.status === "success" ? "success" : "error",
                title: response.status === "success" ? "Sucesso!" : "Erro!",
                text: response.mensagem,
                confirmButtonColor: response.status === "success" ? "#28a745" : "#d33"
            });

            if (response.status === "success") location.reload(); // Recarrega a página em caso de sucesso
        } catch (error) {
            console.error("Erro na requisição AJAX:", error);
            Swal.fire({
                icon: "error",
                title: "Erro!",
                text: "Erro inesperado na requisição. Tente novamente.",
                confirmButtonColor: "#d33"
            });
        }
    });
}

function searchOrders() {
    var input = document.getElementById('search-input');
    var filter = input.value.toLowerCase();
    var table = document.querySelector('.recent-orders table');
    var rows = table.getElementsByTagName('tr');

    // Itera sobre todas as linhas da tabela, começando pela segunda linha (para pular o cabeçalho)
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var found = false;

        // Verifica se algum valor nas células corresponde ao que foi digitado
        for (var j = 0; j < cells.length; j++) {
            var cell = cells[j];
            if (cell) {
                if (cell.innerText.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }

        // Mostra ou esconde a linha dependendo da busca
        if (found) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}
