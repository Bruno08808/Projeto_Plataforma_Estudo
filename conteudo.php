<?php
require_once 'model.php';
session_start();

$slug = $_GET['slug'] ?? null;

if (!$slug) {
    die("Conteúdo não especificado.");
}

// O model agora faz o JOIN automaticamente baseado no slug
$conteudo = getConteudoPorSlug($slug);

if (!$conteudo) {
    die("Conteúdo não encontrado na base de dados. Slug: " . htmlspecialchars($slug));
}

$page_title = $conteudo['Titulo'] . " | StudyHub";
include 'header.php';
?>

<main class="container" style="padding: 50px 20px; max-width: 1200px; margin: 0 auto;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
        
        <div class="prod-imagem">
            <?php $img = !empty($conteudo['Imagem']) ? $conteudo['Imagem'] : 'https://via.placeholder.com/600x400'; ?>
            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($conteudo['Titulo']) ?>" style="width: 100%; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        </div>

        <div class="prod-detalhes">
            <span style="background: #eee; padding: 5px 15px; border-radius: 20px; font-size: 0.9em; display: inline-block; margin-bottom: 10px;">
                <?= ucfirst($conteudo['Tipo']) ?>
            </span>
            
            <h1 style="font-size: 2.5em; margin: 15px 0;"><?= htmlspecialchars($conteudo['Titulo']) ?></h1>
            
            <div style="font-size: 1.2em; color: #666; margin-bottom: 20px; line-height: 1.6;">
                <?= nl2br(htmlspecialchars($conteudo['Info_Extra'])) ?>
            </div>

            <div style="background: #f9f9f9; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                <?php if ($conteudo['Tipo'] == 'Curso'): ?>
                    <p style="margin: 8px 0;">📅 <strong>Início:</strong> <?= $conteudo['Data_Inicio'] ?? 'A definir' ?></p>
                    <?php 
                    $vagasDisponiveis = ($conteudo['Vagas_Totais'] ?? 0) - ($conteudo['Vagas_Preenchidas'] ?? 0);
                    ?>
                    <p style="margin: 8px 0;">👥 <strong>Vagas:</strong> <?= $vagasDisponiveis ?> disponíveis</p>
                    
                <?php elseif ($conteudo['Tipo'] == 'Ebook'): ?>
                    <p style="margin: 8px 0;">📖 <strong>Páginas:</strong> <?= $conteudo['Num_Paginas'] ?? '---' ?></p>
                    <p style="margin: 8px 0;">📄 <strong>Formato:</strong> Digital (PDF/EPUB)</p>
                    
                <?php elseif ($conteudo['Tipo'] == 'Palestra'): ?>
                    <p style="margin: 8px 0;">📍 <strong>Local:</strong> <?= $conteudo['Localizacao'] ?? 'Online' ?></p>
                    <p style="margin: 8px 0;">⏰ <strong>Data:</strong> <?= $conteudo['Data_Evento'] ?? 'Brevemente' ?></p>
                    
                <?php elseif (in_array($conteudo['Tipo'], ['Explicacoes', 'Explicação', 'Explicacao'])): ?>
                    <p style="margin: 8px 0;">🎓 <strong>Nível:</strong> <?= $conteudo['Nivel'] ?? 'Todos os níveis' ?></p>
                    <p style="margin: 8px 0;">💻 <strong>Formato:</strong> Online (videochamada)</p>
                <?php endif; ?>
                
                <?php if (!empty($conteudo['Avaliacao'])): ?>
                    <p style="margin: 8px 0;">⭐ <strong>Avaliação:</strong> <?= $conteudo['Avaliacao'] ?>/5</p>
                <?php endif; ?>
            </div>

            <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                <h2 style="color: #E89A3C; font-size: 2em; margin: 0;">
                    <?= ($conteudo['Preco'] > 0) ? "€" . number_format($conteudo['Preco'], 2, ',', '.') : "Gratuito" ?>
                </h2>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="inscrever.php" method="POST">
                        <input type="hidden" name="idConteudo" value="<?= $conteudo['IDconteudo'] ?>">
                        <button type="submit" style="padding: 15px 40px; background: #E89A3C; color: white; border: none; border-radius: 30px; font-weight: bold; cursor: pointer; font-size: 16px; transition: all 0.3s;">
                            <?php 
                                if($conteudo['Tipo'] == 'Ebook') echo "📥 Baixar Ebook";
                                elseif($conteudo['Tipo'] == 'Palestra') echo "🎫 Reservar Lugar";
                                elseif(in_array($conteudo['Tipo'], ['Explicacoes', 'Explicação', 'Explicacao'])) echo "📅 Agendar Explicação";
                                else echo "✅ Inscrever Agora";
                            ?>
                        </button>
                    </form>
                <?php else: ?>
                    <a href="login.php" style="padding: 15px 40px; background: #4A90E2; color: white; text-decoration: none; border-radius: 30px; font-weight: bold; display: inline-block;">
                        🔒 Fazer Login para Inscrever
                    </a>
                <?php endif; ?>
            </div>
            
            <div style="margin-top: 20px;">
                <a href="<?php 
                    if($conteudo['Tipo'] == 'Curso') echo 'cursos.php';
                    elseif($conteudo['Tipo'] == 'Ebook') echo 'ebooks.php';
                    elseif($conteudo['Tipo'] == 'Palestra') echo 'palestras.php';
                    else echo 'explicacoes.php';
                ?>" style="color: #666; text-decoration: none; font-size: 14px;">
                    ← Voltar à lista
                </a>
            </div>
        </div>
    </div>
</main>

<style>
@media (max-width: 768px) {
    main .container > div {
        grid-template-columns: 1fr !important;
    }
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(232, 154, 60, 0.3);
}
</style>

<?php include 'footer.php'; ?>