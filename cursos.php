<?php
$page_title = "StudyHub - Cursos";
$page_css = "cursos.css";
session_start();
include 'model.php';
include 'header.php';

// Buscar todos os cursos da BD
$cursos = getTodosCursos();
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
        
        <?php if (empty($cursos)): ?>
            <div class="empty-state">
                <p>Ainda não há cursos disponíveis no momento.</p>
            </div>
        <?php else: ?>
            <div class="cursos-grid">
                <?php foreach ($cursos as $curso): ?>
                    <!-- Curso dinâmico da BD -->
                    <div class="curso-card">
                        <div class="curso-thumbnail">
                            <?php 
                            // Usa a imagem da BD se existir, senão placeholder
                            $imagemSrc = !empty($curso['Imagem']) ? htmlspecialchars($curso['Imagem']) : 'https://via.placeholder.com/400x250';
                            ?>
                            <img src="<?php echo $imagemSrc; ?>" alt="<?php echo htmlspecialchars($curso['Titulo']); ?>">
                            
                            <?php if ($curso['Disponibilidade'] == 1): ?>
                                <span class="badge-novo">Disponível</span>
                            <?php endif; ?>
                        </div>
                        <div class="curso-content">
                            <div class="curso-categoria">Curso</div>
                            <h3><?php echo htmlspecialchars($curso['Titulo']); ?></h3>
                            
                            <?php if (!empty($curso['Info_Extra'])): ?>
                                <p><?php echo htmlspecialchars($curso['Info_Extra']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($curso['Avaliacao'])): ?>
                                <div class="curso-stats">
                                    <span>⭐ <?php echo htmlspecialchars($curso['Avaliacao']); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="curso-footer">
                                <?php if (!empty($curso['Preco']) && $curso['Preco'] > 0): ?>
                                    <div class="preco">€<?php echo number_format($curso['Preco'], 2, ',', '.'); ?></div>
                                <?php else: ?>
                                    <div class="preco" style="color: #5FA777; font-weight: bold;">Gratuito</div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <form method="POST" action="inscrever.php" style="margin: 0;">
                                    <input type="hidden" name="idConteudo" value="<?php echo $curso['IDconteudo']; ?>">
                                    <button type="submit" class="btn-inscrever">Inscrever</button>
                                </form>
                            <?php else: ?>
                                <a href="login.php" class="btn-inscrever" style="display: block; text-align: center; text-decoration: none;">Fazer Login para Inscrever</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
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