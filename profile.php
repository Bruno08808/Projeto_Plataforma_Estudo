<?php
session_start();
include 'model.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Busca os dados REAIS do utilizador logado
$dados = getDadosUtilizador($_SESSION['user_id']);
$user_name = $dados['Nome'];
$user_email = $dados['Email'];
$user_idade = $dados['Idade']; // Novo campo da tua BD

// ... resto do teu código de layout ...

// define o título e CSS
$page_title = "StudyHub - Perfil";
$page_css = "profile.css";

// busca dados do user da session
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

// dados de exemplo - depois vêm da BD
$cursos_inscritos = [
    ['nome' => 'Matemática Avançada', 'progresso' => 65],
    ['nome' => 'Programação Web', 'progresso' => 40],
    ['nome' => 'Inglês Fluente', 'progresso' => 80]
];

$palestras_favoritas = [
    ['nome' => 'Inteligência Artificial', 'duracao' => '45min'],
    ['nome' => 'Gestão de Tempo', 'duracao' => '30min'],
    ['nome' => 'Empreendedorismo', 'duracao' => '50min']
];

// inclui o header
include 'header.php';
?>

<!-- CONTEÚDO ESPECÍFICO DO PERFIL -->
<div class="profile-container">
    <!-- cabeçalho do perfil com avatar, info e botão de sair -->
    <div class="profile-header">
        <div class="profile-avatar">
            <!-- avatar placeholder - depois podes meter uma imagem real -->
            <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        </div>
        
        <div class="profile-info">
            <h1><?php echo $user_name; ?></h1>
            <p><?php echo $user_email; ?></p>
        </div>
        
        <div class="profile-actions">
            <a href="login.php" class="btn-logout">Sair</a>
        </div>
    </div>

    <!-- conteúdo do perfil dividido em duas colunas -->
    <div class="profile-content">
        <!-- secção dos cursos inscritos -->
        <div class="profile-section">
            <h2>Os Meus Cursos</h2>
            <div class="cursos-lista">
                <?php foreach($cursos_inscritos as $curso): ?>
                    <div class="curso-item">
                        <div class="curso-info">
                            <h3><?php echo $curso['nome']; ?></h3>
                            <!-- barra de progresso -->
                            <div class="progresso-bar">
                                <div class="progresso-fill" style="width: <?php echo $curso['progresso']; ?>%"></div>
                            </div>
                            <span class="progresso-texto"><?php echo $curso['progresso']; ?>% completo</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- secção das palestras favoritas -->
        <div class="profile-section">
            <h2>Palestras Favoritas</h2>
            <div class="palestras-lista">
                <?php foreach($palestras_favoritas as $palestra): ?>
                    <div class="palestra-item">
                        <!-- icon de play -->
                        <div class="palestra-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                            </svg>
                        </div>
                        <div class="palestra-info">
                            <h3><?php echo $palestra['nome']; ?></h3>
                            <span><?php echo $palestra['duracao']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php
// inclui o footer
include 'footer.php';
?>