<?php
$page_title = "StudyHub - Ebooks";
$page_css = "ebooks.css";
session_start();
include 'model.php';
include 'header.php';

// Sistema de pesquisa
$pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';

// Buscar ebooks (com ou sem filtro)
if (!empty($pesquisa)) {
    $ebooks = pesquisarEbooks($pesquisa);
} else {
    $ebooks = getTodosEbooks();
}
?>

<!-- HERO EBOOKS -->
<section class="hero-ebooks">
    <div class="hero-content">
        <h1>Biblioteca Digital</h1>
        <p>Milhares de ebooks para expandir o teu conhecimento</p>
        <div class="search-bar" style="margin-top: 20px;">
            <form method="GET" action="ebooks.php" style="display: flex; gap: 10px; max-width: 600px; margin: 0 auto;">
                <input 
                    type="text" 
                    name="pesquisa" 
                    placeholder="Pesquisar ebooks... (ex: PHP, JavaScript, Design)" 
                    value="<?php echo htmlspecialchars($pesquisa); ?>"
                    style="flex: 1; padding: 12px 20px; border: none; border-radius: 25px; font-size: 16px;"
                >
                <button type="submit" style="padding: 12px 30px; background: #5FA777; color: white; border: none; border-radius: 25px; cursor: pointer; font-weight: bold;">
                    🔍 Procurar
                </button>
                <?php if (!empty($pesquisa)): ?>
                    <a href="ebooks.php" style="padding: 12px 20px; background: #666; color: white; border-radius: 25px; text-decoration: none; display: inline-block;">
                        ✕ Limpar
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<!-- GRID DE EBOOKS -->
<section class="ebooks-section">
    <div class="container">
        <?php if (!empty($pesquisa)): ?>
            <h2>Resultados para "<?php echo htmlspecialchars($pesquisa); ?>" (<?php echo count($ebooks); ?> encontrados)</h2>
        <?php else: ?>
            <h2>Todos os Ebooks</h2>
        <?php endif; ?>
        
        <?php if (empty($ebooks)): ?>
            <div class="empty-state" style="text-align: center; padding: 50px 20px;">
                <p style="font-size: 18px; color: #666;">
                    <?php if (!empty($pesquisa)): ?>
                        Nenhum ebook encontrado para "<?php echo htmlspecialchars($pesquisa); ?>". 
                        <br><br>
                        <a href="ebooks.php" style="color: #5FA777; text-decoration: underline;">Ver todos os ebooks</a>
                    <?php else: ?>
                        Ainda não há ebooks disponíveis no momento.
                    <?php endif; ?>
                </p>
            </div>
        <?php else: ?>
            <div class="ebooks-grid">
                <?php foreach ($ebooks as $ebook): ?>
                    <div class="ebook-card">
                        <div class="ebook-cover">
                            <?php 
                            $imagemSrc = !empty($ebook['Imagem']) ? htmlspecialchars($ebook['Imagem']) : 'https://via.placeholder.com/300x400';
                            ?>
                            <img src="<?php echo $imagemSrc; ?>" alt="<?php echo htmlspecialchars($ebook['Titulo']); ?>">
                            <div class="ebook-overlay">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <form method="POST" action="inscrever.php">
                                        <input type="hidden" name="idConteudo" value="<?php echo $ebook['IDconteudo']; ?>">
                                        <a href="conteudo.php?tipo=ebook&slug=<?= $ebook['IDebook'] ?>" class="btn-ver-mais">
    Ver mais
</a>
                                    </form>
                                <?php else: ?>
                                    <a href="login.php" class="btn-download">🔒 Login para Download</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="ebook-info">
                            <span class="ebook-badge">Ebook</span>
                            <h3><?php echo htmlspecialchars($ebook['Titulo']); ?></h3>
                            
                            <?php if (!empty($ebook['Info_Extra'])): ?>
                                <p class="descricao"><?php echo htmlspecialchars(mb_substr($ebook['Info_Extra'], 0, 80)); ?>...</p>
                            <?php endif; ?>
                            
                            <?php if (!empty($ebook['Avaliacao'])): ?>
                                <div class="ebook-stats">
                                    <span>⭐ <?php echo htmlspecialchars($ebook['Avaliacao']); ?>/5</span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($ebook['Preco']) && $ebook['Preco'] > 0): ?>
                                <p class="preco-ebook" style="font-size: 1.2em; color: #E89A3C; font-weight: bold; margin-top: 10px;">
                                    €<?php echo number_format($ebook['Preco'], 2, ',', '.'); ?>
                                </p>
                            <?php else: ?>
                                <p class="preco-ebook" style="font-size: 1.2em; color: #5FA777; font-weight: bold; margin-top: 10px;">
                                    Gratuito
                                </p>
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