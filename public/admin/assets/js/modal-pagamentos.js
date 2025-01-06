const addPayment = document.getElementById('create-payment-method');
const userModal = document.getElementById('user-modal');


// const IDuserModal = document.getElementById('idUsuarioModal');
// const nomeUsuarioModal = document.getElementById('nomeUsuarioModal');
// const sobrenomeUsuarioModal = document.getElementById('sobrenomeUsuarioModal');
// const emailUsuarioModal = document.getElementById('emailUsuarioModal');
// const cpfUsuarioModal = document.getElementById('cpfUsuarioModal');
// const telefoneUsuarioModal = document.getElementById('telefoneUsuarioModal');



const closeModal = document.querySelector('.close-modal');

// Inputs da modal
const inputId = document.getElementById('botao-editar');

console.log(inputId);


function abrirModal(){
    userModal.style.display = 'block';
}

// Abrir modal e preencher os campos
// addPayment.forEach((button) => {
//     button.addEventListener('click', () => {
        // const userId = button.getAttribute('data-id');
        // const nome = button.getAttribute('data-nome');
        // const sobrenome = button.getAttribute('data-sobrenome');
        // const email = button.getAttribute('data-email');
        // const cpf = button.getAttribute('data-cpf');
        // const telefone = button.getAttribute('data-telefone');

        // console.log(inputId);

        // const cpfInput = document.getElementById('cpfUsuarioModal');
        // const telefoneInput = document.getElementById('telefoneUsuarioModal');

        // const cpfMask = new Inputmask('999.999.999-99'); // Máscara CPF
        // const telefoneMask = new Inputmask('(99) 9 9999-9999'); // Máscara Telefone

        // cpfMask.mask(cpfInput);
        // telefoneMask.mask(telefoneInput);

        // // Preenche os inputs da modal
        // IDuserModal.value = userId;
        // nomeUsuarioModal.value = nome;
        // sobrenomeUsuarioModal.value = sobrenome;
        // emailUsuarioModal.value = email;
        // cpfUsuarioModal.value = cpf;
        // telefoneUsuarioModal.value = telefone;


        // Exibe a modal
//         userModal.style.display = 'block';
//     });
// });

// Fechar modal
closeModal.addEventListener('click', () => {
    userModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === userModal) {
        userModal.style.display = 'none';
    }
});

// document.getElementById('user-form').addEventListener('submit', async function (event) {
//     event.preventDefault(); // Previne o comportamento padrão do formulário (recarregar a página)

//     // Captura os dados do formulário
//     const formData = new FormData(this);

//     try {
//         // Envia os dados via AJAX para o PHP
//         const response = await fetch('?a=editar_usuario', {
//             method: 'POST',
//             body: formData,
//         });

//         // Garante que o retorno seja em JSON
//         const result = await response.json();

//         console.log('Dados enviados:', result.data);

//         if (result.success) {
//             // Armazena o sucesso no localStorage para exibir o alert após o reload
//             localStorage.setItem('userUpdateSuccess', 'true');

//             // Recarrega a página
//             location.reload();
//         } else {
//             Swal.fire({
//                 title: 'Erro!',
//                 text: result.message || 'Ocorreu um problema ao atualizar o usuário.',
//                 icon: 'error',
//                 confirmButtonText: 'Ok',
//             });
//         }
//     } catch (error) {
//         // Trate erros inesperados (ex.: falha de conexão)
//         Swal.fire({
//             title: 'Erro inesperado!',
//             text: 'Não foi possível processar a solicitação. Tente novamente mais tarde.',
//             icon: 'error',
//             confirmButtonText: 'Ok',
//         });
//         console.error('Erro na solicitação:', error);
//     }
// });

// // Após o carregamento da página, verifica se o sucesso foi registrado
// window.addEventListener('load', function () {
//     if (localStorage.getItem('userUpdateSuccess') === 'true') {
//         // Exibe o SweetAlert de sucesso
//         Swal.fire({
//             title: 'Sucesso!',
//             text: 'Usuário atualizado com sucesso.',
//             icon: 'success',
//             confirmButtonText: 'Ok',
//         });

//         // Remove o item do localStorage após exibir o alerta
//         localStorage.removeItem('userUpdateSuccess');
//     }
// });


// document.addEventListener("DOMContentLoaded", function () {
//     // Máscara para CPF
//     const cpfInput = document.getElementById('cpf');
//     const telefoneInput = document.getElementById('telefone');

//     const cpfMask = new Inputmask('999.999.999-99'); // Máscara CPF
//     const telefoneMask = new Inputmask('(99) 9 9999-9999'); // Máscara Telefone

//     cpfMask.mask(cpfInput);
//     telefoneMask.mask(telefoneInput);
// });


// function excluirUsuario(id) {
//     Swal.fire({
//         title: "Você tem certeza?",
//         text: "Não será possível reverter essa alteração!",
//         icon: "warning",
//         showCancelButton: true,
//         cancelButtonText: "Cancelar",
//         confirmButtonColor: "#d33",
//         cancelButtonColor: "#6E7881",
//         confirmButtonText: "Sim, deletar"
//     }).then((result) => {
//         if (result.isConfirmed) {
//             // Usando $.ajax para fazer a requisição AJAX
//             console.log(result.data)
//             $.ajax({
//                 url: "?a=excluir_usuario",  // Ação para excluir o usuário
//                 type: "GET",
//                 data: { id: id },  // Enviando o ID do usuário a ser deletado
//                 success: function(response) {
//                     // Se a exclusão for bem-sucedida, exibe a mensagem de sucesso
//                     Swal.fire({
//                         title: "Usuário Excluído!",
//                         text: "O usuário selecionado foi excluído.",
//                         icon: "success"
//                     }).then(() => {
//                         // Recarrega a página após o alerta de sucesso
//                         location.reload(); // Recarregar a página
//                     });
//                 },
//                 error: function() {
//                     // Se ocorrer um erro durante a requisição
//                     Swal.fire({
//                         title: "Erro!",
//                         text: "Ocorreu um erro ao tentar excluir o usuário.",
//                         icon: "error"
//                     });
//                 }
//             });
//         }
//     });
// }