<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../model/dono.php';

$metodo = $_SERVER['REQUEST_METHOD'];

try {


    if ($metodo === 'GET') {

        if (isset($_GET['id'])) {

            $dono = Dono::buscar($_GET['id']);

            if (!$dono) {

                http_response_code(404);

                echo json_encode(array(
                    'sucesso' => false,
                    'mensagem' => 'Dono não encontrado'
                ));

                exit;
            }

            echo json_encode(array(
                'sucesso' => true,
                'dono' => $dono
            ));

            exit;
        }

        $resultado = Dono::listar();

        $donos = array();

        while ($linha = $resultado->fetch_assoc()) {

            $donos[] = $linha;
        }

        echo json_encode(array(
            'sucesso' => true,
            'donos' => $donos
        ));

        exit;
    }

    $conteudo = file_get_contents('php://input');

    $dados = json_decode($conteudo, true);

    if ($metodo === 'POST') {

        $nome = isset($dados['nome'])
            ? trim($dados['nome'])
            : '';

        $cpf = isset($dados['cpf'])
            ? trim($dados['cpf'])
            : '';

        $telefone = isset($dados['telefone'])
            ? trim($dados['telefone'])
            : '';


        if ($nome === '') {

            http_response_code(400);

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => 'Nome é obrigatório'
            ));

            exit;
        }


        if ($cpf === '') {

            http_response_code(400);

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => 'CPF é obrigatório'
            ));

            exit;
        }

//cadastra o dono
        Dono::cadastrar(
            $nome,
            $cpf,
            $telefone
        );


        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Dono cadastrado com sucesso'
        ));

        exit;
    }

    if ($metodo === 'PUT') {

        $id = isset($dados['id'])
            ? intval($dados['id'])
            : 0;

        $nome = isset($dados['nome'])
            ? trim($dados['nome'])
            : '';

        $cpf = isset($dados['cpf'])
            ? trim($dados['cpf'])
            : '';

        $telefone = isset($dados['telefone'])
            ? trim($dados['telefone'])
            : '';


        if ($id <= 0) {

            http_response_code(400);

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => 'ID inválido'
            ));

            exit;
        }


        if ($nome === '') {

            http_response_code(400);

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => 'Nome é obrigatório'
            ));

            exit;
        }


        if ($cpf === '') {

            http_response_code(400);

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => 'CPF é obrigatório'
            ));

            exit;
        }

//atualiza os dados do dono
        Dono::atualizar(
            $id,
            $nome,
            $cpf,
            $telefone
        );


        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Dono atualizado com sucesso'
        ));

        exit;
    }
//deleta
    if ($metodo === 'DELETE') {

        $id = isset($dados['id'])
            ? intval($dados['id'])
            : 0;


        if ($id <= 0) {

            http_response_code(400);

            echo json_encode(array(
                'sucesso' => false,
                'mensagem' => 'ID inválido'
            ));

            exit;
        }


        Dono::excluir($id);


        echo json_encode(array(
            'sucesso' => true,
            'mensagem' => 'Dono excluído com sucesso'
        ));

        exit;
    }

    http_response_code(405);

    echo json_encode(array(
        'sucesso' => false,
        'mensagem' => 'Método não permitido'
    ));


} catch (Exception $e) {

    http_response_code(500);

    echo json_encode(array(
        'sucesso' => false,
        'mensagem' => 'Erro interno no servidor'
    ));
}

?>
