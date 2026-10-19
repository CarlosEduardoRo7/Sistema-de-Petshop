<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once __DIR__ . '/../model/animal.php';
    require_once __DIR__ . '/../model/dono.php';

    $metodo = $_SERVER['REQUEST_METHOD'];

    if ($metodo == 'GET') {

        if (isset($_GET['id'])) {

            $animal = Animal::buscar($_GET['id']);

            if ($animal) {

                echo json_encode(array(
                    'sucesso' => true,
                    'animal' => $animal
                ));

            } else {

                echo json_encode(array(
                    'sucesso' => false,
                    'mensagem' => 'Animal não encontrado'
                ));
            }

            exit;
        }

        $resultado = Animal::listar();

        $animais = array();

        while ($linha = $resultado->fetch_assoc()) {
            $animais[] = $linha;
        }
//mostra os donos
        $resultadoDonos = Dono::listar();

        $donos = array();

        while ($dono = $resultadoDonos->fetch_assoc()) {
            $donos[] = $dono;
        }

        echo json_encode(array(
            'sucesso' => true,
            'animais' => $animais,
            'donos' => $donos
        ));

        exit;
    }


    $dados = json_decode(file_get_contents('php://input'), true);


    if ($metodo == 'POST') {

        $nome = isset($dados['nome']) ? $dados['nome'] : '';
        $idade = isset($dados['idade']) ? $dados['idade'] : '';
        $peso = isset($dados['peso']) ? $dados['peso'] : '';
        $especie = isset($dados['especie']) ? $dados['especie'] : '';
        $raca = isset($dados['raca']) ? $dados['raca'] : '';
        $id_dono = isset($dados['id_dono']) ? $dados['id_dono'] : '';

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

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => implode('<br>', $erros)
            ));

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

        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Animal cadastrado com sucesso'
        ));

        exit;
    }

//add as coisas
    if ($metodo == 'PUT') {

        $id_animal = isset($dados['id_animal']) ? $dados['id_animal'] : '';
        $nome = isset($dados['nome']) ? $dados['nome'] : '';
        $idade = isset($dados['idade']) ? $dados['idade'] : '';
        $peso = isset($dados['peso']) ? $dados['peso'] : '';
        $especie = isset($dados['especie']) ? $dados['especie'] : '';
        $raca = isset($dados['raca']) ? $dados['raca'] : '';
        $id_dono = isset($dados['id_dono']) ? $dados['id_dono'] : '';

        $erros = array();

        if (empty($id_animal)) {
            $erros[] = "Animal inválido";
        }

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

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => implode('<br>', $erros)
            ));

            exit;
        }

        $peso = str_replace(',', '.', $peso);
//atualiza o animal
        Animal::atualizar(
            $id_animal,
            $nome,
            $idade,
            $peso,
            $especie,
            $raca,
            $id_dono
        );

        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Animal atualizado com sucesso'
        ));

        exit;
    }

//deleta
    if ($metodo == 'DELETE') {

        $id_animal = isset($dados['id_animal'])
            ? $dados['id_animal']
            : '';

        Animal::excluir($id_animal);

        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Animal excluído com sucesso'
        ));

        exit;
    }

?>
