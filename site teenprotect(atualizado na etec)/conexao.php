<?php
/*
$conexao = new mysqli(
    "localhost",
    "root",
    "",
    "teenprotect"
);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}*/

/*
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conexao = new mysqli(
    "127.0.0.1",
    "root",
    "",
    "teenprotect",
    3307
);

$conexao->set_charset("utf8");
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conexao = new mysqli(
    "127.0.0.1",
    "root",
    "",
    "teenprotect",
    3306
);

$conexao->set_charset("utf8");
?>