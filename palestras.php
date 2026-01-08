<?php
$page_title = "StudyHub - Palestras";
$page_css = "palestras.css";
session_start();
include 'model.php';
include 'header.php';

// Sistema de pesquisa
$pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';

// Buscar palestras (com ou sem filtro)
if (!empty($pesquisa)) {
    $palestras = pesquisarPalestras($pesquisa);
} else {
    $palestras = getTodasPalestras();
}
?>

<!-- HERO PALESTRAS -->
<section class="hero-palestras">
    <div class="hero-content">
        <h1>Palestras Inspiradoras</h1>
        <p>Aprende com especialistas de todo o mundo</p>
        <div class="search-bar" style="margin-top: 20px;">
            <form method="GET" action="palestras.php" style="display: flex; gap: 10px; max-width: 600px; margin: 0 auto;">
                <input 
                    type="text" 
                    name="pesquisa" 
                    placeholder="Pesquisar palestras... (ex: IA, Marketing, Saúde)" 
                    value="<?php echo htmlspecialchars($pesquisa); ?>"
                    style="flex: 1; padding: 12px 20px; border: none; border-radius: 25px; font-size: 16px;"
                >
                <button type="submit" style="padding: 12px 30px; background: #D96459; color: white; border: none; border-radius: 25px; cursor: pointer; font-weight: bold;">
                    🔍 Procurar
                </button>
                <?php if (!empty($pesquisa)): ?>
                    <a href="palestras.php" style="padding: 12px 20px; background: #666; color: white; border-radius: 25px; text-decoration: none; display: inline-block;">
                        ✕ Limpar
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<!-- GRID DE PALESTRAS -->
<section class="palestras-grid-section">
    <div class="container">
        <?php if (!empty($pesquisa)): ?>
            <h2>Resultados para "<?php echo htmlspecialchars($pesquisa); ?>" (<?php echo count($palestras); ?> encontrados)</h2>
        <?php else: ?>
            <h2>Todas as Palestras</h2>
        <?php endif; ?>
        
        <?php if (empty($palestras)): ?>
            <div class="empty-state" style="text-align: center; padding: 50px 20px;">
                <p style="font-size: 18px; color: #666;">
                    <?php if (!empty($pesquisa)): ?>
                        Nenhuma palestra encontrada para "<?php echo htmlspecialchars($pesquisa); ?>". 
                        <br><br>
                        <a href="palestras.php" style="color: #D96459; text-decoration: underline;">Ver todas as palestras</a>
                    <?php else: ?>
                        Ainda não há palestras disponíveis no momento.
                    <?php endif; ?>
                </p>
            </div>
        <?php else: ?>
            <div class="palestras-grid">
                <?php foreach ($palestras as $palestra): ?>
                    <div class="palestra-card">
                        <div class="palestra-thumb">
                            <?php 
                            $imagemSrc = !empty($palestra['Imagem']) ? htmlspecialchars($palestra['Imagem']) : 'https://via.placeholder.com/400x225';
                            ?>
                            <img src="<?php echo $imagemSrc; ?>" alt="<?php echo htmlspecialchars($palestra['Titulo']); ?>">
                            <div class="play-overlay">▶</div>
                        </div>
                        <div class="palestra-content">
                            <span class="cat-badge negocios">Palestra</span>
                            <h3><?php echo htmlspecialchars($palestra['Titulo']); ?></h3>
                            
                            <?php if (!empty($palestra['Info_Extra'])): ?>
                                <p class="speaker"><?php echo htmlspecialchars(mb_substr($palestra['Info_Extra'], 0, 60)); ?>...</p>
                            <?php endif; ?>
                            
                            <?php if (!empty($palestra['Avaliacao'])): ?>
                                <div class="palestra-stats">
                                    <span>⭐ <?php echo htmlspecialchars($palestra['Avaliacao']); ?>/5</span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <form method="POST" action="inscrever.php" style="margin-top: 10px;">
                                    <input type="hidden" name="idConteudo" value="<?php echo $palestra['IDconteudo']; ?>">
                                    <a href="conteudo.php?tipo=palestra&slug=<?= $palestra['IDpalestra'] ?>" class="btn-ver-mais">
    Ver mais
</a>
                                </form>
                            <?php else: ?>
                                <a href="login.php" style="display: block; margin-top: 10px; text-align: center; padding: 8px; background: #4A90E2; color: white; text-decoration: none; border-radius: 5px;">Login</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
include 'footer.php';
?>