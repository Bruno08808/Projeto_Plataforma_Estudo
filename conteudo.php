<?php
session_start();
include 'model.php';

// 1. Verificar se temos um slug na URL
if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    header("Location: index.php"); // Se não houver slug, manda para a home
    exit();
}

// 2. Buscar TUDO sobre este conteúdo (Dados básicos + Detalhes específicos)
$slug = $_GET['slug'];
$item = getConteudoPorSlug($slug);

// 3. Se o slug não existir na BD, mostra erro 404
if (!$item) {
    echo "<h1>Erro 404</h1><p>Conteúdo não encontrado.</p><a href='index.php'>Voltar</a>";
    exit();
}

$page_title = "StudyHub - " . htmlspecialchars($item['Titulo']);
$page_css = "conteudo.css"; // Vamos criar este CSS já a seguir
include 'header.php';
?>

<div class="content-hero" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo !empty($item['Imagem']) ? $item['Imagem'] : 'https://via.placeholder.com/1200x400'; ?>');">
    <div class="container">
        <span class="badge-tipo"><?php echo htmlspecialchars($item['Tipo']); ?></span>
        <h1><?php echo htmlspecialchars($item['Titulo']); ?></h1>
        
        <div class="hero-meta">
            <?php if($item['Avaliacao']): ?>
                <span>⭐ <?php echo $item['Avaliacao']; ?>/5</span>
            <?php endif; ?>
            
            <?php if($item['Preco'] > 0): ?>
                <span class="price-tag">€<?php echo number_format($item['Preco'], 2); ?></span>
            <?php else: ?>
                <span class="price-tag free">Gratuito</span>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container content-layout">
    
    <main class="main-details">
        <h2>Sobre este conteúdo</h2>
        <div class="description-text">
            <?php echo nl2br(htmlspecialchars($item['Info_Extra'] ?? 'Sem descrição disponível.')); ?>
        </div>

        <div class="specific-details">
            <h3>Detalhes Técnicos</h3>
            <ul class="detail-list">
                
                <?php if ($item['Tipo'] == 'Curso'): ?>
                    <li><strong>📅 Início:</strong> <?php echo $item['Data_Inicio'] ? date('d/m/Y', strtotime($item['Data_Inicio'])) : 'A definir'; ?></li>
                    <li><strong>🎓 Vagas:</strong> <?php echo ($item['Vagas_Totais'] - $item['Vagas_Preenchidas']); ?> restantes</li>
                    <li><strong>📜 Certificado:</strong> Incluído</li>

                <?php elseif ($item['Tipo'] == 'Ebook'): ?>
                    <li><strong>📄 Páginas:</strong> <?php echo $item['Num_Paginas']; ?></li>
                    <li><strong>💾 Formato:</strong> <?php echo htmlspecialchars($item['Formato'] ?? 'PDF'); ?></li>
                    <li><strong>📱 Leitura:</strong> Compatível com Mobile/Tablet</li>

                <?php elseif ($item['Tipo'] == 'Palestra'): ?>
                    <li><strong>🎤 Orador:</strong> <?php echo htmlspecialchars($item['Orador'] ?? 'Convidado Especial'); ?></li>
                    <li><strong>📍 Local:</strong> <?php echo htmlspecialchars($item['Localizacao']); ?></li>
                    <li><strong>📅 Data:</strong> <?php echo $item['Data_Evento'] ? date('d/m/Y H:i', strtotime($item['Data_Evento'])) : 'Brevemente'; ?></li>

                <?php elseif ($item['Tipo'] == 'Explicacoes'): ?>
                    <li><strong>⏱️ Duração:</strong> <?php echo $item['Duracao_Minutos']; ?> minutos</li>
                    <li><strong>📚 Nível:</strong> <?php echo htmlspecialchars($item['Nivel']); ?></li>
                    <li><strong>👨‍🏫 Tipo:</strong> Individual (One-on-One)</li>
                <?php endif; ?>

            </ul>
        </div>
    </main>

    <aside class="sidebar-action">
        <div class="action-card">
            <h3>Inscreve-te Agora</h3>
            <p>Garante o teu acesso imediato.</p>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="inscrever.php" method="POST">
                    <input type="hidden" name="idConteudo" value="<?php echo $item['IDconteudo']; ?>">
                    
                    <?php if ($item['Tipo'] == 'Curso'): ?>
                        <button type="submit" class="btn-cta">Inscrever no Curso</button>
                    
                    <?php elseif ($item['Tipo'] == 'Ebook'): ?>
                        <button type="submit" class="btn-cta download">📥 Comprar & Baixar</button>
                    
                    <?php elseif ($item['Tipo'] == 'Palestra'): ?>
                        <button type="submit" class="btn-cta">Garantir Lugar</button>
                    
                    <?php else: ?>
                        <button type="submit" class="btn-cta">Agendar Sessão</button>
                    <?php endif; ?>
                </form>
            <?php else: ?>
                <a href="login.php" class="btn-cta login">Faz Login para Aceder</a>
                <p class="small-note">Ainda não tens conta? <a href="registo.php">Regista-te</a></p>
            <?php endif; ?>

            <div class="security-badges">
                <span>🔒 Pagamento Seguro</span>
                <span>✅ Garantia de Satisfação</span>
            </div>
        </div>
    </aside>

</div>

<?php include 'footer.php'; ?>