<?php
/* MODEL.PHP - VERSÃO COMPLETA COM TODAS AS PESQUISAS */

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

/* ================= LOGIN, REGISTO E PERFIL ================= */

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

function getDadosUtilizador($id) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT Nome, Email, Idade FROM Utilizador WHERE IDuser = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return false; }
}

function getConteudoUtilizador($idUser, $tipo) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT c.Titulo AS nome, c.Info_Extra AS info_extra, i.Progresso AS progresso, c.Slug FROM Conteudo c JOIN Inscricoes i ON c.IDconteudo = i.IDconteudo WHERE i.IDuser = ? AND c.Tipo = ?");
        $stmt->execute([$idUser, $tipo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

/* ================= LISTAGENS GERAIS ================= */

function getTodosCursos() {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT c.*, d.Data_Inicio FROM Conteudo c LEFT JOIN Conteudo_Curso d ON c.IDconteudo = d.IDconteudo WHERE c.Tipo = 'Curso' ORDER BY c.IDconteudo DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function getTodasPalestras() {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT c.*, d.Data_Evento FROM Conteudo c LEFT JOIN Conteudo_Palestra d ON c.IDconteudo = d.IDconteudo WHERE c.Tipo = 'Palestra' ORDER BY c.IDconteudo DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function getTodosEbooks() {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT c.*, d.Num_Paginas FROM Conteudo c LEFT JOIN Conteudo_Ebook d ON c.IDconteudo = d.IDconteudo WHERE c.Tipo = 'Ebook' ORDER BY c.IDconteudo DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function getTodasExplicacoes() {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT c.*, d.Nivel FROM Conteudo c LEFT JOIN Conteudo_Explicacao d ON c.IDconteudo = d.IDconteudo WHERE c.Tipo IN ('Explicacoes', 'Explicação') ORDER BY c.IDconteudo DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

/* ================= FUNÇÕES DE PESQUISA (O que estava a faltar) ================= */

function pesquisarCursos($termo) {
    try {
        $db = estabelecerConexao();
        $termo = "%$termo%";
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE Tipo = 'Curso' AND (Titulo LIKE ? OR Info_Extra LIKE ?) ORDER BY IDconteudo DESC");
        $stmt->execute([$termo, $termo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function pesquisarPalestras($termo) {
    try {
        $db = estabelecerConexao();
        $termo = "%$termo%";
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE Tipo = 'Palestra' AND (Titulo LIKE ? OR Info_Extra LIKE ?) ORDER BY IDconteudo DESC");
        $stmt->execute([$termo, $termo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function pesquisarEbooks($termo) {
    try {
        $db = estabelecerConexao();
        $termo = "%$termo%";
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE Tipo = 'Ebook' AND (Titulo LIKE ? OR Info_Extra LIKE ?) ORDER BY IDconteudo DESC");
        $stmt->execute([$termo, $termo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

function pesquisarExplicacoes($termo) {
    try {
        $db = estabelecerConexao();
        $termo = "%$termo%";
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE Tipo IN ('Explicacoes', 'Explicação') AND (Titulo LIKE ? OR Info_Extra LIKE ?) ORDER BY IDconteudo DESC");
        $stmt->execute([$termo, $termo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) { return []; }
}

/* ================= PÁGINA DE PRODUTO & INSCRIÇÃO ================= */

function getConteudoPorSlug($slug) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE Slug = ?");
        $stmt->execute([$slug]);
        $base = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$base) return false;

        $id = $base['IDconteudo'];
        $tipo = $base['Tipo'];
        $sql_extra = "";

        if ($tipo == 'Curso') $sql_extra = "SELECT * FROM Conteudo_Curso WHERE IDconteudo = ?";
        elseif ($tipo == 'Ebook') $sql_extra = "SELECT * FROM Conteudo_Ebook WHERE IDconteudo = ?";
        elseif ($tipo == 'Palestra') $sql_extra = "SELECT * FROM Conteudo_Palestra WHERE IDconteudo = ?";
        elseif ($tipo == 'Explicacoes' || $tipo == 'Explicação') $sql_extra = "SELECT * FROM Conteudo_Explicacao WHERE IDconteudo = ?";

        if ($sql_extra) {
            $stmt = $db->prepare($sql_extra);
            $stmt->execute([$id]);
            $extra = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($extra) return array_merge($base, $extra);
        }
        return $base;
    } catch(PDOException $e) { return false; }
}

function inscreverUtilizador($idUser, $idConteudo) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT * FROM Inscricoes WHERE IDuser = ? AND IDconteudo = ?");
        $stmt->execute([$idUser, $idConteudo]);
        if ($stmt->fetch()) return false;
        $stmt = $db->prepare("INSERT INTO Inscricoes (IDuser, IDconteudo, Progresso) VALUES (?, ?, 0)");
        return $stmt->execute([$idUser, $idConteudo]);
    } catch(PDOException $e) { return false; }
}
?>