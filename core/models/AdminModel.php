<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class AdminModel
{

    public function validar_login($usuario, $senha)
    {
        $sql = new Database();

        $param = [
            ':usuario' => $usuario
        ];

        $sql = new Database();
        $resultado = $sql->select("SELECT * FROM usuario WHERE email = :usuario AND ativo = 1 AND nivel_usuario = 1", $param);


        if (count($resultado) != 1) {
            //usuario nao existe
            return false;
        } else {
            //usuario existe
            $usuario = $resultado[0];

            if (!password_verify($senha, $usuario->senha)) {
                //usuario existe mas a senha nao corresponde
                return false;
            } else {

                //login valido 
                return $usuario;
            }
        }
    }

    public function totalVendas()
    {
        $sql = new Database();


        $res = $sql->select("SELECT IFNULL(ROUND(SUM(total_pedido)), 0) AS total_vendas FROM pedidos WHERE status_pedido = 'entregue';");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function totalEstoque()
    {
        $sql = new Database();


        $res = $sql->select("SELECT IFNULL(SUM(quantidade_disponivel), 0) AS total_estoque FROM estoque;");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function totalClientes()
    {
        $sql = new Database();


        $res = $sql->select("SELECT COUNT(*) AS novos_clientes FROM usuario WHERE MONTH(data_criacao) = MONTH(CURDATE()) - 1 AND YEAR(data_criacao) = YEAR(CURDATE())");

        if (count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function listarPedidos(){
        $sql = new Database();

        $res = $sql->select("SELECT pedidos.id AS pedido_id, CONCAT(usuario.nome, ' ', usuario.sobrenome) AS nome_usuario, pedidos.data_pedido, pedidos.status_pedido, pedidos.total_pedido, pedidos.data_criacao, pedidos.data_atualizacao FROM pedidos JOIN usuario ON pedidos.id_usuario = usuario.id;");

        return $res;
    }

    public function listarClientes(){
        $sql = new Database();

        $res = $sql->select("SELECT * FROM usuario");

        if(count($res) != 0){
            return $res;
        } else {
            return false;
        }
    }
}
