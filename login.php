<?php
session_start();
include 'model.php'; // Incluímos as funções da BD

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = verificarLogin($email, $password);
    
    if($user) {
        // Guardamos o ID real vindo da base de dados
        $_SESSION['user_id'] = $user['IDuser'];
        header("Location: profile.php");
        exit();
    } else {
        $erro = "Email ou password incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyHub - Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>StudyHub</h1>
            <h2>Login</h2>
            
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Entrar</button>
            </form>
            
            <p><a href="index.php">Voltar à página inicial</a></p>
        </div>
    </div>
</body>
</html>