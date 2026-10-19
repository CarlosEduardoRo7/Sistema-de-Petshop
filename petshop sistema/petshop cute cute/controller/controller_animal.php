<?php

require_once __DIR__ . '/../model/animal.php';
require_once __DIR__ . '/../model/mensagens.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {

    $nome = $_POST['nomeAnimal'];
    $idade = $_POST['idade'];
    $peso = $_POST['peso'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $id_dono = $_POST['id_dono'];

    $erros = array();

    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }

    if (empty($idade)) {
        $erros[] = "Idade é obrigatória";
    }

    if (empty($peso)) {
        $erros[] = "Peso é obrigatório";
    }

    if (empty($especie)) {
        $erros[] = "Espécie é obrigatória";
    }

    if (empty($id_dono)) {
        $erros[] = "Dono é obrigatório";
    }

    if (!empty($erros)) {

        setMensagem('erro', implode('<br>', $erros));
        header("Location: ../view/Animais_Cadastro.php");
        exit;
    }

    $peso = str_replace(',', '.', $peso);

    Animal::cadastrar(
        $nome,
        $idade,
        $peso,
        $especie,
        $raca,
        $id_dono
    );

    setMensagem('sucesso', "Animal cadastrado com sucesso");
    header("Location: ../view/Animais_Cadastro.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])) {

    $id_animal = $_POST['id_animal'];
    $nome = $_POST['nomeAnimal'];
    $idade = $_POST['idade'];
    $peso = $_POST['peso'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $id_dono = $_POST['id_dono'];

    $peso = str_replace(',', '.', $peso);

    Animal::atualizar(
        $id_animal,
        $nome,
        $idade,
        $peso,
        $especie,
        $raca,
        $id_dono
    );

    setMensagem('sucesso', "Animal atualizado com sucesso");
    header("Location: ../view/Animais_Cadastro.php");
    exit;
}

if (isset($_GET['excluir'])) {

    Animal::excluir($_GET['excluir']);

    setMensagem('sucesso', "Animal excluído com sucesso");
    header("Location: ../view/Animais_Cadastro.php");
    exit;
}

?>
