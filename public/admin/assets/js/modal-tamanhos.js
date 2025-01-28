
function abrirModalRegistro() {
    const modal = document.getElementById('register-modal');
    modal.style.display = 'block';
}

function fecharModalRegistro() {
    const modal = document.getElementById('register-modal');
    modal.style.display = 'none';
}

function abrirModalEditar(id, nome) {
    const modal = document.getElementById('change-size-modal');
    const nomeCategoria = document.getElementById('tamanho');
    const idCategoria = document.getElementById('id');

    nomeCategoria.value = nome;
    idCategoria.value = id;

    modal.style.display = 'block';
}

function fecharModalEditar() {
    const modal = document.getElementById('change-size-modal');

    modal.style.display = 'none';
}

function cadastrarTamanho() {
    const tamanho = document.getElementById('nameCategoryModal').value;


    $.ajax({
        url: '?a=criar_tamanho_produto',
        type: 'POST',
        data: { tamanho: tamanho }, // Envia o valor correto
        success: function (response) {
            console.log("Resposta: ", response);

            Swal.fire({
                title: 'Sucesso!',
                text: 'Tamanho cadastrado com sucesso.',
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then(() => {
                location.reload(); // Recarrega a página após o alerta de sucesso
            });
        },
        error: function (error) {
            console.error("Erro ao criar tamanho:", error);

            Swal.fire({
                title: 'Erro.',
                text: 'Erro ao registrar tamanho. Tente novamente.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
        }
    });

    console.log(categoria);
}

function editarTamanho() {

    const tamanho = document.getElementById('tamanho').value;
    const id = document.getElementById('id').value;


    $.ajax({
        url: '?a=editar_tamanho_produto',
        type: 'POST',
        data: {
            tamanho: tamanho,
            id: id
        }, // Envia o valor correto
        success: function (response) {
            console.log("Resposta: ", response);

            Swal.fire({
                title: 'Sucesso!',
                text: 'Tamanho editado com sucesso.',
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then(() => {
                location.reload(); // Recarrega a página após o alerta de sucesso
            });
        },
        error: function (error) {
            console.error("Erro ao editar tamanho:", error);

            Swal.fire({
                title: 'Erro.',
                text: 'Erro ao editar tamanho. Tente novamente.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
        }
    });


}