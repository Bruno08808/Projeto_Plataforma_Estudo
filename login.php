<?php
session_start();
include 'model.php'; // Usa a ligação corrigida à Hostinger

$erro = "";

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Tenta validar as credenciais na tabela 'Utilizador'
    $user = verificarLogin($email, $password);
    
    if($user) {
        // Guarda o ID real da base de dados na sessão
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
            
            <?php if($erro != ""): ?>
                <p style="color: #ff4d4d; font-size: 0.9em; margin-bottom: 15px; text-align: center;"><?php echo $erro; ?></p>
            <?php endif; ?>
            
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Entrar</button>
            </form>
            
            <p style="margin-top: 15px; font-size: 0.9em; color: #666;">
                Não tens conta? <a href="registo.php" style="color: #4a90e2; text-decoration: none; font-weight: bold;">Cria uma agora</a>
            </p>
            
            <p style="margin-top: 10px;"><a href="index.php" style="color: #4a90e2; text-decoration: none; font-size: 0.85em;">Voltar à página inicial</a></p>
        </div>
    </div>
</body>
</html>