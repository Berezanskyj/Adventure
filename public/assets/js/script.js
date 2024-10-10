function menuShow() {
    let menuMobile = document.querySelector('.mobile-menu');
    if (menuMobile.classList.contains('open')) {
        menuMobile.classList.remove('open');
        document.querySelector('.icon').src = "assets/images/menu_white_36dp.svg";
    } else {
        menuMobile.classList.add('open');
        document.querySelector('.icon').src = "assets/images/close_white_36dp.svg";
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const uniformeslBtn = document.getElementById('uniformes');
    const brindesBtn = document.getElementById('brindes');
    const radioLabels = document.querySelectorAll('.radio');

    // Função para atualizar o estilo dos radio buttons
    function updateRadioStyles() {
        radioLabels.forEach(label => {
            if (label.querySelector('input').checked) {
                label.classList.add('checked');
            } else {
                label.classList.remove('checked');
            }
        });
    }

    // Inicializa os estilos
    updateRadioStyles();

    // Adiciona eventos de mudança aos radio buttons
    uniformeslBtn.addEventListener('change', updateRadioStyles);
    brindesBtn.addEventListener('change', updateRadioStyles);
});
