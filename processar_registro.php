<?php
function inserirNovoUsuario($username, $name, $password, $active) {
    $host = "localhost";
    $port = "5432";
    $dbname = "teste";
    $user = "postgres"; // Nome de usuário do PostgreSQL
    $password_db = "123456"; // Senha do PostgreSQL

    $conexao = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password_db");

    if (!$conexao) {
        throw new Exception("Erro na conexão com o banco de dados: " . pg_last_error());
    }
    
    // Verifique se o usuário já existe
    $verificar_query = "SELECT id FROM users WHERE username = $1";
    $verificar_resultado = pg_query_params($conexao, $verificar_query, array($username));

    if (pg_num_rows($verificar_resultado) > 0) {
        throw new Exception("Nome de usuário já existe.");
    }

    // Consulta para obter o próximo valor da sequência "usuario_id_seq"
    $query = "SELECT nextval('usuario_id_seq') as novo_id";
    $resultado = pg_query($conexao, $query);

    if (!$resultado) {
        throw new Exception("Erro ao obter o próximo valor da sequência: " . pg_last_error());
    }

    $row = pg_fetch_assoc($resultado);
    $novo_id = $row['novo_id'];

    // Inserir o novo registro com o ID gerado automaticamente
    $inserir_query = "INSERT INTO users (id, username, name, password, active) VALUES ($1, $2, $3, $4, $5)";
    $inserir_resultado = pg_query_params($conexao, $inserir_query, array($novo_id, $username, $name, $password, $active));

    if (!$inserir_resultado) {
        throw new Exception("Erro ao inserir o novo usuário: " . pg_last_error());
    }

    pg_close($conexao);

    return $novo_id;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $active = isset($_POST['active']) ? true : false;

    try {
        $novo_id = inserirNovoUsuario($username, $name, $password, $active);
        echo "Novo usuário inserido com sucesso. ID: $novo_id";
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Acesso inválido.";
}
?>
