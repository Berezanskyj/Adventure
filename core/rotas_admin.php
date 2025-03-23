<?php

//? Coleção de rotas
$rotas = [

    'inicio' => 'admin@index',  //* Define a rota 'inicio' para o método 'index' do controlador 'main'

    'admin_login' => 'admin@admin_login',
    'login_admin_submit' => 'admin@login_admin_submit',
    'logout' => 'admin@logout',

    'lista_clientes' => 'admin@lista_clientes',
    'usuario_admin' => 'admin@usuario_admin',
    'detalhes_usuario' => 'admin@detalhes_usuario',
    'editar_usuario' => 'admin@editar_usuario',
    'excluir_usuario' => 'admin@excluir_usuario',
    'pedidos' => 'admin@pedidos',
    'alterar_pedidos' => 'admin@alterar_pedidos',
    'obterItensPedido' => 'admin@obterItensPedido',
    'excluir_pedido' => 'admin@excluir_pedido',
    'ativar_pedido' => 'admin@ativar_pedido',
    'pedidos_cancelados' => 'admin@pedidos_cancelados',
    'pagamentos' => 'admin@pagamentos',
    'registrar_usuario' => 'admin@registrar_usuario',
    'editar_pagamento' => 'admin@editar_pagamento',
    'criar_status_pagamento' => 'admin@criar_status_pagamento',
    'produtos_categorias' => 'admin@produtos_categorias',
    'criar_categoria_produto' => 'admin@criar_categoria_produto',
    'editar_categoria_produto' => 'admin@editar_categoria_produto',
    'produtos_tamanhos' => 'admin@produtos_tamanhos',
    'criar_tamanho_produto' => 'admin@criar_tamanho_produto',
    'editar_tamanho_produto' => 'admin@editar_tamanho_produto',
    'produtos_cores' => 'admin@produtos_cores',
    'criar_cor_produto' => 'admin@criar_cor_produto',
    'editar_cor_produto' => 'admin@editar_cor_produto',
    'gerencia_produtos' => 'admin@gerencia_produtos',
    'cadastro_produtos' => 'admin@cadastro_produtos',
    'editar_produtos' => 'admin@editar_produtos',
    'processa_cadastro_produto' => 'admin@processa_cadastro_produto',
    'edita_cadastro_produto' => 'admin@edita_cadastro_produto',
    'inativar_produto' => 'admin@inativar_produto',
    'ativar_produto' => 'admin@ativar_produto',


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

