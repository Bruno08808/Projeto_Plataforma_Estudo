<?php
// define o título da página
$page_title = "StudyHub - Página Inicial";
// define o CSS específico desta página
$page_css = "homePage.css";

// inclui o header (navbar)
include 'header.php';
?>

<!-- AQUI COMEÇA O CONTEÚDO ESPECÍFICO DA PÁGINA INICIAL -->

<!-- secção hero com a call to action -->
<section class="hero">
    <div class="hero-content">
        <h1>Aprende ao Teu Ritmo</h1>
        <p>A melhor plataforma de estudo online com cursos, ebooks e palestras exclusivas</p>
        <a href="login.php" class="btn-cta">Começa a Aprender</a>
    </div>
</section>

<!-- secção dos cursos mais populares -->
<section class="cursos-populares">
    <div class="container">
        <h2>Cursos Mais Populares</h2>
        <div class="cards-grid">
            <!-- card 1 - isto aqui seria dinamico depois com a BD -->
            <div class="course-card">
                <div class="card-header laranja">
                    <h3>Matemática Avançada</h3>
                </div>
                <div class="card-body">
                    <p>Domina cálculo, álgebra e geometria com exercícios práticos</p>
                    <div class="card-stats">
                        <span>⭐ 4.8</span>
                        <span>👥 2.5k alunos</span>
                    </div>
                </div>
            </div>

            <!-- card 2 -->
            <div class="course-card">
                <div class="card-header laranja">
                    <h3>Programação Web</h3>
                </div>
                <div class="card-body">
                    <p>HTML, CSS, JavaScript e PHP do zero ao avançado</p>
                    <div class="card-stats">
                        <span>⭐ 4.9</span>
                        <span>👥 3.2k alunos</span>
                    </div>
                </div>
            </div>

            <!-- card 3 -->
            <div class="course-card">
                <div class="card-header laranja">
                    <h3>Inglês Fluente</h3>
                </div>
                <div class="card-body">
                    <p>Aprende inglês com nativos e consegue fluência</p>
                    <div class="card-stats">
                        <span>⭐ 4.7</span>
                        <span>👥 1.8k alunos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- secção das palestras mais vistas -->
<section class="palestras-vistas">
    <div class="container">
        <h2>Palestras Mais Vistas</h2>
        <div class="cards-grid">
            <!-- palestra 1 -->
            <div class="palestra-card">
                <div class="card-header vermelho">
                    <h3>Inteligência Artificial</h3>
                </div>
                <div class="card-body">
                    <p>O futuro da IA e como vai mudar o mundo</p>
                    <div class="card-stats">
                        <span>👁️ 15k visualizações</span>
                        <span>⏱️ 45min</span>
                    </div>
                </div>
            </div>

            <!-- palestra 2 -->
            <div class="palestra-card">
                <div class="card-header vermelho">
                    <h3>Gestão de Tempo</h3>
                </div>
                <div class="card-body">
                    <p>Técnicas comprovadas para ser mais produtivo</p>
                    <div class="card-stats">
                        <span>👁️ 12k visualizações</span>
                        <span>⏱️ 30min</span>
                    </div>
                </div>
            </div>

            <!-- palestra 3 -->
            <div class="palestra-card">
                <div class="card-header vermelho">
                    <h3>Empreendedorismo</h3>
                </div>
                <div class="card-body">
                    <p>Como começar o teu próprio negócio do zero</p>
                    <div class="card-stats">
                        <span>👁️ 10k visualizações</span>
                        <span>⏱️ 50min</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- secção dos testemunhos -->
<section class="testemunhos">
    <div class="container">
        <h2>O Que Dizem os Nossos Alunos</h2>
        <div class="testemunhos-grid">
            <!-- testemunho 1 -->
            <div class="testemunho-card">
                <div class="testemunho-texto">
                    <p>"Mudou completamente a minha forma de estudar. Os cursos são práticos e diretos ao assunto!"</p>
                </div>
                <div class="testemunho-autor">
                    <strong>Maria Silva</strong>
                    <span>Estudante de Engenharia</span>
                </div>
            </div>

            <!-- testemunho 2 -->
            <div class="testemunho-card">
                <div class="testemunho-texto">
                    <p>"As palestras são incríveis! Aprendi mais em 3 meses aqui do que em anos a estudar sozinho."</p>
                </div>
                <div class="testemunho-autor">
                    <strong>João Costa</strong>
                    <span>Programador</span>
                </div>
            </div>

            <!-- testemunho 3 -->
            <div class="testemunho-card">
                <div class="testemunho-texto">
                    <p>"Plataforma intuitiva e conteúdo de qualidade. Recomendo a todos que querem aprender!"</p>
                </div>
                <div class="testemunho-autor">
                    <strong>Ana Pereira</strong>
                    <span>Designer</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// inclui o footer
include 'footer.php';
?>