CREATE DATABASE db_tarefas;
USE db_tarefas;

CREATE TABLE tb_usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    administrador BOOLEAN NOT NULL
);

CREATE TABLE tb_tarefa (
    id_tarefa INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    data_inicio DATE NOT NULL,
    data_conclusao DATE NOT NULL,
    prioridade INT,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario) ON DELETE CASCADE
);

INSERT INTO tb_usuario VALUES (null, 'Fulano', 'fulano@teste.com', '123321', 1);
INSERT INTO tb_usuario VALUES (null, 'Ciclano', 'ciclano@teste.com', 'abc123', 1);

INSERT INTO tb_tarefa VALUES (null, 'Task1', 'Tarefa numero 1', '2001-12-31', '2002-01-31', 1, 1);
INSERT INTO tb_tarefa VALUES (null, 'Task2', 'Tarefa numero 2', '2002-01-20', '2002-02-15', 1, 1);
INSERT INTO tb_tarefa VALUES (null, 'Task3', 'Tarefa numero 3', '2002-01-23', '2002-02-13', 1, 1);