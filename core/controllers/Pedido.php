<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use PDO;

class Pedido{
    

    public function pagamento_processado(){

        echo '<pre>';
        print_r($_SESSION);
        die('OLA');
    }


}