<?php
// define o título da página
$page_title = "StudyHub - Página Inicial";
// define o CSS específico desta página
$page_css = "homePage.css";

// inclui o model para buscar dados
include 'model.php';

// Buscar conteúdos para mostrar na home
$cursosPopulares = getTodosCursos();
$palestrasPopulares = getTodasPalestras();

// Limita a 3 itens para a home
$cursosPopulares = array_slice($cursosPopulares, 0, 3);
$palestrasPopulares = array_slice($palestrasPopulares, 0, 3);

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
        
        <?php if (empty($cursosPopulares)): ?>
            <p style="text-align: center; color: #666;">Em breve teremos cursos disponíveis!</p>
        <?php else: ?>
            <div class="cards-grid">
                <?php foreach ($cursosPopulares as $curso): ?>
                    <!-- card dinâmico da BD -->
                    <div class="course-card">
                        <div class="card-header laranja">
                            <h3><?php echo htmlspecialchars($curso['Titulo']); ?></h3>
                        </div>
                        <div class="card-body">
                            <p><?php echo htmlspecialchars($curso['Info_Extra'] ?? 'Curso completo e prático'); ?></p>
                            <div class="card-stats">
                                <span>⭐ 4.8</span>
                                <span>👥 2.5k alunos</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="cursos.php" style="display: inline-block; padding: 12px 30px; background: #E89A3C; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Ver Todos os Cursos</a>
        </div>
    </div>
</section>

<!-- secção das palestras mais vistas -->
<section class="palestras-vistas">
    <div class="container">
        <h2>Palestras Mais Vistas</h2>
        
        <?php if (empty($palestrasPopulares)): ?>
            <p style="text-align: center; color: #666;">Em breve teremos palestras disponíveis!</p>
        <?php else: ?>
            <div class="cards-grid">
                <?php foreach ($palestrasPopulares as $palestra): ?>
                    <!-- palestra dinâmica da BD -->
                    <div class="palestra-card">
                        <div class="card-header vermelho">
                            <h3><?php echo htmlspecialchars($palestra['Titulo']); ?></h3>
                        </div>
                        <div class="card-body">
                            <p><?php echo htmlspecialchars($palestra['Info_Extra'] ?? 'Uma palestra inspiradora'); ?></p>
                            <div class="card-stats">
                                <span>👁️ 15k visualizações</span>
                                <span>⏱️ 45min</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="palestras.php" style="display: inline-block; padding: 12px 30px; background: #D96459; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Ver Todas as Palestras</a>
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