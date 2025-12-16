<?php 

/* Implementar com PDO PHP Data Objects */ 
	
/* Estabelecer conexão com a base de dados */    
function estabelecerConexao()
{
   // Podem mais tarde passar para um ficheiro de configuração
   $hostname = 'localhost';
   $dbname = 'u506280443_bruevaDB';
   $username = 'u50628443_bruevadbUser';
   $password = 'kZumpy6&';

   try {
         $conexao = new PDO( "mysql:host=$hostname;dbname=$dbname;charset=utf8mb4",
                              $username, $password );
   }
   catch( PDOException $e ) {
      echo $e->getMessage();
   }

   return $conexao;
    
}

/* 
   Obter todas as as fotos num array   
*/ 
function getFotos() 
{
   // Estabelecer a conexao com a BD
   $con = estabelecerConexao();

   // Construir uma Query 'SELECT * FROM fotos'
   $res = $con->query( 'SELECT * FROM fotos' );

   // return $res->fetchAll(PDO::FETCH_ASSOC);  
   return $res->fetchAll(PDO::FETCH_KEY_PAIR);

}

/* 
   Verifica se um dado username existe 
   Retorna booleano
*/ 
function usernameExists( $username )
{
    

}

/* 
   Adiciona um novo utilizador 
   Insere um novo utilizador na tabela users
*/ 
function adicionarUser( $username )
{
  

}

/* 
   Retorna um array com os likes associados a um user 
*/ 
function getLikes( $username )
{
    
    
}

/* 
   Adiciona um Like aos Likes de um utilizador   tabela 'userlikes'
   cujo 'username' é passado no primeiro parâmetro,
   e a fotoId passada no segundo parâmetro  
*/ 
function adicionarLike($username, $fotoId )
{
   

}

/* 
   Remove um Like dos Likes de um utilizador   tabela 'userlikes'
   cujo 'username' é passado no primeiro parâmetro,
    e a fotoId passada no segundo parâmetro  
*/ 
function removerLike($username, $fotoId ) {
   
}

 ?>