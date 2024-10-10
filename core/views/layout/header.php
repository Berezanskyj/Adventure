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
                        <li class="nav-item"><a href="?a=sobre" class="nav-link"> Sobre</a></li>
                    </ul>
                </div>
                <div class="login-button">
                    <?php if(Store::clienteLogado()):?>
                    <div class="dropdown">
                        <img src="assets/images/user-solid.svg" alt="">

                        <div class="dropdown-menu">
                            <li><a href="?a=user-account">Conta</a></li>
                            <li><a href="?a=logout">Sair</a></li>
                        </div>
                    </div>
                <?php else:?>

                    <div class="dropdown">
                        <img src="assets/images/user-solid.svg" alt="">

                        <div class="dropdown-menu">
                            <li><a href="?a=login">Entrar</a></li>
                            <li><a href="?a=registrar_usuario">Registrar</a></li>
                        </div>
                    </div>
                </div>
                <?php endif;?>

                <div class="mobile-menu-icon">
                    <button onclick="menuShow()"><img class="icon" src="assets/images/menu_white_36dp.svg" alt=""></button>
                </div>
    </nav>
                <div class="mobile-menu">
                    <ul>
                        <li class="nav-item"><a href="?a=inicio" class="nav-link">Início</a></li>
                        <li class="nav-item"><a href="?a=loja" class="nav-link">Produtos</a></li>
                        <li class="nav-item"><a href="?a=sobre" class="nav-link"> Sobre</a></li>
                    </ul>

                    <div class="login-button">
                    <?php if(Store::clienteLogado()):?>
                        <button><a href="?a=user_account">Minha conta</a></button>
                        <button><a href="?a=logout">Sair</a></button>
                    <?php else:?>
                        <button><a href="?a=login">Entrar</a></button>
                        <button><a href="?a=registrar_usuario">Registrar</a></button>
                    <?php endif;?>
                    </div>
                </div>
</header>
