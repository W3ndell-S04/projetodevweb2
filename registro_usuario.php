<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuário</title>
</head>
<body>
    <h1>Registro de Novo Usuário</h1>
    <form action="processar_registro.php" method="POST">
        <label for="username">Nome de Usuário:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="name">Nome Completo:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="active">Ativo:</label>
        <input type="checkbox" id="active" name="active"><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>
