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

    //$evidencia = null;
//--------------------------------------
    $evidencia = null;

if (isset($_FILES["evidencia"]) && $_FILES["evidencia"]["error"] == UPLOAD_ERR_OK) {

    // Pasta onde os arquivos serão salvos
    $pasta = __DIR__ . "/../uploads/evidencias/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    // Tamanho máximo: 5 MB
    $tamanhoMaximo = 5 * 1024 * 1024;

    if ($_FILES["evidencia"]["size"] > $tamanhoMaximo) {
        die("O arquivo excede o tamanho máximo permitido (5 MB).");
    }

    // Extensões permitidas
    $extensoesPermitidas = ["jpg", "jpeg", "png", "webp"];

    $extensao = strtolower(
        pathinfo($_FILES["evidencia"]["name"], PATHINFO_EXTENSION)
    );

    if (!in_array($extensao, $extensoesPermitidas)) {
        die("Formato de arquivo não permitido.");
    }

    // Verificar se é realmente uma imagem
    $tipoMime = mime_content_type($_FILES["evidencia"]["tmp_name"]);

    $tiposPermitidos = [
        "image/jpeg",
        "image/png",
        "image/webp"
    ];

    if (!in_array($tipoMime, $tiposPermitidos)) {
        die("O arquivo enviado não é uma imagem válida.");
    }

    // Nome único para o arquivo
    $nomeArquivo = uniqid("evidencia_", true) . "." . $extensao;

    $caminhoCompleto = $pasta . $nomeArquivo;

    if (move_uploaded_file(
        $_FILES["evidencia"]["tmp_name"],
        $caminhoCompleto
    )) {

        // Caminho relativo para salvar no banco
        $evidencia = "uploads/evidencias/" . $nomeArquivo;

    } else {

        die("Erro ao salvar a imagem.");

    }
}
/*
if (isset($_FILES["evidencia"]) && $_FILES["evidencia"]["error"] == 0) {

    $pasta = __DIR__ . "/../uploads/evidencias/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $nomeArquivo = uniqid() . "_" . basename($_FILES["evidencia"]["name"]);

    $caminhoCompleto = $pasta . $nomeArquivo;

    if (move_uploaded_file($_FILES["evidencia"]["tmp_name"], $caminhoCompleto)) {

        // Caminho que será salvo no banco
        $evidencia = "uploads/evidencias/" . $nomeArquivo;

    } else {

        die("Erro ao enviar a imagem.");

    }
}*/
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // pega os dados

    // INSERT na tabela denuncias

    $stmt->execute();

    // obtém o id da denúncia criada
    $denuncia_id = $conexao->insert_id;

    // percorre todos os arquivos
    foreach ($_FILES["evidencias"]["tmp_name"] as $i => $tmpName) {

        // move o arquivo

        // INSERT na tabela evidencias

    }

}*/
//------------------------------
//$denuncia_id = $conexao->insert_id;


/*
$pasta = __DIR__ . "/../uploads/evidencias/";

if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
}

$tiposPermitidos = [
    "image/jpeg",
    "image/png",
    "image/webp",
    "video/mp4",
    "video/webm",
    "video/quicktime"
];

echo "<pre>";
print_r($_FILES["evidencias"]);
echo "</pre>";
*/

  //-------------------
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

    if($stmt->execute()){
        echo "<script>alert('envio realizado com sucesso!');</script>";
            header("Location: /denuncia");
            exit;
    }else {
        echo "<script>alert('Erro ao enviar denuncia.');</script>";
    }
}
//$denuncia_id = $conexao->insert_id;
/*
foreach ($_FILES["evidencias"]["tmp_name"] as $i => $tmpName) {

    if ($_FILES["evidencias"]["error"][$i] != UPLOAD_ERR_OK) {
        continue;
    }

    $tipoMime = mime_content_type($tmpName);

    if (!in_array($tipoMime, $tiposPermitidos)) {
        continue;
    }

    $nomeOriginal = $_FILES["evidencias"]["name"][$i];
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    $nomeArquivo = uniqid() . "." . $extensao;

    move_uploaded_file(
        $tmpName,
        $pasta . $nomeArquivo
    );

    $tipo = str_starts_with($tipoMime, "image/")
        ? "imagem"
        : "video";

    $caminho = "uploads/evidencias/" . $nomeArquivo;

    $sqlEvidencia = "INSERT INTO evidencias
                    (denuncia_id, arquivo, tipo)
                    VALUES (?, ?, ?)";

    $stmtEvidencia = $conexao->prepare($sqlEvidencia);

    $stmtEvidencia->bind_param(
        "iss",
        $denuncia_id,
        $caminho,
        $tipo
    );

    if ($stmtEvidencia->execute()) {
    echo "Evidência salva com sucesso.<br>";
    } else {
        echo "Erro ao salvar evidência: " . $stmtEvidencia->error . "<br>";
    }
}*/
?>

     <div class="denuncia-page">
            <form id="denuncia-form" action="/pages/denuncia.php" method="POST" enctype="multipart/form-data">
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
                <input id="file-button" type="file" name = "evidencia[]" multiple
    accept="image/jpeg,image/png,image/webp,video/mp4,video/webm,video/quicktime">

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
