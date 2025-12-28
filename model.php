<?php 

/**
 * ESTABELECER CONEXÃO
 * Conecta o PHP à base de dados MySQL na Hostinger usando PDO.
 */
function estabelecerConexao() {
   $hostname = 'localhost';
   $dbname   = 'u506280443_bruevaDB'; 
   $username = 'u506280443_bruevadbUser'; 
   $password = 'kZumpy6&'; 

   try {
      $conexao = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8mb4", $username, $password);
      // Ativa o modo de erro para avisar se houver algo errado nas tabelas
      $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conexao;
   } catch(PDOException $e) {
      die("Erro Crítico de Ligação: " . $e->getMessage());
   }
}

/**
 * LOGIN
 * Verifica se o email e a password (encriptada) coincidem.
 */
function verificarLogin($email, $password) {
    $db = estabelecerConexao();
    $stmt = $db->prepare("SELECT IDuser, Password, Nome FROM Utilizador WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Compara a password escrita com o hash guardado na BD
    if ($user && password_verify($password, $user['Password'])) {
        return $user;
    }
    return false;
}

/**
 * REGISTO
 * Encripta a password e insere um novo utilizador.
 */
function adicionarUtilizador($nome, $email, $idade, $password) {
    $db = estabelecerConexao();
    
    // Verifica se o email já existe para evitar erro de duplicado
    $check = $db->prepare("SELECT IDuser FROM Utilizador WHERE Email = ?");
    $check->execute([$email]);
    if($check->fetch()) return false;

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO Utilizador (Nome, Email, Idade, Password) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$nome, $email, $idade, $hash]);
}

/**
 * DADOS DO PERFIL
 * Vai buscar Nome, Email e Idade do utilizador logado.
 */
function getDadosUtilizador($id) {
    $db = estabelecerConexao();
    $stmt = $db->prepare("SELECT Nome, Email, Idade FROM Utilizador WHERE IDuser = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * CONTEÚDO DINÂMICO (O teu erro estava aqui)
 * Faz um JOIN entre a tabela Conteudo e Inscricoes.
 * O 'AS nome' garante que o PHP encontra a chave certa para o HTML.
 */
function getConteudoUtilizador($id_user, $tipo) {
   $db = estabelecerConexao();
   
   $sql = "SELECT c.Titulo AS nome, c.Info_Extra, i.Progresso AS progresso 
           FROM Conteudo c
           JOIN Inscricoes i ON c.IDconteudo = i.IDconteudo
           WHERE i.IDuser = ? AND c.Tipo = ?";
           
   $stmt = $db->prepare($sql);
   $stmt->execute([$id_user, $tipo]);
   $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // Mapeia o campo Info_Extra para os nomes que usaste nas secções do Perfil
   foreach ($resultados as &$item) {
       $item['duracao'] = $item['Info_Extra']; // Para Palestras
       $item['autor']   = $item['Info_Extra']; // Para Ebooks
       $item['data']    = $item['Info_Extra']; // Para Explicações
   }
   
   return $resultados;
}
?>