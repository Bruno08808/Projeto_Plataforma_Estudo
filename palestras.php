<?php
$page_title = "StudyHub - Palestras";
$page_css = "palestras.css";
session_start();
include 'header.php';
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
            <button class="tab-item" data-tab="negocios">NegÃ³cios</button>
            <button class="tab-item" data-tab="motivacao">MotivaÃ§Ã£o</button>
            <button class="tab-item" data-tab="saude">SaÃºde</button>
        </div>
    </div>
</section>

<!-- PALESTRAS EM DESTAQUE -->
<section class="palestras-destaque">
    <div class="container">
        <h2>ðŸ”¥ Em Destaque</h2>
        <div class="palestra-featured">
            <div class="featured-video">
                <img src="https://via.placeholder.com/800x450" alt="Palestra">
                <div class="play-button">â–¶</div>
                <span class="duracao-badge">1h 15min</span>
            </div>
            <div class="featured-info">
                <span class="categoria-badge">Tecnologia</span>
                <h3>O Futuro da InteligÃªncia Artificial</h3>
                <p class="palestrante">ðŸ‘¤ Dr. Miguel Santos â€¢ Google AI</p>
                <p class="descricao">Uma visÃ£o profunda sobre como a IA vai transformar todas as indÃºstrias nos prÃ³ximos 10 anos. Descobre as tendÃªncias, desafios e oportunidades que nos esperam.</p>
                <div class="stats-row">
                    <span>ðŸ‘ï¸ 25k visualizaÃ§Ãµes</span>
                    <span>â­ 4.9 (342 avaliaÃ§Ãµes)</span>
                    <span>ðŸ“… HÃ¡ 2 dias</span>
                </div>
                <button class="btn-assistir">â–¶ Assistir Agora</button>
            </div>
        </div>
    </div>
</section>

<!-- GRID DE PALESTRAS -->
<section class="palestras-grid-section">
    <div class="container">
        <h2>Todas as Palestras</h2>
        <div class="palestras-grid">
            
            <!-- Palestra 1 -->
            <div class="palestra-card" data-categoria="negocios">
                <div class="palestra-thumb">
                    <img src="https://via.placeholder.com/400x225" alt="Palestra">
                    <div class="play-overlay">â–¶</div>
                    <span class="duracao">45min</span>
                </div>
                <div class="palestra-content">
                    <span class="cat-badge negocios">NegÃ³cios</span>
                    <h3>Como Escalar uma Startup</h3>
                    <p class="speaker">Ana Costa â€¢ CEO Startup Inc</p>
                    <div class="palestra-stats">
                        <span>ðŸ‘ï¸ 12k</span>
                        <span>â­ 4.8</span>
                    </div>
                </div>
            </div>

            <!-- Palestra 2 -->
            <div class="palestra-card" data-categoria="motivacao">
                <div class="palestra-thumb">
                    <img src="https://via.placeholder.com/400x225" alt="Palestra">
                    <div class="play-overlay">â–¶</div>
                    <span class="duracao">32min</span>
                </div>
                <div class="palestra-content">
                    <span class="cat-badge motivacao">MotivaÃ§Ã£o</span>
                    <h3>Supera os Teus Limites</h3>
                    <p class="speaker">JoÃ£o Silva â€¢ Coach Motivacional</p>
                    <div class="palestra-stats">
                        <span>ðŸ‘ï¸ 18k</span>
                        <span>â­ 5.0</span>
                    </div>
                </div>
            </div>

            <!-- Palestra 3 -->
            <div class="palestra-card" data-categoria="tecnologia">
                <div class="palestra-thumb">
                    <img src="https://via.placeholder.com/400x225" alt="Palestra">
                    <div class="play-overlay">â–¶</div>
                    <span class="duracao">50min</span>
                </div>
                <div class="palestra-content">
                    <span class="cat-badge tecnologia">Tecnologia</span>
                    <h3>Blockchain Explicado</h3>
                    <p class="speaker">Pedro Alves â€¢ Engenheiro Blockchain</p>
                    <div class="palestra-stats">
                        <span>ðŸ‘ï¸ 9k</span>
                        <span>â­ 4.7</span>
                    </div>
                </div>
            </div>

            <!-- Palestra 4 -->
            <div class="palestra-card" data-categoria="saude">
                <div class="palestra-thumb">
                    <img src="https://via.placeholder.com/400x225" alt="Palestra">
                    <div class="play-overlay">â–¶</div>
                    <span class="duracao">38min</span>
                </div>
                <div class="palestra-content">
                    <span class="cat-badge saude">SaÃºde</span>
                    <h3>Mindfulness no Dia a Dia</h3>
                    <p class="speaker">Rita Santos â€¢ PsicÃ³loga ClÃ­nica</p>
                    <div class="palestra-stats">
                        <span>ðŸ‘ï¸ 15k</span>
                        <span>â­ 4.9</span>
                    </div>
                </div>
            </div>

            <!-- Palestra 5 -->
            <div class="palestra-card" data-categoria="tecnologia">
                <div class="palestra-thumb">
                    <img src="https://via.placeholder.com/400x225" alt="Palestra">
                    <div class="play-overlay">â–¶</div>
                    <span class="duracao">55min</span>
                </div>
                <div class="palestra-content">
                    <span class="cat-badge tecnologia">Tecnologia</span>
                    <h3>CiberseguranÃ§a em 2024</h3>
                    <p class="speaker">Carlos Mendes â€¢ Especialista SeguranÃ§a</p>
                    <div class="palestra-stats">
                        <span>ðŸ‘ï¸ 11k</span>
                        <span>â­ 4.8</span>
                    </div>
                </div>
            </div>

            <!-- Palestra 6 -->
            <div class="palestra-card" data-categoria="negocios">
                <div class="palestra-thumb">
                    <img src="https://via.placeholder.com/400x225" alt="Palestra">
                    <div class="play-overlay">â–¶</div>
                    <span class="duracao">42min</span>
                </div>
                <div class="palestra-content">
                    <span class="cat-badge negocios">NegÃ³cios</span>
                    <h3>LideranÃ§a 4.0</h3>
                    <p class="speaker">Maria Oliveira â€¢ Consultora Empresarial</p>
                    <div class="palestra-stats">
                        <span>ðŸ‘ï¸ 13k</span>
                        <span>â­ 4.9</span>
                    </div>
                </div>
            </div>

        </div>
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