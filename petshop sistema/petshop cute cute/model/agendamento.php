<?php

require_once __DIR__ . '/../config/database.php';

class Agendamento {

    public static function listar() {
        global $conexao;

        $sql = "SELECT agendamento.*, animal.nome AS nome_animal,
                servico.nome AS nome_servico
                FROM agendamento
                INNER JOIN animal ON agendamento.id_animal = animal.id_animal
                INNER JOIN servico ON agendamento.id_servico = servico.id_servico
                ORDER BY data_agendamento DESC, horario DESC";

        $resultado = $conexao->query($sql);

        if (!$resultado) {
            die("Erro na consulta: " . $conexao->error);
        }

        return $resultado;
    }

    public static function buscar($id_agendamento) {
        global $conexao;

        $id_agendamento = intval($id_agendamento);

        $sql = "SELECT * FROM agendamento
                WHERE id_agendamento = $id_agendamento";

        $resultado = $conexao->query($sql);

        return $resultado->fetch_assoc();
    }

    public static function cadastrar($data, $horario, $id_animal, $id_servico) {
        global $conexao;

        $sql = "INSERT INTO agendamento
                (data_agendamento, horario, id_animal, id_servico)
                VALUES
                ('$data', '$horario', '$id_animal', '$id_servico')";

        $conexao->query($sql);
    }

    public static function atualizar($id_agendamento, $data, $horario, $id_animal, $id_servico) {
        global $conexao;

        $id_agendamento = intval($id_agendamento);

        $sql = "UPDATE agendamento SET
                data_agendamento = '$data',
                horario = '$horario',
                id_animal = '$id_animal',
                id_servico = '$id_servico'
                WHERE id_agendamento = $id_agendamento";

        $conexao->query($sql);
    }

    public static function excluir($id_agendamento) {
        global $conexao;

        $id_agendamento = intval($id_agendamento);

        $sql = "DELETE FROM agendamento
                WHERE id_agendamento = $id_agendamento";

        $conexao->query($sql);
    }

}

?>
