<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once __DIR__ . '/../model/agendamento.php';
    require_once __DIR__ . '/../model/animal.php';
    require_once __DIR__ . '/../model/servico.php';

    $metodo = $_SERVER['REQUEST_METHOD'];

    if ($metodo == 'GET') {

        if (isset($_GET['id'])) {

            $agendamento = Agendamento::buscar($_GET['id']);

            if ($agendamento) {

                echo json_encode(array(
                    'sucesso' => true,
                    'agendamento' => $agendamento
                ));

            } else {

                echo json_encode(array(
                    'sucesso' => false,
                    'mensagem' => 'Agendamento não encontrado'
                ));
            }

            exit;
        }

        $resultado = Agendamento::listar();

        $agendamentos = array();

        while ($linha = $resultado->fetch_assoc()) {
            $agendamentos[] = $linha;
        }


        $resultadoAnimais = Animal::listar();

        $animais = array();

        while ($animal = $resultadoAnimais->fetch_assoc()) {
            $animais[] = $animal;
        }
        //add no banco

        $resultadoServicos = Servico::listar();

        $servicos = array();

        while ($servico = $resultadoServicos->fetch_assoc()) {
            $servicos[] = $servico;
        }


        echo json_encode(array(
            'sucesso' => true,
            'agendamentos' => $agendamentos,
            'animais' => $animais,
            'servicos' => $servicos
        ));

        exit;
    }


    $dados = json_decode(file_get_contents('php://input'), true);


    if ($metodo == 'POST') {

        $data = isset($dados['data'])
            ? $dados['data']
            : '';

        $horario = isset($dados['horario'])
            ? $dados['horario']
            : '';

        $id_animal = isset($dados['id_animal'])
            ? $dados['id_animal']
            : '';

        $id_servico = isset($dados['id_servico'])
            ? $dados['id_servico']
            : '';


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

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => implode('<br>', $erros)
            ));

            exit;
        }

// cadastra o agendamento
        Agendamento::cadastrar(
            $data,
            $horario,
            $id_animal,
            $id_servico
        );


        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Agendamento cadastrado com sucesso'
        ));

        exit;
    }


    if ($metodo == 'PUT') {

        $id_agendamento = isset($dados['id_agendamento'])
            ? $dados['id_agendamento']
            : '';

        $data = isset($dados['data'])
            ? $dados['data']
            : '';

        $horario = isset($dados['horario'])
            ? $dados['horario']
            : '';

        $id_animal = isset($dados['id_animal'])
            ? $dados['id_animal']
            : '';

        $id_servico = isset($dados['id_servico'])
            ? $dados['id_servico']
            : '';


        $erros = array();

        if (empty($id_agendamento)) {
            $erros[] = "Agendamento inválido";
        }

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

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => implode('<br>', $erros)
            ));

            exit;
        }

//atualiza
        Agendamento::atualizar(
            $id_agendamento,
            $data,
            $horario,
            $id_animal,
            $id_servico
        );


        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Agendamento atualizado com sucesso'
        ));

        exit;
    }

// deleta
    if ($metodo == 'DELETE') {

        $id_agendamento = isset($dados['id_agendamento'])
            ? $dados['id_agendamento']
            : '';


        Agendamento::excluir($id_agendamento);


        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Agendamento excluído com sucesso'
        ));

        exit;
    }

?>
