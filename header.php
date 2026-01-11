<?php
// se ainda não iniciou a session, inicia
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NL0CDQLTQ4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-NL0CDQLTQ4');
</script>

<title><?php echo $seo['title']; ?></title>
    <meta name="description" content="<?php echo $seo['description']; ?>">
    <meta name="keywords" content="<?php echo $seo['keywords']; ?>">
    <meta name="author" content="StudyHub">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
    
    <script src="analytics-tracking.js" defer></script>
    <script src="cookie-consent.js"></script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'StudyHub'; ?></title>
    
    <!-- aqui vais carregar o CSS base (menu) e depois o CSS específico de cada página -->
    <link rel="stylesheet" href="style.css">
    <?php if(isset($page_css)): ?>
        <link rel="stylesheet" href="<?php echo $page_css; ?>">
    <?php endif; ?>
</head>

<body>
    <!-- navbar que vai aparecer em todas as páginas -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <h1><a href="index.php">StudyHub</a></h1>
            </div>
            
            <!-- links principais da navbar -->
            <ul class="nav-links">
                <li><a href="index.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Início</a></li>
                <li><a href="explicacoes.php" class="explicacoes-link <?php echo (basename($_SERVER['PHP_SELF']) == 'explicacoes.php') ? 'active' : ''; ?>">Explicações</a></li>
                <li><a href="cursos.php" class="cursos-link <?php echo (basename($_SERVER['PHP_SELF']) == 'cursos.php') ? 'active' : ''; ?>">Cursos</a></li>
                <li><a href="ebooks.php" class="ebooks-link <?php echo (basename($_SERVER['PHP_SELF']) == 'ebooks.php') ? 'active' : ''; ?>">Ebooks</a></li>
                <li><a href="palestras.php" class="palestras-link <?php echo (basename($_SERVER['PHP_SELF']) == 'palestras.php') ? 'active' : ''; ?>">Palestras</a></li>
            </ul>
            
            <!-- parte direita da navbar - login ou perfil -->
            <div class="nav-right">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <!-- se tiver logado mostra o icon do perfil -->
                    <a href="profile.php" class="profile-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                <?php else: ?>
                    <!-- se não tiver logado mostra botão de login -->
                    <a href="login.php" class="btn-login">Entrar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>