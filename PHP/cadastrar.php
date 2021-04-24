<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../CSS/estilo.css">
</head>
<body>
    <div id="corpo-form">
        <h1>Cadastrar</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" maxlength="40">
            <input type="email" name="email" placeholder="E-mail" maxlength="40">
            <input type="password" name="senha" placeholder="Senha">
            <input type="password" name="confirmarSenha" placeholder="Confirmar senha">
            <input type="submit" value="CADASTRAR">
            <a href="../index.php">Já está cadastrado? <strong>Entrar</strong></a>
        </form>
    </div>
</body>
</html>