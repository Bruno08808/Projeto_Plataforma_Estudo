<?php
$page_title = "StudyHub - Cursos";
$page_css = "cursos.css";
session_start();
include 'header.php';
?>

<!-- HERO CURSOS -->
<section class="hero-cursos">
    <div class="hero-content">
        <h1>Cursos Online</h1>
        <p>Aprende novas skills com cursos completos e certificados</p>
        <div class="search-bar">
            <input type="text" placeholder="O que queres aprender hoje?">
            <button>🔍 Procurar</button>
        </div>
    </div>
</section>

<!-- CATEGORIAS -->
<section class="categorias-section">
    <div class="container">
        <h2>Explora por Categoria</h2>
        <div class="categorias-grid">
            <div class="categoria-card">
                <div class="categoria-icon" style="background: #E89A3C;">💻</div>
                <h3>Programação</h3>
                <p>127 cursos</p>
            </div>
            <div class="categoria-card">
                <div class="categoria-icon" style="background: #5FA777;">🎨</div>
                <h3>Design</h3>
                <p>89 cursos</p>
            </div>
            <div class="categoria-card">
                <div class="categoria-icon" style="background: #D96459;">📊</div>
                <h3>Marketing</h3>
                <p>64 cursos</p>
            </div>
            <div class="categoria-card">
                <div class="categoria-icon" style="background: #4A90E2;">💼</div>
                <h3>Negócios</h3>
                <p>93 cursos</p>
            </div>
        </div>
    </div>
</section>

<!-- CURSOS EM DESTAQUE -->
<section class="cursos-destaque">
    <div class="container">
        <h2>Cursos em Destaque</h2>
        <div class="cursos-grid">
            
            <!-- Curso 1 -->
            <div class="curso-card">
                <div class="curso-thumbnail">
                    <img src="https://via.placeholder.com/400x250" alt="Curso">
                    <span class="badge-novo">Novo</span>
                    <span class="badge-nivel">Intermediário</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">Programação</div>
                    <h3>Desenvolvimento Web Completo</h3>
                    <p>HTML, CSS, JavaScript, React e Node.js do zero ao avançado</p>
                    <div class="curso-stats">
                        <span>⭐ 4.9</span>
                        <span>👥 3.2k alunos</span>
                        <span>⏱️ 40h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. João Silva</span>
                        </div>
                        <div class="preco">€89</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

            <!-- Curso 2 -->
            <div class="curso-card">
                <div class="curso-thumbnail">
                    <img src="https://via.placeholder.com/400x250" alt="Curso">
                    <span class="badge-bestseller">Bestseller</span>
                    <span class="badge-nivel">Iniciante</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">Design</div>
                    <h3>UI/UX Design Masterclass</h3>
                    <p>Aprende a criar interfaces incríveis com Figma e Adobe XD</p>
                    <div class="curso-stats">
                        <span>⭐ 4.8</span>
                        <span>👥 5.7k alunos</span>
                        <span>⏱️ 32h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Ana Costa</span>
                        </div>
                        <div class="preco">€79</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

            <!-- Curso 3 -->
            <div class="curso-card">
                <div class="curso-thumbnail">
                    <img src="https://via.placeholder.com/400x250" alt="Curso">
                    <span class="badge-nivel">Avançado</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">Marketing</div>
                    <h3>Marketing Digital 360°</h3>
                    <p>Estratégias completas de SEO, SEM, Social Media e Email Marketing</p>
                    <div class="curso-stats">
                        <span>⭐ 4.7</span>
                        <span>👥 2.1k alunos</span>
                        <span>⏱️ 28h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Pedro Alves</span>
                        </div>
                        <div class="preco">€99</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

            <!-- Curso 4 -->
            <div class="curso-card">
                <div class="curso-thumbnail">
                    <img src="https://via.placeholder.com/400x250" alt="Curso">
                    <span class="badge-novo">Novo</span>
                    <span class="badge-nivel">Intermediário</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">Programação</div>
                    <h3>Python para Data Science</h3>
                    <p>Análise de dados, Machine Learning e visualização com Python</p>
                    <div class="curso-stats">
                        <span>⭐ 4.9</span>
                        <span>👥 1.8k alunos</span>
                        <span>⏱️ 35h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Maria Santos</span>
                        </div>
                        <div class="preco">€95</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

            <!-- Curso 5 -->
            <div class="curso-card">
                <div class="curso-thumbnail">
                    <img src="https://via.placeholder.com/400x250" alt="Curso">
                    <span class="badge-nivel">Iniciante</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">Negócios</div>
                    <h3>Empreendedorismo Digital</h3>
                    <p>Como criar e escalar o teu negócio online do zero</p>
                    <div class="curso-stats">
                        <span>⭐ 4.8</span>
                        <span>👥 4.3k alunos</span>
                        <span>⏱️ 25h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Carlos Mendes</span>
                        </div>
                        <div class="preco">€75</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

            <!-- Curso 6 -->
            <div class="curso-card">
                <div class="curso-thumbnail">
                    <img src="https://via.placeholder.com/400x250" alt="Curso">
                    <span class="badge-bestseller">Bestseller</span>
                    <span class="badge-nivel">Intermediário</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">Design</div>
                    <h3>Fotografia Profissional</h3>
                    <p>Técnicas avançadas de fotografia e edição com Lightroom</p>
                    <div class="curso-stats">
                        <span>⭐ 5.0</span>
                        <span>👥 2.9k alunos</span>
                        <span>⏱️ 30h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Rita Ferreira</span>
                        </div>
                        <div class="preco">€85</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

        </div>
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