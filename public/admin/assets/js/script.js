const themeToggler = document.querySelector('.theme-toggler');
const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");





menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
})





document.addEventListener("DOMContentLoaded", function() {
    const dateInput = document.getElementById("date-input");
    const today = new Date();
    
    // Formatar a data no formato YYYY-MM-DD
    const formattedDate = today.toLocaleDateString('pt-BR', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    }).split('/').reverse().join('-'); // Converte para o formato correto

    dateInput.value = formattedDate;
});



document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle'); // Seleciona todos os dropdown-toggles

    dropdownToggles.forEach(function (toggle) {
        const dropdownContent = toggle.nextElementSibling; // Seleciona o conteúdo do dropdown adjacente
        const arrow = toggle.querySelector('.arrow'); // Seleciona a seta dentro do toggle

        toggle.addEventListener('click', function (event) {
            event.preventDefault(); // Evita o comportamento padrão do link
            
            // Alterna a exibição do dropdown
            const isDropdownOpen = dropdownContent.style.display === 'block';
            dropdownContent.style.display = isDropdownOpen ? 'none' : 'block';

            // Alterna a classe "open" na seta
            arrow.classList.toggle('open', !isDropdownOpen);
        });

        // Fecha o dropdown e reseta a seta se clicar fora dele
        window.addEventListener('click', function (event) {
            if (!toggle.contains(event.target) && !dropdownContent.contains(event.target)) {
                dropdownContent.style.display = 'none';
                arrow.classList.remove('open'); // Remove a classe "open" da seta
            }
        });
    });
});


themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})
