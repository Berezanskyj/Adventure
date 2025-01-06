const addUserButtons = document.querySelectorAll('.add-user');
const userModal = document.getElementById('user-modal');
const registerUserModal = document.getElementById('register-user-modal');


const IDuserModal = document.getElementById('idUsuarioModal');
const nomeUsuarioModal = document.getElementById('nomeUsuarioModal');
const sobrenomeUsuarioModal = document.getElementById('sobrenomeUsuarioModal');
const emailUsuarioModal = document.getElementById('emailUsuarioModal');
const cpfUsuarioModal = document.getElementById('cpfUsuarioModal');
const telefoneUsuarioModal = document.getElementById('telefoneUsuarioModal');



const closeModal = document.querySelector('.close-modal');

// Inputs da modal
const inputId = document.getElementById('botao-editar');

console.log(inputId);


// Abrir modal e preencher os campos
addUserButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const userId = button.getAttribute('data-id');
        const nome = button.getAttribute('data-nome');
        const sobrenome = button.getAttribute('data-sobrenome');
        const email = button.getAttribute('data-email');
        const cpf = button.getAttribute('data-cpf');
        const telefone = button.getAttribute('data-telefone');

        console.log(inputId);

        const cpfInput = document.getElementById('cpfUsuarioModal');
        const telefoneInput = document.getElementById('telefoneUsuarioModal');

        const cpfMask = new Inputmask('999.999.999-99'); // Máscara CPF
        const telefoneMask = new Inputmask('(99) 9 9999-9999'); // Máscara Telefone

        cpfMask.mask(cpfInput);
        telefoneMask.mask(telefoneInput);

        // Preenche os inputs da modal
        IDuserModal.value = userId;
        nomeUsuarioModal.value = nome;
        sobrenomeUsuarioModal.value = sobrenome;
        emailUsuarioModal.value = email;
        cpfUsuarioModal.value = cpf;
        telefoneUsuarioModal.value = telefone;


        // Exibe a modal
        userModal.style.display = 'block';
    });
});

// Fechar modal
closeModal.addEventListener('click', () => {
    userModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === userModal) {
        userModal.style.display = 'none';
    }
});

