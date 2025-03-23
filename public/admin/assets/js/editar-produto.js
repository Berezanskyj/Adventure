// document.getElementById('product-form').addEventListener('submit', function(event) {
//     event.preventDefault();
//     alert('Produto cadastrado com sucesso!');
// });

document.getElementById('imagem').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Pré-visualização">`;
        };
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '<span>Pré-visualização da imagem</span>';
    }
});

$(document).ready(function () {
    $("#preco").maskMoney({
        prefix: "R$ ",
        decimal: ",",
        thousands: "."
    });
});

document.getElementById("product-form").addEventListener("submit", function (event) {
    let camposFaltando = [];

    let nome = document.getElementById("nome_produto").value.trim();
    let preco = document.getElementById("preco").value.trim();
    let categoria = document.getElementById("categoria").value;
    let tamanho = document.getElementById("tamanho").value;
    let cor = document.getElementById("cor").value;
    let imagem = document.getElementById("imagem").files.length;
    let descricao = document.getElementById("descricao").value.trim();

    if (nome === "") camposFaltando.push("Nome do Produto");
    if (preco === "") camposFaltando.push("Preço");
    if (categoria === "") camposFaltando.push("Categoria");
    if (tamanho === "") camposFaltando.push("Tamanho");
    if (cor === "") camposFaltando.push("Cor");
    if (imagem === 0) camposFaltando.push("Imagem do Produto");
    if (descricao === "") camposFaltando.push("Descrição");

    if (camposFaltando.length > 0) {
        event.preventDefault(); // Impede o envio do formulário
        
        Swal.fire({
            icon: "error",
            title: "Erro!",
            html: "Os seguintes campos são obrigatórios:<br><strong>" + camposFaltando.join("<br>") + "</strong>",
            confirmButtonColor: "#d33"
        });
    }
});



$(document).ready(function () {
    // Captura o ID do produto da URL
    const urlParams = new URLSearchParams(window.location.search);
    const produtoId = urlParams.get('id'); // Exemplo: 123

    $("#product-form").on("submit", function (event) {
        event.preventDefault(); // Impede o envio normal do formulário

        let formData = new FormData(this); // Captura os dados do formulário

        $.ajax({
            url: "?a=edita_cadastro_produto&id=" + produtoId, // Adiciona o ID como parâmetro GET
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                try {
                    let json = response; // Converte resposta para JSON

                    if (json.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Sucesso!",
                            text: json.mensagem,
                            confirmButtonColor: "#28a745"
                        }).then(() => {
                            window.location.href = "?a=gerencia_produtos";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Erro!",
                            text: json.mensagem,
                            confirmButtonColor: "#d33"
                        });
                    }
                } catch (e) {
                    console.error("Erro ao processar JSON:", response);
                    Swal.fire({
                        icon: "error",
                        title: "Erro!",
                        text: "Erro inesperado ao processar a resposta.",
                        confirmButtonColor: "#d33"
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "Erro na requisição AJAX: " + error,
                    confirmButtonColor: "#d33"
                });
            }
        });
    });
});