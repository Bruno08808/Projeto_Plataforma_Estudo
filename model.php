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
            "SELECT c.Titulo AS nome, c.Info_Extra AS info_extra, i.Progresso AS progresso
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


//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// Função para listar explicações na página de agendamento
function getTodasExplicacoes() {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE Tipo = 'Explicação'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro em getTodasExplicacoes: " . $e->getMessage());
        return [];
    }
}

function getExplicacaoPorID($id) {
    try {
        $db = estabelecerConexao();
        $stmt = $db->prepare("SELECT * FROM Conteudo WHERE IDconteudo = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro em getExplicacaoPorID: " . $e->getMessage());
        return false;
    }
}
?>