$("#formDuvidas").on("submit", function (event) {
    event.preventDefault(); // Impede o envio normal do formulário

    let formData = new FormData(this); // Captura os dados do formulário

    $.ajax({
        url: "?a=formulario-duvidas",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            Swal.fire({
                title: 'Enviando...',
                text: 'Por favor, aguarde.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading(); // Mostra o loader
                }
            });
        },
        success: function (response) {
            Swal.close(); // Fecha o loader

            try {
                let json = response;

                if (json.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Sucesso!",
                        text: json.mensagem,
                        confirmButtonColor: "#28a745"
                    }).then(() => {
                        window.location.href = "?a=gerencia_produtos";
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
            Swal.close(); // Fecha o loader
            Swal.fire({
                icon: "error",
                title: "Erro!",
                text: "Erro na requisição AJAX: " + error,
                confirmButtonColor: "#d33"
            });
        }
    });
});
