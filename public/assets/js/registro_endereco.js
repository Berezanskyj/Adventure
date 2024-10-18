function mostrarEndereco(dados) {
    let bairro = document.getElementById('bairro');
    let rua = document.getElementById('rua');
    let cidade = document.getElementById('cidade');


    bairro.value = dados.bairro; 
    rua.value = dados.logradouro; 
    cidade.value = dados.localidade + " - " + dados.uf; 
}

function consultaEndereco(){
    let cep = document.getElementById("cep").value;

    if (cep.length !== 8) {
        window.alert("CEP Inválido");
        return;
    }

    let url = `https://viacep.com.br/ws/${cep}/json/`;

    fetch(url).then(function(response){
        response.json().then(function(data){
            console.log(data);
            mostrarEndereco(data);
        })
    })
}

