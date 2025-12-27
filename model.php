<?php 
// Estabelecer conexão com a base de dados
function estabelecerConexao() {
   $hostname = 'localhost';
   $dbname = 'u506280443_bruevaDB';
   $username = 'u50628443_bruevadbUser';
   $password = 'kZumpy6&';

   try {
      $conexao = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8mb4", $username, $password);
      $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conexao;
   } catch(PDOException $e) {
      die("Erro de ligação: " . $e->getMessage());
   }
}


// Verifica se o login é válido
function verificarLogin($email, $password) {
    $db = estabelecerConexao();
    // Procuramos o utilizador pelo email
    $stmt = $db->prepare("SELECT IDuser, Password, Nome FROM Utilizador WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se o user existir, verificamos a password (usando hash para segurança)
    if ($user && password_verify($password, $user['Password'])) {
        return $user;
    }
    return false;
}

// Regista um novo utilizador
function adicionarUtilizador($nome, $email, $idade, $password) {
    $db = estabelecerConexao();
    $hash = password_hash($password, PASSWORD_DEFAULT); // Nunca guardar texto limpo!
    
    $stmt = $db->prepare("INSERT INTO Utilizador (Nome, Email, Idade, Password) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$nome, $email, $idade, $hash]);
}

// Vai buscar os dados para o Perfil
function getDadosUtilizador($id) {
    $db = estabelecerConexao();
    $stmt = $db->prepare("SELECT Nome, Email, Idade FROM Utilizador WHERE IDuser = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>