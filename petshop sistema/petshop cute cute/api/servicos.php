<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once __DIR__ . '/../model/servico.php';

    $metodo = $_SERVER['REQUEST_METHOD'];

    if ($metodo == 'GET') {

        if (isset($_GET['id'])) {

            $servico = Servico::buscar($_GET['id']);

            if ($servico) {

                echo json_encode(array(
                    'sucesso' => true,
                    'servico' => $servico
                ));

            } else {

                echo json_encode(array(
                    'sucesso' => false,
                    'mensagem' => 'Serviço não encontrado'
                ));
            }

            exit;
        }

        $resultado = Servico::listar();

        $servicos = array();

        while ($linha = $resultado->fetch_assoc()) {
            $servicos[] = $linha;
        }

        echo json_encode(array(
            'sucesso' => true,
            'servicos' => $servicos
        ));

        exit;
    }


    $dados = json_decode(file_get_contents('php://input'), true);


    if ($metodo == 'POST') {

        $nome = isset($dados['nome']) ? $dados['nome'] : '';
        $preco = isset($dados['preco']) ? $dados['preco'] : '';

        $erros = array();

        if (empty($nome)) {
            $erros[] = "Nome do serviço é obrigatório";
        }

        if (empty($preco)) {
            $erros[] = "Preço é obrigatório";
        }

        if (!empty($erros)) {

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => implode('<br>', $erros)
            ));

            exit;
        }

        $preco = str_replace(',', '.', $preco);
//cadastra  o serviço
        Servico::cadastrar(
            $nome,
            $preco
        );

        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Serviço cadastrado com sucesso'
        ));

        exit;
    }


    if ($metodo == 'PUT') {

        $id_servico = isset($dados['id_servico'])
            ? $dados['id_servico']
            : '';

        $nome = isset($dados['nome'])
            ? $dados['nome']
            : '';

        $preco = isset($dados['preco'])
            ? $dados['preco']
            : '';

        $erros = array();

        if (empty($id_servico)) {
            $erros[] = "Serviço inválido";
        }

        if (empty($nome)) {
            $erros[] = "Nome do serviço é obrigatório";
        }

        if (empty($preco)) {
            $erros[] = "Preço é obrigatório";
        }

        if (!empty($erros)) {

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => implode('<br>', $erros)
            ));

            exit;
        }

        $preco = str_replace(',', '.', $preco);
//atualiza o servoço
        Servico::atualizar(
            $id_servico,
            $nome,
            $preco
        );

        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Serviço atualizado com sucesso'
        ));

        exit;
    }

//metodo para deletar
    if ($metodo == 'DELETE') {

        $id_servico = isset($dados['id_servico'])
            ? $dados['id_servico']
            : '';

        Servico::excluir($id_servico);

        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Serviço excluído com sucesso'
        ));

        exit;
    }

?>
