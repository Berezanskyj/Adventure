<?php

use core\classes\Store;

?>

<header>
    <nav class="nav-bar">
        <!-- Logo alinhado à esquerda -->
        <div class="logo">
            <a href="?a=inicio"><img src="assets/images/Novo Projeto.png" alt=""></a>
        </div>

        <!-- Opções de navegação centralizadas -->
        <div class="nav-list">
            <ul>
                <li class="nav-item"><a href="?a=inicio" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="?a=loja" class="nav-link">Produtos</a></li>
                <li class="nav-item"><a href="?a=sobre" class="nav-link">Sobre</a></li>
            </ul>
        </div>
        
        <!-- Dropdown Menu de Usuário à direita -->
        <div class="dropdown">
            <img src="assets/images/user-solid.svg" alt="User Icon" class="user-icon" onclick="toggleDropdown()">
            <ul class="dropdown-menu" id="dropdownMenu">
                <?php if(Store::clienteLogado()): ?>
                    <li><a class="nav-link" href="?a=user_account">Minha Conta</a></li>
                    <li><a class="nav-link" href="?a=logout">Sair</a></li>
                <?php else: ?>
                    <li><a class="nav-link" href="?a=login">Entrar</a></li>
                    <li><a class="nav-link" href="?a=registrar_usuario">Registrar</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Ícone de menu mobile, visível apenas em telas menores -->
        <div class="mobile-menu-icon">
            <button onclick="menuShow()"><img src="assets/images/menu_white_36dp.svg" alt=""></button>
        </div>
    </nav>
</header>

<!-- Menu mobile que aparece apenas em dispositivos móveis -->
<div class="mobile-menu">
    <ul>
        <li class="nav-item"><a href="?a=inicio" class="nav-link">Início</a></li>
        <li class="nav-item"><a href="?a=loja" class="nav-link">Produtos</a></li>
        <li class="nav-item"><a href="?a=sobre" class="nav-link">Sobre</a></li>
        <?php if(Store::clienteLogado()): ?>
            <li class="nav-item"><a class="nav-link" href="?a=user_account">Minha Conta</a></li>
            <li class="nav-item"><a class="nav-link" href="?a=logout">Sair</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="?a=login">Entrar</a></li>
            <li class="nav-item"><a class="nav-link" href="?a=registrar_usuario">Registrar</a></li>
        <?php endif; ?>
    </ul>
</div>

<script>
function toggleDropdown() {
    document.getElementById("dropdownMenu").classList.toggle("show");
}

// Fechar dropdown ao clicar fora
window.onclick = function(event) {
    if (!event.target.matches('.user-icon')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
</script>
