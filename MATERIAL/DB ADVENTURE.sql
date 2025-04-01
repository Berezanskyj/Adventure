-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS adventure CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE adventure;

-- Definir o conjunto de caracteres e collation para o banco de dados
SET NAMES 'utf8mb4';
SET CHARACTER SET 'utf8mb4';

-- Criação da tabela nivel_usuario
CREATE TABLE IF NOT EXISTS nivel_usuario (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nivel_usuario VARCHAR(50) NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela usuario com chave estrangeira para nivel_usuario
CREATE TABLE IF NOT EXISTS usuario (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  sobrenome VARCHAR(50) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  cpf VARCHAR(15) UNIQUE NOT NULL,
  senha VARCHAR(255) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  nivel_usuario INT NOT NULL,
  token VARCHAR(50),
  ativo TINYINT DEFAULT 0,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (nivel_usuario) REFERENCES nivel_usuario (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela enderecos com chave estrangeira para usuario
CREATE TABLE IF NOT EXISTS enderecos (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  cep VARCHAR(10) NOT NULL,
  cidade VARCHAR(255) NOT NULL,
  bairro VARCHAR(50) NOT NULL,
  rua VARCHAR(100) NOT NULL,
  numero VARCHAR(10) DEFAULT 'S/N',
  complemento VARCHAR(100),
  apelido VARCHAR(50),
  id_usuario INT NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuario (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela categorias
CREATE TABLE IF NOT EXISTS produto_categoria (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome_categoria VARCHAR(50) NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela produto_tamanho
CREATE TABLE IF NOT EXISTS produto_tamanho (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  tamanho VARCHAR(10) NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela produto_cores
CREATE TABLE IF NOT EXISTS produto_cores (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  cor VARCHAR(50) NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela produtos com chave estrangeira para categorias
CREATE TABLE IF NOT EXISTS produtos (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome_produto VARCHAR(100) NOT NULL,
  descricao TEXT NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  categoria_id INT NOT NULL,
  tamanho_id INT NOT NULL,
  cor_id INT NOT NULL,
  imagem_produto VARCHAR(255),
  visivel TINYINT,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (categoria_id) REFERENCES produto_categoria (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (tamanho_id) REFERENCES produto_tamanho (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (cor_id) REFERENCES produto_cores (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela estoque com chaves estrangeiras para produtos, cores e tamanhos
CREATE TABLE IF NOT EXISTS estoque (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  produto_id INT NOT NULL,
  cor_id INT NOT NULL,
  tamanho_id INT NOT NULL,
  quantidade_disponivel INT NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (produto_id) REFERENCES produtos (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (cor_id) REFERENCES produto_cores (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (tamanho_id) REFERENCES produto_tamanho (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela personalizacao com chave estrangeira para produtos
CREATE TABLE IF NOT EXISTS personalizacao (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  tipo_personalizacao VARCHAR(100) NOT NULL,
  valor_adicional DECIMAL(10,2) NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela pedidos com chave estrangeira para usuario
CREATE TABLE IF NOT EXISTS pedidos (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  data_pedido DATE,
  status_pedido ENUM('pendente','enviado','entregue', 'cancelado') NOT NULL,
  total_pedido DECIMAL(10,2) NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuario (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela itens_pedidos com chaves estrangeiras para pedidos e produtos
CREATE TABLE IF NOT EXISTS itens_pedidos (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  pedido_id INT NOT NULL,
  produto_id INT NOT NULL,
  cor_id INT NOT NULL,
  tamanho_id INT NOT NULL,
  quantidade INT NOT NULL,
  preco_unitario DECIMAL(10,2) NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (pedido_id) REFERENCES pedidos (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (produto_id) REFERENCES produtos (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (cor_id) REFERENCES produto_cores (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (tamanho_id) REFERENCES produto_tamanho (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela metodo_pagamento
CREATE TABLE IF NOT EXISTS metodo_pagamento (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  metodo VARCHAR(20) NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela status_pagamento
CREATE TABLE IF NOT EXISTS status_pagamento (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome_status VARCHAR(20) NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela pagamento com chaves estrangeiras para pedidos, metodo_pagamento e status_pagamento
CREATE TABLE IF NOT EXISTS pagamento (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  pedido_id INT NOT NULL,
  metodo_pagamento_id INT NOT NULL,
  status_pagamento_id INT NOT NULL,
  data_pagamento DATETIME NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (pedido_id) REFERENCES pedidos (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (metodo_pagamento_id) REFERENCES metodo_pagamento (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (status_pagamento_id) REFERENCES status_pagamento (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela movimentacoes_estoque
CREATE TABLE IF NOT EXISTS movimentacoes_estoque (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  produto_id INT NOT NULL,
  cor_id INT NOT NULL,
  tamanho_id INT NOT NULL,
  tipo_movimentacao ENUM('entrada', 'saida') NOT NULL,
  quantidade INT NOT NULL,
  data_movimentacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (produto_id) REFERENCES produtos (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (cor_id) REFERENCES produto_cores (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (tamanho_id) REFERENCES produto_tamanho (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Trigger para atualização de estoque após inserção de movimentação
DELIMITER //

CREATE TRIGGER after_movimentacao_insert 
AFTER INSERT ON movimentacoes_estoque
FOR EACH ROW
BEGIN
  IF NEW.tipo_movimentacao = 'entrada' THEN
    UPDATE estoque
    SET quantidade_disponivel = quantidade_disponivel + NEW.quantidade
    WHERE produto_id = NEW.produto_id 
      AND cor_id = NEW.cor_id 
      AND tamanho_id = NEW.tamanho_id;
  ELSEIF NEW.tipo_movimentacao = 'saida' THEN
    UPDATE estoque
    SET quantidade_disponivel = quantidade_disponivel - NEW.quantidade
    WHERE produto_id = NEW.produto_id 
      AND cor_id = NEW.cor_id 
      AND tamanho_id = NEW.tamanho_id;
  END IF;
END;//

-- Trigger para evitar estoque negativo
DELIMITER //

CREATE TRIGGER before_movimentacao_insert 
BEFORE INSERT ON movimentacoes_estoque
FOR EACH ROW
BEGIN
  DECLARE estoque_atual INT DEFAULT 0;

  IF NEW.tipo_movimentacao = 'saida' THEN
    SELECT quantidade_disponivel INTO estoque_atual
    FROM estoque
    WHERE produto_id = NEW.produto_id 
      AND cor_id = NEW.cor_id 
      AND tamanho_id = NEW.tamanho_id
    LIMIT 1;

    IF estoque_atual IS NULL THEN
      SET estoque_atual = 0;
    END IF;

    IF estoque_atual < NEW.quantidade THEN
      SIGNAL SQLSTATE '45000' 
      SET MESSAGE_TEXT = 'Quantidade em estoque insuficiente para esta movimentação.';
    END IF;
  END IF;
END;//

DELIMITER ;

-- Trigger para inserir produto no estoque após criação de um novo produto
DELIMITER //

CREATE TRIGGER after_produto_insert 
AFTER INSERT ON produtos
FOR EACH ROW
BEGIN
  INSERT INTO estoque (produto_id, cor_id, tamanho_id, quantidade_disponivel, data_criacao, data_atualizacao) 
  VALUES (NEW.id, NEW.cor_id, NEW.tamanho_id, 0, NOW(), NOW());
END;//

DELIMITER ;

-- Trigger para validação de estoque ao criar itens de pedido
DELIMITER //

CREATE TRIGGER after_itens_pedidos_insert 
AFTER INSERT ON itens_pedidos
FOR EACH ROW
BEGIN
  DECLARE estoque_atual INT;

  -- Obtém a quantidade disponível em estoque para o produto, cor e tamanho especificados
  SELECT quantidade_disponivel INTO estoque_atual
  FROM estoque
  WHERE produto_id = NEW.produto_id 
    AND cor_id = NEW.cor_id 
    AND tamanho_id = NEW.tamanho_id
  LIMIT 1;

  -- Verifica se o estoque atual é nulo ou se a quantidade solicitada é maior que a disponível
  IF estoque_atual IS NULL OR estoque_atual < NEW.quantidade THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Quantidade em estoque insuficiente para este produto.';
  ELSE
    -- Se houver estoque suficiente, registra a movimentação de saída
    INSERT INTO movimentacoes_estoque (produto_id, cor_id, tamanho_id, tipo_movimentacao, quantidade)
    VALUES (NEW.produto_id, NEW.cor_id, NEW.tamanho_id, 'saida', NEW.quantidade);
  END IF;
END;//

DELIMITER ;

-- Trigger para atualizar a cor no estoque
DELIMITER //

CREATE TRIGGER after_produto_update_cor
AFTER UPDATE ON produtos
FOR EACH ROW
BEGIN
  -- Verifica se houve mudança na cor do produto
  IF NEW.cor_id != OLD.cor_id THEN
    UPDATE estoque
    SET cor_id = NEW.cor_id
    WHERE produto_id = NEW.id;
    
    -- Atualiza a cor em itens_pedidos, caso a cor seja alterada
    UPDATE itens_pedidos
    SET cor_id = NEW.cor_id
    WHERE produto_id = NEW.id;
  END IF;
END//

DELIMITER ;

-- Trigger para atualizar o tamanho no estoque
DELIMITER //

CREATE TRIGGER after_produto_update_tamanho
AFTER UPDATE ON produtos
FOR EACH ROW
BEGIN
  -- Verifica se houve mudança no tamanho do produto
  IF NEW.tamanho_id != OLD.tamanho_id THEN
    UPDATE estoque
    SET tamanho_id = NEW.tamanho_id
    WHERE produto_id = NEW.id;
    
    -- Atualiza o tamanho em itens_pedidos, caso o tamanho seja alterado
    UPDATE itens_pedidos
    SET tamanho_id = NEW.tamanho_id
    WHERE produto_id = NEW.id;
  END IF;
END//

DELIMITER ;

-- Atualização de produto_cores
DELIMITER //

CREATE TRIGGER after_produto_cores_update
AFTER UPDATE ON produto_cores
FOR EACH ROW
BEGIN
  IF NEW.cor != OLD.cor THEN
    UPDATE produtos
    SET cor_id = NEW.id
    WHERE cor_id = OLD.id;

    UPDATE estoque
    SET cor_id = NEW.id
    WHERE cor_id = OLD.id;

    UPDATE itens_pedidos
    SET cor_id = NEW.id
    WHERE cor_id = OLD.id;
  END IF;
END//

DELIMITER ;

-- Atualização de produto_tamanho
DELIMITER //

CREATE TRIGGER after_produto_tamanho_update
AFTER UPDATE ON produto_tamanho
FOR EACH ROW
BEGIN
  IF NEW.tamanho != OLD.tamanho THEN
    UPDATE produtos
    SET tamanho_id = NEW.id
    WHERE tamanho_id = OLD.id;

    UPDATE estoque
    SET tamanho_id = NEW.id
    WHERE tamanho_id = OLD.id;

    UPDATE itens_pedidos
    SET tamanho_id = NEW.id
    WHERE tamanho_id = OLD.id;
  END IF;
END//

DELIMITER ;

-- Atualização de produto_categoria
DELIMITER //

CREATE TRIGGER after_produto_categoria_update
AFTER UPDATE ON produto_categoria
FOR EACH ROW
BEGIN
  IF NEW.nome_categoria != OLD.nome_categoria THEN
    UPDATE produtos
    SET categoria_id = NEW.id
    WHERE categoria_id = OLD.id;
  END IF;
END//

DELIMITER ;

-- Atualização de nivel_usuario
DELIMITER //

CREATE TRIGGER after_nivel_usuario_update
AFTER UPDATE ON nivel_usuario
FOR EACH ROW
BEGIN
  IF NEW.nivel_usuario != OLD.nivel_usuario THEN
    UPDATE usuario
    SET nivel_usuario = NEW.id
    WHERE nivel_usuario = OLD.id;
  END IF;
END//

DELIMITER ;





-- ----------------------------------
-- Inserções nas tabelas
-- ----------------------------------

-- Inserções nas tabelas

-- Inserir nível de usuário
INSERT INTO nivel_usuario (nivel_usuario) VALUES 
('Admin'), 
('Cliente');

-- Inserir usuário
INSERT INTO usuario (nome, sobrenome, email, senha, telefone, nivel_usuario, token, ativo) VALUES 
('João', 'Silva', 'joao.silva@example.com', 'senha123', '123456789', 1, 'token123', 1);

-- Inserir endereço
INSERT INTO enderecos (cep, bairro, rua, numero, complemento, apelido, id_usuario) VALUES 
('12345-678', 'Centro', 'Rua Principal', '123', 'Apto 101', 'Casa do João', 1);

-- Inserir categoria de produto
INSERT INTO produto_categoria (nome_categoria) VALUES 
('Roupas'), 
('Acessórios');

-- Inserir tamanho de produto
INSERT INTO produto_tamanho (tamanho) VALUES 
('P'), 
('M'), 
('G');

-- Inserir cor de produto
INSERT INTO produto_cores (cor) VALUES 
('Vermelho'), 
('Azul');

-- Inserir produto
INSERT INTO produtos (nome_produto, descricao, preco, categoria_id, tamanho_id, cor_id, imagem_produto, visivel) 
VALUES 
('Camiseta Vermelha', 'Camiseta de algodão vermelha.', 49.99, 1, 1, 1, 'camiseta-1-vermelha.png', 1);

-- Inserir personalização
INSERT INTO personalizacao (tipo_personalizacao, valor_adicional) VALUES 
('Nome Bordado', 10.00);

-- Inserir pedido
INSERT INTO pedidos (id_usuario, data_pedido, status_pedido, total_pedido) VALUES 
(1, NOW(), 'pendente', 29.99);

-- Inserir movimentação de estoque
INSERT INTO movimentacoes_estoque (produto_id, cor_id, tamanho_id, tipo_movimentacao, quantidade) VALUES 
(1, 1, 1, 'entrada', 50) ;

-- Inserir item de pedido
INSERT INTO itens_pedidos (pedido_id, produto_id, cor_id, tamanho_id, quantidade, preco_unitario) 
VALUES (1, 1, 1, 1, 1, 29.99);

-- Inserir método de pagamento
INSERT INTO metodo_pagamento (metodo) VALUES 
('cartao_credito'), 
('transferencia'),
('pix');

-- Inserir status de pagamento
INSERT INTO status_pagamento (nome_status) VALUES 
('Pendente'), 
('Em Processamento'),
('Pago'),
('Recusado'),
('Cancelado'),
('Reembolsado');

-- Inserir pagamento
INSERT INTO pagamento (pedido_id, metodo_pagamento_id, status_pagamento_id, data_pagamento) VALUES 
(1, 1, 2, NOW());