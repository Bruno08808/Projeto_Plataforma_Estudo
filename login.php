<?php
// inicia session
session_start();

// se clicar no botão de login, cria session e vai pro perfil
if(isset($_POST['login'])) {
    // cria dados fake na session
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = "João Silva";
    $_SESSION['user_email'] = "joao@email.com";
    
    // vai pra página de perfil
    header("Location: profile.php");
    exit();
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