<?php
session_start();
include 'model.php';

// Verifica se o utilizador está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?erro=precisaLogin");
    exit();
}

// Verifica se recebeu o ID do conteúdo
if (!isset($_POST['idConteudo']) || empty($_POST['idConteudo'])) {
    header("Location: index.php?erro=conteudoInvalido");
    exit();
}

$idUser = $_SESSION['user_id'];
$idConteudo = (int)$_POST['idConteudo'];

// Tenta inscrever o utilizador
$sucesso = inscreverUtilizador($idUser, $idConteudo);

if ($sucesso) {
    // Inscrição bem-sucedida - redireciona para o perfil
    header("Location: profile.php?sucesso=inscrito");
} else {
    // Já estava inscrito ou erro - redireciona de volta
    header("Location: profile.php?erro=jaInscrito");
}
exit();
?>
