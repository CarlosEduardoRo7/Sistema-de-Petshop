<?php

require_once __DIR__ . '/../config/database.php';

class Servico {

    public static function listar() {
        global $conexao;

        $sql = "SELECT * FROM servico
                ORDER BY id_servico DESC";

        $resultado = $conexao->query($sql);

        if (!$resultado) {
            die("Erro na consulta: " . $conexao->error);
        }

        return $resultado;
    }

    public static function buscar($id_servico) {
        global $conexao;

        $id_servico = intval($id_servico);

        $sql = "SELECT * FROM servico
                WHERE id_servico = $id_servico";

        $resultado = $conexao->query($sql);

        return $resultado->fetch_assoc();
    }

    public static function cadastrar($nome, $preco) {
        global $conexao;

        $sql = "INSERT INTO servico (nome, preco)
                VALUES ('$nome', '$preco')";

        $conexao->query($sql);
    }

    public static function atualizar($id_servico, $nome, $preco) {
        global $conexao;

        $id_servico = intval($id_servico);

        $sql = "UPDATE servico SET
                nome = '$nome',
                preco = '$preco'
                WHERE id_servico = $id_servico";

        $conexao->query($sql);
    }

    public static function excluir($id_servico) {
        global $conexao;

        $id_servico = intval($id_servico);

        $sql = "DELETE FROM servico
                WHERE id_servico = $id_servico";

        $conexao->query($sql);
    }

}

?>
