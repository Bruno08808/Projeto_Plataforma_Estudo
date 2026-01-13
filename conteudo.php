<?php
session_start();

// Incluir arquivos necessários
require_once 'model.php';

// Verificar se seo_config existe antes de incluir
if (file_exists('seo_config.php')) {
    require_once 'seo_config.php';
} else {
    // Fallback: definir constantes básicas se seo_config não existir
    if (!defined('SITE_URL')) {
        define('SITE_URL', 'https://www.studyhub.pt');
    }
    if (!defined('SITE_NAME')) {
        define('SITE_NAME', 'StudyHub');
    }
}

$slug = $_GET['slug'] ?? null;

if (!$slug) {
    die("Conteúdo não especificado.");
}

// O model agora faz o JOIN automaticamente baseado no slug
$conteudo = getConteudoPorSlug($slug);

if (!$conteudo) {
    die("Conteúdo não encontrado na base de dados. Slug: " . htmlspecialchars($slug));
}

// ==================== SEO AVANÇADO - TÍTULO E META DESCRIPTION ====================
$tipo_formatado = ($conteudo['Tipo'] == 'Curso') ? 'Curso' : 
                  ($conteudo['Tipo'] == 'Ebook') ? 'Ebook' : 
                  ($conteudo['Tipo'] == 'Palestra') ? 'Palestra' : 'Explicação';

$page_title = $conteudo['Titulo'] . " | " . $tipo_formatado . " Online | StudyHub";

// Meta description otimizada (150-160 caracteres)
$meta_description = $conteudo['Info_Extra'] ? 
    substr(strip_tags($conteudo['Info_Extra']), 0, 155) . "..." :
    $tipo_formatado . " de " . $conteudo['Titulo'] . " na StudyHub. Aprende online ao teu ritmo em Santarém, Portugal.";

// URL base para imagens
$site_url = defined('SITE_URL') ? SITE_URL : 'https://www.studyhub.pt';

$page_seo = [
    'title' => $page_title,
    'description' => $meta_description,
    'keywords' => $conteudo['Titulo'] . ', ' . strtolower($tipo_formatado) . ' online, formação online, ' . strtolower($tipo_formatado) . ' portugal',
    'image' => !empty($conteudo['Imagem']) ? $conteudo['Imagem'] : $site_url . '/assets/images/og-default.jpg',
];

// ==================== BREADCRUMBS ====================
$breadcrumbs = [
    ['name' => 'Início', 'url' => $site_url . '/index.php'],
    ['name' => $tipo_formatado . 's', 'url' => $site_url . '/' . strtolower($conteudo['Tipo']) . 's.php'],
    ['name' => $conteudo['Titulo'], 'url' => '']
];

// ==================== SCHEMA.ORG MARKUP ====================
$schema_markup = null;

// Verificar se as funções existem antes de chamar
if ($conteudo['Tipo'] == 'Curso' && function_exists('getCursoSchema')) {
    $schema_markup = getCursoSchema($conteudo);
} elseif ($conteudo['Tipo'] == 'Ebook' && function_exists('getEbookSchema')) {
    $schema_markup = getEbookSchema($conteudo);
} elseif ($conteudo['Tipo'] == 'Palestra' && function_exists('getPalestraSchema')) {
    $schema_markup = getPalestraSchema($conteudo);
} else {
    // Fallback: criar schema básico inline
    if ($conteudo['Tipo'] == 'Curso') {
        $schema_markup = [
            '@context' => 'https://schema.org',
            '@type' => 'Course',
            'name' => $conteudo['Titulo'],
            'description' => $conteudo['Info_Extra'] ?? '',
            'provider' => [
                '@type' => 'Organization',
                'name' => 'StudyHub',
                'url' => $site_url,
            ],
        ];
    } elseif ($conteudo['Tipo'] == 'Ebook') {
        $schema_markup = [
            '@context' => 'https://schema.org',
            '@type' => 'Book',
            'name' => $conteudo['Titulo'],
            'description' => $conteudo['Info_Extra'] ?? '',
            'bookFormat' => 'EBook',
            'inLanguage' => 'pt-PT',
        ];
    } elseif ($conteudo['Tipo'] == 'Palestra') {
        $schema_markup = [
            '@context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => $conteudo['Titulo'],
            'description' => $conteudo['Info_Extra'] ?? '',
        ];
    }
}

include 'header.php';
?>

<!-- ==================== CONTEÚDO PRINCIPAL COM TAGS SEMÂNTICAS ==================== -->
<main class="container" style="padding: 50px 20px; max-width: 1200px; margin: 0 auto;" itemscope itemtype="<?php 
    if($conteudo['Tipo'] == 'Curso') echo 'https://schema.org/Course';
    elseif($conteudo['Tipo'] == 'Ebook') echo 'https://schema.org/Book';
    elseif($conteudo['Tipo'] == 'Palestra') echo 'https://schema.org/Event';
    else echo 'https://schema.org/Service';
