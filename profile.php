<?php
session_start();
include 'model.php';

/* ================= SEGURANÇA ================= */

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* ================= DADOS DO UTILIZADOR ================= */

$dados = getDadosUtilizador($_SESSION['user_id']);

$user_name  = $dados['Nome'];
$user_email = $dados['Email'];

/* Idade: a BD guarda o ANO (YEAR), calculamos a idade real */
$idade = null;
if (!empty($dados['Idade'])) {
    $idade = date('Y') - (int)$dados['Idade'];
}

$id_logado = $_SESSION['user_id'];

/* ================= CONTEÚDO DO UTILIZADOR ================= */

$cursos_inscritos     = getConteudoUtilizador($id_logado, 'curso');
$palestras_favoritas  = getConteudoUtilizador($id_logado, 'palestra');
$ebooks               = getConteudoUtilizador($id_logado, 'ebook');
$explicacoes          = getConteudoUtilizador($id_logado, 'explicacao');

/* ================= HEADER ================= */

$page_title = "StudyHub - Perfil";
$page_css   = "profile.css";
include 'header.php';
?>

<div class="profile-container">

    <!-- ================= HEADER PERFIL ================= -->
    <div class="profile-header">

        <div class="profile-avatar">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        </div>

        <div class="profile-info">
            <h1><?php echo htmlspecialchars($user_name); ?></h1>
            <p><?php echo htmlspecialchars($user_email); ?></p>

            <?php if ($idade !== null): ?>
                <p class="user-idade"><?php echo $idade; ?> anos</p>
            <?php endif; ?>
        </div>

        <div class="profile-actions">
            <a href="logout.php" class="btn-logout">Sair</a>
        </div>

    </div>

    <!-- ================= CONTEÚDO ================= -->
    <div class="profile-content">

        <!-- ================= CURSOS ================= -->
        <div class="profile-section">
            <h2>Os Meus Cursos</h2>

            <?php if (empty($cursos_inscritos)): ?>
                <div class="empty-state">
                    <p>Ainda não estás inscrito em nenhum curso</p>
                    <a href="cursos.php" class="btn-explore">Explorar Cursos</a>
                </div>
            <?php else: ?>
                <?php foreach ($cursos_inscritos as $curso): ?>
                    <div class="curso-item">
                        <h3><?php echo htmlspecialchars($curso['nome']); ?></h3>

                        <?php if ($curso['progresso'] !== null): ?>
                            <div class="progresso-bar">
                                <div class="progresso-fill"
                                     style="width: <?php echo (int)$curso['progresso']; ?>%">
                                </div>
                            </div>
                            <span><?php echo (int)$curso['progresso']; ?>% completo</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- ================= PALESTRAS ================= -->
        <div class="profile-section">
            <h2>Palestras Favoritas</h2>

            <?php if (empty($palestras_favoritas)): ?>
                <div class="empty-state">
                    <p>Ainda não tens palestras favoritas</p>
                    <a href="palestras.php" class="btn-explore">Ver Palestras</a>
                </div>
            <?php else: ?>
                <?php foreach ($palestras_favoritas as $palestra): ?>
                    <div class="palestra-item">
                        <h3><?php echo htmlspecialchars($palestra['nome']); ?></h3>
                        <?php if (!empty($palestra['info_extra'])): ?>
                            <span><?php echo htmlspecialchars($palestra['info_extra']); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- ================= EBOOKS ================= -->
        <div class="profile-section">
            <h2>Os Meus Ebooks</h2>

            <?php if (empty($ebooks)): ?>
                <div class="empty-state">
                    <p>Ainda não tens ebooks guardados</p>
                    <a href="ebooks.php" class="btn-explore">Explorar Ebooks</a>
                </div>
            <?php else: ?>
                <?php foreach ($ebooks as $ebook): ?>
                    <div class="ebook-item">
                        <h3><?php echo htmlspecialchars($ebook['nome']); ?></h3>
                        <?php if (!empty($ebook['info_extra'])): ?>
                            <span><?php echo htmlspecialchars($ebook['info_extra']); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- ================= EXPLICAÇÕES ================= -->
        <div class="profile-section">
            <h2>Minhas Explicações</h2>

            <?php if (empty($explicacoes)): ?>
                <div class="empty-state">
                    <p>Não tens explicações agendadas</p>
                    <a href="explicacoes.php" class="btn-explore">Agendar Explicações</a>
                </div>
            <?php else: ?>
                <?php foreach ($explicacoes as $explicacao): ?>
                    <div class="explicacao-item">
                        <h3><?php echo htmlspecialchars($explicacao['nome']); ?></h3>
                        <?php if (!empty($explicacao['info_extra'])): ?>
                            <span><?php echo htmlspecialchars($explicacao['info_extra']); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>
