<?php
// define o título e CSS
$page_title = "StudyHub - Explicações";
$page_css = "explicacoes.css";

// verifica se tá logado (opcional, depende se queres que só users logados vejam)
session_start();
include 'model.php';
include 'header.php';

// Buscar todas as explicações da BD
$explicacoes = getTodasExplicacoes();
?>

<!-- HERO SECTION -->
<section class="hero-explicacoes">
    <div class="hero-content">
        <h1>Explicações Personalizadas</h1>
        <p>Aprende com os melhores professores em sessões one-on-one</p>
    </div>
</section>

<!-- FILTROS -->
<section class="filtros-section">
    <div class="container">
        <div class="filtros">
            <button class="filtro-btn active" data-categoria="todas">Todas</button>
            <button class="filtro-btn" data-categoria="matematica">Matemática</button>
            <button class="filtro-btn" data-categoria="ciencias">Ciências</button>
            <button class="filtro-btn" data-categoria="linguas">Línguas</button>
            <button class="filtro-btn" data-categoria="programacao">Programação</button>
        </div>
    </div>
</section>

<!-- GRID DE EXPLICADORES -->
<section class="explicadores-section">
    <div class="container">
        <?php if (empty($explicacoes)): ?>
            <div class="empty-state">
                <p>Ainda não há explicações disponíveis no momento.</p>
            </div>
        <?php else: ?>
            <div class="explicadores-grid">
                <?php foreach ($explicacoes as $explicacao): ?>
                    <!-- Explicação dinâmica da BD -->
                    <div class="explicador-card" data-categoria="todas">
                        <div class="explicador-photo">
                            <img src="https://via.placeholder.com/150" alt="Professor">
                            <span class="badge-disponivel">Disponível</span>
                        </div>
                        <div class="explicador-info">
                            <h3><?php echo htmlspecialchars($explicacao['Titulo']); ?></h3>
                            <p class="especialidade"><?php echo htmlspecialchars($explicacao['Info_Extra'] ?? 'Explicação Especializada'); ?></p>
                            <div class="rating">
                                <span>⭐⭐⭐⭐⭐</span>
                                <span class="reviews">(48 avaliações)</span>
                            </div>
                            <p class="descricao">Professor certificado com experiência comprovada</p>
                            <div class="preco-horario">
                                <span class="preco">€25/hora</span>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <form method="POST" action="inscrever.php" style="margin: 0;">
                                        <input type="hidden" name="idConteudo" value="<?php echo $explicacao['IDconteudo']; ?>">
                                        <button type="submit" class="btn-agendar">Agendar</button>
                                    </form>
                                <?php else: ?>
                                    <a href="login.php" class="btn-agendar" style="display: inline-block; text-decoration: none; padding: 8px 16px;">Login</a>
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

<script>
// filtro de categorias
document.querySelectorAll('.filtro-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // remove active de todos
        document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('active'));
        // adiciona active no clicado
        this.classList.add('active');
        
        const categoria = this.dataset.categoria;
        
        // mostra/esconde cards
        document.querySelectorAll('.explicador-card').forEach(card => {
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