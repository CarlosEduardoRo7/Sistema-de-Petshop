CREATE DATABASE IF NOT EXISTS PetShop;

CREATE TABLE dono (
    id_dono INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    telefone VARCHAR(20)
);


CREATE TABLE animal (
    id_animal INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    idade INT NOT NULL,
    peso DECIMAL(5,2) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raca VARCHAR(50),
    id_dono INT NOT NULL,

    FOREIGN KEY (id_dono) REFERENCES dono(id_dono)
);

CREATE TABLE servico (
    id_servico INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);


CREATE TABLE agendamento (
    id_agendamento INT PRIMARY KEY AUTO_INCREMENT,
    data_agendamento DATE NOT NULL,
    horario TIME NOT NULL,
    id_animal INT NOT NULL,
    id_servico INT NOT NULL,

    FOREIGN KEY (id_animal) REFERENCES animal(id_animal),
    FOREIGN KEY (id_servico) REFERENCES servico(id_servico)
);
