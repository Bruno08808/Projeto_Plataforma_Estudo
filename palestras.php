<?php
$page_title = "StudyHub - Palestras";
$page_css = "palestras.css";
session_start();
include 'model.php';
include 'header.php';

// Buscar todas as palestras da BD
$palestras = getTodasPalestras();
?>

<!-- HERO PALESTRAS -->
<section class="hero-palestras">
    <div class="hero-content">
        <h1>Palestras Inspiradoras</h1>
        <p>Aprende com especialistas de todo o mundo</p>
    </div>
</section>

<!-- TABS CATEGORIAS -->
<section class="tabs-section">
    <div class="container">
        <div class="tabs-wrapper">
            <button class="tab-item active" data-tab="todas">Todas</button>
            <button class="tab-item" data-tab="tecnologia">Tecnologia</button>
            <button class="tab-item" data-tab="negocios">Negócios</button>
            <button class="tab-item" data-tab="motivacao">Motivação</button>
            <button class="tab-item" data-tab="saude">Saúde</button>
        </div>
    </div>
</section>

<!-- PALESTRAS EM DESTAQUE -->
<?php if (!empty($palestras)): 
    $palestraDestaque = $palestras[0]; // Primeira palestra em destaque
?>
<section class="palestras-destaque">
    <div class="container">
        <h2>🔥 Em Destaque</h2>
        <div class="palestra-featured">
            <div class="featured-video">
                <img src="https://via.placeholder.com/800x450" alt="Palestra">
                <div class="play-button">▶</div>
                <span class="duracao-badge">1h 15min</span>
            </div>
            <div class="featured-info">
                <span class="categoria-badge">Palestra</span>
                <h3><?php echo htmlspecialchars($palestraDestaque['Titulo']); ?></h3>
                
                <?php if (!empty($palestraDestaque['Info_Extra'])): ?>
                    <p class="descricao"><?php echo htmlspecialchars($palestraDestaque['Info_Extra']); ?></p>
                <?php endif; ?>
                
                <?php if (!empty($palestraDestaque['Avaliacao'])): ?>
                    <div class="stats-row">
                        <span>⭐ <?php echo htmlspecialchars($palestraDestaque['Avaliacao']); ?></span>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST" action="inscrever.php" style="margin: 0;">
                        <input type="hidden" name="idConteudo" value="<?php echo $palestraDestaque['IDconteudo']; ?>">
                        <button type="submit" class="btn-assistir">▶ Assistir Agora</button>
                    </form>
                <?php else: ?>
                    <a href="login.php" class="btn-assistir" style="text-decoration: none;">▶ Fazer Login para Assistir</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- GRID DE PALESTRAS -->
<section class="palestras-grid-section">
    <div class="container">
        <h2>Todas as Palestras</h2>
        
        <?php if (empty($palestras)): ?>
            <div class="empty-state">
                <p>Ainda não há palestras disponíveis no momento.</p>
            </div>
        <?php else: ?>
            <div class="palestras-grid">
                <?php foreach ($palestras as $palestra): ?>
                    <!-- Palestra dinâmica da BD -->
                    <div class="palestra-card" data-categoria="todas">
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
                                <p class="speaker"><?php echo htmlspecialchars($palestra['Info_Extra']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($palestra['Avaliacao'])): ?>
                                <div class="palestra-stats">
                                    <span>⭐ <?php echo htmlspecialchars($palestra['Avaliacao']); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <form method="POST" action="inscrever.php" style="margin-top: 10px;">
                                    <input type="hidden" name="idConteudo" value="<?php echo $palestra['IDconteudo']; ?>">
                                    <button type="submit" class="btn-assistir" style="width: 100%; padding: 8px;">Assistir</button>
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

<script>
// sistema de tabs
document.querySelectorAll('.tab-item').forEach(tab => {
    tab.addEventListener('click', function() {
        // remove active de todas
        document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
        // adiciona active na clicada
        this.classList.add('active');
        
        const categoria = this.dataset.tab;
        
        // filtra palestras
        document.querySelectorAll('.palestra-card').forEach(card => {
            if(categoria === 'todas' || card.dataset.categoria === categoria) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>

<?php
include 'footer.php';
?>