<?php
// define o título e CSS
$page_title = "StudyHub - Explicações";
$page_css = "explicacoes.css";

// verifica se tá logado (opcional, depende se queres que só users logados vejam)
session_start();

// inclui o header
include 'header.php';
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
        <div class="explicadores-grid">
            
            <!-- Explicador 1 -->
            <div class="explicador-card" data-categoria="matematica">
                <div class="explicador-photo">
                    <img src="https://via.placeholder.com/150" alt="Professor">
                    <span class="badge-disponivel">Disponível</span>
                </div>
                <div class="explicador-info">
                    <h3>Prof. Maria Santos</h3>
                    <p class="especialidade">Matemática & Física</p>
                    <div class="rating">
                        <span>⭐⭐⭐⭐⭐</span>
                        <span class="reviews">(48 avaliações)</span>
                    </div>
                    <p class="descricao">Licenciada em Matemática com 10 anos de experiência em ensino</p>
                    <div class="preco-horario">
                        <span class="preco">€25/hora</span>
                        <button class="btn-agendar">Agendar</button>
                    </div>
                </div>
            </div>

            <!-- Explicador 2 -->
            <div class="explicador-card" data-categoria="linguas">
                <div class="explicador-photo">
                    <img src="https://via.placeholder.com/150" alt="Professor">
                    <span class="badge-ocupado">Ocupado</span>
                </div>
                <div class="explicador-info">
                    <h3>Prof. João Costa</h3>
                    <p class="especialidade">Inglês & Espanhol</p>
                    <div class="rating">
                        <span>⭐⭐⭐⭐⭐</span>
                        <span class="reviews">(92 avaliações)</span>
                    </div>
                    <p class="descricao">Nativo bilingue com certificação Cambridge</p>
                    <div class="preco-horario">
                        <span class="preco">€30/hora</span>
                        <button class="btn-agendar" disabled>Indisponível</button>
                    </div>
                </div>
            </div>

            <!-- Explicador 3 -->
            <div class="explicador-card" data-categoria="programacao">
                <div class="explicador-photo">
                    <img src="https://via.placeholder.com/150" alt="Professor">
                    <span class="badge-disponivel">Disponível</span>
                </div>
                <div class="explicador-info">
                    <h3>Prof. Ana Silva</h3>
                    <p class="especialidade">Python & Web Development</p>
                    <div class="rating">
                        <span>⭐⭐⭐⭐⭐</span>
                        <span class="reviews">(67 avaliações)</span>
                    </div>
                    <p class="descricao">Engenheira de Software com paixão por ensinar</p>
                    <div class="preco-horario">
                        <span class="preco">€35/hora</span>
                        <button class="btn-agendar">Agendar</button>
                    </div>
                </div>
            </div>

            <!-- Explicador 4 -->
            <div class="explicador-card" data-categoria="ciencias">
                <div class="explicador-photo">
                    <img src="https://via.placeholder.com/150" alt="Professor">
                    <span class="badge-disponivel">Disponível</span>
                </div>
                <div class="explicador-info">
                    <h3>Prof. Pedro Oliveira</h3>
                    <p class="especialidade">Química & Biologia</p>
                    <div class="rating">
                        <span>⭐⭐⭐⭐⭐</span>
                        <span class="reviews">(35 avaliações)</span>
                    </div>
                    <p class="descricao">Doutorado em Química Orgânica</p>
                    <div class="preco-horario">
                        <span class="preco">€28/hora</span>
                        <button class="btn-agendar">Agendar</button>
                    </div>
                </div>
            </div>

            <!-- Explicador 5 -->
            <div class="explicador-card" data-categoria="matematica">
                <div class="explicador-photo">
                    <img src="https://via.placeholder.com/150" alt="Professor">
                    <span class="badge-disponivel">Disponível</span>
                </div>
                <div class="explicador-info">
                    <h3>Prof. Rita Ferreira</h3>
                    <p class="especialidade">Matemática Avançada</p>
                    <div class="rating">
                        <span>⭐⭐⭐⭐⭐</span>
                        <span class="reviews">(54 avaliações)</span>
                    </div>
                    <p class="descricao">Especialista em preparação para exames nacionais</p>
                    <div class="preco-horario">
                        <span class="preco">€27/hora</span>
                        <button class="btn-agendar">Agendar</button>
                    </div>
                </div>
            </div>

            <!-- Explicador 6 -->
            <div class="explicador-card" data-categoria="linguas">
                <div class="explicador-photo">
                    <img src="https://via.placeholder.com/150" alt="Professor">
                    <span class="badge-disponivel">Disponível</span>
                </div>
                <div class="explicador-info">
                    <h3>Prof. Carlos Mendes</h3>
                    <p class="especialidade">Francês & Português</p>
                    <div class="rating">
                        <span>⭐⭐⭐⭐⭐</span>
                        <span class="reviews">(41 avaliações)</span>
                    </div>
                    <p class="descricao">Professor certificado com experiência internacional</p>
                    <div class="preco-horario">
                        <span class="preco">€26/hora</span>
                        <button class="btn-agendar">Agendar</button>
                    </div>
                </div>
            </div>

        </div>
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