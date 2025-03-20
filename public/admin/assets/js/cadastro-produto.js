document.getElementById('product-form').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Produto cadastrado com sucesso!');
});

document.getElementById('imagem').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Pré-visualização">`;
        };
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '<span>Pré-visualização da imagem</span>';
    }
});

document.addEventListener("DOMContentLoaded", function () {
var im = new Inputmask("R$ 9{1,3}.9{1,3}.9{1,3},99", {
"numericInput": true, // Permite entrada numérica
"radixPoint": ",",    // Define a vírgula como separador decimal
"groupSeparator": ".", // Define o ponto como separador de milhar
"prefix": "R$ ",      // Prefixo "R$" na frente
"rightAlign": false,  // Alinha à esquerda
"clearMaskOnLostFocus": true, // Limpa a máscara quando o campo perde foco
"autoUnmask": true, // Permite o valor sem a máscara ser recuperado ao enviar o formulário
"onincomplete": function() {
    this.inputmask.setValue(this.inputmask.unmaskedvalue());
}
});

im.mask(document.getElementById("preco"));
});