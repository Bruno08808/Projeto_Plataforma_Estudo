<?php
$page_title = "StudyHub - Ebooks";
$page_css = "ebooks.css";
session_start();
include 'header.php';
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
        <div class="ebooks-grid">
            
            <!-- Ebook 1 -->
            <div class="ebook-card">
                <div class="ebook-cover">
                    <img src="https://via.placeholder.com/300x400" alt="Ebook">
                    <div class="ebook-overlay">
                        <button class="btn-download">📥 Download</button>
                        <button class="btn-preview">👁️ Pré-visualizar</button>
                    </div>
                </div>
                <div class="ebook-info">
                    <span class="ebook-badge">Tecnologia</span>
                    <h3>Clean Code: Manual Prático</h3>
                    <p class="autor">Por Robert C. Martin</p>
                    <div class="ebook-stats">
                        <span>⭐ 4.9</span>
                        <span>📖 420 páginas</span>
                        <span>⬇️ 2.1k downloads</span>
                    </div>
                    <p class="descricao">Aprende as melhores práticas para escrever código limpo e maintível</p>
                </div>
            </div>

            <!-- Ebook 2 -->
            <div class="ebook-card">
                <div class="ebook-cover">
                    <img src="https://via.placeholder.com/300x400" alt="Ebook">
                    <div class="ebook-overlay">
                        <button class="btn-download">📥 Download</button>
                        <button class="btn-preview">👁️ Pré-visualizar</button>
                    </div>
                </div>
                <div class="ebook-info">
                    <span class="ebook-badge negocio">Negócios</span>
                    <h3>Lean Startup</h3>
                    <p class="autor">Por Eric Ries</p>
                    <div class="ebook-stats">
                        <span>⭐ 4.8</span>
                        <span>📖 336 páginas</span>
                        <span>⬇️ 3.5k downloads</span>
                    </div>
                    <p class="descricao">Como criar empresas inovadoras com menos recursos</p>
                </div>
            </div>

            <!-- Ebook 3 -->
            <div class="ebook-card">
                <div class="ebook-cover">
                    <img src="https://via.placeholder.com/300x400" alt="Ebook">
                    <div class="ebook-overlay">
                        <button class="btn-download">📥 Download</button>
                        <button class="btn-preview">👁️ Pré-visualizar</button>
                    </div>
                </div>
                <div class="ebook-info">
                    <span class="ebook-badge pessoal">Desenvolvimento Pessoal</span>
                    <h3>Hábitos Atómicos</h3>
                    <p class="autor">Por James Clear</p>
                    <div class="ebook-stats">
                        <span>⭐ 5.0</span>
                        <span>📖 288 páginas</span>
                        <span>⬇️ 5.2k downloads</span>
                    </div>
                    <p class="descricao">Pequenas mudanças que transformam a tua vida</p>
                </div>
            </div>

            <!-- Ebook 4 -->
            <div class="ebook-card">
                <div class="ebook-cover">
                    <img src="https://via.placeholder.com/300x400" alt="Ebook">
                    <div class="ebook-overlay">
                        <button class="btn-download">📥 Download</button>
                        <button class="btn-preview">👁️ Pré-visualizar</button>
                    </div>
                </div>
                <div class="ebook-info">
                    <span class="ebook-badge marketing">Marketing</span>
                    <h3>Marketing 4.0</h3>
                    <p class="autor">Por Philip Kotler</p>
                    <div class="ebook-stats">
                        <span>⭐ 4.7</span>
                        <span>📖 192 páginas</span>
                        <span>⬇️ 1.8k downloads</span>
                    </div>
                    <p class="descricao">Estratégias de marketing na era digital</p>
                </div>
            </div>

            <!-- Ebook 5 -->
            <div class="ebook-card">
                <div class="ebook-cover">
                    <img src="https://via.placeholder.com/300x400" alt="Ebook">
                    <div class="ebook-overlay">
                        <button class="btn-download">📥 Download</button>
                        <button class="btn-preview">👁️ Pré-visualizar</button>
                    </div>
                </div>
                <div class="ebook-info">
                    <span class="ebook-badge design">Design</span>
                    <h3>Don't Make Me Think</h3>
                    <p class="autor">Por Steve Krug</p>
                    <div class="ebook-stats">
                        <span>⭐ 4.9</span>
                        <span>📖 216 páginas</span>
                        <span>⬇️ 2.7k downloads</span>
                    </div>
                    <p class="descricao">Princípios fundamentais de usabilidade web</p>
                </div>
            </div>

            <!-- Ebook 6 -->
            <div class="ebook-card">
                <div class="ebook-cover">
                    <img src="https://via.placeholder.com/300x400" alt="Ebook">
                    <div class="ebook-overlay">
                        <button class="btn-download">📥 Download</button>
                        <button class="btn-preview">👁️ Pré-visualizar</button>
                    </div>
                </div>
                <div class="ebook-info">
                    <span class="ebook-badge">Tecnologia</span>
                    <h3>The Pragmatic Programmer</h3>
                    <p class="autor">Por David Thomas</p>
                    <div class="ebook-stats">
                        <span>⭐ 4.8</span>
                        <span>📖 352 páginas</span>
                        <span>⬇️ 3.1k downloads</span>
                    </div>
                    <p class="descricao">De aprendiz a mestre programador</p>
                </div>
            </div>

        </div>
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