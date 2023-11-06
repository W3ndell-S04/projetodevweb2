
<?php 
function conectaBanco(){
    $host = "localhost";
    $port = "5432";
    $dbname = "nome_banco";
    $user = "postgres";
    $password = "12345";

    $conn_string = "host=$host port=$port dbmane=$dbname user=$user password=$password"; 
    $conexao = pg_connect($conn_string);

    if(!$conexao){
        die("ERRO NA CONEXAO COM O BANCO DE DADOS : ". pg_last_error());
    }

    return $conexao;
    
}


?>