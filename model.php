<?php 

/**
 * Estabelece a conexão PDO com a base de dados na Hostinger
 */
function estabelecerConexao() {
   // Dados corrigidos conforme as capturas de ecrã
   $hostname = 'localhost';
   $dbname = 'u506280443_bruevaDB'; //
   $username = 'u506280443_bruevadbUser'; // Adicionado o '0' que faltava
   $password = 'kZumpy6&'; //

   try {
      $conexao = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8mb4", $username, $password);
      // Configura o PDO para lançar exceções em caso de erro
      $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conexao;
   } catch(PDOException $e) {
      // Se houver erro de credenciais, ele será exibido aqui
      die("Erro de ligação: " . $e->getMessage());
   }
}

/**
 * Verifica se as credenciais de login são válidas
 */
function verificarLogin($email, $password) {
    $db = estabelecerConexao();
    // Nome da tabela 'Utilizador' com 'U' maiúsculo conforme a BD
    $stmt = $db->prepare("SELECT IDuser, Password, Nome FROM Utilizador WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica a password usando hash por segurança
    if ($user && password_verify($password, $user['Password'])) {
        return $user;
    }
    return false;
}

/**
 * Verifica se um email já está registado na base de dados
 */
function emailExiste($email) {
    $db = estabelecerConexao();
    $stmt = $db->prepare("SELECT IDuser FROM Utilizador WHERE Email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch() ? true : false;
}

/**
 * Insere um novo utilizador na tabela Utilizador
 */
function adicionarUtilizador($nome, $email, $idade, $password) {
    // Primeiro verifica se o email já existe para não dar erro de duplicado
    if (emailExiste($email)) {
        return false;
    }

    $db = estabelecerConexao();
    // Transforma a password em hash antes de guardar
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Colunas: Nome, Email, Idade, Password conforme a captura
    $stmt = $db->prepare("INSERT INTO Utilizador (Nome, Email, Idade, Password) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$nome, $email, $idade, $hash]);
}

/**
 * Recupera todos os dados de um utilizador específico para a página de perfil
 */
function getDadosUtilizador($id) {
    $db = estabelecerConexao();
    $stmt = $db->prepare("SELECT Nome, Email, Idade FROM Utilizador WHERE IDuser = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getConteudoUtilizador($id_user, $tipo) {
   $db = estabelecerConexao();
   
   // IMPORTANTE: Usamos 'AS nome' para que o PHP encontre a chave que o teu HTML pede
   $sql = "SELECT c.Titulo AS nome, c.Info_Extra, i.Progresso AS progresso 
           FROM Conteudo c
           JOIN Inscricoes i ON c.IDconteudo = i.IDconteudo
           WHERE i.IDuser = ? AND c.Tipo = ?";
           
   $stmt = $db->prepare($sql);
   $stmt->execute([$id_user, $tipo]);
   $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // Mapeamos a coluna Info_Extra para as variáveis que usaste no profile.php
   foreach ($resultados as &$item) {
       $item['duracao'] = $item['Info_Extra']; // Para palestras
       $item['autor']   = $item['Info_Extra']; // Para ebooks
       $item['data']    = $item['Info_Extra']; // Para explicacoes
   }
   
   return $resultados;
}
?>