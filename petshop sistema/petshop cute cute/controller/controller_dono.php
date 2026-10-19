<?php

require_once __DIR__ . '/../model/dono.php';
require_once __DIR__ . '/../model/mensagens.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {

    $nome = $_POST['nomeDono'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['fone'];

    // validações
    $erros = array();

    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }
    if (empty($cpf)) {
        $erros[] = "CPF é obrigatório";
    }

    if (!empty($erros)) {

        setMensagem('erro', implode('<br>', $erros));
        header("Location: ../view/Cadastro_Donos.php");
        exit;
    }

    Dono::cadastrar($nome, $cpf, $telefone);

    setMensagem('sucesso', "Dono cadastrado com sucesso");
    header("Location: ../view/Cadastro_Donos.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])) {

    $id_dono = $_POST['id_dono'];
    $nome = $_POST['nomeDono'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['fone'];

    Dono::atualizar($id_dono, $nome, $cpf, $telefone);

    setMensagem('sucesso', "Dono atualizado com sucesso");
    header("Location: ../view/Cadastro_Donos.php");
    exit;
}

if (isset($_GET['excluir'])) {

    Dono::excluir($_GET['excluir']);

    setMensagem('sucesso', "Dono excluído com sucesso");
    header("Location: ../view/Cadastro_Donos.php");
    exit;
}

?>