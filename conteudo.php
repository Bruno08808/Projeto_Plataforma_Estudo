<?php
include 'model.php';

$tipo = $_GET['tipo'] ?? null;
$slug = $_GET['slug'] ?? null;

if (!$tipo || !$slug) {
    die("Conteúdo inválido.");
}

if (!$conteudo) {
    die("Conteúdo não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($conteudo['Titulo']) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="pagina-produto">

    <h1><?= htmlspecialchars($conteudo['Titulo']) ?></h1>

    <p class="descricao">
        <?= nl2br(htmlspecialchars($conteudo['Descricao'])) ?>
    </p>

    <div class="info-produto">
        <p><strong>Preço:</strong> €<?= number_format($conteudo['Preco'], 2, ',', '.') ?></p>
        <p><strong>Avaliação:</strong> <?= $conteudo['Avaliacao'] ?>/5</p>

        <?php if ($tipo === 'curso' && isset($conteudo['Duracao'])): ?>
            <p><strong>Duração:</strong> <?= $conteudo['Duracao'] ?> horas</p>
        <?php endif; ?>
    </div>

    <button class="btn-inscrever">
        Inscrever
    </button>

</main>

<?php include 'footer.php'; ?>

</body>
</html>
