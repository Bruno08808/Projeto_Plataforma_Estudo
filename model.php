<?php

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

        if ($user && password_verify($password, $user['Password'])) {
            return $user;
        }
        return false;
    } catch(PDOException $e) {
        error_log("Erro em verificarLogin: " . $e->getMessage());
        return false;
    }
}

function emailExiste($email) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT IDuser FROM Utilizador WHERE Email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() ? true : false;
    } catch(PDOException $e) {
        error_log("Erro em emailExiste: " . $e->getMessage());
        return false;
    }
}

function adicionarUtilizador($nome, $email, $idade, $password) {
    try {
        if (emailExiste($email)) return false;
        $db = estabelecerConexao();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO Utilizador (Nome, Email, Idade, Password) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $email, $idade, $hash]);
    } catch(PDOException $e) {
        error_log("Erro em adicionarUtilizador: " . $e->getMessage());
        return false;
    }
}

/* ================= PERFIL E CONTEÚDOS ================= */

function getDadosUtilizador($id) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT Nome, Email, Idade FROM Utilizador WHERE IDuser = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro em getDadosUtilizador: " . $e->getMessage());
        return false;
    }
}

function getConteudoUtilizador($idUser, $tipo) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare(
            "SELECT c.Titulo AS nome, c.Info_Extra AS info_extra, i.Progresso AS progresso, c.Slug
             FROM Conteudo c
             JOIN Inscricoes i ON c.IDconteudo = i.IDconteudo
             WHERE i.IDuser = ? AND c.Tipo = ?"
        );
        
        if (!$stmt) {
            error_log("Erro ao preparar query em getConteudoUtilizador");
            return [];
        }
        
        $stmt->execute([$idUser, $tipo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro em getConteudoUtilizador: " . $e->getMessage());
        return [];
    }
}


/* ================= LISTAGENS (AGORA COM JOIN NAS TABELAS FILHAS) ================= */

// Buscar todos os cursos + detalhes
function getTodosCursos() {
    try {
        $db = estabelecerConexao();
        $sql = "SELECT c.*, d.Data_Inicio, d.Vagas_Totais, d.Vagas_Preenchidas 
                FROM Conteudo c 
                LEFT JOIN Conteudo_Curso d ON c.IDconteudo = d.IDconteudo 
                WHERE c.Tipo = 'Curso' 
                ORDER BY c.IDconteudo DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro em getTodosCursos: " . $e->getMessage());
        return [];
    }
}

// Buscar todas as palestras + detalhes
function getTodasPalestras() {
    try {
        $db = estabelecerConexao();
        $sql = "SELECT c.*, d.Data_Evento, d.Localizacao, d.Orador
                FROM Conteudo c 
                LEFT JOIN Conteudo_Palestra d ON c.IDconteudo = d.IDconteudo 
                WHERE c.Tipo = 'Palestra' 
                ORDER BY c.IDconteudo DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro em getTodasPalestras: " . $e->getMessage());
        return [];
    }
}

// Buscar todos os ebooks + detalhes
function getTodosEbooks() {
    try {
        $db = estabelecerConexao();
        $sql = "SELECT c.*, d.Num_Paginas, d.Formato 
                FROM Conteudo c 
                LEFT JOIN Conteudo_Ebook d ON c.IDconteudo = d.IDconteudo 
                WHERE c.Tipo = 'Ebook' 
                ORDER BY c.IDconteudo DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro em getTodosEbooks: " . $e->getMessage());
        return [];
    }
}

// Buscar todas as explicações + detalhes
function getTodasExplicacoes() {
    try {
        $db = estabelecerConexao();
        // Nota: Mantido 'Explicacoes' conforme a tua BD
        $sql = "SELECT c.*, d.Duracao_Minutos, d.Nivel 
                FROM Conteudo c 
                LEFT JOIN Conteudo_Explicacao d ON c.IDconteudo = d.IDconteudo 
                WHERE c.Tipo = 'Explicacoes' 
                ORDER BY c.IDconteudo DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro em getTodasExplicacoes: " . $e->getMessage());
        return [];
    }
}

/* ================= NOVA FUNÇÃO: SINGLE PAGE (CONTEUDO.PHP) ================= */

function getConteudoPorSlug($slug) {
    try {
        $db = estabelecerConexao();
        
        // 1. Primeiro descobre o tipo e os dados básicos
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE Slug = ?");
        $stmt->execute([$slug]);
        $base = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$base) return false;

        // 2. Baseado no tipo, vai buscar os detalhes à tabela correta
        $detalhes = [];
        $id = $base['IDconteudo'];
        $tipo = $base['Tipo'];

        if ($tipo == 'Curso') {
            $stmt = $db->prepare("SELECT * FROM Conteudo_Curso WHERE IDconteudo = ?");
        } elseif ($tipo == 'Ebook') {
            $stmt = $db->prepare("SELECT * FROM Conteudo_Ebook WHERE IDconteudo = ?");
        } elseif ($tipo == 'Palestra') {
            $stmt = $db->prepare("SELECT * FROM Conteudo_Palestra WHERE IDconteudo = ?");
        } elseif ($tipo == 'Explicacoes') {
            $stmt = $db->prepare("SELECT * FROM Conteudo_Explicacao WHERE IDconteudo = ?");
        } else {
            return $base; // Se não tiver tabela extra, devolve só o base
        }

        $stmt->execute([$id]);
        $extra = $stmt->fetch(PDO::FETCH_ASSOC);

        // Junta os dois arrays (Base + Detalhes)
        if ($extra) {
            return array_merge($base, $extra);
        }
        
        return $base;

    } catch(PDOException $e) {
        error_log("Erro em getConteudoPorSlug: " . $e->getMessage());
        return false;
    }
}

// Manter esta para compatibilidade (busca simples)
function getConteudoPorID($id) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE IDconteudo = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro em getConteudoPorID: " . $e->getMessage());
        return false;
    }
}

// Inscrever utilizador
function inscreverUtilizador($idUser, $idConteudo) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT * FROM Inscricoes WHERE IDuser = ? AND IDconteudo = ?");
        $stmt->execute([$idUser, $idConteudo]);
        if ($stmt->fetch()) {
            return false; 
        }
        
        $stmt = $db->prepare("INSERT INTO Inscricoes (IDuser, IDconteudo, Progresso) VALUES (?, ?, 0)");
        return $stmt->execute([$idUser, $idConteudo]);
    } catch(PDOException $e) {
        error_log("Erro em inscreverUtilizador: " . $e->getMessage());
        return false;
    }
}
?>