const UserInformationForm = document.querySelector('.UserInformationForm');
const UserAddressForm = document.querySelector('.UserAddressForm');
const btnUserAddress = document.querySelector('.btnUserAddress');
const btnUserInformation = document.querySelector('.btnUserInformation');
let nome = document.getElementById('nome');
let sobrenome = document.getElementById('sobrenome');
let email = document.getElementById('email');
let telefone = document.getElementById('telefone');
let senha = document.getElementById('senha');
let confirma_senha = document.getElementById('confirma_senha');

btnUserInformation.onclick = (event) => {
event.preventDefault(); // Impede o recarregamento da página

if (nome.value && sobrenome.value && email.value && telefone.value && senha.value && confirma_senha.value) {
    UserAddressForm.classList.add('active');
    UserInformationForm.classList.add('active');
} else {
    window.alert("Preencha todos os campos.");
}
};


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

    if(cep.lenght > 8 && cep.lenght < 8){
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

