# Adventure - Plataforma de Personalização de Produtos

![Logo Adventure](public/assets/images/header-logo.png)

## 📚 Descrição

Adventure é uma plataforma web desenvolvida para facilitar a personalização de uniformes e brindes. Com uma interface intuitiva e soluções de qualidade, a Adventure permite que empresas e indivíduos destaquem sua marca desde o primeiro pedido, garantindo uma experiência sem complicações.

## 🚀 Funcionalidades

- **Personalização de Produtos:** Escolha entre uma variedade de uniformes e brindes para personalizar conforme a identidade da sua marca.
- **Gestão de Conta:** Crie, gerencie e acompanhe suas contas de usuário com facilidade.
- **Carrinho de Compras:** Adicione produtos ao carrinho e finalize suas compras de maneira segura.
- **Sistema de Rotas:** Navegação simplificada através de rotas bem definidas.
- **Autenticação de Usuário:** Login seguro para proteger suas informações e pedidos.

## 🛠️ Tecnologias Utilizadas

- **Back-end:**
  - PHP 7+
  - PDO para interação com banco de dados MySQL
  - Composer para gerenciamento de dependências
- **Front-end:**
  - HTML5 & CSS3
  - JavaScript
  - Bootstrap
  - FontAwesome
- **Banco de Dados:**
  - MySQL

## 📂 Estrutura do Projeto
```
Adventure
├── core
│   ├── controllers
│   │   └── Main.php
│   └── views
│       ├── layout
│       │   ├── footer.php
│       │   ├── header.php
│       │   ├── html_footer.php
│       │   ├── html_header.php
│       │   ├── carrinho.php
│       │   ├── inicio.php
│       │   ├── loja.php
│       │   ├── sobre.php
│       │   ├── user_account.php
│       │   └── rotas.php
├── public
│   ├── assets
│   │   ├── css
│   │   │   ├── all.min.css
│   │   │   ├── app.css
│   │   │   ├── bootstrap.min.css
│   │   │   ├── bootstrap.min.css.map
│   │   │   ├── header-footer.css
│   │   │   └── home.css
│   │   ├── images
│   │   └── js
│   │       ├── app.js
│   │       ├── bootstrap.bundle.js
│   │       ├── bootstrap.bundle.js.map
│   │       └── script.js
│   ├── webfonts
│   └── index.php
├── src
├── vendor
│   ├── composer.json
│   ├── composer.lock
├── config
│   └── config.php
└── readme.md


```

## 🛠️ Instalação

1. **Clone o Repositório:**
   ```bash
   git clone https://github.com/seu-usuario/adventure.git
   ```

2. **Navegue para o Diretório do Projeto:**
    ```bash
    cd adventure
    ```

3. ***Instale as Dependências com Composer:**
    ```bash
    composer install
    ```

4. **Configure o Banco de Dados:**

 - Crie um banco de dados MySQL.
 - Configure as variáveis de ambiente ou o arquivo de configuração com as credenciais do banco de dados.

5. **Configure o Servidor Web:**

 - Utilize o Apache, Nginx ou outro servidor web de sua preferência.
 - Aponte a raiz do servidor para o diretório do projeto.

6. **Inicie a Aplicação:**
 - Acesse `http://localhost/adventure` no seu navegador.

***<h1>📝 Uso</h1>***
 - **Página Inicial:** Apresenta os principais produtos e informações sobre a plataforma.
 - **Loja:** Navegue e personalize os produtos disponíveis.
 - **Sobre:** Saiba mais sobre a missão e visão da Adventure.
 - **Carrinho:** Visualize e gerencie os produtos adicionados antes de finalizar a compra.
 - **Conta do Usuário:** Gerencie suas informações de perfil e pedidos.
 - **Login/Registro:** Acesse sua conta ou crie uma nova para começar a personalizar seus produtos.




 **<h1>🔧 Detalhes Técnicos</h1>**
**<h3>Database.php</h3>**
Classe responsável pela conexão e operações com o banco de dados utilizando PDO. Inclui métodos para `select`, `insert`, `update`, `delete` e execução de `statements`.

**<h3>Store.php</h3>**
Classe que gerencia a renderização das views e verifica se um cliente está logado na sessão.

**<h3>Main.php</h3>**
Controlador principal que define as ações para diferentes rotas como `index`, `loja`, `sobre`, `carrinho`, entre outras. Utiliza a classe `Store` para carregar as views correspondentes.

**<h3>Rotas</h3>**
Arquivo `rotas.php` define as rotas da aplicação, mapeando URLs para métodos específicos do controlador `Main`.

**<h3>Views</h3>**
As views estão organizadas dentro do diretório `core/views`, separando os componentes de layout (`header`, `footer`, etc.) das páginas específicas (`inicio`, `loja`, `sobre`, etc.).