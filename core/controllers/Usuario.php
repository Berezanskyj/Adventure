<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use PDO;

class Usuario{
    

    public function user_account(){

        Store::Layout([
            'layout/html_header',
            'layout/header',
            'user_account',
            'layout/footer',
            'layout/html_footer',
        ]);
    }


}