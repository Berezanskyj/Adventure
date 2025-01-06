document.addEventListener('DOMContentLoaded', function () {
    const telefone = document.getElementById('telefone');
    const cpf = document.getElementById('cpf');
    const cep = document.getElementById('cep');

    if (telefone) {
        const telefoneMask = new Inputmask('(99) 9 9999-9999');
        telefoneMask.mask(telefone);
    }

    if (cpf) {
        const cpfMask = new Inputmask('999.999.999-99');
        cpfMask.mask(cpf);
    }
});