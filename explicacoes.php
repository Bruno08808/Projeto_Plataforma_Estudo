<?php
$page_title = "StudyHub - Explicações";
$page_css = "explicacoes.css";
session_start();
include 'model.php';
include 'header.php';

// Sistema de pesquisa
$pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';

// Buscar explicações (com ou sem filtro)
if (!empty($pesquisa)) {
    $explicacoes = pesquisarExplicacoes($pesquisa);
    
    // Rastrear pesquisa no Analytics
    echo "<script>
        if (typeof StudyHubTracking !== 'undefined') {
            StudyHubTracking.trackPesquisa('" . addslashes($pesquisa) . "', 'Explicacoes', " . count($explicacoes) . ");
        }
    </script>";
} else {
    $explicacoes = getTodasExplicacoes();
}
?>

<!-- HERO SECTION -->
<section class="hero-explicacoes">
    <div class="hero-content">
        <h1>Explicações Personalizadas</h1>
        <p>Aprende com os melhores professores em sessões one-on-one</p>
        <div class="search-bar" style="margin-top: 20px;">
            <form method="GET" action="explicacoes.php" style="display: flex; gap: 10px; max-width: 600px; margin: 0 auto;">
                <input 
                    type="text" 
                    name="pesquisa" 
                    placeholder="Pesquisar explicações... (ex: Matemática, Física, Inglês)" 
                    value="<?php echo htmlspecialchars($pesquisa); ?>"
                    style="flex: 1; padding: 12px 20px; border: none; border-radius: 25px; font-size: 16px;"
                >
                <button type="submit" style="padding: 12px 30px; background: #4A90E2; color: white; border: none; border-radius: 25px; cursor: pointer; font-weight: bold;">
                    🔍 Procurar
                </button>
                <?php if (!empty($pesquisa)): ?>
                    <a href="explicacoes.php" style="padding: 12px 20px; background: #666; color: white; border-radius: 25px; text-decoration: none; display: inline-block;">
                        ✕ Limpar
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<!-- GRID DE EXPLICADORES -->
<section class="explicadores-section">
    <div class="container">
        <?php if (!empty($pesquisa)): ?>
            <h2>Resultados para "<?php echo htmlspecialchars($pesquisa); ?>" (<?php echo count($explicacoes); ?> encontrados)</h2>
        <?php else: ?>
            <h2>Todas as Explicações</h2>
        <?php endif; ?>
        
        <?php if (empty($explicacoes)): ?>
            <div class="empty-state" style="text-align: center; padding: 50px 20px;">
                <p style="font-size: 18px; color: #666;">
                    <?php if (!empty($pesquisa)): ?>
                        Nenhuma explicação encontrada para "<?php echo htmlspecialchars($pesquisa); ?>". 
                        <br><br>
                        <a href="explicacoes.php" style="color: #4A90E2; text-decoration: underline;">Ver todas as explicações</a>
                    <?php else: ?>
                        Ainda não há explicações disponíveis no momento.
                    <?php endif; ?>
                </p>
            </div>
        <?php else: ?>
            <div class="explicadores-grid">
                <?php foreach ($explicacoes as $explicacao): ?>
                    <div class="explicador-card">
                        <div class="explicador-photo">
                            <?php 
                            // Se não tiver imagem, usa um avatar aleatório mas consistente
                            $imagemSrc = !empty($explicacao['Imagem']) 
                                ? htmlspecialchars($explicacao['Imagem']) 
                                : 'https://i.pravatar.cc/150?img=' . (($explicacao['IDconteudo'] ?? 1) % 70 + 1);
                            ?>
                            <img src="<?php echo $imagemSrc; ?>" alt="Professor">
                            <?php if ($explicacao['Disponibilidade'] == 1): ?>
                                <span class="badge-disponivel">Disponível</span>
                            <?php else: ?>
                                <span class="badge-ocupado">Ocupado</span>
                            <?php endif; ?>
                        </div>
                        <div class="explicador-info">
                            <h3><?php echo htmlspecialchars($explicacao['Titulo']); ?></h3>
                            
                            <?php if (!empty($explicacao['Info_Extra'])): ?>
                                <p class="especialidade"><?php echo htmlspecialchars($explicacao['Info_Extra']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($explicacao['Avaliacao'])): ?>
                                <div class="rating">
                                    <span>⭐ <?php echo htmlspecialchars($explicacao['Avaliacao']); ?>/5</span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="preco-horario">
                                <?php if (!empty($explicacao['Preco']) && $explicacao['Preco'] > 0): ?>
                                    <span class="preco">€<?php echo number_format($explicacao['Preco'], 2, ',', '.'); ?>/hora</span>
                                <?php else: ?>
                                    <span class="preco" style="color: #5FA777;">Gratuito</span>
                                <?php endif; ?>
                                
                                <?php if ($explicacao['Disponibilidade'] == 1): ?>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <form method="POST" action="inscrever.php" style="margin: 0;">
                                            <input type="hidden" name="idConteudo" value="<?php echo $explicacao['IDconteudo']; ?>">
                                            <a href="conteudo.php?slug=<?= $explicacao['Slug'] ?>" 
                                               class="btn-ver-mais"
                                               onclick="StudyHubTracking.trackVerMais('Explicacao', '<?php echo addslashes($explicacao['Titulo']); ?>', '<?php echo $explicacao['IDconteudo']; ?>');">Ver mais</a>
                                        </form>
                                    <?php else: ?>
                                        <a href="login.php" class="btn-agendar" style="display: inline-block; text-decoration: none; padding: 8px 16px;">Login</a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <button class="btn-agendar" disabled>Indisponível</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- COMO FUNCIONA -->
<section class="como-funciona">
    <div class="container">
        <h2>Como Funciona?</h2>
        <div class="passos-grid">
            <div class="passo">
                <div class="passo-numero">1</div>
                <h3>Escolhe o Professor</h3>
                <p>Navega pelos perfis e escolhe o professor ideal para ti</p>
            </div>
            <div class="passo">
                <div class="passo-numero">2</div>
                <h3>Agenda a Sessão</h3>
                <p>Escolhe o dia e hora que melhor se adequa ao teu horário</p>
            </div>
            <div class="passo">
                <div class="passo-numero">3</div>
                <h3>Aprende Online</h3>
                <p>Participa na videochamada e tira todas as tuas dúvidas</p>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>