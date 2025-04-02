function modalEntrada(botao) {
    const modalEntrada = document.getElementById("entrada-modal");
    const modalIdProduto = document.getElementById('id_produto');
    const modalIdCor = document.getElementById('id_cor');
    const modalIdTamanho = document.getElementById('id_tamanho');
    const modalNomeProduto = document.getElementById('nome_produto');
    const modalCorProduto = document.getElementById('produto_cor');
    const modalTamanhoProduto = document.getElementById('produto_tamanho');
    const modalQuantidadeProduto = document.getElementById('qtdEntrada');

    modalQuantidadeProduto.style.backgroundColor = "#fff"
    
    // Pegando os atributos do botão clicado
    const produtoId = botao.getAttribute('data-id');
    const corId = botao.getAttribute('data-id_cor');
    const tamanhoId = botao.getAttribute('data-id_tamanho');
    const produtoNome = botao.getAttribute('data-nome_produto');
    const produtoCor = botao.getAttribute('data-nome_cor');
    const produtoTamanho = botao.getAttribute('data-nome_tamanho');
    const produtoQuantidade = botao.getAttribute('data-quantidade_disponivel');

    modalIdProduto.value = produtoId;
    modalNomeProduto.value = produtoNome;
    modalCorProduto.value = produtoCor;
    modalTamanhoProduto.value = produtoTamanho;
    modalQuantidadeProduto.value = produtoQuantidade;
    modalIdCor.value = corId;
    modalIdTamanho.value = tamanhoId;

    console.log(produtoId);


    modalEntrada.style.display = 'block';
}

function fecharModalEntrada(){
    const modalEntrada = document.getElementById("entrada-modal");

    modalEntrada.style.display = 'none';
}

function cadastrarEntrada(){
    $("#entrada-form").on("submit", function(event) {
        
        
        event.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "?a=entrada_estoque",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                try {
                    let json = response;

                    console.log(json);

                    if(json.status === "success"){
                        Swal.fire({
                            icon: "success",
                            title: "Sucesso!",
                            text: json.mensagem,
                            confirmButtonColor: "#28a745"
                        }).then(() => {
                            window.location.href = "?a=estoque";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Erro!",
                            text: json.mensagem,
                            confirmButtonColor: "#d33"
                        });
                    }
                } catch (e){
                    console.error("Erro ao processo JSON: ", response + " " + e);
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
        })
    })

}




function modalSaida(botao) {
    const modalSaida = document.getElementById("saida-modal");
    const modalIdProduto = document.getElementById('id_produto_saida');
    const modalNomeProduto = document.getElementById('nome_produto_saida');
    const modalIdCorProduto = document.getElementById('id_cor_saida');
    const modalCorProduto = document.getElementById('produto_cor_saida');
    const modalTamanhoProduto = document.getElementById('produto_tamanho_saida');
    const modalIdTamanhoProduto = document.getElementById('id_tamanho_saida');
    const modalQuantidadeProduto = document.getElementById('qtdSaida_saida');

    modalQuantidadeProduto.style.backgroundColor = "#fff"
    // Pegando os atributos do botão clicado
    const produtoId = botao.getAttribute('data-id_saida');
    const corId = botao.getAttribute('data-id_cor_saida');
    const tamanhoId = botao.getAttribute('data-id_tamanho_saida');
    const produtoNome = botao.getAttribute('data-nome_produto_saida');
    const produtoCor = botao.getAttribute('data-nome_cor_saida');
    const produtoTamanho = botao.getAttribute('data-nome_tamanho_saida');
    const produtoQuantidade = botao.getAttribute('data-quantidade_disponivel_saida');

    

    
    modalIdProduto.value = produtoId;
    modalIdCorProduto.value = corId;
    modalIdTamanhoProduto.value = tamanhoId;
    modalNomeProduto.value = produtoNome;
    modalCorProduto.value = produtoCor;
    modalTamanhoProduto.value = produtoTamanho;
    modalQuantidadeProduto.value = produtoQuantidade

    

    modalSaida.style.display = 'block';
}

function fecharModalSaida(){
    const modalSaida = document.getElementById("saida-modal");

    modalSaida.style.display = 'none';
}

function cadastrarSaida(){
    $("#saida-form").on("submit", function(event) {
        
        
        event.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "?a=saida_estoque",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                try {
                    let json = response;

                    console.log(json);

                    if(json.status === "success"){
                        Swal.fire({
                            icon: "success",
                            title: "Sucesso!",
                            text: json.mensagem,
                            confirmButtonColor: "#28a745"
                        }).then(() => {
                            window.location.href = "?a=estoque";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Erro!",
                            text: json.mensagem,
                            confirmButtonColor: "#d33"
                        });
                    }
                } catch (e){
                    console.error("Erro ao processo JSON: ", response + " " + e);
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
        })
    })

}

