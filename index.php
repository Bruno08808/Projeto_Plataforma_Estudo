<?php
// define o tÃ­tulo da pÃ¡gina
$page_title = "StudyHub - PÃ¡gina Inicial";
// define o CSS especÃ­fico desta pÃ¡gina
$page_css = "homePage.css";

// inclui o header (navbar)
include 'header.php';
?>

<!-- AQUI COMEÃ‡A O CONTEÃšDO ESPECÃFICO DA PÃGINA INICIAL -->

<!-- secÃ§Ã£o hero com a call to action -->
<section class="hero">
    <div class="hero-content">
        <h1>Aprende ao Teu Ritmo</h1>
        <p>A melhor plataforma de estudo online com cursos, ebooks e palestras exclusivas</p>
        <a href="login.php" class="btn-cta">ComeÃ§a a Aprender</a>
    </div>
</section>

<!-- secÃ§Ã£o dos cursos mais populares -->
<section class="cursos-populares">
    <div class="container">
        <h2>Cursos Mais Populares</h2>
        <div class="cards-grid">
            <!-- card 1 - isto aqui seria dinamico depois com a BD -->
            <div class="course-card">
                <div class="card-header laranja">
                    <h3>MatemÃ¡tica AvanÃ§ada</h3>
                </div>
                <div class="card-body">
                    <p>Domina cÃ¡lculo, Ã¡lgebra e geometria com exercÃ­cios prÃ¡ticos</p>
                    <div class="card-stats">
                        <span>â­ 4.8</span>
                        <span>ðŸ‘¥ 2.5k alunos</span>
                    </div>
                </div>
            </div>

            <!-- card 2 -->
            <div class="course-card">
                <div class="card-header laranja">
                    <h3>ProgramaÃ§Ã£o Web</h3>
                </div>
                <div class="card-body">
                    <p>HTML, CSS, JavaScript e PHP do zero ao avanÃ§ado</p>
                    <div class="card-stats">
                        <span>â­ 4.9</span>
                        <span>ðŸ‘¥ 3.2k alunos</span>
                    </div>
                </div>
            </div>

            <!-- card 3 -->
            <div class="course-card">
                <div class="card-header laranja">
                    <h3>InglÃªs Fluente</h3>
                </div>
                <div class="card-body">
                    <p>Aprende inglÃªs com nativos e consegue fluÃªncia</p>
                    <div class="card-stats">
                        <span>â­ 4.7</span>
                        <span>ðŸ‘¥ 1.8k alunos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- secÃ§Ã£o das palestras mais vistas -->
<section class="palestras-vistas">
    <div class="container">
        <h2>Palestras Mais Vistas</h2>
        <div class="cards-grid">
            <!-- palestra 1 -->
            <div class="palestra-card">
                <div class="card-header vermelho">
                    <h3>InteligÃªncia Artificial</h3>
                </div>
                <div class="card-body">
                    <p>O futuro da IA e como vai mudar o mundo</p>
                    <div class="card-stats">
                        <span>ðŸ‘ï¸ 15k visualizaÃ§Ãµes</span>
                        <span>â±ï¸ 45min</span>
                    </div>
                </div>
            </div>

            <!-- palestra 2 -->
            <div class="palestra-card">
                <div class="card-header vermelho">
                    <h3>GestÃ£o de Tempo</h3>
                </div>
                <div class="card-body">
                    <p>TÃ©cnicas comprovadas para ser mais produtivo</p>
                    <div class="card-stats">
                        <span>ðŸ‘ï¸ 12k visualizaÃ§Ãµes</span>
                        <span>â±ï¸ 30min</span>
                    </div>
                </div>
            </div>

            <!-- palestra 3 -->
            <div class="palestra-card">
                <div class="card-header vermelho">
                    <h3>Empreendedorismo</h3>
                </div>
                <div class="card-body">
                    <p>Como comeÃ§ar o teu prÃ³prio negÃ³cio do zero</p>
                    <div class="card-stats">
                        <span>ðŸ‘ï¸ 10k visualizaÃ§Ãµes</span>
                        <span>â±ï¸ 50min</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- secÃ§Ã£o dos testemunhos -->
<section class="testemunhos">
    <div class="container">
        <h2>O Que Dizem os Nossos Alunos</h2>
        <div class="testemunhos-grid">
            <!-- testemunho 1 -->
            <div class="testemunho-card">
                <div class="testemunho-texto">
                    <p>"Mudou completamente a minha forma de estudar. Os cursos sÃ£o prÃ¡ticos e diretos ao assunto!"</p>
                </div>
                <div class="testemunho-autor">
                    <strong>Maria Silva</strong>
                    <span>Estudante de Engenharia</span>
                </div>
            </div>

            <!-- testemunho 2 -->
            <div class="testemunho-card">
                <div class="testemunho-texto">
                    <p>"As palestras sÃ£o incrÃ­veis! Aprendi mais em 3 meses aqui do que em anos a estudar sozinho."</p>
                </div>
                <div class="testemunho-autor">
                    <strong>JoÃ£o Costa</strong>
                    <span>Programador</span>
                </div>
            </div>

            <!-- testemunho 3 -->
            <div class="testemunho-card">
                <div class="testemunho-texto">
                    <p>"Plataforma intuitiva e conteÃºdo de qualidade. Recomendo a todos que querem aprender!"</p>
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