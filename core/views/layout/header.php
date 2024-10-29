<?php

use core\classes\Store;

?>

<header>
    <nav class="nav-bar">
        <div class="logo">
            <a href="?a=inicio"><img src="assets/images/header-logo.png" alt=""></a>
        </div>
        <div class="nav-list">
            <ul>
                <li class="nav-item"><a href="?a=inicio" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="?a=loja" class="nav-link">Produtos</a></li>
                <li class="nav-item"><a href="?a=sobre" class="nav-link">Sobre</a></li>
            </ul>
        </div>
        <?php if(Store::clienteLogado()):?>
        <div class="login-container">
            <p class="nome-usuario">Olá <?=$_SESSION['nome']?></p>
            <div class="dropdown">
                <img src="assets/images/user-solid.svg" alt="">
                <ul class="dropdown-menu">
                    <li><a href="?a=user-account">Conta</a></li>
                    <li><a href="?a=logout">Sair</a></li>
                </ul>
            </div>
        </div>
        <?php else:?>
        <div class="dropdown">
            <img src="assets/images/user-solid.svg" alt="">
            <ul class="dropdown-menu">
                <li><a href="?a=login">Entrar</a></li>
                <li><a href="?a=registrar_usuario">Registrar</a></li>
            </ul>
        </div>
        <?php endif;?>
        <div class="mobile-menu-icon">
            <button onclick="menuShow()"><img src="assets/images/menu_white_36dp.svg" alt=""></button>
        </div>
    </nav>
</header>