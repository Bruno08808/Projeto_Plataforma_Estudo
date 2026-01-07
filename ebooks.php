<?php
$page_title = "StudyHub - Ebooks";
$page_css = "ebooks.css";
session_start();
include 'model.php';
include 'header.php';

// Buscar todos os ebooks da BD
$ebooks = getTodosEbooks();
?>

<!-- HERO EBOOKS -->
<section class="hero-ebooks">
    <div class="hero-content">
        <h1>Biblioteca Digital</h1>
        <p>Milhares de ebooks para expandir o teu conhecimento</p>
    </div>
</section>

<!-- FILTROS -->
<section class="filtros-ebooks">
    <div class="container">
        <div class="filtros-wrapper">
            <select class="filtro-select">
                <option>Todas as Categorias</option>
                <option>Tecnologia</option>
                <option>Negócios</option>
                <option>Desenvolvimento Pessoal</option>
                <option>Marketing</option>
                <option>Design</option>
            </select>
            <select class="filtro-select">
                <option>Ordenar por</option>
                <option>Mais Recentes</option>
                <option>Mais Populares</option>
                <option>Melhor Avaliados</option>
            </select>
        </div>
    </div>
</section>

<!-- GRID DE EBOOKS -->
<section class="ebooks-section">
    <div class="container">
        <?php if (empty($ebooks)): ?>
            <div class="empty-state">
                <p>Ainda não há ebooks disponíveis no momento.</p>
            </div>
        <?php else: ?>
            <div class="ebooks-grid">
                <?php foreach ($ebooks as $ebook): ?>
                    <!-- Ebook dinâmico da BD -->
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
                                        <button type="submit" class="btn-download">📥 Download</button>
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
                                <p class="descricao"><?php echo htmlspecialchars($ebook['Info_Extra']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($ebook['Avaliacao'])): ?>
                                <div class="ebook-stats">
                                    <span>⭐ <?php echo htmlspecialchars($ebook['Avaliacao']); ?></span>
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

<!-- CTA SECTION -->
<section class="cta-ebooks">
    <div class="container">
        <h2>Acesso Ilimitado a Toda a Biblioteca</h2>
        <p>Subscreve agora e tem acesso a todos os ebooks disponíveis</p>
        <button class="btn-subscrever">Subscrever por €9.99/mês</button>
    </div>
</section>

<?php
include 'footer.php';
?>