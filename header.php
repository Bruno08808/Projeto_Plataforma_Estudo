<?php
// Se ainda não iniciou a session, inicia
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir configurações SEO se disponível
if (file_exists('seo_config.php')) {
    require_once 'seo_config.php';
    $site_url = defined('SITE_URL') ? SITE_URL : 'https://www.studyhub.pt';
    $site_name = defined('SITE_NAME') ? SITE_NAME : 'StudyHub';
} else {
    $site_url = 'https://www.studyhub.pt';
    $site_name = 'StudyHub';
}

// Configuração SEO da página
$page = basename($_SERVER['PHP_SELF'], '.php');
$seo = isset($page_seo) ? $page_seo : (function_exists('getSeoConfig') ? getSeoConfig($page) : [
    'title' => (isset($page_title) ? $page_title : 'StudyHub'),
    'description' => 'Plataforma de educação online com cursos, ebooks e palestras',
    'keywords' => 'cursos online, ebooks, palestras, educação',
    'image' => $site_url . '/assets/images/og-default.jpg'
]);

// URL Canonical
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$canonical_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <!-- ==================== GOOGLE TAG MANAGER ==================== -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MWJCTLHP');</script>
    
    <!-- ==================== META TAGS BÁSICAS ==================== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- ==================== SEO META TAGS ==================== -->
    <title><?php echo htmlspecialchars($seo['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seo['description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($seo['keywords'] ?? ''); ?>">
    <meta name="author" content="StudyHub">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
    
    <!-- ==================== OPEN GRAPH (Facebook/WhatsApp) ==================== -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo $site_name; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($seo['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo['description']); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($seo['image'] ?? $site_url . '/assets/images/og-default.jpg'); ?>">
    <meta property="og:locale" content="pt_PT">
    
    <!-- ==================== TWITTER CARDS ==================== -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($seo['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($seo['description']); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($seo['image'] ?? $site_url . '/assets/images/og-default.jpg'); ?>">
    
    <!-- ==================== FAVICON ==================== -->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    
    <!-- ==================== PRECONNECT PARA PERFORMANCE ==================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://i.pravatar.cc">
    <link rel="preconnect" href="https://picsum.photos">
    
    <!-- ==================== CSS ==================== -->
    <link rel="stylesheet" href="style.css">
    <?php if(isset($page_css) && !empty($page_css)): ?>
        <link rel="stylesheet" href="<?php echo $page_css; ?>">
    <?php endif; ?>
    
    <!-- ==================== ANALYTICS & COOKIES ==================== -->
    <script src="analytics-tracking.js" defer></script>
    <script src="cookie-consent.js" defer></script>
    
    <!-- ==================== SCHEMA.ORG - ORGANIZATION ==================== -->
    <?php if (function_exists('getOrganizationSchema')): ?>
    <script type="application/ld+json">
    <?php echo json_encode(getOrganizationSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
    </script>
    <?php endif; ?>
    
    <!-- ==================== SCHEMA.ORG - PAGE SPECIFIC ==================== -->
    <?php if (isset($schema_markup) && $schema_markup): ?>
    <script type="application/ld+json">
    <?php echo json_encode($schema_markup, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
    </script>
    <?php endif; ?>
</head>

<body>
    <!-- ==================== GOOGLE TAG MANAGER (NOSCRIPT) ==================== -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MWJCTLHP"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar" role="navigation" aria-label="Navegação principal">
        <div class="nav-container">
            <div class="logo">
                <h1><a href="index.php" aria-label="StudyHub - Página Inicial">StudyHub</a></h1>
            </div>
            
            <!-- Links principais da navbar -->
            <ul class="nav-links" role="menubar">
                <li role="none"><a href="index.php" role="menuitem" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Início</a></li>
                <li role="none"><a href="explicacoes.php" role="menuitem" class="explicacoes-link <?php echo (basename($_SERVER['PHP_SELF']) == 'explicacoes.php') ? 'active' : ''; ?>">Explicações</a></li>
                <li role="none"><a href="cursos.php" role="menuitem" class="cursos-link <?php echo (basename($_SERVER['PHP_SELF']) == 'cursos.php') ? 'active' : ''; ?>">Cursos</a></li>
                <li role="none"><a href="ebooks.php" role="menuitem" class="ebooks-link <?php echo (basename($_SERVER['PHP_SELF']) == 'ebooks.php') ? 'active' : ''; ?>">Ebooks</a></li>
                <li role="none"><a href="palestras.php" role="menuitem" class="palestras-link <?php echo (basename($_SERVER['PHP_SELF']) == 'palestras.php') ? 'active' : ''; ?>">Palestras</a></li>
            </ul>
            
            <!-- Parte direita da navbar - login ou perfil -->
            <div class="nav-right">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <!-- Se tiver logado mostra o icon do perfil -->
                    <a href="profile.php" class="profile-icon" aria-label="Meu Perfil">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                <?php else: ?>
                    <!-- Se não tiver logado mostra botão de login -->
                    <a href="login.php" class="btn-login">Entrar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <!-- ==================== BREADCRUMBS ==================== -->
    <?php if (isset($breadcrumbs) && !empty($breadcrumbs)): ?>
    <nav aria-label="Breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
            <?php foreach ($breadcrumbs as $index => $item): ?>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <?php if (!empty($item['url'])): ?>
                        <a href="<?php echo htmlspecialchars($item['url']); ?>" itemprop="item">
                            <span itemprop="name"><?php echo htmlspecialchars($item['name']); ?></span>
                        </a>
                    <?php else: ?>
                        <span itemprop="name"><?php echo htmlspecialchars($item['name']); ?></span>
                    <?php endif; ?>
                    <meta itemprop="position" content="<?php echo $index + 1; ?>">
                </li>
            <?php endforeach; ?>
        </ol>
    </nav>
    <?php 
    // Gerar schema de breadcrumbs
    if (function_exists('getBreadcrumbSchema')):
    ?>
    <script type="application/ld+json">
    <?php echo json_encode(getBreadcrumbSchema($breadcrumbs), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
    </script>
    <?php endif; ?>
    <?php endif; ?>