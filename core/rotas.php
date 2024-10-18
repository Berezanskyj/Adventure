<?php

//? Coleção de rotas
$rotas = [
    'inicio' => 'main@index',  //* Define a rota 'inicio' para o método 'index' do controlador 'main'
    'loja' => 'main@loja',     //* Define a rota 'loja' para o método 'loja' do controlador 'main'
    'sobre' => 'main@sobre',
    'carrinho' => 'main@carrinho',
    'user_account' => 'main@user_account',
    'logout' => 'main@index',
    'login' => 'main@login',
    'registrar_usuario' => 'main@registrar_usuario',
    'criar_cliente' => 'main@criar_cliente',
    'registro_endereco' => 'main@registro_endereco',
];

//* Define a ação padrão como 'inicio'
$acao = 'inicio';

//* Verifica se a ação foi passada na query string
if(isset($_GET['a'])){
    //! Verifica se a ação passada existe nas rotas
    if(!key_exists($_GET['a'], $rotas)){
        //* Se a ação não existir, define como 'inicio'
        $acao = 'inicio';
    } else{
        //* Se a ação existir, define com base no valor passado
        $acao = $_GET['a'];
    }
}

//* Tratamento da rota, separando o controlador e o método
$partes = explode('@', $rotas[$acao]);  //? Separa o controlador e o método com base no formato 'controlador@metodo'
$controlador = 'core\\controllers\\'.ucfirst($partes[0]);  //* Define o controlador com namespace, ajustando a primeira letra para maiúscula
$metodo = $partes[1];  //* Define o método

//* Instancia o controlador e chama o método
$ctr = new $controlador();
$ctr->$metodo();

