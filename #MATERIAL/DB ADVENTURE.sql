-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS adventure;
USE adventure;

-- Criação da tabela nivel_usuario
CREATE TABLE `nivel_usuario` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nivel_usuario` VARCHAR(50) NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criação da tabela usuario com chave estrangeira para nivel_usuario
CREATE TABLE `usuario` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `sobrenome` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `nivel_usuario` INT NOT NULL,
  `token` VARCHAR(50) NOT NULL,
  `ativo` TINYINT DEFAULT 0,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`nivel_usuario`) REFERENCES `nivel_usuario` (`id`)
);

-- Criação da tabela enderecos com chave estrangeira para usuario
CREATE TABLE `enderecos` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `cep` VARCHAR(10) NOT NULL,
  `bairro` VARCHAR(50) NOT NULL,
  `rua` VARCHAR(100) NOT NULL,
  `numero` VARCHAR(10) DEFAULT 'S/N',
  `complemento` VARCHAR(100),
  `apelido` VARCHAR(50),
  `id_usuario` INT NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
);

-- Criação da tabela categorias
CREATE TABLE `categorias` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome_categoria` VARCHAR(50) NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criação da tabela produtos com chave estrangeira para categorias
CREATE TABLE `produtos` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome_produto` VARCHAR(100) NOT NULL,
  `descricao` TEXT NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `categoria_id` INT NOT NULL,
  `imagem_produto` VARCHAR(255),
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
);

-- Criação da tabela tamanho_disponivel com chave estrangeira para produtos
CREATE TABLE `tamanho_disponivel` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `produto_id` INT NOT NULL,
  `tamanho` VARCHAR(10) NOT NULL,
  `qtd_disponivel` INT NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
);

-- Criação da tabela cores_disponiveis com chave estrangeira para produtos
CREATE TABLE `cores_disponiveis` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `produto_id` INT NOT NULL,
  `cor` VARCHAR(50) NOT NULL,
  `quantidade_disponivel` INT NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
);

-- Criação da tabela estoque com chaves estrangeiras para produto, cor e tamanho
CREATE TABLE `estoque` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `produto_id` INT NOT NULL,
  `cor_id` INT NOT NULL,
  `tamanho_id` INT NOT NULL,
  `quantidade_disponivel` INT NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  FOREIGN KEY (`cor_id`) REFERENCES `cores_disponiveis` (`id`),
  FOREIGN KEY (`tamanho_id`) REFERENCES `tamanho_disponivel` (`id`)
);

-- Criação da tabela personalizacao com chave estrangeira para produtos
CREATE TABLE `personalizacao` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `produto_id` INT NOT NULL,
  `tipo_personalizacao` VARCHAR(100) NOT NULL,
  `valor_adicional` DECIMAL(10,2) NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
);

-- Criação da tabela pedidos com chave estrangeira para usuario
CREATE TABLE `pedidos` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `data_pedido` DATETIME NOT NULL,
  `status_pedido` ENUM('pendente','enviado','entregue','cancelado') NOT NULL,
  `total_pedido` DECIMAL(10,2) NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
);

-- Criação da tabela itens_pedidos com chaves estrangeiras para pedidos e produtos
CREATE TABLE `itens_pedidos` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `pedido_id` INT NOT NULL,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `preco_unitario` DECIMAL(10,2) NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
);

-- Criação da tabela metodo_pagamento
CREATE TABLE `metodo_pagamento` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `metodo` VARCHAR(20) NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criação da tabela status_pagamento
CREATE TABLE `status_pagamento` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `status` VARCHAR(20) NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criação da tabela pagamento com chaves estrangeiras para pedidos, metodo_pagamento e status_pagamento
CREATE TABLE `pagamento` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `pedido_id` INT NOT NULL,
  `metodo_pagamento_id` INT NOT NULL,
  `status_pagamento_id` INT NOT NULL,
  `data_pagamento` DATETIME NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  FOREIGN KEY (`metodo_pagamento_id`) REFERENCES `metodo_pagamento` (`id`),
  FOREIGN KEY (`status_pagamento_id`) REFERENCES `status_pagamento` (`id`)
);

-- Criação da tabela movimentacoes_estoque
CREATE TABLE `movimentacoes_estoque` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `produto_id` INT NOT NULL,
  `cor_id` INT NOT NULL,
  `tamanho_id` INT NOT NULL,
  `tipo_movimentacao` ENUM('entrada', 'saida') NOT NULL,
  `quantidade` INT NOT NULL,
  `data_movimentacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_exclusao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`cor_id`) REFERENCES `cores_disponiveis` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tamanho_id`) REFERENCES `tamanho_disponivel` (`id`) ON DELETE CASCADE
);

-- Trigger para atualização de estoque após inserção de movimentação
DELIMITER //

CREATE TRIGGER `after_movimentacao_insert` 
AFTER INSERT ON `movimentacoes_estoque`
FOR EACH ROW
BEGIN
  IF NEW.tipo_movimentacao = 'entrada' THEN
    UPDATE `estoque`
    SET `quantidade_disponivel` = `quantidade_disponivel` + NEW.quantidade
    WHERE `produto_id` = NEW.produto_id 
      AND `cor_id` = NEW.cor_id 
      AND `tamanho_id` = NEW.tamanho_id;
  ELSEIF NEW.tipo_movimentacao = 'saida' THEN
    UPDATE `estoque`
    SET `quantidade_disponivel` = `quantidade_disponivel` - NEW.quantidade
    WHERE `produto_id` = NEW.produto_id 
      AND `cor_id` = NEW.cor_id 
      AND `tamanho_id` = NEW.tamanho_id;
  END IF;
END;//

-- Trigger para evitar estoque negativo
DELIMITER //

CREATE TRIGGER `before_movimentacao_insert` 
BEFORE INSERT ON `movimentacoes_estoque`
FOR EACH ROW
BEGIN
  DECLARE estoque_atual INT DEFAULT 0; -- Declaração no início

  IF NEW.tipo_movimentacao = 'saida' THEN
    -- Obtém a quantidade disponível no estoque
    SELECT `quantidade_disponivel` INTO estoque_atual
    FROM `estoque`
    WHERE `produto_id` = NEW.produto_id 
      AND `cor_id` = NEW.cor_id 
      AND `tamanho_id` = NEW.tamanho_id
    LIMIT 1;

    -- Trata o caso onde não há registro no estoque
    IF estoque_atual IS NULL THEN
      SET estoque_atual = 0;
    END IF;

    -- Verifica se há estoque suficiente
    IF estoque_atual < NEW.quantidade THEN
      SIGNAL SQLSTATE '45000' 
      SET MESSAGE_TEXT = 'Quantidade em estoque insuficiente para esta movimentação.';
    END IF;
  END IF;
END;
//

DELIMITER ;

-- Adicionando restrição de unicidade nas combinações de produto, cor e tamanho na tabela estoque
ALTER TABLE `estoque`
  ADD UNIQUE (`produto_id`, `cor_id`, `tamanho_id`);

-- Adicionando índices para melhorar a performance
CREATE INDEX `idx_estoque_produto_cor_tamanho` 
  ON `estoque` (`produto_id`, `cor_id`, `tamanho_id`);

CREATE INDEX `idx_movimentacoes_produto_cor_tamanho` 
  ON `movimentacoes_estoque` (`produto_id`, `cor_id`, `tamanho_id`);

-- ----------------------------------
-- Inserções nas tabelas
-- ----------------------------------

-- 1. Inserções na tabela nivel_usuario
INSERT INTO `nivel_usuario` (`nivel_usuario`) VALUES 
('Administrador'),
('Gerente'),
('Cliente');

-- 2. Inserções na tabela usuario
INSERT INTO `usuario` (`nome`, `sobrenome`, `email`, `senha`, `telefone`, `nivel_usuario`, `token`, `ativo`) VALUES 
('João', 'Silva', 'joao.silva@example.com', 'senha123', '11999999999', 1, 'token123', 1),
('Maria', 'Oliveira', 'maria.oliveira@example.com', 'senha456', '21988888888', 2, 'token456', 1),
('Carlos', 'Santos', 'carlos.santos@example.com', 'senha789', '31977777777', 3, 'token789', 1);

-- 3. Inserções na tabela enderecos
INSERT INTO `enderecos` (`cep`, `bairro`, `rua`, `numero`, `complemento`, `apelido`, `id_usuario`) VALUES 
('01000-000', 'Centro', 'Rua das Flores', '123', 'Apto 45', 'Casa', 1),
('02000-000', 'Jardim', 'Avenida Brasil', '456', 'Casa 2', 'Trabalho', 2),
('03000-000', 'Vila', 'Rua dos Andradas', '789', 'Sala 3', 'Apartamento', 3);

-- 4. Inserções na tabela categorias
INSERT INTO `categorias` (`nome_categoria`) VALUES 
('Camisas'),
('Calças'),
('Vestidos');

-- 5. Inserções na tabela produtos
INSERT INTO `produtos` (`nome_produto`, `descricao`, `preco`, `categoria_id`, `imagem_produto`) VALUES 
('Camisa Polo Masculina', 'Camisa polo de algodão, disponível em várias cores.', 79.90, 1, 'camisa_polo.jpg'),
('Calça Jeans Feminina', 'Calça jeans confortável com stretch.', 149.90, 2, 'calca_jeans.jpg'),
('Vestido Floral', 'Vestido floral estampado, perfeito para o verão.', 199.90, 3, 'vestido_floral.jpg');

-- 6. Inserções na tabela cores_disponiveis
INSERT INTO `cores_disponiveis` (`produto_id`, `cor`, `quantidade_disponivel`) VALUES 
(1, 'Azul', 50),
(1, 'Branca', 30),
(2, 'Preta', 40),
(2, 'Azul', 35),
(3, 'Vermelho', 20),
(3, 'Verde', 15);

-- 7. Inserções na tabela tamanho_disponivel
INSERT INTO `tamanho_disponivel` (`produto_id`, `tamanho`, `qtd_disponivel`) VALUES 
(1, 'P', 20),
(1, 'M', 25),
(1, 'G', 5),
(2, '38', 15),
(2, '40', 10),
(2, '42', 10),
(3, 'PP', 5),
(3, 'P', 10),
(3, 'M', 5);

-- 8. Inserções na tabela estoque
INSERT INTO `estoque` (`produto_id`, `cor_id`, `tamanho_id`, `quantidade_disponivel`) VALUES 
-- Camisa Polo Masculina - Azul
(1, 1, 1, 20),
(1, 1, 2, 25),
(1, 1, 3, 5),
-- Camisa Polo Masculina - Branca
(1, 2, 1, 20),
(1, 2, 2, 25),
(1, 2, 3, 5),
-- Calça Jeans Feminina - Preta
(2, 3, 4, 15),
(2, 3, 5, 10),
(2, 3, 6, 10),
-- Calça Jeans Feminina - Azul
(2, 4, 4, 15),
(2, 4, 5, 10),
(2, 4, 6, 10),
-- Vestido Floral - Vermelho
(3, 5, 7, 5),
(3, 5, 8, 10),
(3, 5, 9, 5),
-- Vestido Floral - Verde
(3, 6, 7, 5),
(3, 6, 8, 10),
(3, 6, 9, 5);

-- 9. Inserções na tabela metodo_pagamento
INSERT INTO `metodo_pagamento` (`metodo`) VALUES 
('Cartão de Crédito'),
('Boleto Bancário'),
('PayPal');

-- 10. Inserções na tabela status_pagamento
INSERT INTO `status_pagamento` (`status`) VALUES 
('Pendente'),
('Aprovado'),
('Cancelado');

-- 11. Inserções na tabela pedidos
INSERT INTO `pedidos` (`id_usuario`, `data_pedido`, `status_pedido`, `total_pedido`) VALUES 
(3, '2024-04-01 10:00:00', 'pendente', 279.80),
(2, '2024-04-02 15:30:00', 'enviado', 149.90),
(1, '2024-04-03 09:45:00', 'entregue', 199.90);

-- 12. Inserções na tabela itens_pedidos
INSERT INTO `itens_pedidos` (`pedido_id`, `produto_id`, `quantidade`, `preco_unitario`) VALUES 
(1, 1, 2, 79.90),  -- 2 Camisa Polo Masculina
(1, 2, 1, 149.90), -- 1 Calça Jeans Feminina
(2, 2, 1, 149.90), -- 1 Calça Jeans Feminina
(3, 3, 1, 199.90); -- 1 Vestido Floral

-- 13. Inserções na tabela personalizacao
INSERT INTO `personalizacao` (`produto_id`, `tipo_personalizacao`, `valor_adicional`) VALUES 
(1, 'Estampa Personalizada', 20.00),
(2, 'Ajuste de Tamanho', 15.00),
(3, 'Embalagem Especial', 10.00);

-- 14. Inserções na tabela pagamento
INSERT INTO `pagamento` (`pedido_id`, `metodo_pagamento_id`, `status_pagamento_id`, `data_pagamento`) VALUES 
(1, 1, 1, '2024-04-01 10:05:00'), -- Pedido 1: Cartão de Crédito, Pendente
(2, 2, 2, '2024-04-02 15:35:00'), -- Pedido 2: Boleto Bancário, Aprovado
(3, 3, 2, '2024-04-03 09:50:00'); -- Pedido 3: PayPal, Aprovado

-- 15. Inserções na tabela movimentacoes_estoque
INSERT INTO `movimentacoes_estoque` (`produto_id`, `cor_id`, `tamanho_id`, `tipo_movimentacao`, `quantidade`) VALUES 
-- Entradas
(1, 1, 1, 'entrada', 10), -- Entrada de 10 Camisa Polo Azul P
(2, 3, 4, 'entrada', 5),  -- Entrada de 5 Calça Jeans Preta 38
(3, 5, 7, 'entrada', 2),  -- Entrada de 2 Vestido Floral Vermelho PP
-- Saídas
(1, 1, 1, 'saida', 2),    -- Saída de 2 Camisa Polo Azul P
(2, 3, 4, 'saida', 1),    -- Saída de 1 Calça Jeans Preta 38
(3, 5, 7, 'saida', 1);    -- Saída de 1 Vestido Floral Vermelho PP
