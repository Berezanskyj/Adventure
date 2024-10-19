<?php

namespace core\models;
use core\classes\Database;
use core\classes\Store;


class Clientes{
    public function verificarEmailRegistrado($email){

        $sql = new Database();

        $paramEmail = [
            ":email" => strtolower(trim($email)),
        ];

        $resEmail = $sql->select("SELECT email FROM usuario WHERE email = :email", $paramEmail);

        //*se o cliente ja tem cadastro...
        if(count($resEmail) != 0){
            return true;
        } else {
            return false;
        }
    }

    public function verificarCpfRegistrado($email){

        $sql = new Database();

        $paramCpf = [
            ":cpf" => $_POST['cpf'],
        ];

        $resCpf = $sql->select("SELECT cpf FROM usuario WHERE cpf = :cpf", $paramCpf);

        //*se o cpf ja existe...
        if(count($resCpf) != 0){
            return true;
        } else {
            return false;
        }


    }

    
    public function registrarCliente(){
        $sql = new Database();



        //*criacao o novo cliente
        $token = Store::criarToken();

        $param = [
            ':nome' => trim($_POST['nome']),
            ':sobrenome' => trim($_POST['sobrenome']),
            ':email' => strtolower(trim($_POST['email'])),
            ':cpf' => $_POST['cpf'],
            ':senha' => password_hash(trim($_POST['senha']), PASSWORD_DEFAULT, ['cost' => 10]),
            ':telefone' => $_POST['telefone'],
            ':nivel_usuario' => 2,
            ':token' => $token,
            ':ativo' => 0 // ou 1 dependendo do que deseja para o usuário novo
        ];
        
        $sql->insert("INSERT INTO usuario (nome, sobrenome, email, cpf, senha, telefone, nivel_usuario, token, ativo)
        VALUES (:nome, :sobrenome, :email, :cpf, :senha, :telefone, :nivel_usuario, :token, :ativo)", $param);

        //retorna token

        return $token;
    }

    public function registrarEndereco(){
        $sql = new Database();

        $result = $sql->select("SELECT id FROM usuario ORDER BY id DESC LIMIT 1;");
        $lastUserId = $result[0]->id;

        $param = [
            ':cep' => trim($_POST['cep']),
            ':cidade' => trim($_POST['cidade']),
            ':bairro' => strtolower(trim($_POST['bairro'])),
            ':rua' => $_POST['rua'],
            ':numero' => trim($_POST['numero']),
            ':complemento' => $_POST['complemento'],
            ':apelido' => $_POST['apelido'],
            ':id_usuario' => $lastUserId
        ];
        
        $sql->insert("INSERT INTO enderecos (cep, cidade, bairro, rua, numero, complemento, apelido, id_usuario)
        VALUES (:cep, :cidade, :bairro, :rua, :numero, :complemento, :apelido, :id_usuario)", $param);
    }

    

}