?>">
    
    <!-- ==================== H1 OTIMIZADO PARA SEO ==================== -->
    <h1 itemprop="name" style="display: none;"><?= htmlspecialchars($conteudo['Titulo']) ?> - <?= $tipo_formatado ?> Online</h1>
    
    <article style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
        
        <!-- ==================== IMAGEM COM ALT TEXT OTIMIZADO ==================== -->
        <div class="prod-imagem">
            <?php 
            // Gera placeholder baseado no tipo de conteúdo
            if (!empty($conteudo['Imagem'])) {
                $img = $conteudo['Imagem'];
            } else {
                $id = $conteudo['IDconteudo'] ?? rand(1, 100);
                
                if ($conteudo['Tipo'] == 'Curso') {
                    $img = "https://picsum.photos/seed/curso{$id}/600/400";
                } elseif ($conteudo['Tipo'] == 'Ebook') {
                    $cores = ['5FA777', '4A90E2', 'E89A3C', 'D96459', '9B59B6'];
                    $cor = $cores[$id % count($cores)];
                    $titulo = urlencode(substr($conteudo['Titulo'], 0, 30));
                    $img = "https://via.placeholder.com/600x800/{$cor}/ffffff?text={$titulo}";
                } elseif ($conteudo['Tipo'] == 'Palestra') {
                    $img = "https://picsum.photos/seed/palestra{$id}/600/400";
                } else { // Explicações
                    $img = "https://i.pravatar.cc/600?img=" . ($id % 70 + 1);
                }
            }
            
            // Alt text otimizado para SEO
            $alt_text = $tipo_formatado . " de " . $conteudo['Titulo'] . " - StudyHub Santarém";
            ?>
            <img src="<?= htmlspecialchars($img) ?>" 
                 alt="<?= htmlspecialchars($alt_text) ?>" 
                 itemprop="image"
                 title="<?= htmlspecialchars($conteudo['Titulo']) ?>"
                 loading="lazy"
                 width="600"
                 height="400"
                 style="width: 100%; height: auto; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        </div>

        <!-- ==================== DETALHES DO PRODUTO ==================== -->
        <div class="prod-detalhes">
            <span style="background: #eee; padding: 5px 15px; border-radius: 20px; font-size: 0.9em; display: inline-block; margin-bottom: 10px;">
                <?= ucfirst($tipo_formatado) ?>
            </span>
            
            <h2 style="font-size: 2.5em; margin: 15px 0;" itemprop="name"><?= htmlspecialchars($conteudo['Titulo']) ?></h2>
            
            <?php if (!empty($conteudo['Info_Extra'])): ?>
            <div style="font-size: 1.2em; color: #666; margin-bottom: 20px; line-height: 1.6;" itemprop="description">
                <?= nl2br(htmlspecialchars($conteudo['Info_Extra'])) ?>
            </div>
            <?php endif; ?>

            <!-- ==================== INFORMAÇÕES ESPECÍFICAS POR TIPO ==================== -->
            <div style="background: #f9f9f9; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                <?php if ($conteudo['Tipo'] == 'Curso'): ?>
                    <?php if (!empty($conteudo['Data_Inicio'])): ?>
                    <p style="margin: 8px 0;"><strong>📅 Início:</strong> <time itemprop="startDate" datetime="<?= $conteudo['Data_Inicio'] ?>"><?= date('d/m/Y', strtotime($conteudo['Data_Inicio'])) ?></time></p>
                    <?php endif; ?>
                    <?php 
                    $vagasDisponiveis = ($conteudo['Vagas_Totais'] ?? 0) - ($conteudo['Vagas_Preenchidas'] ?? 0);
                    if ($vagasDisponiveis > 0):
                    ?>
                    <p style="margin: 8px 0;"><strong>👥 Vagas:</strong> <span itemprop="maximumAttendeeCapacity"><?= $vagasDisponiveis ?></span> disponíveis</p>
                    <?php endif; ?>
                    
                <?php elseif ($conteudo['Tipo'] == 'Ebook'): ?>
                    <?php if (!empty($conteudo['Num_Paginas'])): ?>
                    <p style="margin: 8px 0;"><strong>📖 Páginas:</strong> <span itemprop="numberOfPages"><?= $conteudo['Num_Paginas'] ?></span></p>
                    <?php endif; ?>
                    <p style="margin: 8px 0;"><strong>📄 Formato:</strong> <span itemprop="bookFormat">Digital (PDF/EPUB)</span></p>
                    <p style="margin: 8px 0;"><strong>🌍 Idioma:</strong> <span itemprop="inLanguage">Português</span></p>
                    
                <?php elseif ($conteudo['Tipo'] == 'Palestra'): ?>
                    <?php if (!empty($conteudo['Localizacao'])): ?>
                    <p style="margin: 8px 0;"><strong>📍 Local:</strong> <span itemprop="location"><?= htmlspecialchars($conteudo['Localizacao']) ?></span></p>
                    <?php endif; ?>
                    <?php if (!empty($conteudo['Data_Evento'])): ?>
                    <p style="margin: 8px 0;"><strong>⏰ Data:</strong> <time itemprop="startDate" datetime="<?= $conteudo['Data_Evento'] ?>"><?= date('d/m/Y H:i', strtotime($conteudo['Data_Evento'])) ?></time></p>
                    <?php endif; ?>
                    
                <?php else: // Explicações ?>
                    <?php if (!empty($conteudo['Nivel'])): ?>
                    <p style="margin: 8px 0;"><strong>🎓 Nível:</strong> <?= htmlspecialchars($conteudo['Nivel']) ?></p>
                    <?php endif; ?>
                    <p style="margin: 8px 0;"><strong>💻 Formato:</strong> Online (videochamada)</p>
                    <p style="margin: 8px 0;"><strong>📍 Localização:</strong> Santarém, Portugal</p>
                <?php endif; ?>
                
                <?php if (!empty($conteudo['Avaliacao'])): ?>
                    <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                        <p style="margin: 8px 0;">
                            <strong>⭐ Avaliação:</strong> 
                            <span itemprop="ratingValue"><?= $conteudo['Avaliacao'] ?></span>/5
                            <meta itemprop="bestRating" content="5">
                            <meta itemprop="worstRating" content="1">
                            <meta itemprop="ratingCount" content="1">
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- ==================== PREÇO E BOTÃO DE AÇÃO ==================== -->
            <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <meta itemprop="priceCurrency" content="EUR">
                <meta itemprop="url" content="<?= $site_url ?>/conteudo.php?slug=<?= $slug ?>">
                <meta itemprop="availability" content="https://schema.org/<?= ($conteudo['Disponibilidade'] == 1) ? 'InStock' : 'OutOfStock' ?>">
                
                <h3 style="color: #E89A3C; font-size: 2em; margin: 0;" itemprop="price" content="<?= $conteudo['Preco'] ?>">
                    <?= ($conteudo['Preco'] > 0) ? "€" . number_format($conteudo['Preco'], 2, ',', '.') : "Gratuito" ?>
                </h3>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="inscrever.php" method="POST" onsubmit="return handleInscricao(event);">
                        <input type="hidden" name="idConteudo" value="<?= $conteudo['IDconteudo'] ?>">
                        <input type="hidden" id="conteudo_tipo" value="<?= $conteudo['Tipo'] ?>">
                        <input type="hidden" id="conteudo_titulo" value="<?= htmlspecialchars($conteudo['Titulo']) ?>">
                        <input type="hidden" id="conteudo_preco" value="<?= $conteudo['Preco'] ?>">
                        <input type="hidden" id="conteudo_id" value="<?= $conteudo['IDconteudo'] ?>">
                        
                        <button type="submit" 
                                style="padding: 15px 40px; background: #E89A3C; color: white; border: none; border-radius: 30px; font-weight: bold; cursor: pointer; font-size: 16px; transition: all 0.3s;"
                                aria-label="<?php 
                                    if($conteudo['Tipo'] == 'Ebook') echo "Baixar ebook " . htmlspecialchars($conteudo['Titulo']);
                                    elseif($conteudo['Tipo'] == 'Palestra') echo "Reservar lugar na palestra " . htmlspecialchars($conteudo['Titulo']);
                                    elseif(in_array($conteudo['Tipo'], ['Explicacoes', 'Explicação', 'Explicacao'])) echo "Agendar explicação de " . htmlspecialchars($conteudo['Titulo']);
                                    else echo "Inscrever no curso " . htmlspecialchars($conteudo['Titulo']);
                                ?>">
                            <?php 
                                if($conteudo['Tipo'] == 'Ebook') echo "📥 Baixar Ebook";
                                elseif($conteudo['Tipo'] == 'Palestra') echo "🎫 Reservar Lugar";
                                elseif(in_array($conteudo['Tipo'], ['Explicacoes', 'Explicação', 'Explicacao'])) echo "📅 Agendar Explicação";
                                else echo "✅ Inscrever Agora";
                            ?>
                        </button>
                    </form>
                    
                    <script>
                    function handleInscricao(event) {
                        var tipo = document.getElementById('conteudo_tipo').value;
                        var titulo = document.getElementById('conteudo_titulo').value;
                        var preco = parseFloat(document.getElementById('conteudo_preco').value) || 0;
                        var id = document.getElementById('conteudo_id').value;
                        
                        if (typeof StudyHubTracking !== 'undefined') {
                            if (tipo === 'Curso') {
                                StudyHubTracking.trackInscricaoCurso(id, titulo, preco);
                            } else if (tipo === 'Ebook') {
                                StudyHubTracking.trackDownloadEbook(id, titulo, preco);
                            } else if (tipo === 'Palestra') {
                                StudyHubTracking.trackReservaPalestra(id, titulo, preco);
                            } else {
                                StudyHubTracking.trackAgendamentoExplicacao(id, titulo, preco);
                            }
                        }
                        
                        return true;
                    }
                    </script>
                <?php else: ?>
                    <a href="login.php" 
                       style="padding: 15px 40px; background: #4A90E2; color: white; text-decoration: none; border-radius: 30px; font-weight: bold; display: inline-block;"
                       aria-label="Fazer login para inscrever em <?= htmlspecialchars($conteudo['Titulo']) ?>">
                        🔒 Fazer Login para Inscrever
                    </a>
                <?php endif; ?>
            </div>
            
            <!-- ==================== LINK DE VOLTAR ==================== -->
            <div style="margin-top: 20px;">
                <a href="<?php 
                    if($conteudo['Tipo'] == 'Curso') echo 'cursos.php';
                    elseif($conteudo['Tipo'] == 'Ebook') echo 'ebooks.php';
                    elseif($conteudo['Tipo'] == 'Palestra') echo 'palestras.php';
                    else echo 'explicacoes.php';
                ?>" style="color: #666; text-decoration: none; font-size: 14px;" aria-label="Voltar à lista de <?= strtolower($tipo_formatado) ?>s">
                    ← Voltar à lista
                </a>
            </div>
        </div>
    </article>
    
    <!-- ==================== SEO: CONTEÚDO ADICIONAL (TEXTO PARA INDEXAÇÃO) ==================== -->
    <?php if (!empty($conteudo['Info_Extra']) && strlen($conteudo['Info_Extra']) > 200): ?>
    <section style="margin-top: 60px; max-width: 800px;">
        <h2 style="color: #2c3e50; margin-bottom: 20px;">Sobre este <?= $tipo_formatado ?></h2>
        <div style="line-height: 1.8; color: #555;">
            <?= nl2br(htmlspecialchars($conteudo['Info_Extra'])) ?>
        </div>
    </section>
    <?php endif; ?>
    
    <!-- ==================== FAQ SCHEMA (SE APLICÁVEL) ==================== -->
    <?php if ($conteudo['Tipo'] == 'Curso' || in_array($conteudo['Tipo'], ['Explicacoes', 'Explicação'])): ?>
    <section style="margin-top: 60px; max-width: 800px;" itemscope itemtype="https://schema.org/FAQPage">
        <h2 style="color: #2c3e50; margin-bottom: 20px;">Perguntas Frequentes</h2>
        
        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" style="margin-bottom: 20px; padding: 15px; background: #f9f9f9; border-radius: 8px;">
            <h3 itemprop="name" style="font-size: 1.1em; color: #2c3e50; margin-bottom: 10px;">Como funciona a inscrição?</h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div itemprop="text" style="color: #555; line-height: 1.6;">
                    Basta clicar no botão "Inscrever Agora" e seguir as instruções. Receberás um email de confirmação com todos os detalhes.
                </div>
            </div>
        </div>
        
        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" style="margin-bottom: 20px; padding: 15px; background: #f9f9f9; border-radius: 8px;">
            <h3 itemprop="name" style="font-size: 1.1em; color: #2c3e50; margin-bottom: 10px;">Posso cancelar a minha inscrição?</h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div itemprop="text" style="color: #555; line-height: 1.6;">
                    Sim, podes cancelar a qualquer momento através do teu perfil ou contactando o nosso suporte.
                </div>
            </div>
        </div>
        
        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" style="margin-bottom: 20px; padding: 15px; background: #f9f9f9; border-radius: 8px;">
            <h3 itemprop="name" style="font-size: 1.1em; color: #2c3e50; margin-bottom: 10px;">Recebo certificado?</h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div itemprop="text" style="color: #555; line-height: 1.6;">
                    <?php if ($conteudo['Tipo'] == 'Curso'): ?>
                    Sim! Ao completar o curso recebes um certificado digital reconhecido.
                    <?php else: ?>
                    Após as sessões, fornecemos um comprovativo de participação.
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
</main>

<style>
@media (max-width: 768px) {
    main article {
        grid-template-columns: 1fr !important;
    }
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(232, 154, 60, 0.3);
}
</style>

<?php include 'footer.php'; ?>