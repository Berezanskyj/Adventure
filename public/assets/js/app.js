
function adicionar_carrinho(id_produto){
    

    //adicionar produto ao carrinho
    axios.defaults.withCredentials = true;
    axios.get('?a=adicionar_carrinho&id_produto=' + id_produto)
        .then(function(response){

            var total_produtos = response.data;
            document.getElementById('carrinho').innerText = "Itens: " + total_produtos;

            console.log(response.data);


        })
}


function alerta_estoque(){
    Swal.fire({
        icon: "error",
        title: "Produto sem estoque",
        text: "Parece que estamos sem estoque deste produto, tente novamente mais tarde",
    });
}

function toggleEnderecoForm() {
    const form = document.getElementById('registrar_endereco');
    const checkbox = document.getElementById('editar-endereco');
    form.style.display = checkbox.checked ? 'block' : 'none';
}

function endereco_alternativo(){
    axios({
        method: 'post',
        url: '?a=endereco_alternativo',
        headers: {
            'Content-Type': 'application/json'  // Define o conteúdo como JSON
        },
        data: JSON.stringify({
            cep: document.getElementById('cep').value,
            cidade: document.getElementById('cidade').value,
            bairro: document.getElementById('bairro').value,
            rua: document.getElementById('rua').value,
            numero: document.getElementById('numero').value,
            complemento: document.getElementById('complemento').value,
            apelido: document.getElementById('apelido').value
        })
    })
    .then(response => {
        console.log("Endereço alternativo enviado com sucesso:", response.data);
        // Redireciona para a página de método de pagamento após sucesso
        window.location.href = '?a=metodo_pagamento';
    })
    .catch(error => {
        console.error("Erro ao enviar endereço alternativo:", error);
    });
}