<?php
use core\classes\Database;

//* Inicia a sessão
session_start();

//* Carrega todas as classes do projeto via autoload do Composer
require_once('../../vendor/autoload.php');

//* Carrega o sistema de rotas
require_once('../../core/rotas_admin.php');

