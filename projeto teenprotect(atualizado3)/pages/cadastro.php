<?php

require_once(__DIR__ . "/../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo "Formulario enviado";

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmar = $_POST["confirme-senha"];

    if ($senha != $confirmar) {
        die("As senhas não coincidem.");
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha)
            VALUES (?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senhaHash);

    if ($stmt->execute()) {
        //echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            header("Location: /login"); //arrumar essa parte e a pagina denuncia porque no infinity, ao enviar o form ela nn redireciona pra pagina login e dá erro
            exit;
        } else {
        echo "<script>alert('Erro ao cadastrar usuário.');</script>";
    }
}
?>
<div class="cadastro-page" id="page-register">
    <div class="form-card">
        
        <!-- Metade Esquerda: Formulário -->
        <div class="form-card-left">
            <h2 class="form-title">CADASTRO</h2>
            <form action="/pages/cadastro.php" data-link method="POST">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <div class="form-group">
                    <label for="confirme-senha">Confirme a senha:</label>
                    <input type="password" id="confirme-senha" name="confirme-senha" required>
                </div>

                <button type="submit" class="btn-primary" >CADASTRAR</button>
            </form>
        </div>

        <!-- Metade Direita: Boas-vindas -->
        <div class="form-card-right">
            <h2>Seja bem vindo!</h2>
            <img src="./img/logoTeenProtectFigura1.png" alt="Escudo TeenProtect" class="cadastro-logo-img">
        </div>

    </div>
</div>