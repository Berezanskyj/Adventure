const themeToggler = document.querySelector('.theme-toggler');
const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");


document.addEventListener("DOMContentLoaded", function() {
    const themeToggler = document.querySelector('.theme-toggler');

    // Checar se há um tema salvo no localStorage
    const savedTheme = localStorage.getItem('theme');

    // Aplicar o tema salvo (se houver)
    if (savedTheme) {
        document.body.classList.add(savedTheme);
        if (savedTheme === 'dark-theme-variables') {
            themeToggler.querySelector('span:nth-child(1)').classList.remove('active'); // Light mode ícone
            themeToggler.querySelector('span:nth-child(2)').classList.add('active');   // Dark mode ícone
        } else {
            themeToggler.querySelector('span:nth-child(1)').classList.add('active');
            themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
        }
    }

    // Alternar entre dark e light theme e salvar no localStorage
    themeToggler.addEventListener('click', () => {
        document.body.classList.toggle('dark-theme-variables');

        const isDarkMode = document.body.classList.contains('dark-theme-variables');

        // Salvar a preferência do tema no localStorage
        if (isDarkMode) {
            localStorage.setItem('theme', 'dark-theme-variables');
            themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
            themeToggler.querySelector('span:nth-child(2)').classList.add('active');
        } else {
            localStorage.setItem('theme', 'light-theme-variables');
            themeToggler.querySelector('span:nth-child(1)').classList.add('active');
            themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
        }
    });
});




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


document.addEventListener("DOMContentLoaded", () => {
    // Seleciona todos os elementos com o id "status"
    const statusElements = document.querySelectorAll("#status");

    // Itera sobre os elementos encontrados
    statusElements.forEach((element) => {
        const statusText = element.textContent.trim().toLowerCase(); // Obtém o texto do status

        // Remove classes existentes antes de adicionar a nova
        element.classList.remove("success", "danger", "warning");

        // Aplica a classe correspondente ao status
        if (statusText === "cancelado") {
            element.classList.add("danger");
        } else if (statusText === "enviado") {
            element.classList.add("primary");
        } else if (statusText === "pendente") {
            element.classList.add("warning");
        } else {
            element.classList.add("success");
        }
    });
});




// themeToggler.addEventListener('click', () => {
//     document.body.classList.toggle('dark-theme-variables');

//     themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
//     themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
// })
