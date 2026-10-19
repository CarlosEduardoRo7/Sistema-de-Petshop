<?php

    require_once __DIR__ . '/../config/database.php';

    class Dono {

    public static function listar() {
        global $conexao;

        $sql_busca = "SELECT * FROM dono ORDER BY id_dono DESC";
        $resultado = $conexao->query($sql_busca);

        if (!$resultado) {
            die("Erro na query: " . $conexao->error);
        }

        return $resultado;
    }

        public static function buscar($id_dono) {
            global $conexao;

            $id_dono = intval($id_dono);
            $sql_busca = "SELECT * FROM dono WHERE id_dono = $id_dono";
            $resultado = $conexao->query($sql_busca);

            return $resultado->fetch_assoc();
        }

        public static function cadastrar($nome, $cpf, $telefone) {
            global $conexao;

            $sql_cadastro = "INSERT INTO dono (nome, cpf, telefone) VALUES ('$nome', '$cpf', '$telefone')";
            $conexao->query($sql_cadastro);
        }

        public static function atualizar($id_dono, $nome, $cpf, $telefone) {
            global $conexao;

            $id_dono = intval($id_dono);
            $sql_atualizar = "UPDATE dono SET nome = '$nome', cpf = '$cpf', telefone = '$telefone' WHERE id_dono = $id_dono";
            $conexao->query($sql_atualizar);
        }

        public static function excluir($id_dono) {
            global $conexao;

            $id_dono = intval($id_dono);
            $sql_excluir = "DELETE FROM dono WHERE id_dono = $id_dono";
            $conexao->query($sql_excluir);
        }

    }

?>