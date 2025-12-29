<?php
require_once 'model.php';

// Validar se o ID foi enviado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Explicação não encontrada.");
}

$id = $_GET['id'];
$detalhe = getExplicacaoPorID($id);

if (!$detalhe) {
    die("O conteúdo selecionado não existe.");
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Detalhes da Explicação</title>
    <link rel="stylesheet" href="explicações_detalhes.css">
</head>
<body>
    <div class="container-detalhe">
        <a href="explicações.php" class="btn-voltar">← Voltar</a>
        
        <div class="detalhe-card">
            <h1><?php echo htmlspecialchars($detalhe['Titulo']); ?></h1>
            <span class="badge"><?php echo htmlspecialchars($detalhe['Tipo']); ?></span>
            
            <div class="info-corpo">
                <h3>Sobre esta explicação:</h3>
                <p><?php echo nl2br(htmlspecialchars($detalhe['Info_Extra'])); ?></p>
            </div>

            <div class="footer-detalhe">
                <button onclick="alert('Funcionalidade de agendamento em breve!')" class="btn-confirmar">Confirmar Agendamento</button>
            </div>
        </div>
    </div>
</body>
</html>