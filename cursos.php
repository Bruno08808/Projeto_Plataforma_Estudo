<?php
$page_title = "StudyHub - Cursos";
$page_css = "cursos.css";
session_start();
include 'model.php';
include 'header.php';

// Sistema de pesquisa
$pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';

// Buscar cursos (com ou sem filtro)
if (!empty($pesquisa)) {
    $cursos = pesquisarCursos($pesquisa);
} else {
    $cursos = getTodosCursos();
}
?>

<!-- HERO CURSOS -->
<section class="hero-cursos">
    <div class="hero-content">
        <h1>Cursos Online</h1>
        <p>Aprende novas skills com cursos completos e certificados</p>
        <div class="search-bar">
            <form method="GET" action="cursos.php" style="display: flex; gap: 10px; max-width: 600px; margin: 0 auto;">
                <input 
                    type="text" 
                    name="pesquisa" 
                    placeholder="Pesquisar cursos... (ex: Python, Web, Design)" 
                    value="<?php echo htmlspecialchars($pesquisa); ?>"
                    style="flex: 1; padding: 12px 20px; border: none; border-radius: 25px; font-size: 16px;"
                >
                <button type="submit" style="padding: 12px 30px; background: #E89A3C; color: white; border: none; border-radius: 25px; cursor: pointer; font-weight: bold;">
                    🔍 Procurar
                </button>
                <?php if (!empty($pesquisa)): ?>
                    <a href="cursos.php" style="padding: 12px 20px; background: #666; color: white; border-radius: 25px; text-decoration: none; display: inline-block;">
                        ✕ Limpar
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<!-- CURSOS EM DESTAQUE -->
<section class="cursos-destaque">
    <div class="container">
        <?php if (!empty($pesquisa)): ?>
            <h2>Resultados para "<?php echo htmlspecialchars($pesquisa); ?>" (<?php echo count($cursos); ?> encontrados)</h2>
        <?php else: ?>
            <h2>Cursos em Destaque</h2>
        <?php endif; ?>
        
        <?php if (empty($cursos)): ?>
            <div class="empty-state" style="text-align: center; padding: 50px 20px;">
                <p style="font-size: 18px; color: #666;">
                    <?php if (!empty($pesquisa)): ?>
                        Nenhum curso encontrado para "<?php echo htmlspecialchars($pesquisa); ?>". 
                        <br><br>
                        <a href="cursos.php" style="color: #E89A3C; text-decoration: underline;">Ver todos os cursos</a>
                    <?php else: ?>
                        Ainda não há cursos disponíveis no momento.
                    <?php endif; ?>
                </p>
            </div>
        <?php else: ?>
            <div class="cursos-grid">
                <?php foreach ($cursos as $curso): ?>
                    <div class="curso-card">
                        <div class="curso-thumbnail">
                            <?php 
                            $imagemSrc = !empty($curso['Imagem']) ? htmlspecialchars($curso['Imagem']) : 'https://via.placeholder.com/400x250';
                            ?>
                            <img src="<?php echo $imagemSrc; ?>" alt="<?php echo htmlspecialchars($curso['Titulo']); ?>">
                            
                            <?php if ($curso['Disponibilidade'] == 1): ?>
                                <span class="badge-novo">Disponível</span>
                            <?php endif; ?>
                        </div>
                        <div class="curso-content">
                            <div class="curso-categoria">Curso</div>
                            <h3><?php echo htmlspecialchars($curso['Titulo']); ?></h3>
                            
                            <?php if (!empty($curso['Info_Extra'])): ?>
                                <p><?php echo htmlspecialchars(mb_substr($curso['Info_Extra'], 0, 100)); ?>...</p>
                            <?php endif; ?>
                            
                            <?php if (!empty($curso['Avaliacao'])): ?>
                                <div class="curso-stats">
                                    <span>⭐ <?php echo htmlspecialchars($curso['Avaliacao']); ?>/5</span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="curso-footer">
                                <?php if (!empty($curso['Preco']) && $curso['Preco'] > 0): ?>
                                    <div class="preco">€<?php echo number_format($curso['Preco'], 2, ',', '.'); ?></div>
                                <?php else: ?>
                                    <div class="preco" style="color: #5FA777; font-weight: bold;">Gratuito</div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <form method="POST" action="inscrever.php" style="margin: 0;">
                                    <input type="hidden" name="idConteudo" value="<?php echo $curso['IDconteudo']; ?>">
                                    <a href="conteudo.php?tipo=curso&slug=<?= $curso['IDcurso'] ?>" class="btn-ver-mais"> Ver mais</a>
                                </form>
                            <?php else: ?>
                                <a href="login.php" class="btn-inscrever" style="display: block; text-align: center; text-decoration: none;">Fazer Login para Inscrever</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- BENEFÍCIOS -->
<section class="beneficios">
    <div class="container">
        <h2>Porquê Escolher os Nossos Cursos?</h2>
        <div class="beneficios-grid">
            <div class="beneficio">
                <div class="beneficio-icon">📜</div>
                <h3>Certificado</h3>
                <p>Recebe um certificado reconhecido ao completar</p>
            </div>
            <div class="beneficio">
                <div class="beneficio-icon">♾️</div>
                <h3>Acesso Vitalício</h3>
                <p>Acesso ilimitado ao conteúdo para sempre</p>
            </div>
            <div class="beneficio">
                <div class="beneficio-icon">💬</div>
                <h3>Suporte</h3>
                <p>Tira dúvidas diretamente com o instrutor</p>
            </div>
            <div class="beneficio">
                <div class="beneficio-icon">📱</div>
                <h3>Mobile</h3>
                <p>Aprende onde e quando quiseres</p>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>