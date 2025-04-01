function modalSaida(botao) {
    const modalSaida = document.getElementById("saida-modal");
    const modalNomeProduto = document.getElementById('nome_produto');
    const modalCorProduto = document.getElementById('produto_cor');
    const modalTamanhoProduto = document.getElementById('produto_tamanho');
    const modalQuantidadeProduto = document.getElementById('qtdSaida');

    modalQuantidadeProduto.style.backgroundColor = "#fff"
    // Pegando os atributos do botão clicado
    const produtoId = botao.getAttribute('data-id');
    const produtoNome = botao.getAttribute('data-nome_produto');
    const produtoCor = botao.getAttribute('data-nome_cor');
    const produtoTamanho = botao.getAttribute('data-nome_tamanho');
    const produtoQuantidade = botao.getAttribute('data-quantidade_disponivel');

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
    
}

function modalEntrada(botao) {
    const modalEntrada = document.getElementById("entrada-modal");
    const modalNomeProduto = document.getElementById('nome_produto');
    const modalCorProduto = document.getElementById('produto_cor');
    const modalTamanhoProduto = document.getElementById('produto_tamanho');
    const modalQuantidadeProduto = document.getElementById('qtdEntrada');

    modalQuantidadeProduto.style.backgroundColor = "#fff"
    // Pegando os atributos do botão clicado
    const produtoId = botao.getAttribute('data-id');
    const produtoNome = botao.getAttribute('data-nome_produto');
    const produtoCor = botao.getAttribute('data-nome_cor');
    const produtoTamanho = botao.getAttribute('data-nome_tamanho');
    const produtoQuantidade = botao.getAttribute('data-quantidade_disponivel');

    modalNomeProduto.value = produtoNome;
    modalCorProduto.value = produtoCor;
    modalTamanhoProduto.value = produtoTamanho;
    modalQuantidadeProduto.value = produtoQuantidade


    modalEntrada.style.display = 'block';
}

function fecharModalEntrada(){
    const modalEntrada = document.getElementById("entrada-modal");

    modalEntrada.style.display = 'none';
}