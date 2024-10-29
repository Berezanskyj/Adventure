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

    public function verificarClienteRegistrado($email){
        $sql = new Database();

        $param = [
            ":email" => $email
        ];


        $res = $sql->select("SELECT * FROM usuario WHERE email = :email", $param);

        if(count($res) != 0){
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
            ':id' => $lastUserId
        ];

        $token = $sql->select("SELECT token FROM usuario WHERE id = :id", $param);

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

        return $token;
    }

    public function buscarEndereco($id) {
        $sql = new Database();
    
        $param = [
            ":id_usuario" => $id
        ];
    
        $res = $sql->select("SELECT * FROM enderecos WHERE id_usuario = :id_usuario", $param);
    
        if (count($res) != 0) {
            return $res; // Retorna um array com os dados do endereço
        } else {
            return false; // Retorna false se nenhum endereço for encontrado
        }
    }




    public function validar_email($token){



        //validar o email do novo cliente
        $sql = new Database();
        $param = [
            ':token' => $token
        ];

        $res = $sql->select("SELECT * FROM usuario WHERE token = :token", $param);

        if(count($res) != 1){
            return false;
        }

        $id_cliente = $res[0]->id; 

        //atualizar os dados do cliente
        $param = [
            ':id' => $id_cliente
        ];

        $sql->update("UPDATE usuario SET token = NULL, ativo = 1, data_atualizacao = NOW() WHERE id = :id", $param);

        return true;

    }

    public function validar_login($usuario, $senha){
        $sql = new Database();

        $param = [
            ':usuario' => $usuario
        ];

        $sql = new Database();
        $resultado = $sql->select("SELECT * FROM usuario WHERE email = :usuario AND ativo = 1", $param);


        if(count($resultado) != 1){
            //usuario nao existe
            return false;

        } else {
            //usuario existe
            $usuario = $resultado[0];

            if(!password_verify($senha, $usuario->senha)){
                //usuario existe mas a senha nao corresponde
                return false;
            } else {

                //login valido 
                return $usuario;
            }
        }


    }




    public function gera_senha_temp($email){

        $sql = new Database();

        $senha_temp = Store::criarToken();

        $param = [
            ":email" => $email
        ];

        $res = $sql->select("SELECT * FROM usuario WHERE email = :email", $param);

        if(count($res) != 0){

            $param2 = [
                ":email" => $email,
                ":senha" => $senha_temp
            ];
    
            $sql->update("UPDATE usuario SET senha = :senha WHERE email = :email", $param2);
    
            return $senha_temp;
        } else {
            return $senha_temp == 'Cliente nao encontrado na base';
        }




        
    }

    public function recuperar_senha($email, $senha) {
        $sql = new Database();
    
        $param = [
            ':email' => $email
        ];
    
        // Consulta o usuário pelo e-mail
        $cliente = $sql->select("SELECT * FROM usuario WHERE email = :email", $param);
    
        // Verifica se o usuário foi encontrado
        if (count($cliente) != 0) {
            $param2 = [
                ":email" => $email,
                ":senha" => password_hash(trim($senha), PASSWORD_DEFAULT, ['cost' => 10]) // Removida a vírgula extra aqui
            ];
    
            // Atualiza a senha do usuário
            $alteraSenha = $sql->update("UPDATE usuario SET senha = :senha WHERE email = :email", $param2);
    
            return $alteraSenha;  // Retorna o resultado da operação de atualização
        } else {
            return false;  // Retorna false se o usuário não foi encontrado
        }
    }

    

}