<?php
require_once 'model.php';
$explicacoes = getTodasExplicacoes();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Explicações Disponíveis</title>
    <link rel="stylesheet" href="explicações_detalhes.css">
</head>
<body>
    <div class="container">
        <h1>Nossas Explicações</h1>
        <div class="grid-explicacoes">
            <?php foreach ($explicacoes as $exp): ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($exp['Titulo']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($exp['Info_Extra'], 0, 100)) . '...'; ?></p>
                    <a href="explicações_detalhes.php?id=<?php echo $exp['IDconteudo']; ?>" class="btn-agendar">Agendar</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>