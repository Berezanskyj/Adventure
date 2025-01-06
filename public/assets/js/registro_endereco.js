function mostrarEndereco(dados) {
    let bairro = document.getElementById('bairro');
    let rua = document.getElementById('rua');
    let cidade = document.getElementById('cidade');


    bairro.value = dados.bairro; 
    rua.value = dados.logradouro; 
    cidade.value = dados.localidade + " - " + dados.uf; 
}

function consultaEndereco() {
    // Obtém o valor do campo de CEP
    let cep = document.getElementById("cep").value;

    // Remove a máscara (mantém apenas os números)
    cep = cep.replace(/[^0-9]/g, '');

    // Valida o tamanho do CEP (deve conter 8 dígitos)
    if (cep.length !== 8) {
        window.alert("CEP Inválido");
        return;
    }

    // Define a URL da API com o CEP sem máscara
    let url = `https://viacep.com.br/ws/${cep}/json/`;

    // Faz a requisição à API
    fetch(url)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            console.log(data);
            mostrarEndereco(data); // Chama a função para exibir os dados do endereço
        })
        .catch(function(error) {
            console.error("Erro ao buscar o endereço:", error);
            window.alert("Erro ao buscar o endereço. Tente novamente.");
        });
}