document.getElementById('user-form').addEventListener('submit', async function (event) {
    event.preventDefault(); // Previne o comportamento padrão do formulário (recarregar a página)

    // Captura os dados do formulário
    const formData = new FormData(this);

    try {
        // Envia os dados via AJAX para o PHP
        const response = await fetch('?a=editar_usuario', {
            method: 'POST',
            body: formData,
        });

        // Garante que o retorno seja em JSON
        const result = await response.json();

        console.log('Dados enviados:', result.data);

        if (result.success) {
            // Armazena o sucesso no localStorage para exibir o alert após o reload
            localStorage.setItem('userUpdateSuccess', 'true');

            // Recarrega a página
            location.reload();
        } else {
            Swal.fire({
                title: 'Erro!',
                text: result.message || 'Ocorreu um problema ao atualizar o usuário.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
        }
    } catch (error) {
        // Trate erros inesperados (ex.: falha de conexão)
        Swal.fire({
            title: 'Erro inesperado!',
            text: 'Não foi possível processar a solicitação. Tente novamente mais tarde.',
            icon: 'error',
            confirmButtonText: 'Ok',
        });
        console.error('Erro na solicitação:', error);
    }
});


// document.getElementById('register-user-form').addEventListener('submit', async function (event) {
//     // event.preventDefault(); // Previne o comportamento padrão do formulário (recarregar a pagia)

//     const formData = new FormData(this);

//     try {
//         const response = await fetch('?a=registrar_usuario', {
//             method: 'POST',
//             body: formData,
//         });

//         const result = await response.json();

//         if (result.success) {
//             localStorage.setItem('RegisteruserUpdateSuccess', 'true');

//             // Recarrega a página
//             location.reload();

//             console.log(result.data);
//             console.log(response.json);
//         } else {
//             Swal.fire({
//                 title: 'Erro!',
//                 text: result.message || 'erro.',
//                 icon: 'error',
//                 confirmButtonText: 'OK',
//             });
//             console.log(result.data);
//             console.log(response.json);
//         }
//     } catch (error) {
//         Swal.fire({
//             title: 'Erro!',
//             text: 'Ocorreu um erro ao cadastrar o usuário.' + error.message,
//             icon: 'error',
//             confirmButtonText: 'OK',
//         });
//         console.log("Erro na solicitacao", error.message);
//     }
// });


function registrarUsuario() {
    // Captura os valores do formulário
    const nome = $('#registronomeUsuarioModal').val();
    const sobrenome = $('#registrosobrenomeUsuarioModal').val();
    const email = $('#registroemailUsuarioModal').val();
    const cpf = $('#registrocpfUsuarioModal').val();
    const telefone = $('#registrotelefoneUsuarioModal').val();
    const senha = $('#registrosenha').val();
    const nivelUsuario = $('#nivel_usuario').val();
    const cpfNoMask = $('#registrocpfUsuarioModal').val().replace(/\D/g, ''); // Remove a máscara do CPF
    const telefoneNoMask = $('#registrotelefoneUsuarioModal').val().replace(/\D/g, ''); // Remove a máscara do telefone

    // Validações básicas antes do envio
    if (!nome || !sobrenome || !email || !cpf || !telefone || !senha) {
        alert("Todos os campos devem ser preenchidos.");
        return;
    }

    if (cpfNoMask.length < 11) {
        Swal.fire({
            title: 'CPF Inválido!',
            text: 'O CPF deve conter todos os caracteres.',
            icon: 'error',
            confirmButtonText: 'Ok',
        });
        return;
    }

    if (telefoneNoMask.length < 11) {
        Swal.fire({
            title: 'Telefone Inválido!',
            text: 'O telefone deve conter todos os caracteres (incluindo DDD).',
            icon: 'error',
            confirmButtonText: 'Ok',
        });
        return;
    }

    // Envia os dados via AJAX
    $.ajax({
        url: '?a=registrar_usuario',
        type: 'POST',
        data: {
            nome: nome,
            sobrenome: sobrenome,
            email: email,
            cpf: cpf,
            telefone: telefone,
            senha: senha,
            nivel_usuario: nivelUsuario
        },
        success: function (response) {
            // Exibe a resposta do servidor no console
            console.log("Resposta do servidor:", response);

            Swal.fire({
                title: 'Sucesso!',
                text: 'Usuário cadastrado com sucesso.',
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then(() => {
                location.reload(); // Recarrega a página após o alerta de sucesso
            });
        },
        error: function (error) {
            console.error("Erro no servidor:", error);
            console.log("Resposta do servidor:", error);

            Swal.fire({
                title: 'Erro.',
                text: 'Erro ao registrar usuário. Tente novamente.',
                icon: 'error',
                confirmButtonText: 'Ok',
            });
        }
    });
}

// Após o carregamento da página, verifica se o sucesso foi registrado
window.addEventListener('load', function () {
    if (localStorage.getItem('userUpdateSuccess') === 'true') {
        // Exibe o SweetAlert de sucesso
        Swal.fire({
            title: 'Sucesso!',
            text: 'Usuário atualizado com sucesso.',
            icon: 'success',
            confirmButtonText: 'Ok',
        });

        // Remove o item do localStorage após exibir o alerta
        localStorage.removeItem('userUpdateSuccess');
    }
});




document.addEventListener("DOMContentLoaded", function () {
    // Máscara para CPF
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');

    const cpfMask = new Inputmask('999.999.999-99'); // Máscara CPF
    const telefoneMask = new Inputmask('(99) 9 9999-9999'); // Máscara Telefone

    cpfMask.mask(cpfInput);
    telefoneMask.mask(telefoneInput);
});


function excluirUsuario(id) {
    Swal.fire({
        title: "Você tem certeza?",
        text: "Não será possível reverter essa alteração!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6E7881",
        confirmButtonText: "Sim, deletar"
    }).then((result) => {
        if (result.isConfirmed) {
            // Usando $.ajax para fazer a requisição AJAX
            console.log(result.data)
            $.ajax({
                url: "?a=excluir_usuario",  // Ação para excluir o usuário
                type: "GET",
                data: { id: id },  // Enviando o ID do usuário a ser deletado
                success: function (response) {
                    // Se a exclusão for bem-sucedida, exibe a mensagem de sucesso
                    Swal.fire({
                        title: "Usuário Excluído!",
                        text: "O usuário selecionado foi excluído.",
                        icon: "success"
                    }).then(() => {
                        // Recarrega a página após o alerta de sucesso
                        location.reload(); // Recarregar a página
                    });
                },
                error: function () {
                    // Se ocorrer um erro durante a requisição
                    Swal.fire({
                        title: "Erro!",
                        text: "Ocorreu um erro ao tentar excluir o usuário.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

function abrirModal() {
    registerUserModal.style.display = 'block'

    const cpfInput = document.getElementById('registrocpfUsuarioModal');
    const telefoneInput = document.getElementById('registrotelefoneUsuarioModal');

    const cpfMask = new Inputmask('999.999.999-99'); // Máscara CPF
    const telefoneMask = new Inputmask('(99) 9 9999-9999'); // Máscara Telefone

    cpfMask.mask(cpfInput);
    telefoneMask.mask(telefoneInput);
}


function fecharModal() {
    registerUserModal.style.display = 'none'

}


