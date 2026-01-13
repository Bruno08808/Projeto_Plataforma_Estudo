/**
 * STUDYHUB - ANALYTICS TRACKING SYSTEM
 * Sistema de rastreamento de eventos para Google Analytics
 * 
 * @version 1.0
 * @author StudyHub Team
 */

(function() {
    'use strict';
    
    // Verificar se gtag existe
    if (typeof gtag === 'undefined') {
        console.warn('⚠️ Google Analytics não carregado. Tracking desativado.');
        return;
    }
    
    // ==================== SISTEMA DE TRACKING ====================
    
    window.StudyHubTracking = {
        
        /**
         * Rastreia pesquisas realizadas
         */
        trackPesquisa: function(termo, categoria, resultados) {
            try {
                gtag('event', 'search', {
                    'search_term': termo,
                    'event_category': 'Pesquisa',
                    'event_label': categoria,
                    'value': resultados
                });
                console.log('✅ Pesquisa rastreada:', termo);
            } catch (e) {
                console.error('❌ Erro ao rastrear pesquisa:', e);
            }
        },
        
        /**
         * Rastreia cliques em "Ver Mais"
         */
        trackVerMais: function(tipo, titulo, id) {
            try {
                gtag('event', 'view_item', {
                    'event_category': 'Conteúdo',
                    'event_label': tipo + ': ' + titulo,
                    'value': id
                });
                console.log('✅ Ver Mais rastreado:', titulo);
            } catch (e) {
                console.error('❌ Erro ao rastrear Ver Mais:', e);
            }
        },
        
        /**
         * Rastreia inscrições em cursos
         */
        trackInscricaoCurso: function(id, nome, preco) {
            try {
                gtag('event', 'purchase', {
                    'transaction_id': 'curso_' + id + '_' + Date.now(),
                    'value': preco,
                    'currency': 'EUR',
                    'items': [{
                        'item_id': id,
                        'item_name': nome,
                        'item_category': 'Curso',
                        'price': preco,
                        'quantity': 1
                    }]
                });
                console.log('✅ Inscrição em curso rastreada:', nome);
            } catch (e) {
                console.error('❌ Erro ao rastrear inscrição:', e);
            }
        },
        
        /**
         * Rastreia downloads de ebooks
         */
        trackDownloadEbook: function(id, nome, preco) {
            try {
                gtag('event', 'purchase', {
                    'transaction_id': 'ebook_' + id + '_' + Date.now(),
                    'value': preco,
                    'currency': 'EUR',
                    'items': [{
                        'item_id': id,
                        'item_name': nome,
                        'item_category': 'Ebook',
                        'price': preco,
                        'quantity': 1
                    }]
                });
                console.log('✅ Download de ebook rastreado:', nome);
            } catch (e) {
                console.error('❌ Erro ao rastrear download:', e);
            }
        },
        
        /**
         * Rastreia reservas de palestras
         */
        trackReservaPalestra: function(id, nome, preco) {
            try {
                gtag('event', 'purchase', {
                    'transaction_id': 'palestra_' + id + '_' + Date.now(),
                    'value': preco,
                    'currency': 'EUR',
                    'items': [{
                        'item_id': id,
                        'item_name': nome,
                        'item_category': 'Palestra',
                        'price': preco,
                        'quantity': 1
                    }]
                });
                console.log('✅ Reserva de palestra rastreada:', nome);
            } catch (e) {
                console.error('❌ Erro ao rastrear reserva:', e);
            }
        },
        
        /**
         * Rastreia agendamentos de explicações
         */
        trackAgendamentoExplicacao: function(id, nome, preco) {
            try {
                gtag('event', 'purchase', {
                    'transaction_id': 'explicacao_' + id + '_' + Date.now(),
                    'value': preco,
                    'currency': 'EUR',
                    'items': [{
                        'item_id': id,
                        'item_name': nome,
                        'item_category': 'Explicacao',
                        'price': preco,
                        'quantity': 1
                    }]
                });
                console.log('✅ Agendamento de explicação rastreado:', nome);
            } catch (e) {
                console.error('❌ Erro ao rastrear agendamento:', e);
            }
        },
        
        /**
         * Rastreia cliques em botões CTA
         */
        trackCTA: function(nome, localizacao) {
            try {
                gtag('event', 'click', {
                    'event_category': 'CTA',
                    'event_label': nome,
                    'value': localizacao
                });
                console.log('✅ CTA rastreado:', nome);
            } catch (e) {
                console.error('❌ Erro ao rastrear CTA:', e);
            }
        }
    };
    
    console.log('📊 Analytics Tracking System inicializado');
    
})();