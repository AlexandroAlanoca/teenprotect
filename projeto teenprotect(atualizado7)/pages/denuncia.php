<?php
session_start();
require_once(__DIR__ . "/../conexao.php");

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}


if (isset($_POST["enviar_denuncia"])/*$_SERVER["REQUEST_METHOD"] == "POST"   <-- retirei porque tem dois forms (form denuncia e form protocolo) e nao funcionava*/) {

    $usuario_id = $_SESSION["usuario_id"] ?? null;

    $tipo_denuncia = $_POST["tipo_denuncia"];
    $descricao = $_POST["descricao"];
    $data_ocorrido = $_POST["data_ocorrido"];

    $protocolo = "TP" . date("YmdHis") . rand(100,999);

    $IMG = null;
    $Video = null;

    if (
        isset($_FILES["evidencia"]) &&
        $_FILES["evidencia"]["error"] === UPLOAD_ERR_OK
    ) {

        $nomeOriginal = $_FILES["evidencia"]["name"];
        $tmp = $_FILES["evidencia"]["tmp_name"];

        $extensao = strtolower(
            pathinfo($nomeOriginal, PATHINFO_EXTENSION)
        );

        $mime = mime_content_type($tmp);

        $nomeArquivo = uniqid("ARQ_", true) . "." . $extensao;

         $tamanhoMaximo = 5 * 1024 * 1024;

    if ($_FILES["evidencia"]["size"] > $tamanhoMaximo) {
        die("O arquivo excede o tamanho máximo permitido (5 MB).");
    }

        if (str_starts_with($mime, "image/")) {

            $pasta = __DIR__ . "/../uploadImg/";

            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }

            move_uploaded_file($tmp, $pasta . $nomeArquivo);

            //echo $pasta . $nomeArquivo;
            //exit;

            $IMG = "uploadImg/" . $nomeArquivo;

        } elseif (str_starts_with($mime, "video/")) {

            $pasta = __DIR__ . "/../uploadVideo/";

            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }

            move_uploaded_file($tmp, $pasta . $nomeArquivo);

            $Video = "uploadVideo/" . $nomeArquivo;
        }
    }

    $sql = "INSERT INTO denuncias
            (usuario_id, protocolo, tipo_denuncia, descricao, data_ocorrido, IMG, Video)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param(
        "issssss",
        $usuario_id,
        $protocolo,
        $tipo_denuncia,
        $descricao,
        $data_ocorrido,
        $IMG,
        $Video
    );

    if ($stmt->execute()) {
        echo "<script>alert('Envio realizado com sucesso! Protocolo: $protocolo');</script>";
        header("Location: /denuncia"); 
        exit;
    } else {
        echo "<script>alert('Erro ao enviar denúncia.');</script>";
    }
}

//----------sistema protocolo-------
$resultadoDenuncia = null;

if (isset($_POST["buscar_protocolo"])) {

    $protocolo = $_POST["protocolo"];

    $sql = "SELECT * FROM denuncias WHERE protocolo = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $protocolo);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {

        //$denuncia = $resultado->fetch_assoc();
        /*
        echo "Tipo: " . $denuncia["tipo_denuncia"] . "<br>";
        echo "Descrição: " . $denuncia["descricao"] . "<br>";
        echo "Data: " . $denuncia["data_ocorrido"] . "<br>";
        */
        $resultadoDenuncia = $resultado->fetch_assoc();
        //header("Location: /denuncia"); 
        //exit;
      
    } else {

        echo "Protocolo não encontrado.";

    }
}
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
                <input id="file-button" type="file" name = "evidencia" accept = "image/*,video/*" multiple="multiple"> 

                <button type = "submit" name="enviar_denuncia">Enviar denúncia</button>
            </form>

            <form id="denuncia-form-protocol" action="/pages/denuncia.php" method="POST">
                <h2 class="text-content">Acompanhe a sua denúncia</h2>
                <div id="campo-protocolo-denuncia">
                    <span class="text-content">Protocolo da denúncia:</span>
                    <input type="text" name="protocolo" placeholder="Digite o protocolo">
                </div>
                <button type="submit" name="buscar_protocolo">Buscar</button>
            </form>
            <!--exibicao do protocolo-->
            
            <?php if ($resultadoDenuncia): ?>

<div class="resultado-protocolo">

    <h2>Denúncia encontrada</h2>

    <p>
        <strong>Tipo:</strong>
        <?= $resultadoDenuncia["tipo_denuncia"] ?>
    </p>

    <p>
        <strong>Descrição:</strong>
        <?= $resultadoDenuncia["descricao"] ?>
    </p>

    <p>
        <strong>Data:</strong>
        <?= $resultadoDenuncia["data_ocorrido"] ?>
    </p>

</div>

<?php endif; ?>
        </div>