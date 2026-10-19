<?php

require_once __DIR__ . '/../model/servico.php';
require_once __DIR__ . '/../model/mensagens.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {

    $nome = $_POST['nomeServico'];
    $preco = $_POST['preco'];

    $erros = array();

    if (empty($nome)) {
        $erros[] = "Nome do serviço é obrigatório";
    }

    if (empty($preco)) {
        $erros[] = "Preço é obrigatório";
    }

    if (!empty($erros)) {

        setMensagem('erro', implode('<br>', $erros));
        header("Location: ../view/Servicos.php");
        exit;
    }

    $preco = str_replace(',', '.', $preco);

    Servico::cadastrar($nome, $preco);

    setMensagem('sucesso', "Serviço cadastrado com sucesso");
    header("Location: ../view/Servicos.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])) {

    $id_servico = $_POST['id_servico'];
    $nome = $_POST['nomeServico'];
    $preco = $_POST['preco'];

    $preco = str_replace(',', '.', $preco);

    Servico::atualizar($id_servico, $nome, $preco);

    setMensagem('sucesso', "Serviço atualizado com sucesso");
    header("Location: ../view/Servicos.php");
    exit;
}

if (isset($_GET['excluir'])) {

    Servico::excluir($_GET['excluir']);

    setMensagem('sucesso', "Serviço excluído com sucesso");
    header("Location: ../view/Servicos.php");
    exit;
}

?>
