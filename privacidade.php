<?php
$page_title = "Política de Privacidade | StudyHub";
$page_css = "";

$breadcrumbs = [
    ['name' => 'Início', 'url' => 'index.php'],
    ['name' => 'Política de Privacidade', 'url' => '']
];

include 'header.php';
?>

<main class="container" style="max-width: 900px; margin: 50px auto; padding: 0 20px;">
    <article style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
        
        <h1 style="color: #2c3e50; margin-bottom: 10px;">Política de Privacidade</h1>
        <p style="color: #7f8c8d; margin-bottom: 40px;">Última atualização: <?php echo date('d/m/Y'); ?></p>
        
        <section style="margin-bottom: 40px;">
            <h2 style="color: #E89A3C; margin-bottom: 15px;">1. Informações que Recolhemos</h2>
            <p style="line-height: 1.8; color: #555;">
                No StudyHub, recolhemos as seguintes informações:
            </p>
            <ul style="line-height: 1.8; color: #555; margin-left: 20px;">
                <li><strong>Informações de Conta:</strong> Nome, email, idade quando te registas.</li>
                <li><strong>Informações de Uso:</strong> Páginas visitadas, cursos visualizados, tempo no site.</li>
                <li><strong>Informações Técnicas:</strong> Endereço IP, tipo de navegador, dispositivo.</li>
                <li><strong>Cookies:</strong> Pequenos ficheiros armazenados no teu navegador para melhorar a experiência.</li>
            </ul>
        </section>
        
        <section style="margin-bottom: 40px;">
            <h2 style="color: #E89A3C; margin-bottom: 15px;">2. Como Usamos as Informações</h2>
            <p style="line-height: 1.8; color: #555;">
                Utilizamos as tuas informações para:
            </p>
            <ul style="line-height: 1.8; color: #555; margin-left: 20px;">
                <li>Fornecer e melhorar os nossos serviços</li>
                <li>Personalizar a tua experiência de aprendizagem</li>
                <li>Comunicar sobre cursos, ebooks e novidades</li>
                <li>Analisar o uso da plataforma (através do Google Analytics)</li>
                <li>Garantir a segurança da plataforma</li>
            </ul>
        </section>
        
        <section style="margin-bottom: 40px;">
            <h2 style="color: #E89A3C; margin-bottom: 15px;">3. Cookies e Tecnologias Semelhantes</h2>
            <p style="line-height: 1.8; color: #555; margin-bottom: 15px;">
                Utilizamos cookies para melhorar a tua experiência. Os cookies são pequenos ficheiros de texto armazenados no teu dispositivo.
            </p>
            
            <h3 style="color: #2c3e50; margin: 20px 0 10px 0; font-size: 1.1em;">Tipos de Cookies que Usamos:</h3>
            
            <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 15px;">
                <h4 style="color: #27ae60; margin: 0 0 10px 0;">🔒 Cookies Essenciais (Obrigatórios)</h4>
                <p style="margin: 0; color: #555; line-height: 1.6;">
                    Necessários para o funcionamento básico do site, como manter a tua sessão iniciada e garantir segurança.
                </p>
            </div>
            
            <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 15px;">
                <h4 style="color: #3498db; margin: 0 0 10px 0;">📊 Cookies Analíticos (Opcional)</h4>
                <p style="margin: 0; color: #555; line-height: 1.6;">
                    Ajudam-nos a entender como os visitantes interagem com o site através do Google Analytics. 
                    Estes dados são anónimos e usados apenas para melhorar a plataforma.
                </p>
            </div>
            
            <div style="background: #fff3cd; padding: 20px; border-radius: 10px; border-left: 4px solid #E89A3C;">
                <h4 style="color: #856404; margin: 0 0 10px 0;">⚙️ Como Gerir Cookies</h4>
                <p style="margin: 0 0 10px 0; color: #555; line-height: 1.6;">
                    Podes gerir as tuas preferências de cookies a qualquer momento:
                </p>
                <button onclick="CookieConsent.showSettings()" style="background: #E89A3C; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                    ⚙️ Configurar Cookies
                </button>
            </div>
        </section>
        
        <section style="margin-bottom: 40px;">
            <h2 style="color: #E89A3C; margin-bottom: 15px;">4. Google Analytics</h2>
            <p style="line-height: 1.8; color: #555;">
                Utilizamos o Google Analytics para analisar o uso do nosso site. O Google Analytics usa cookies para recolher informações anónimas sobre:
            </p>
            <ul style="line-height: 1.8; color: #555; margin-left: 20px;">
                <li>Páginas visitadas e tempo de visita</li>
                <li>Origem do tráfego (Google, redes sociais, etc.)</li>
                <li>Dispositivo e navegador usado</li>
                <li>Localização geográfica aproximada</li>
            </ul>
            <p style="line-height: 1.8; color: #555;">
                <strong>Importante:</strong> Estas informações são completamente anónimas e não te identificam pessoalmente.
            </p>
        </section>
        
        <section style="margin-bottom: 40px;">
            <h2 style="color: #E89A3C; margin-bottom: 15px;">5. Partilha de Informações</h2>
            <p style="line-height: 1.8; color: #555;">
                <strong>Não vendemos</strong> as tuas informações pessoais. Podemos partilhar dados apenas com:
            </p>
            <ul style="line-height: 1.8; color: #555; margin-left: 20px;">
                <li><strong>Google Analytics:</strong> Para análise anónima de uso</li>
                <li><strong>Autoridades:</strong> Se legalmente obrigados</li>
                <li><strong>Processadores de Pagamento:</strong> Para processar transações (se aplicável)</li>
            </ul>
        </section>
        
        <section style="margin-bottom: 40px;">
            <h2 style="color: #E89A3C; margin-bottom: 15px;">6. Os Teus Direitos (GDPR/LGPD)</h2>
            <p style="line-height: 1.8; color: #555;">
                Tens direito a:
            </p>
            <ul style="line-height: 1.8; color: #555; margin-left: 20px;">
                <li><strong>Acesso:</strong> Solicitar cópia dos teus dados</li>
                <li><strong>Retificação:</strong> Corrigir dados incorretos</li>
                <li><strong>Eliminação:</strong> Solicitar remoção dos teus dados</li>
                <li><strong>Portabilidade:</strong> Receber os teus dados em formato estruturado</li>
                <li><strong>Oposição:</strong> Opor-te ao processamento dos teus dados</li>
                <li><strong>Retirar Consentimento:</strong> Retirar consentimento dado anteriormente</li>
            </ul>
        </section>
        
        <section style="margin-bottom: 40px;">
            <h2 style="color: #E89A3C; margin-bottom: 15px;">7. Segurança</h2>
            <p style="line-height: 1.8; color: #555;">
                Implementamos medidas de segurança adequadas para proteger as tuas informações, incluindo:
            </p>
            <ul style="line-height: 1.8; color: #555; margin-left: 20px;">
                <li>Encriptação de dados sensíveis</li>
                <li>Acesso restrito a informações pessoais</li>
                <li>Monitorização contínua de segurança</li>
                <li>Backups regulares</li>
            </ul>
        </section>
        
        <section style="margin-bottom: 40px;">
            <h2 style="color: #E89A3C; margin-bottom: 15px;">8. Retenção de Dados</h2>
            <p style="line-height: 1.8; color: #555;">
                Mantemos os teus dados enquanto a tua conta estiver ativa ou conforme necessário para fornecer os serviços. 
                Podes solicitar a eliminação da tua conta a qualquer momento.
            </p>
        </section>
        
        <section style="margin-bottom: 40px;">
            <h2 style="color: #E89A3C; margin-bottom: 15px;">9. Alterações a Esta Política</h2>
            <p style="line-height: 1.8; color: #555;">
                Podemos atualizar esta política periodicamente. Notificaremos sobre mudanças significativas através de:
            </p>
            <ul style="line-height: 1.8; color: #555; margin-left: 20px;">
                <li>Aviso no site</li>
                <li>Email (se aplicável)</li>
                <li>Atualização da data no topo desta página</li>
            </ul>
        </section>
        
        <section style="background: #e8f5e9; padding: 30px; border-radius: 10px; border-left: 4px solid #27ae60;">
            <h2 style="color: #27ae60; margin-bottom: 15px;">📧 Contacto</h2>
            <p style="line-height: 1.8; color: #555; margin-bottom: 15px;">
                Se tiveres questões sobre esta Política de Privacidade ou quiseres exercer os teus direitos, contacta-nos:
            </p>
            <ul style="line-height: 1.8; color: #555; list-style: none; padding: 0;">
                <li><strong>Email:</strong> privacidade@studyhub.pt</li>
                <li><strong>Localização:</strong> Santarém, Portugal</li>
            </ul>
        </section>
        
        <div style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #ecf0f1; text-align: center;">
            <button onclick="CookieConsent.showSettings()" style="background: #E89A3C; color: white; border: none; padding: 15px 30px; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px; transition: all 0.3s ease;">
                ⚙️ Gerir Preferências de Cookies
            </button>
        </div>
        
    </article>
</main>

<style>
.container article h2 {
    margin-top: 30px;
}

.container article h3 {
    margin-top: 20px;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(232, 154, 60, 0.3);
}

@media (max-width: 768px) {
    .container article {
        padding: 20px;
    }
}
</style>

<?php include 'footer.php'; ?>