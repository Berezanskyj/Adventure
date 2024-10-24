
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