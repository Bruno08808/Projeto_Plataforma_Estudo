<?php
session_start();
include 'model.php'; // Importa a lógica de registo

$mensagem = "";
$tipo_msg = "";

if (isset($_POST['registar'])) {
    $nome     = $_POST['nome'];
    $email    = $_POST['email'];
    $idade    = $_POST['idade'];
    $password = $_POST['password'];

    // Tenta inserir na base de dados Hostinger
    if (adicionarUtilizador($nome, $email, $idade, $password)) {
        $mensagem = "Conta criada! Já podes fazer login.";
        $tipo_msg = "green";
    } else {
        $mensagem = "Erro: Este email já existe ou os dados são inválidos.";
        $tipo_msg = "#ff4d4d";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyHub - Registo</title>
    <link rel="stylesheet" href="login.css"> </head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>StudyHub</h1>
            <h2>Criar Conta</h2>
            
            <?php if($mensagem != ""): ?>
                <p style="color: <?php echo $tipo_msg; ?>; font-size: 0.9em; margin-bottom: 15px; text-align: center;"><?php echo $mensagem; ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="nome" placeholder="Nome Completo" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="number" name="idade" placeholder="Ano Nascimento (Ex: 1998)" required min="1900" max="2025">
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="registar">Registar</button>
            </form>
            
            <p style="margin-top: 15px; font-size: 0.9em; color: #666;">
                Já tens conta? <a href="login.php" style="color: #4a90e2; text-decoration: none; font-weight: bold;">Faz login aqui</a>
            </p>
            
            <p style="margin-top: 10px;"><a href="index.php" style="color: #4a90e2; text-decoration: none; font-size: 0.85em;">Voltar à página inicial</a></p>
        </div>
    </div>
</body>
</html>