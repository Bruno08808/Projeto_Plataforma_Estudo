/**
 * STUDYHUB - COOKIE CONSENT BANNER
 * Sistema completo de gestão de consentimento de cookies (GDPR/LGPD)
 * Integrado com Google Analytics
 * 
 * @version 1.0
 * @author Claude
 */

(function() {
    'use strict';
    
    // ==================== CONFIGURAÇÕES ====================
    const CONFIG = {
        cookieName: 'studyhub_cookie_consent',
        cookieExpireDays: 365,
        analyticsEnabled: false, // Começa desativado até o usuário aceitar
        showDelay: 1000, // Delay de 1 segundo para mostrar o banner
    };
    
    // ==================== FUNÇÕES DE COOKIES ====================
    
    /**
     * Define um cookie
     */
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/;SameSite=Lax";
    }
    
    /**
     * Obtém um cookie
     */
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    
    /**
     * Remove um cookie
     */
    function deleteCookie(name) {
        document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
    }
    
    // ==================== GOOGLE ANALYTICS CONTROL ====================
    
    /**
     * Ativa o Google Analytics
     */
    function enableAnalytics() {
        if (typeof gtag !== 'undefined') {
            // Ativar Analytics
            gtag('consent', 'update', {
                'analytics_storage': 'granted'
            });
            
            CONFIG.analyticsEnabled = true;
            console.log('✅ Google Analytics ATIVADO');
            
            // Enviar evento de consentimento
            gtag('event', 'cookie_consent_granted', {
                'event_category': 'privacidade',
                'event_label': 'Consentimento Aceito'
            });
        }
    }
    
    /**
     * Desativa o Google Analytics
     */
    function disableAnalytics() {
        if (typeof gtag !== 'undefined') {
            // Desativar Analytics
            gtag('consent', 'update', {
                'analytics_storage': 'denied'
            });
            
            CONFIG.analyticsEnabled = false;
            console.log('❌ Google Analytics DESATIVADO');
            
            // Limpar cookies do Analytics
            deleteCookie('_ga');
            deleteCookie('_gid');
            deleteCookie('_gat');
        }
    }
    
    /**
     * Inicializa Analytics com consentimento pendente
     */
    function initializeAnalyticsConsent() {
        if (typeof gtag !== 'undefined') {
            // Definir estado inicial como negado
            gtag('consent', 'default', {
                'analytics_storage': 'denied',
                'ad_storage': 'denied',
                'wait_for_update': 500
            });
        }
    }
    
    // ==================== BANNER HTML ====================
    
    /**
     * Cria o HTML do banner
     */
    function createBannerHTML() {
        return `
            <div id="cookie-banner" class="cookie-banner" role="dialog" aria-labelledby="cookie-banner-title" aria-describedby="cookie-banner-description">
                <div class="cookie-banner-content">
                    <div class="cookie-banner-icon">
                        🍪
                    </div>
                    <div class="cookie-banner-text">
                        <h3 id="cookie-banner-title">Este site utiliza cookies</h3>
                        <p id="cookie-banner-description">
                            Utilizamos cookies para melhorar a tua experiência, analisar o tráfego do site e personalizar conteúdo. 
                            Ao clicar em "Aceitar", concordas com o uso de cookies.
                            <a href="privacidade.php" class="cookie-banner-link" target="_blank">Saber mais</a>
                        </p>
                    </div>
                    <div class="cookie-banner-actions">
                        <button id="cookie-accept" class="cookie-btn cookie-btn-accept" aria-label="Aceitar cookies">
                            ✓ Aceitar
                        </button>
                        <button id="cookie-reject" class="cookie-btn cookie-btn-reject" aria-label="Rejeitar cookies">
                            ✕ Rejeitar
                        </button>
                        <button id="cookie-settings" class="cookie-btn cookie-btn-settings" aria-label="Configurar cookies">
                            ⚙ Configurar
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Modal de Configurações -->
            <div id="cookie-settings-modal" class="cookie-modal" role="dialog" aria-labelledby="cookie-settings-title" style="display: none;">
                <div class="cookie-modal-content">
                    <div class="cookie-modal-header">
                        <h2 id="cookie-settings-title">Configurações de Cookies</h2>
                        <button id="cookie-modal-close" class="cookie-modal-close" aria-label="Fechar">&times;</button>
                    </div>
                    <div class="cookie-modal-body">
                        <div class="cookie-category">
                            <div class="cookie-category-header">
                                <input type="checkbox" id="cookie-essential" checked disabled>
                                <label for="cookie-essential">
                                    <strong>Cookies Essenciais</strong>
                                    <span class="cookie-required">(Obrigatório)</span>
                                </label>
                            </div>
                            <p class="cookie-category-description">
                                Necessários para o funcionamento básico do site, como autenticação e segurança.
                            </p>
                        </div>
                        
                        <div class="cookie-category">
                            <div class="cookie-category-header">
                                <input type="checkbox" id="cookie-analytics" checked>
                                <label for="cookie-analytics">
                                    <strong>Cookies Analíticos</strong>
                                </label>
                            </div>
                            <p class="cookie-category-description">
                                Ajudam-nos a entender como os visitantes interagem com o site, recolhendo e reportando informações anonimamente.
                            </p>
                        </div>
                        
                        <div class="cookie-category">
                            <div class="cookie-category-header">
                                <input type="checkbox" id="cookie-marketing" disabled>
                                <label for="cookie-marketing">
                                    <strong>Cookies de Marketing</strong>
                                    <span class="cookie-coming-soon">(Em breve)</span>
                                </label>
                            </div>
                            <p class="cookie-category-description">
                                Usados para rastrear visitantes em websites para mostrar anúncios relevantes.
                            </p>
                        </div>
                    </div>
                    <div class="cookie-modal-footer">
                        <button id="cookie-save-settings" class="cookie-btn cookie-btn-accept">
                            Guardar Preferências
                        </button>
                        <button id="cookie-accept-all" class="cookie-btn cookie-btn-primary">
                            Aceitar Tudo
                        </button>
                    </div>
                </div>
            </div>
        `;
    }
    
    /**
     * Cria os estilos CSS
     */
    function createBannerStyles() {
        const style = document.createElement('style');
        style.textContent = `
            /* Cookie Banner */
            .cookie-banner {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
                color: #ecf0f1;
                padding: 25px 20px;
                box-shadow: 0 -5px 25px rgba(0, 0, 0, 0.3);
                z-index: 10000;
                animation: slideUp 0.5s ease-out;
                border-top: 3px solid #E89A3C;
            }
            
            @keyframes slideUp {
                from {
                    transform: translateY(100%);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
            
            .cookie-banner-content {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                align-items: center;
                gap: 25px;
                flex-wrap: wrap;
            }
            
            .cookie-banner-icon {
                font-size: 48px;
                animation: bounce 2s infinite;
            }
            
            @keyframes bounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            
            .cookie-banner-text {
                flex: 1;
                min-width: 300px;
            }
            
            .cookie-banner-text h3 {
                margin: 0 0 10px 0;
                font-size: 1.3em;
                color: #fff;
            }
            
            .cookie-banner-text p {
                margin: 0;
                line-height: 1.6;
                color: #bdc3c7;
                font-size: 0.95em;
            }
            
            .cookie-banner-link {
                color: #E89A3C;
                text-decoration: underline;
                font-weight: 500;
            }
            
            .cookie-banner-link:hover {
                color: #f1a94e;
            }
            
            .cookie-banner-actions {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
            }
            
            .cookie-btn {
                padding: 12px 24px;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 0.95em;
                white-space: nowrap;
            }
            
            .cookie-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            }
            
            .cookie-btn-accept {
                background: #27ae60;
                color: white;
            }
            
            .cookie-btn-accept:hover {
                background: #229954;
            }
            
            .cookie-btn-reject {
                background: #e74c3c;
                color: white;
            }
            
            .cookie-btn-reject:hover {
                background: #c0392b;
            }
            
            .cookie-btn-settings {
                background: #95a5a6;
                color: white;
            }
            
            .cookie-btn-settings:hover {
                background: #7f8c8d;
            }
            
            .cookie-btn-primary {
                background: #E89A3C;
                color: white;
            }
            
            .cookie-btn-primary:hover {
                background: #d68a2e;
            }
            
            /* Cookie Modal */
            .cookie-modal {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.7);
                z-index: 10001;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                animation: fadeIn 0.3s ease-out;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            
            .cookie-modal-content {
                background: white;
                border-radius: 15px;
                max-width: 600px;
                width: 100%;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
                animation: slideDown 0.3s ease-out;
            }
            
            @keyframes slideDown {
                from {
                    transform: translateY(-50px);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
            
            .cookie-modal-header {
                padding: 25px;
                border-bottom: 2px solid #ecf0f1;
                display: flex;
                justify-content: space-between;
                align-items: center;
                background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
                color: white;
                border-radius: 15px 15px 0 0;
            }
            
            .cookie-modal-header h2 {
                margin: 0;
                font-size: 1.5em;
            }
            
            .cookie-modal-close {
                background: none;
                border: none;
                font-size: 32px;
                cursor: pointer;
                color: white;
                line-height: 1;
                padding: 0;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                transition: all 0.3s ease;
            }
            
            .cookie-modal-close:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: rotate(90deg);
            }
            
            .cookie-modal-body {
                padding: 25px;
            }
            
            .cookie-category {
                margin-bottom: 25px;
                padding: 15px;
                border: 2px solid #ecf0f1;
                border-radius: 10px;
                transition: all 0.3s ease;
            }
            
            .cookie-category:hover {
                border-color: #E89A3C;
                background: #fefaf5;
            }
            
            .cookie-category-header {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 10px;
            }
            
            .cookie-category-header input[type="checkbox"] {
                width: 20px;
                height: 20px;
                cursor: pointer;
            }
            
            .cookie-category-header label {
                cursor: pointer;
                flex: 1;
                font-size: 1.05em;
            }
            
            .cookie-required, .cookie-coming-soon {
                font-size: 0.85em;
                color: #7f8c8d;
                font-weight: normal;
            }
            
            .cookie-category-description {
                margin: 0;
                padding-left: 32px;
                color: #7f8c8d;
                font-size: 0.9em;
                line-height: 1.6;
            }
            
            .cookie-modal-footer {
                padding: 25px;
                border-top: 2px solid #ecf0f1;
                display: flex;
                gap: 12px;
                justify-content: flex-end;
                flex-wrap: wrap;
            }
            
            /* Responsive */
            @media (max-width: 768px) {
                .cookie-banner-content {
                    flex-direction: column;
                    text-align: center;
                }
                
                .cookie-banner-icon {
                    font-size: 36px;
                }
                
                .cookie-banner-actions {
                    width: 100%;
                    justify-content: center;
                }
                
                .cookie-btn {
                    flex: 1;
                    min-width: auto;
                }
                
                .cookie-modal-footer {
                    flex-direction: column;
                }
                
                .cookie-modal-footer .cookie-btn {
                    width: 100%;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    // ==================== LÓGICA PRINCIPAL ====================
    
    /**
     * Aceita os cookies
     */
    function acceptCookies(analyticsOnly = false) {
        if (analyticsOnly) {
            setCookie(CONFIG.cookieName, 'analytics_only', CONFIG.cookieExpireDays);
        } else {
            setCookie(CONFIG.cookieName, 'accepted', CONFIG.cookieExpireDays);
        }
        
        enableAnalytics();
        hideBanner();
    }
    
    /**
     * Rejeita os cookies
     */
    function rejectCookies() {
        setCookie(CONFIG.cookieName, 'rejected', CONFIG.cookieExpireDays);
        disableAnalytics();
        hideBanner();
    }
    
    /**
     * Esconde o banner
     */
    function hideBanner() {
        const banner = document.getElementById('cookie-banner');
        if (banner) {
            banner.style.animation = 'slideDown 0.5s ease-out reverse';
            setTimeout(() => {
                banner.remove();
            }, 500);
        }
    }
    
    /**
     * Mostra o modal de configurações
     */
    function showSettingsModal() {
        const modal = document.getElementById('cookie-settings-modal');
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }
    
    /**
     * Esconde o modal de configurações
     */
    function hideSettingsModal() {
        const modal = document.getElementById('cookie-settings-modal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }
    }
    
    /**
     * Salva as preferências do modal
     */
    function saveSettings() {
        const analyticsCheckbox = document.getElementById('cookie-analytics');
        
        if (analyticsCheckbox && analyticsCheckbox.checked) {
            acceptCookies(true);
        } else {
            rejectCookies();
        }
        
        hideSettingsModal();
    }
    
    /**
     * Verifica o consentimento e mostra o banner se necessário
     */
    function checkConsent() {
        const consent = getCookie(CONFIG.cookieName);
        
        if (!consent) {
            // Não há consentimento - mostrar banner após delay
            setTimeout(() => {
                showBanner();
            }, CONFIG.showDelay);
        } else if (consent === 'accepted' || consent === 'analytics_only') {
            // Consentimento dado - ativar analytics
            enableAnalytics();
        } else if (consent === 'rejected') {
            // Consentimento negado - garantir que analytics está desativado
            disableAnalytics();
        }
    }
    
    /**
     * Mostra o banner
     */
    function showBanner() {
        // Criar estilos
        createBannerStyles();
        
        // Criar e inserir HTML
        const bannerHTML = createBannerHTML();
        document.body.insertAdjacentHTML('beforeend', bannerHTML);
        
        // Event listeners
        document.getElementById('cookie-accept').addEventListener('click', () => acceptCookies());
        document.getElementById('cookie-reject').addEventListener('click', rejectCookies);
        document.getElementById('cookie-settings').addEventListener('click', showSettingsModal);
        document.getElementById('cookie-modal-close').addEventListener('click', hideSettingsModal);
        document.getElementById('cookie-save-settings').addEventListener('click', saveSettings);
        document.getElementById('cookie-accept-all').addEventListener('click', () => {
            hideSettingsModal();
            acceptCookies();
        });
        
        // Fechar modal ao clicar fora
        document.getElementById('cookie-settings-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideSettingsModal();
            }
        });
    }
    
    // ==================== EXPORTAR PARA USO GLOBAL ====================
    
    window.CookieConsent = {
        accept: acceptCookies,
        reject: rejectCookies,
        show: showBanner,
        hide: hideBanner,
        getConsent: () => getCookie(CONFIG.cookieName),
        isAnalyticsEnabled: () => CONFIG.analyticsEnabled,
        showSettings: showSettingsModal
    };
    
    // ==================== INICIALIZAÇÃO ====================
    
    // Inicializar consent mode do Analytics
    initializeAnalyticsConsent();
    
    // Verificar consentimento quando DOM estiver pronto
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', checkConsent);
    } else {
        checkConsent();
    }
    
    console.log('🍪 Cookie Consent System inicializado');
    
})();