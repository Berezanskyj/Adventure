
function abrirModalRegistro() {
    const modal = document.getElementById('register-modal');
    modal.style.display = 'block';
}

function fecharModalRegistro() {
    const modal = document.getElementById('register-modal');
    modal.style.display = 'none';
}

function abrirModalEditar(id, nome) {
    const modal = document.getElementById('change-category-modal');
    const nomeCategoria = document.getElementById('categoria');
    const idCategoria = document.getElementById('id');

    nomeCategoria.value = nome;
    idCategoria.value = id;

    modal.style.display = 'block';
}

function fecharModalEditar() {
    const modal = document.getElementById('change-category-modal');

    modal.style.display = 'none';
}

function cadastrarCategoria() {
    const categoria = document.getElementById('nameCategoryModal').value;


    $.ajax({
        url: '?a=criar_categoria_produto',
        type: 'POST',
        data: { categoria: categoria }, // Envia o valor correto
        success: function (response) {
            console.log("Resposta: ", response);

            Swal.fire({
                title: 'Sucesso!',
                text: 'Categoria cadastrada com sucesso.',
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then(() => {
                location.reload(); // Recarrega a página após o alerta de sucesso
            });
        },
        error: function (error) {
            console.error("Erro ao criar categoria:", error);

            Swal.fire({
                title: 'Erro.',
                text: 'Erro ao registrar categoria. Tente novamente.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
        }
    });

    console.log(categoria);
}

function editarCategoria() {

    const categoria = document.getElementById('categoria').value;
    const id = document.getElementById('id').value;


    $.ajax({
        url: '?a=editar_categoria_produto',
        type: 'POST',
        data: {
            categoria: categoria,
            id: id
        }, // Envia o valor correto
        success: function (response) {
            console.log("Resposta: ", response);

            Swal.fire({
                title: 'Sucesso!',
                text: 'Categoria editada com sucesso.',
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then(() => {
                location.reload(); // Recarrega a página após o alerta de sucesso
            });
        },
        error: function (error) {
            console.error("Erro ao editar categoria:", error);

            Swal.fire({
                title: 'Erro.',
                text: 'Erro ao editar categoria. Tente novamente.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
        }
    });


}