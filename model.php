<?php
/* MODEL.PHP - VERSÃO FINAL CORRIGIDA E COMPLETA */

function estabelecerConexao() {
   $hostname = 'localhost';
   $dbname = 'u506280443_bruevaDB'; 
   $username = 'u506280443_bruevadbUser'; 
   $password = 'kZumpy6&'; 

   try {
      $conexao = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8mb4", $username, $password);
      $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conexao;
   } catch(PDOException $e) {
      die("Erro de ligação: " . $e->getMessage());
   }
}

/* ================= LOGIN & REGISTO ================= */

function verificarLogin($email, $password) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT IDuser, Password, Nome FROM Utilizador WHERE Email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['Password'])) return $user;
        return false;
    } catch(PDOException $e) { return false; }
}

function emailExiste($email) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT IDuser FROM Utilizador WHERE Email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() ? true : false;
    } catch(PDOException $e) { return false; }
}

function adicionarUtilizador($nome, $email, $idade, $password) {
    try {
        if (emailExiste($email)) return false;
        $db = estabelecerConexao();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO Utilizador (Nome, Email, Idade, Password) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $email, $idade, $hash]);
    } catch(PDOException $e) { return false; }
}

/* ================= LISTAGENS GERAIS (COM JOIN) ================= */

function getTodosCursos() {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("
            SELECT c.*, cc.IDcurso, cc.Data_Inicio, cc.Vagas_Totais, cc.Vagas_Preenchidas 
            FROM Conteudo c 
            LEFT JOIN Conteudo_Curso cc ON c.IDconteudo = cc.IDconteudo 
            WHERE c.Tipo = 'Curso' 
            ORDER BY c.IDconteudo DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function getTodasPalestras() {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("
            SELECT c.*, cp.IDpalestra, cp.Data_Evento, cp.Localizacao 
            FROM Conteudo c 
            LEFT JOIN Conteudo_Palestra cp ON c.IDconteudo = cp.IDconteudo 
            WHERE c.Tipo = 'Palestra' 
            ORDER BY c.IDconteudo DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function getTodosEbooks() {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("
            SELECT c.*, ce.IDebook, ce.Num_Paginas 
            FROM Conteudo c 
            LEFT JOIN Conteudo_Ebook ce ON c.IDconteudo = ce.IDconteudo 
            WHERE c.Tipo = 'Ebook' 
            ORDER BY c.IDconteudo DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function getTodasExplicacoes() {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("
            SELECT c.*, cex.IDexplicacao, cex.Nivel 
            FROM Conteudo c 
            LEFT JOIN Conteudo_Explicacao cex ON c.IDconteudo = cex.IDconteudo 
            WHERE c.Tipo IN ('Explicacoes', 'Explicação', 'Explicacao') 
            ORDER BY c.IDconteudo DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

/* ================= PESQUISAS ================= */

function pesquisarCursos($termo) {
    try {
        $db = estabelecerConexao();
        $termo = "%$termo%";
        $stmt = $db->prepare("
            SELECT c.*, cc.IDcurso, cc.Data_Inicio 
            FROM Conteudo c 
            LEFT JOIN Conteudo_Curso cc ON c.IDconteudo = cc.IDconteudo 
            WHERE c.Tipo = 'Curso' AND (c.Titulo LIKE ? OR c.Info_Extra LIKE ?) 
            ORDER BY c.IDconteudo DESC
        ");
        $stmt->execute([$termo, $termo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function pesquisarEbooks($termo) {
    try {
        $db = estabelecerConexao();
        $termo = "%$termo%";
        $stmt = $db->prepare("
            SELECT c.*, ce.IDebook, ce.Num_Paginas 
            FROM Conteudo c 
            LEFT JOIN Conteudo_Ebook ce ON c.IDconteudo = ce.IDconteudo 
            WHERE c.Tipo = 'Ebook' AND (c.Titulo LIKE ? OR c.Info_Extra LIKE ?) 
            ORDER BY c.IDconteudo DESC
        ");
        $stmt->execute([$termo, $termo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function pesquisarPalestras($termo) {
    try {
        $db = estabelecerConexao();
        $termo = "%$termo%";
        $stmt = $db->prepare("
            SELECT c.*, cp.IDpalestra, cp.Data_Evento 
            FROM Conteudo c 
            LEFT JOIN Conteudo_Palestra cp ON c.IDconteudo = cp.IDconteudo 
            WHERE c.Tipo = 'Palestra' AND (c.Titulo LIKE ? OR c.Info_Extra LIKE ?) 
            ORDER BY c.IDconteudo DESC
        ");
        $stmt->execute([$termo, $termo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function pesquisarExplicacoes($termo) {
    try {
        $db = estabelecerConexao();
        $termo = "%$termo%";
        $stmt = $db->prepare("
            SELECT c.*, cex.IDexplicacao, cex.Nivel 
            FROM Conteudo c 
            LEFT JOIN Conteudo_Explicacao cex ON c.IDconteudo = cex.IDconteudo 
            WHERE c.Tipo IN ('Explicacoes', 'Explicação', 'Explicacao') 
            AND (c.Titulo LIKE ? OR c.Info_Extra LIKE ?) 
            ORDER BY c.IDconteudo DESC
        ");
        $stmt->execute([$termo, $termo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

/* ================= FUNÇÃO PARA ABRIR PÁGINA DE CONTEÚDO (SLUG) ================= */

function getConteudoPorSlug($slug) {
    try {
        $db = estabelecerConexao();
        
        // CORRIGIDO: Tenta encontrar o conteúdo verificando todas as tabelas possíveis
        // Primeiro tenta buscar por Slug na tabela principal
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE Slug = ?");
        $stmt->execute([$slug]);
        $base = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Se não encontrou por Slug, tenta pelos IDs específicos de cada tipo
        if (!$base) {
            // Tenta como IDcurso
            $stmt = $db->prepare("
                SELECT c.* 
                FROM Conteudo c 
                INNER JOIN Conteudo_Curso cc ON c.IDconteudo = cc.IDconteudo 
                WHERE cc.IDcurso = ?
            ");
            $stmt->execute([$slug]);
            $base = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        if (!$base) {
            // Tenta como IDebook
            $stmt = $db->prepare("
                SELECT c.* 
                FROM Conteudo c 
                INNER JOIN Conteudo_Ebook ce ON c.IDconteudo = ce.IDconteudo 
                WHERE ce.IDebook = ?
            ");
            $stmt->execute([$slug]);
            $base = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        if (!$base) {
            // Tenta como IDpalestra
            $stmt = $db->prepare("
                SELECT c.* 
                FROM Conteudo c 
                INNER JOIN Conteudo_Palestra cp ON c.IDconteudo = cp.IDconteudo 
                WHERE cp.IDpalestra = ?
            ");
            $stmt->execute([$slug]);
            $base = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        if (!$base) {
            // Tenta como IDexplicacao
            $stmt = $db->prepare("
                SELECT c.* 
                FROM Conteudo c 
                INNER JOIN Conteudo_Explicacao cex ON c.IDconteudo = cex.IDconteudo 
                WHERE cex.IDexplicacao = ?
            ");
            $stmt->execute([$slug]);
            $base = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if (!$base) return false;

        $id = $base['IDconteudo'];
        $tipo = $base['Tipo'];
        
        // Busca detalhes extras conforme o tipo
        if ($tipo == 'Curso') {
            $stmt = $db->prepare("SELECT * FROM Conteudo_Curso WHERE IDconteudo = ?");
        } elseif ($tipo == 'Ebook') {
            $stmt = $db->prepare("SELECT * FROM Conteudo_Ebook WHERE IDconteudo = ?");
        } elseif ($tipo == 'Palestra') {
            $stmt = $db->prepare("SELECT * FROM Conteudo_Palestra WHERE IDconteudo = ?");
        } elseif (in_array($tipo, ['Explicacoes', 'Explicação', 'Explicacao'])) {
            $stmt = $db->prepare("SELECT * FROM Conteudo_Explicacao WHERE IDconteudo = ?");
        } else {
            return $base;
        }

        $stmt->execute([$id]);
        $extra = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $extra ? array_merge($base, $extra) : $base;

    } catch(PDOException $e) { 
        error_log("Erro em getConteudoPorSlug: " . $e->getMessage());
        return false; 
    }
}

/* ================= INSCRIÇÃO ================= */

function inscreverUtilizador($idUser, $idConteudo) {
    try {
        $db = estabelecerConexao();
        
        // Verifica se já está inscrito
        $stmt = $db->prepare("SELECT * FROM Inscricoes WHERE IDuser = ? AND IDconteudo = ?");
        $stmt->execute([$idUser, $idConteudo]);
        if ($stmt->fetch()) {
            return false; // Já inscrito
        }
        
        // Inscreve
        $stmt = $db->prepare("INSERT INTO Inscricoes (IDuser, IDconteudo, Progresso) VALUES (?, ?, 0)");
        return $stmt->execute([$idUser, $idConteudo]);
    } catch(PDOException $e) { 
        error_log("Erro em inscreverUtilizador: " . $e->getMessage());
        return false; 
    }
}

/* ================= FUNÇÕES PARA O PERFIL ================= */

function getDadosUtilizador($idUser) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT * FROM Utilizador WHERE IDuser = ?");
        $stmt->execute([$idUser]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return false; }
}

function getConteudoUtilizador($idUser, $tipo) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("
            SELECT c.Titulo as nome, c.Info_Extra as info_extra, i.Progresso as progresso 
            FROM Inscricoes i 
            INNER JOIN Conteudo c ON i.IDconteudo = c.IDconteudo 
            WHERE i.IDuser = ? AND c.Tipo = ?
            ORDER BY i.Data_Inscricao DESC
        ");
        $stmt->execute([$idUser, $tipo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}
?>