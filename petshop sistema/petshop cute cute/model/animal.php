<?php

require_once __DIR__ . '/../config/database.php';

class Animal {

    public static function listar() {
        global $conexao;

        $sql = "SELECT animal.*, dono.nome AS nome_dono
                FROM animal
                INNER JOIN dono ON animal.id_dono = dono.id_dono
                ORDER BY animal.id_animal DESC";

        $resultado = $conexao->query($sql);

        if (!$resultado) {
            die("Erro na consulta: " . $conexao->error);
        }

        return $resultado;
    }

    public static function buscar($id_animal) {
        global $conexao;

        $id_animal = intval($id_animal);

        $sql = "SELECT * FROM animal
                WHERE id_animal = $id_animal";

        $resultado = $conexao->query($sql);

        return $resultado->fetch_assoc();
    }

    public static function cadastrar($nome, $idade, $peso, $especie, $raca, $id_dono) {
        global $conexao;

        $sql = "INSERT INTO animal
                (nome, idade, peso, especie, raca, id_dono)
                VALUES
                ('$nome', '$idade', '$peso', '$especie', '$raca', '$id_dono')";

        $conexao->query($sql);
    }

    public static function atualizar($id_animal, $nome, $idade, $peso, $especie, $raca, $id_dono) {
        global $conexao;

        $id_animal = intval($id_animal);

        $sql = "UPDATE animal SET
                nome = '$nome',
                idade = '$idade',
                peso = '$peso',
                especie = '$especie',
                raca = '$raca',
                id_dono = '$id_dono'
                WHERE id_animal = $id_animal";

        $conexao->query($sql);
    }

    public static function excluir($id_animal) {
        global $conexao;

        $id_animal = intval($id_animal);

        $sql = "DELETE FROM animal
                WHERE id_animal = $id_animal";

        $conexao->query($sql);
    }

}

?>
