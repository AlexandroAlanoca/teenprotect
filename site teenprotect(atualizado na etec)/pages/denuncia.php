<?php
session_start();

//include("../conexao.php");
require_once(__DIR__ . "/../conexao.php");

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario_id = $_SESSION["usuario_id"] ?? null;

    $tipo_denuncia = $_POST["tipo_denuncia"];
    $descricao = $_POST["descricao"];
    $data_ocorrido = $_POST["data_ocorrido"];

    $protocolo = "TP" . date("YmdHis") . rand(100,999);

    $evidencia = null;

    $sql = "INSERT INTO denuncias
            (usuario_id, protocolo, tipo_denuncia, descricao, data_ocorrido, evidencia)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param(
        "isssss",
        $usuario_id,
        $protocolo,
        $tipo_denuncia,
        $descricao,
        $data_ocorrido,
        $evidencia
    );

    if ($stmt->execute()) {
        echo "<script>alert('Denúncia enviada! Protocolo: $protocolo');</script>";
    } else {
        echo "<script>alert('Erro ao enviar denúncia.');</script>";
    }

    if($stmt){
        echo "aaaaa";
    }
}
?>

     <div class="denuncia-page">
            <form id="denuncia-form" action="/denuncia" method="POST" enctype="multipart/form-data">
                <h1 class="text-content">Denunciar Aliciamento</h1>
                <p class="text-content">Preencha as informações abaixo:</p>

                <span class="text-content">Tipo de denuncia:</span>
                <select name="tipo_denuncia" id="">
                    <option value="aliciamento online">Aliciamento online</option>
                    <option value="aliciamento presencial">Aliciamento presencial</option>
                </select>

                <span class="text-content">Descrição:</span>
                <textarea style="resize: vertical;" name="descricao" id="descricao"></textarea>

                <span class="text-content">Data do ocorrido:</span>
                <input type="date" name="data_ocorrido">

                <span class="text-content">Anexar evidências:</span>
                <input id="file-button" type="file" name = "evidencia">

                <button type = "submit">Enviar denúncia</button>
            </form>
            <form id="denuncia-form-protocol" action="">
                <h2 class="text-content">Acompanhe a sua denúncia</h2>
                <div id="campo-protocolo-denuncia">
                    <span class="text-content">Protocolo da denúncia:</span>
                    <input type="text">
                </div>
                
            </form>
        </div>
