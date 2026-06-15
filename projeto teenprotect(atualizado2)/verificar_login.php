<?php 
    session_start();
    echo json_encode(array(
        "logado" => isset($_SESSION["usuario_id"])
    ));
?>