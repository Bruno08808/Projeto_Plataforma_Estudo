<?php

function estabelecerConexao() {
    $hostname = 'localhost';
    $dbname   = 'u506280443_bruevaDB';
    $username = 'u506280443_bruevadbUser';
    $password = 'kZumpy6&';

    try {
        $pdo = new PDO(
            "mysql:host=$hostname;dbname=$dbname;charset=utf8mb4",
            $username,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return $pdo;
    } catch (PDOException $e) {
        die("Erro de ligação: " . $e->getMessage());
    }
}

/* ================= LOGIN ================= */

function verificarLogin($email, $password) {
    $db = estabelecerConexao();

    $stmt = $db->prepare(
        "SELECT IDuser, Nome, Email, Password 
         FROM Utilizador 
         WHERE Email = ?"
    );
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
        return $user;
    }
    return false;
}

function emailExiste($email) {
    $db = estabelecerConexao();
    $stmt = $db->prepare("SELECT 1 FROM Utilizador WHERE Email = ?");
    $stmt->execute([$email]);
    return (bool) $stmt->fetchColumn();
}

function adicionarUtilizador($nome, $email, $anoNascimento, $password) {
    if (emailExiste($email)) {
        return false;
    }

    $db = estabelecerConexao();
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare(
        "INSERT INTO Utilizador (Nome, Email, Idade, Password)
         VALUES (?, ?, ?, ?)"
    );

    return $stmt->execute([$nome, $email, $anoNascimento, $hash]);
}

/* ================= PERFIL ================= */

function getDadosUtilizador($id) {
    $db = estabelecerConexao();
    $stmt = $db->prepare(
        "SELECT Nome, Email, Idade 
         FROM Utilizador 
         WHERE IDuser = ?"
    );
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getConteudoUtilizador($idUser, $tipo) {
    $db = estabelecerConexao();

    $stmt = $db->prepare(
        "SELECT 
            c.Titulo       AS nome,
            c.Info_Extra   AS info_extra,
            i.Progresso    AS progresso
         FROM Conteudo c
         JOIN Inscricoes i 
           ON c.IDconteudo = i.IDconteudo
         WHERE i.IDuser = ?
           AND c.Tipo = ?"
    );

    $stmt->execute([$idUser, $tipo]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* ================= EXPLICAÇÕES ================= */

// Procura todos os conteúdos que sejam do tipo 'Explicação'
function getTodasExplicacoes() {
   $db = estabelecerConexao();
   $stmt = $db->prepare("SELECT * FROM Conteudo WHERE Tipo = 'Explicação'");
   $stmt->execute();
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Procura os detalhes de uma explicação específica pelo ID
function getExplicacaoPorID($id) {
   $db = estabelecerConexao();
   $stmt = $db->prepare("SELECT * FROM Conteudo WHERE IDconteudo = ?");
   $stmt->execute([$id]);
   return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
