<?php 
    session_start();
    echo json_encode(array(
        "logado" => isset($_SESSION["usuario_id"]),
        "nome" => isset($_SESSION["usuario_nome"]) ? $_SESSION["usuario_nome"] : ""
    ));
?>