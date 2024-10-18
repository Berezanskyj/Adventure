<?php

namespace core\classes;
use PDO;
use PDOException;
use Exception;

class Database{

    private $conexao;

    private function conectar(){
        //! Conectando ao banco de dados
        $this->conexao = new PDO(
            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'. 
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        //? Definindo o modo de erro para emitir warnings
        $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    private function desconectar(){
        //! Desconectando do banco de dados
        $this->conexao = null;
    }

    public function select($sql, $param = null){
        //* Verificando se o comando é um SELECT
        if(!preg_match("/^SELECT/i", $sql)){
            //! Lançando exceção caso não seja um comando SELECT
            throw new Exception('Base de dados - Não é um comando SELECT.');
        }

        //! Conectando ao banco de dados
        $this->conectar();

        $res = null;

        try{
            //* Executando consulta com ou sem parâmetros
            if(!empty($param)){
                $exe = $this->conexao->prepare($sql);
                $exe->execute($param);
                $res = $exe->fetchAll(PDO::FETCH_CLASS);
            } else{
                $exe = $this->conexao->prepare($sql);
                $exe->execute();
                $res = $exe->fetchAll(PDO::FETCH_CLASS);
            }

        }catch(PDOException $e){
            //! Exibindo erro, caso ocorra
            echo $e;
        }

        //! Desconectando do banco de dados
        $this->desconectar();

        //* Retornando o resultado da consulta
        return $res;
    }

    public function update($sql, $param = null){
        //* Verificando se o comando é um UPDATE
        if(!preg_match("/^UPDATE/i", $sql)){
            //! Lançando exceção caso não seja um comando UPDATE
            throw new Exception('Base de dados - Não é um comando UPDATE.');
        }

        //! Conectando ao banco de dados
        $this->conectar();

        try{
            //* Executando atualização com ou sem parâmetros
            if(!empty($param)){
                $exe = $this->conexao->prepare($sql);
                $exe->execute($param);
            } else{
                $exe = $this->conexao->prepare($sql);
                $exe->execute();
            }

        }catch(PDOException $e){
            //! Exibindo erro, caso ocorra
            echo $e;
        }

        //! Desconectando do banco de dados
        $this->desconectar();
    }

    public function delete($sql, $param = null){
        //* Verificando se o comando é um DELETE
        if(!preg_match("/^DELETE/i", $sql)){
            //! Lançando exceção caso não seja um comando DELETE
            throw new Exception('Base de dados - Não é um comando DELETE.');
        }

        //! Conectando ao banco de dados
        $this->conectar();

        try{
            //* Executando exclusão com ou sem parâmetros
            if(!empty($param)){
                $exe = $this->conexao->prepare($sql);
                $exe->execute($param);
            } else{
                $exe = $this->conexao->prepare($sql);
                $exe->execute();
            }

        }catch(PDOException $e){
            //! Exibindo erro, caso ocorra
            echo $e;
        }

        //! Desconectando do banco de dados
        $this->desconectar();
    }

    public function statement($sql, $param = null){
        //* Verificando se o comando é uma instrução inválida
        if(preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)){
            //! Lançando exceção caso seja uma instrução incorreta
            throw new Exception('Base de dados - Instrucao incorreta.');
        }

        //! Conectando ao banco de dados
        $this->conectar();

        try{
            //* Executando instrução com ou sem parâmetros
            if(!empty($param)){
                $exe = $this->conexao->prepare($sql);
                $exe->execute($param);
            } else{
                $exe = $this->conexao->prepare($sql);
                $exe->execute();
            }

        }catch(PDOException $e){
            //! Exibindo erro, caso ocorra
            echo $e;
        }

        //! Desconectando do banco de dados
        $this->desconectar();
    }

    public function insert($sql, $param = null){
        //* Verificando se o comando é um INSERT
        if(!preg_match("/^INSERT/i", $sql)){
            //! Lançando exceção caso não seja um comando INSERT
            throw new Exception('Base de dados - Não é um comando INSERT.');
        }

        //! Conectando ao banco de dados
        $this->conectar();

        try{
            //* Executando inserção com ou sem parâmetros
            if(!empty($param)){
                $exe = $this->conexao->prepare($sql);
                $exe->execute($param);
            } else{
                $exe = $this->conexao->prepare($sql);
                $exe->execute();
            }

        }catch(PDOException $e){
            //! Exibindo erro, caso ocorra
            echo $e;
        }

        //! Desconectando do banco de dados
        $this->desconectar();
    }

    public function lastInsertId() {
        $this->conectar();

        if ($this->conexao) {
            return $this->conexao->lastInsertId();
        }
        throw new Exception('Conexão não está ativa.');

        $this->desconectar();
    }

};

