<?php
session_start();

function setMensagem($tipo, $texto) {
    $_SESSION['mensagem'] = array(
        'tipo' => $tipo,
        'texto' => $texto
    );
}

function getMensagem() {
    if (isset($_SESSION['mensagem'])){
        $msg = $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
        return $msg;
    }
    return null;
}
?>