<?php
/**
 * CONFIGURAÇÃO SEO - STUDYHUB
 * Centraliza todas as configurações de SEO do site
 */

// ==================== INFORMAÇÕES BÁSICAS ====================
define('SITE_NAME', 'StudyHub');
define('SITE_URL', 'https://www.studyhub.pt'); // ALTERAR para o domínio real
define('SITE_LOCALE', 'pt_PT');
define('SITE_LOCATION', 'Santarém, Portugal');

// ==================== DESCRIÇÕES E PALAVRAS-CHAVE ====================
$seo_config = [
    'default' => [
        'title' => 'StudyHub - Plataforma de Educação Online | Cursos, Ebooks e Explicações',
        'description' => 'Plataforma de educação online com cursos, ebooks, palestras e explicações personalizadas. Ideal para estudantes universitários e profissionais em reconversão de carreira.',
        'keywords' => 'cursos online portugal, ebooks educacionais, explicações online, palestras educativas, formação online, reconversão profissional, estudantes universitários',
        'image' => SITE_URL . '/assets/images/og-default.jpg',
    ],
    
    'index' => [
        'title' => 'StudyHub - Aprende ao Teu Ritmo | Educação Online em Portugal',
        'description' => 'A melhor plataforma de estudo online com cursos, ebooks e palestras exclusivas. Aprende ao teu ritmo com conteúdo de qualidade para estudantes e profissionais.',
        'keywords' => 'plataforma educação online, cursos online portugal, ebooks portugal, estudar online, formação profissional',
    ],
    
    'cursos' => [
        'title' => 'Cursos Online Certificados | StudyHub Portugal',
        'description' => 'Descobre cursos online completos e certificados. Acesso vitalício, suporte do instrutor e aprende onde e quando quiseres. Ideal para reconversão profissional.',
        'keywords' => 'cursos online portugal, cursos certificados, formação online, cursos profissionais, aprender online',
    ],
    
    'ebooks' => [
        'title' => 'Biblioteca Digital de Ebooks | StudyHub',
        'description' => 'Milhares de ebooks para expandir o teu conhecimento. Download imediato de ebooks educacionais em PDF. Conteúdo para estudantes e profissionais.',
        'keywords' => 'ebooks educacionais, livros digitais, ebooks portugal, download ebooks, biblioteca digital',
    ],
    
    'palestras' => [
        'title' => 'Palestras Inspiradoras Online | StudyHub',
        'description' => 'Aprende com especialistas através de palestras online inspiradoras. Conteúdo exclusivo sobre tecnologia, negócios, desenvolvimento pessoal e muito mais.',
        'keywords' => 'palestras online, eventos educativos, conferências online, webinars portugal, palestras motivacionais',
    ],
    
    'explicacoes' => [
        'title' => 'Explicações Online Personalizadas | Professores Certificados',
        'description' => 'Explicações online one-on-one com os melhores professores. Aulas personalizadas por videochamada para estudantes universitários e ensino secundário.',
        'keywords' => 'explicações online, aulas particulares online, professores particulares, explicações portugal, apoio escolar online',
    ],
    
    'profile' => [
        'title' => 'Meu Perfil | StudyHub',
        'description' => 'Gere os teus cursos, ebooks e explicações. Acompanha o teu progresso de aprendizagem na plataforma StudyHub.',
        'keywords' => 'perfil estudante, meus cursos, progresso aprendizagem',
    ],
];

// ==================== SCHEMA.ORG - ORGANIZAÇÃO ====================
$organization_schema = [
    '@context' => 'https://schema.org',
    '@type' => 'EducationalOrganization',
    'name' => SITE_NAME,
    'url' => SITE_URL,
    'logo' => SITE_URL . '/assets/images/logo.png',
    'description' => 'Plataforma de educação online com cursos, ebooks, palestras e explicações personalizadas em Portugal',
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Santarém',
        'addressCountry' => 'PT',
    ],
    'sameAs' => [
        // Adicionar redes sociais quando disponíveis
        // 'https://www.facebook.com/studyhub',
        // 'https://www.instagram.com/studyhub',
    ],
];

// ==================== FUNÇÕES AUXILIARES ====================

/**
 * Retorna configuração SEO para uma página específica
 */
function getSeoConfig($page = 'default') {
    global $seo_config;
    return isset($seo_config[$page]) ? $seo_config[$page] : $seo_config['default'];
}

/**
 * Gera schema.org para curso
 */
function getCursoSchema($curso) {
    return [
        '@context' => 'https://schema.org',
        '@type' => 'Course',
        'name' => $curso['Titulo'],
        'description' => $curso['Info_Extra'] ?? '',
        'provider' => [
            '@type' => 'Organization',
            'name' => SITE_NAME,
            'url' => SITE_URL,
        ],
        'offers' => [
            '@type' => 'Offer',
            'price' => $curso['Preco'] ?? 0,
            'priceCurrency' => 'EUR',
        ],
        'aggregateRating' => !empty($curso['Avaliacao']) ? [
            '@type' => 'AggregateRating',
            'ratingValue' => $curso['Avaliacao'],
            'ratingCount' => 1,
        ] : null,
    ];
}

/**
 * Gera schema.org para ebook
 */
function getEbookSchema($ebook) {
    return [
        '@context' => 'https://schema.org',
        '@type' => 'Book',
        'name' => $ebook['Titulo'],
        'description' => $ebook['Info_Extra'] ?? '',
        'bookFormat' => 'EBook',
        'inLanguage' => 'pt-PT',
        'offers' => [
            '@type' => 'Offer',
            'price' => $ebook['Preco'] ?? 0,
            'priceCurrency' => 'EUR',
            'availability' => 'https://schema.org/InStock',
        ],
        'aggregateRating' => !empty($ebook['Avaliacao']) ? [
            '@type' => 'AggregateRating',
            'ratingValue' => $ebook['Avaliacao'],
            'ratingCount' => 1,
        ] : null,
    ];
}

/**
 * Gera schema.org para palestra
 */
function getPalestraSchema($palestra) {
    return [
        '@context' => 'https://schema.org',
        '@type' => 'Event',
        'name' => $palestra['Titulo'],
        'description' => $palestra['Info_Extra'] ?? '',
        'eventStatus' => 'https://schema.org/EventScheduled',
        'eventAttendanceMode' => 'https://schema.org/OnlineEventAttendanceMode',
        'location' => [
            '@type' => 'VirtualLocation',
            'url' => SITE_URL,
        ],
        'organizer' => [
            '@type' => 'Organization',
            'name' => SITE_NAME,
            'url' => SITE_URL,
        ],
        'offers' => [
            '@type' => 'Offer',
            'price' => $palestra['Preco'] ?? 0,
            'priceCurrency' => 'EUR',
        ],
    ];
}

/**
 * Gera breadcrumbs schema.org
 */
function getBreadcrumbSchema($items) {
    $itemListElement = [];
    foreach ($items as $index => $item) {
        $itemListElement[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $item['name'],
            'item' => $item['url'],
        ];
    }
    
    return [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $itemListElement,
    ];
}

/**
 * Retorna o schema da organização
 */
function getOrganizationSchema() {
    global $organization_schema;
    return $organization_schema;
}
?>