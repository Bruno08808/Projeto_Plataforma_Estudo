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
$user_idade = $dados['Idade'] ?? null; // se não tiver idade, fica null

$id_logado = $_SESSION['user_id'];

// BUSCA DADOS REAIS DA BASE DE DADOS
$cursos_inscritos = getConteudoUtilizador($id_logado, 'curso');
$palestras_favoritas = getConteudoUtilizador($id_logado, 'palestra');
$reunioes = getConteudoUtilizador($id_logado, 'reuniao');
$ebooks = getConteudoUtilizador($id_logado, 'ebook');

// inclui o header
$page_title = "StudyHub - Perfil";
$page_css = "profile.css";
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
            <h1><?php echo htmlspecialchars($user_name); ?></h1>
            <p><?php echo htmlspecialchars($user_email); ?></p>
            <?php if($user_idade): ?>
                <p class="user-idade"><?php echo $user_idade; ?> anos</p>
            <?php endif; ?>
        </div>
        
        <div class="profile-actions">
            <a href="logout.php" class="btn-logout">Sair</a>
        </div>
    </div>

    <!-- conteúdo do perfil dividido em várias secções -->
    <div class="profile-content">
        
        <!-- ==================== SECÇÃO DOS CURSOS ==================== -->
        <div class="profile-section">
            <h2>Os Meus Cursos</h2>
            <div class="cursos-lista">
                <?php if(empty($cursos_inscritos)): ?>
                    <!-- mensagem quando não há cursos -->
                    <div class="empty-state">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                        <p>Ainda não estás inscrito em nenhum curso</p>
                        <a href="cursos.php" class="btn-explore">Explorar Cursos</a>
                    </div>
                <?php else: ?>
                    <!-- mostra os cursos quando existem -->
                    <?php foreach($cursos_inscritos as $curso): ?>
                        <div class="curso-item">
                            <div class="curso-info">
                                <h3><?php echo htmlspecialchars($curso['nome']); ?></h3>
                                <!-- barra de progresso -->
                                <div class="progresso-bar">
                                    <div class="progresso-fill" style="width: <?php echo $curso['progresso']; ?>%"></div>
                                </div>
                                <span class="progresso-texto"><?php echo $curso['progresso']; ?>% completo</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- ==================== SECÇÃO DAS PALESTRAS ==================== -->
        <div class="profile-section">
            <h2>Palestras Favoritas</h2>
            <div class="palestras-lista">
                <?php if(empty($palestras_favoritas)): ?>
                    <!-- mensagem quando não há palestras -->
                    <div class="empty-state">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                        <p>Ainda não tens palestras favoritas</p>
                        <a href="palestras.php" class="btn-explore">Ver Palestras</a>
                    </div>
                <?php else: ?>
                    <!-- mostra as palestras quando existem -->
                    <?php foreach($palestras_favoritas as $palestra): ?>
                        <div class="palestra-item">
                            <!-- icon de play -->
                            <div class="palestra-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </div>
                            <div class="palestra-info">
                                <h3><?php echo htmlspecialchars($palestra['nome']); ?></h3>
                                <span><?php echo htmlspecialchars($palestra['duracao']); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- ==================== SECÇÃO DOS EBOOKS ==================== -->
        <div class="profile-section">
            <h2>Os Meus Ebooks</h2>
            <div class="ebooks-lista">
                <?php if(empty($ebooks)): ?>
                    <!-- mensagem quando não há ebooks -->
                    <div class="empty-state">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                        <p>Ainda não tens ebooks guardados</p>
                        <a href="ebooks.php" class="btn-explore">Explorar Ebooks</a>
                    </div>
                <?php else: ?>
                    <!-- mostra os ebooks quando existem -->
                    <?php foreach($ebooks as $ebook): ?>
                        <div class="ebook-item">
                            <div class="ebook-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                            </div>
                            <div class="ebook-info">
                                <h3><?php echo htmlspecialchars($ebook['nome']); ?></h3>
                                <?php if(isset($ebook['autor'])): ?>
                                    <span><?php echo htmlspecialchars($ebook['autor']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- ==================== SECÇÃO DAS REUNIÕES ==================== -->
        <div class="profile-section">
            <h2>Minhas Reuniões</h2>
            <div class="reunioes-lista">
                <?php if(empty($reunioes)): ?>
                    <!-- mensagem quando não há reuniões -->
                    <div class="empty-state">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <p>Não tens reuniões agendadas</p>
                        <a href="explicacoes.php" class="btn-explore">Agendar Reunião</a>
                    </div>
                <?php else: ?>
                    <!-- mostra as reuniões quando existem -->
                    <?php foreach($reunioes as $reuniao): ?>
                        <div class="reuniao-item">
                            <div class="reuniao-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <div class="reuniao-info">
                                <h3><?php echo htmlspecialchars($reuniao['nome']); ?></h3>
                                <?php if(isset($reuniao['data'])): ?>
                                    <span><?php echo htmlspecialchars($reuniao['data']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php
// inclui o footer
include 'footer.php';
?>