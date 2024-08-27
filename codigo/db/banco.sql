CREATE DATABASE db_quarter_horse;
USE db_quarter_horse;

CREATE TABLE tb_usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(45) NOT NULL,
    email_usuario VARCHAR(45) NOT NULL,
    senha_usuario VARCHAR(45) NOT NULL,
    tipo_usuario ENUM('Admin', 'Cliente') NOT NULL
);

CREATE TABLE tb_cavalo (
    id_cavalo INT AUTO_INCREMENT PRIMARY KEY,
    nome_cavalo VARCHAR(45) NOT NULL,
    raca_cavalo VARCHAR(45) NOT NULL,
    pelagem_cavalo VARCHAR(45) NOT NULL,
    premio_cavalo VARCHAR(55),
    situacao_cavalo ENUM('Ativo', 'Inativo', 'Vendido') NOT NULL,
    img_cavalo VARCHAR(45)
);

CREATE TABLE tb_lote (
    id_lote INT AUTO_INCREMENT PRIMARY KEY,
    valor_lote DECIMAL(10,2) NOT NULL,
    data_lote DATETIME NOT NULL,
    estado_lote ENUM('Disponível', 'Finalizado', 'Cancelado') NOT NULL,
    modalidade_cavalo ENUM('Venda', 'Leilão') NOT NULL,
    tb_cavalo_id_cavalo INT,
    FOREIGN KEY (tb_cavalo_id_cavalo) REFERENCES tb_cavalo(id_cavalo)
);

CREATE TABLE tb_lance (
    id_lance INT AUTO_INCREMENT PRIMARY KEY,
    valor_lance DECIMAL(10,2) NOT NULL,
    data_lance DATETIME NOT NULL,
    tb_usuario_id_usuario INT,
    tb_lote_id_lote INT,
    FOREIGN KEY (tb_usuario_id_usuario) REFERENCES tb_usuario(id_usuario),
    FOREIGN KEY (tb_lote_id_lote) REFERENCES tb_lote(id_lote)
);
