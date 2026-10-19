<?php

require_once __DIR__ . '/../model/agendamento.php';
require_once __DIR__ . '/../model/mensagens.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {

    $data = $_POST['data_agendamento'];
    $horario = $_POST['horario'];
    $id_animal = $_POST['id_animal'];
    $id_servico = $_POST['id_servico'];

    $erros = array();

    if (empty($data)) {
        $erros[] = "Data é obrigatória";
    }

    if (empty($horario)) {
        $erros[] = "Horário é obrigatório";
    }

    if (empty($id_animal)) {
        $erros[] = "Animal é obrigatório";
    }

    if (empty($id_servico)) {
        $erros[] = "Serviço é obrigatório";
    }

    if (!empty($erros)) {

        setMensagem('erro', implode('<br>', $erros));
        header("Location: ../view/Agendamentos.php");
        exit;
    }

    Agendamento::cadastrar(
        $data,
        $horario,
        $id_animal,
        $id_servico
    );

    setMensagem('sucesso', "Agendamento cadastrado com sucesso");
    header("Location: ../view/Agendamentos.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])) {

    $id_agendamento = $_POST['id_agendamento'];
    $data = $_POST['data_agendamento'];
    $horario = $_POST['horario'];
    $id_animal = $_POST['id_animal'];
    $id_servico = $_POST['id_servico'];

    Agendamento::atualizar(
        $id_agendamento,
        $data,
        $horario,
        $id_animal,
        $id_servico
    );

    setMensagem('sucesso', "Agendamento atualizado com sucesso");
    header("Location: ../view/Agendamentos.php");
    exit;
}

if (isset($_GET['excluir'])) {

    Agendamento::excluir($_GET['excluir']);

    setMensagem('sucesso', "Agendamento excluído com sucesso");
    header("Location: ../view/Agendamentos.php");
    exit;
}

?>
