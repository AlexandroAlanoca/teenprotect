<?php
session_start();

require_once(__DIR__ . "/../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario["senha"])) {

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nome"] = $usuario["nome"];

            header("Location: /");
            exit;

        } else {
            echo "<script>alert('Senha incorreta!');</script>";
        }

    } else {
        echo "<script>alert('Usuário não encontrado!');</script>";
    }
}
?>

<div class="login-page">
            <div class="login-container">
                <div class="login-left">
                    <div class="login-header">
                        <h1>LOGIN</h1>
                    </div>

                    <form action="/pages/login.php" method="POST" class="login-form"   >
                        <div class="input-group">
                            <label>E-mail:</label>
                            <div class="input-wrapper">
                                <input type="email" name="email" placeholder="seu@email.com" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label data-i18n="loginPassword" >Senha:</label>
                            <div class="input-wrapper">
                                <input type="password" name="senha" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="forgot-password">
                            <a href="#" onclick="alert('Recuperação de senha enviada para seu e-mail!')">Esqueceu a senha?</a>
                        </div>

                        <button type="submit" class="btn-login">ENTRAR</button>

                        <div class="register-link">
                            Não tem uma conta? <a href="#" onclick="alert('Redirecionando para cadastro...')">Crie a sua conta</a>
                        </div>
                    </form>
                </div>

                <div class="login-right">
                    <h2>Bem vindo de volta!</h2>
                    <img src="img/logosite(escudo).png" alt="Escudo TeenProtect" class="login-shield">
                </div>
            </div>
        </div>
