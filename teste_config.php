<?php
/**
 * FICHEIRO DE TESTE - StudyHub
 * Este ficheiro verifica se a configuração está correta
 * 
 * INSTRUÇÕES:
 * 1. Coloca este ficheiro na raiz do teu projeto
 * 2. Acede via browser: http://teusite.com/teste_config.php
 * 3. Verifica os resultados
 * 4. APAGA ESTE FICHEIRO depois de testar (por segurança)
 */

// Ativar exibição de erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>🔧 Teste de Configuração - StudyHub</h1>";
echo "<style>
body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
.success { color: green; font-weight: bold; }
.error { color: red; font-weight: bold; }
.warning { color: orange; font-weight: bold; }
.section { background: white; padding: 15px; margin: 15px 0; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
table { width: 100%; border-collapse: collapse; margin: 10px 0; }
th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
th { background: #4A90E2; color: white; }
</style>";

// ==========================================
// 1. TESTE DE FICHEIROS
// ==========================================
echo "<div class='section'>";
echo "<h2>📁 1. Verificação de Ficheiros</h2>";

$ficheiros_necessarios = [
    'model.php' => 'Funções da base de dados',
    'header.php' => 'Cabeçalho do site',
    'footer.php' => 'Rodapé do site',
    'index.php' => 'Página inicial',
    'cursos.php' => 'Página de cursos',
    'palestras.php' => 'Página de palestras',
    'ebooks.php' => 'Página de ebooks',
    'explicacoes.php' => 'Página de explicações',
    'login.php' => 'Página de login',
    'profile.php' => 'Página de perfil',
    'inscrever.php' => 'Processamento de inscrições'
];

foreach ($ficheiros_necessarios as $ficheiro => $descricao) {
    if (file_exists($ficheiro)) {
        echo "✅ <span class='success'>$ficheiro</span> - $descricao<br>";
    } else {
        echo "❌ <span class='error'>$ficheiro</span> - $descricao (FALTA!)<br>";
    }
}
echo "</div>";

// ==========================================
// 2. TESTE DE CONEXÃO À BD
// ==========================================
echo "<div class='section'>";
echo "<h2>🔌 2. Teste de Conexão à Base de Dados</h2>";

try {
    include 'model.php';
    $db = estabelecerConexao();
    echo "✅ <span class='success'>Conexão estabelecida com sucesso!</span><br>";
    
    // Testar se as tabelas existem
    echo "<h3>Verificação de Tabelas:</h3>";
    
    $tabelas = ['Conteudo', 'Utilizador', 'Inscricoes'];
    foreach ($tabelas as $tabela) {
        try {
            $stmt = $db->query("SELECT COUNT(*) as total FROM $tabela");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "✅ <span class='success'>Tabela '$tabela'</span> existe - <strong>{$result['total']} registos</strong><br>";
        } catch (PDOException $e) {
            echo "❌ <span class='error'>Tabela '$tabela'</span> não encontrada!<br>";
        }
    }
    
} catch (Exception $e) {
    echo "❌ <span class='error'>ERRO DE CONEXÃO:</span> " . $e->getMessage() . "<br>";
    echo "<p class='warning'>⚠️ Verifica as credenciais no ficheiro model.php</p>";
}
echo "</div>";

// ==========================================
// 3. TESTE DA ESTRUTURA DA TABELA CONTEUDO
// ==========================================
if (isset($db)) {
    echo "<div class='section'>";
    echo "<h2>📊 3. Estrutura da Tabela Conteudo</h2>";
    
    try {
        $stmt = $db->query("DESCRIBE Conteudo");
        $colunas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr><th>Campo</th><th>Tipo</th><th>Null</th><th>Default</th></tr>";
        
        foreach ($colunas as $coluna) {
            echo "<tr>";
            echo "<td><strong>{$coluna['Field']}</strong></td>";
            echo "<td>{$coluna['Type']}</td>";
            echo "<td>{$coluna['Null']}</td>";
            echo "<td>{$coluna['Default']}</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Verificar se tem a coluna Avaliacao ou Avaliação
        $tem_avaliacao = false;
        $nome_coluna_avaliacao = '';
        foreach ($colunas as $coluna) {
            if ($coluna['Field'] == 'Avaliacao' || $coluna['Field'] == 'Avaliação') {
                $tem_avaliacao = true;
                $nome_coluna_avaliacao = $coluna['Field'];
            }
        }
        
        if ($tem_avaliacao) {
            if ($nome_coluna_avaliacao == 'Avaliacao') {
                echo "<p>✅ <span class='success'>Coluna de avaliação OK:</span> 'Avaliacao' (sem cedilha)</p>";
            } else {
                echo "<p>⚠️ <span class='warning'>Atenção:</span> Coluna chama-se 'Avaliação' (com cedilha). Recomendo renomear para 'Avaliacao'</p>";
                echo "<p>Execute: <code>ALTER TABLE Conteudo CHANGE `Avaliação` `Avaliacao` TINYINT NULL;</code></p>";
            }
        } else {
            echo "<p>❌ <span class='error'>Coluna de avaliação não encontrada!</span></p>";
        }
        
    } catch (PDOException $e) {
        echo "❌ <span class='error'>Erro:</span> " . $e->getMessage();
    }
    echo "</div>";

    // ==========================================
    // 4. TESTE DE CONTEÚDOS
    // ==========================================
    echo "<div class='section'>";
    echo "<h2>📚 4. Conteúdos Cadastrados</h2>";
    
    try {
        $stmt = $db->query("SELECT Tipo, COUNT(*) as total FROM Conteudo GROUP BY Tipo");
        $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($stats)) {
            echo "<p class='warning'>⚠️ Nenhum conteúdo cadastrado! Execute o script setup_database.sql</p>";
        } else {
            echo "<table>";
            echo "<tr><th>Tipo</th><th>Quantidade</th></tr>";
            foreach ($stats as $stat) {
                echo "<tr><td><strong>{$stat['Tipo']}</strong></td><td>{$stat['total']}</td></tr>";
            }
            echo "</table>";
        }
        
        // Mostrar alguns exemplos
        echo "<h3>Exemplos de Conteúdo:</h3>";
        $stmt = $db->query("SELECT IDconteudo, Titulo, Tipo, Preco, Disponibilidade FROM Conteudo LIMIT 5");
        $exemplos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!empty($exemplos)) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Título</th><th>Tipo</th><th>Preço</th><th>Disponível</th></tr>";
            foreach ($exemplos as $ex) {
                $disponivel = $ex['Disponibilidade'] == 1 ? '✅' : '❌';
                echo "<tr>";
                echo "<td>{$ex['IDconteudo']}</td>";
                echo "<td>{$ex['Titulo']}</td>";
                echo "<td>{$ex['Tipo']}</td>";
                echo "<td>€" . number_format($ex['Preco'], 2) . "</td>";
                echo "<td>$disponivel</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
    } catch (PDOException $e) {
        echo "❌ <span class='error'>Erro:</span> " . $e->getMessage();
    }
    echo "</div>";

    // ==========================================
    // 5. TESTE DAS FUNÇÕES DO MODEL
    // ==========================================
    echo "<div class='section'>";
    echo "<h2>⚙️ 5. Teste das Funções do Model</h2>";
    
    $funcoes_teste = [
        'getTodosCursos' => 'Buscar cursos',
        'getTodasPalestras' => 'Buscar palestras',
        'getTodosEbooks' => 'Buscar ebooks',
        'getTodasExplicacoes' => 'Buscar explicações'
    ];
    
    foreach ($funcoes_teste as $funcao => $descricao) {
        if (function_exists($funcao)) {
            try {
                $resultado = $funcao();
                $total = count($resultado);
                echo "✅ <span class='success'>$funcao()</span> - $descricao - <strong>$total resultados</strong><br>";
            } catch (Exception $e) {
                echo "⚠️ <span class='warning'>$funcao()</span> - Erro ao executar: " . $e->getMessage() . "<br>";
            }
        } else {
            echo "❌ <span class='error'>$funcao()</span> - Função não encontrada!<br>";
        }
    }
    echo "</div>";
}

// ==========================================
// 6. VERIFICAÇÃO DE SESSÕES
// ==========================================
echo "<div class='section'>";
echo "<h2>🔐 6. Teste de Sessões</h2>";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    echo "✅ <span class='success'>Sessão ativa</span> - User ID: {$_SESSION['user_id']}<br>";
    if (isset($_SESSION['user_name'])) {
        echo "👤 Nome: {$_SESSION['user_name']}<br>";
    }
} else {
    echo "ℹ️ Nenhuma sessão de utilizador ativa (normal se não estiveres logado)<br>";
}

echo "</div>";

// ==========================================
// RESUMO FINAL
// ==========================================
echo "<div class='section' style='background: #e3f2fd;'>";
echo "<h2>📋 Resumo</h2>";
echo "<p><strong>✅ TUDO OK?</strong> Se todos os testes passaram, podes apagar este ficheiro e começar a usar o sistema!</p>";
echo "<p><strong>⚠️ TEM ERROS?</strong> Consulta o ficheiro GUIA_DE_AJUSTES.md para instruções detalhadas.</p>";
echo "<p><strong>⚠️ SEGURANÇA:</strong> APAGA este ficheiro (teste_config.php) depois de testar!</p>";
echo "</div>";

?>