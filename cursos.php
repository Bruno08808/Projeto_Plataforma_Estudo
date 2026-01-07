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
            <button>ðŸ” Procurar</button>
        </div>
    </div>
</section>

<!-- CATEGORIAS -->
<section class="categorias-section">
    <div class="container">
        <h2>Explora por Categoria</h2>
        <div class="categorias-grid">
            <div class="categoria-card">
                <div class="categoria-icon" style="background: #E89A3C;">ðŸ’»</div>
                <h3>ProgramaÃ§Ã£o</h3>
                <p>127 cursos</p>
            </div>
            <div class="categoria-card">
                <div class="categoria-icon" style="background: #5FA777;">ðŸŽ¨</div>
                <h3>Design</h3>
                <p>89 cursos</p>
            </div>
            <div class="categoria-card">
                <div class="categoria-icon" style="background: #D96459;">ðŸ“Š</div>
                <h3>Marketing</h3>
                <p>64 cursos</p>
            </div>
            <div class="categoria-card">
                <div class="categoria-icon" style="background: #4A90E2;">ðŸ’¼</div>
                <h3>NegÃ³cios</h3>
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
                    <span class="badge-nivel">IntermediÃ¡rio</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">ProgramaÃ§Ã£o</div>
                    <h3>Desenvolvimento Web Completo</h3>
                    <p>HTML, CSS, JavaScript, React e Node.js do zero ao avanÃ§ado</p>
                    <div class="curso-stats">
                        <span>â­ 4.9</span>
                        <span>ðŸ‘¥ 3.2k alunos</span>
                        <span>â±ï¸ 40h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. JoÃ£o Silva</span>
                        </div>
                        <div class="preco">â‚¬89</div>
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
                    <p>Aprende a criar interfaces incrÃ­veis com Figma e Adobe XD</p>
                    <div class="curso-stats">
                        <span>â­ 4.8</span>
                        <span>ðŸ‘¥ 5.7k alunos</span>
                        <span>â±ï¸ 32h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Ana Costa</span>
                        </div>
                        <div class="preco">â‚¬79</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

            <!-- Curso 3 -->
            <div class="curso-card">
                <div class="curso-thumbnail">
                    <img src="https://via.placeholder.com/400x250" alt="Curso">
                    <span class="badge-nivel">AvanÃ§ado</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">Marketing</div>
                    <h3>Marketing Digital 360Â°</h3>
                    <p>EstratÃ©gias completas de SEO, SEM, Social Media e Email Marketing</p>
                    <div class="curso-stats">
                        <span>â­ 4.7</span>
                        <span>ðŸ‘¥ 2.1k alunos</span>
                        <span>â±ï¸ 28h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Pedro Alves</span>
                        </div>
                        <div class="preco">â‚¬99</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

            <!-- Curso 4 -->
            <div class="curso-card">
                <div class="curso-thumbnail">
                    <img src="https://via.placeholder.com/400x250" alt="Curso">
                    <span class="badge-novo">Novo</span>
                    <span class="badge-nivel">IntermediÃ¡rio</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">ProgramaÃ§Ã£o</div>
                    <h3>Python para Data Science</h3>
                    <p>AnÃ¡lise de dados, Machine Learning e visualizaÃ§Ã£o com Python</p>
                    <div class="curso-stats">
                        <span>â­ 4.9</span>
                        <span>ðŸ‘¥ 1.8k alunos</span>
                        <span>â±ï¸ 35h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Maria Santos</span>
                        </div>
                        <div class="preco">â‚¬95</div>
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
                    <div class="curso-categoria">NegÃ³cios</div>
                    <h3>Empreendedorismo Digital</h3>
                    <p>Como criar e escalar o teu negÃ³cio online do zero</p>
                    <div class="curso-stats">
                        <span>â­ 4.8</span>
                        <span>ðŸ‘¥ 4.3k alunos</span>
                        <span>â±ï¸ 25h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Carlos Mendes</span>
                        </div>
                        <div class="preco">â‚¬75</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

            <!-- Curso 6 -->
            <div class="curso-card">
                <div class="curso-thumbnail">
                    <img src="https://via.placeholder.com/400x250" alt="Curso">
                    <span class="badge-bestseller">Bestseller</span>
                    <span class="badge-nivel">IntermediÃ¡rio</span>
                </div>
                <div class="curso-content">
                    <div class="curso-categoria">Design</div>
                    <h3>Fotografia Profissional</h3>
                    <p>TÃ©cnicas avanÃ§adas de fotografia e ediÃ§Ã£o com Lightroom</p>
                    <div class="curso-stats">
                        <span>â­ 5.0</span>
                        <span>ðŸ‘¥ 2.9k alunos</span>
                        <span>â±ï¸ 30h</span>
                    </div>
                    <div class="curso-footer">
                        <div class="instrutor">
                            <img src="https://via.placeholder.com/40" alt="Instrutor">
                            <span>Prof. Rita Ferreira</span>
                        </div>
                        <div class="preco">â‚¬85</div>
                    </div>
                    <button class="btn-inscrever">Inscrever</button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- BENEFÃCIOS -->
<section class="beneficios">
    <div class="container">
        <h2>PorquÃª Escolher os Nossos Cursos?</h2>
        <div class="beneficios-grid">
            <div class="beneficio">
                <div class="beneficio-icon">ðŸ“œ</div>
                <h3>Certificado</h3>
                <p>Recebe um certificado reconhecido ao completar</p>
            </div>
            <div class="beneficio">
                <div class="beneficio-icon">â™¾ï¸</div>
                <h3>Acesso VitalÃ­cio</h3>
                <p>Acesso ilimitado ao conteÃºdo para sempre</p>
            </div>
            <div class="beneficio">
                <div class="beneficio-icon">ðŸ’¬</div>
                <h3>Suporte</h3>
                <p>Tira dÃºvidas diretamente com o instrutor</p>
            </div>
            <div class="beneficio">
                <div class="beneficio-icon">ðŸ“±</div>
                <h3>Mobile</h3>
                <p>Aprende onde e quando quiseres</p>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>
















