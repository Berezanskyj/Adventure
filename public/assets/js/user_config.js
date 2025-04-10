document.addEventListener("DOMContentLoaded", function () {
    // Máscara para CPF
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');

    const cpfMask = new Inputmask('999.999.999-99'); // Máscara CPF
    const telefoneMask = new Inputmask('(99) 9 9999-9999'); // Máscara Telefone

    cpfMask.mask(cpfInput);
    telefoneMask.mask(telefoneInput);
});


//Formulario Usuario
$(document).ready(function () {

    // Quando o formulário é enviado
    $("#configuracoes-form").on("submit", function (event) {
        event.preventDefault(); // Impede o envio normal do formulário

        let formData = new FormData(this); // Captura os dados do formulário

        $.ajax({
            url: "?a=atualizar_configuracoes", // URL do processamento PHP
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                try {
                    let json = JSON.parse(response); // Converte resposta para JSON

                    if (json.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Sucesso!",
                            text: json.mensagem,
                            confirmButtonColor: "#28a745"
                        }).then(() => {
                            window.location.href = "?a=user_config"; // Redireciona após sucesso
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Erro!",
                            text: json.mensagem,
                            confirmButtonColor: "#d33"
                        });
                    }
                } catch (e) {
                    console.error("Erro ao processar JSON:", response);
                    Swal.fire({
                        icon: "error",
                        title: "Erro!",
                        text: "Erro inesperado ao processar a resposta.",
                        confirmButtonColor: "#d33"
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "Erro na requisição AJAX: " + error,
                    confirmButtonColor: "#d33"
                });
            }
        });
    });
});

// Formulario Endereço
$(document).ready(function () {

    // Quando o formulário é enviado
    $("#atualizar_endereco_form").on("submit", function (event) {
        event.preventDefault(); // Impede o envio normal do formulário

        let formData = new FormData(this); // Captura os dados do formulário

        $.ajax({
            url: "?a=atualizar_endereco", // URL do processamento PHP
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                try {
                    let json = JSON.parse(response); // Converte resposta para JSON

                    if (json.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Sucesso!",
                            text: json.mensagem,
                            confirmButtonColor: "#28a745"
                        }).then(() => {
                            window.location.href = "?a=user_config"; // Redireciona após sucesso
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Erro!",
                            text: json.mensagem,
                            confirmButtonColor: "#d33"
                        });
                    }
                } catch (e) {
                    console.error("Erro ao processar JSON:", response);
                    Swal.fire({
                        icon: "error",
                        title: "Erro!",
                        text: "Erro inesperado ao processar a resposta.",
                        confirmButtonColor: "#d33"
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "Erro na requisição AJAX: " + error,
                    confirmButtonColor: "#d33"
                });
            }
        });
    });
});


// Formulario Senha.
document.getElementById('atualizar_senha_form').addEventListener('submit', function (e) {
    // Obtendo os valores das senhas
    const novaSenha = document.getElementById('nova_senha').value;
    const confirmarSenha = document.getElementById('confirmar_senha').value;

    // Verificando se as senhas são iguais
    if (novaSenha !== confirmarSenha) {
        // Impede o envio do formulário
        e.preventDefault();

        // Exibe o SweetAlert2 com a mensagem de erro
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'As senhas não coincidem. Por favor, tente novamente.',
        });
    } else {
        // Se as senhas são iguais, o processo AJAX será executado
        e.preventDefault(); // Impede o envio do formulário padrão

        // Exibe o SweetAlert de carregamento
        const loadingAlert = Swal.fire({
            title: 'Carregando...',
            text: 'Por favor, aguarde enquanto processamos sua solicitação.',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading(); // Exibe a animação de carregamento
            }
        });

        let formData = new FormData(this); // Captura os dados do formulário

        $.ajax({
            url: "?a=atualizar_seguranca", // URL do processamento PHP
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                try {
                    let json = JSON.parse(response); // Converte resposta para JSON

                    // Fecha o SweetAlert de carregamento
                    loadingAlert.close();

                    if (json.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Sucesso!",
                            text: json.mensagem,
                            confirmButtonColor: "#28a745"
                        }).then(() => {
                            window.location.href = "?a=user_config"; // Redireciona após sucesso
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Erro!",
                            text: json.mensagem,
                            confirmButtonColor: "#d33"
                        });
                    }
                } catch (e) {
                    console.error("Erro ao processar JSON:", response);
                    // Fecha o SweetAlert de carregamento
                    loadingAlert.close();

                    Swal.fire({
                        icon: "error",
                        title: "Erro!",
                        text: "Erro inesperado ao processar a resposta.",
                        confirmButtonColor: "#d33"
                    });
                }
            },
            error: function (xhr, status, error) {
                // Fecha o SweetAlert de carregamento
                loadingAlert.close();

                Swal.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "Erro na requisição AJAX: " + error,
                    confirmButtonColor: "#d33"
                });
            }
        });
    }
});
