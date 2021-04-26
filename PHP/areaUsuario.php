<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header("location: entrar.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Site</title>
    <link rel="stylesheet" href="../CSS/estilo_site.css">
</head>
<body>
    <div id="corpo-form">
            <h1>Bem vindo</h1>
            <a href="entrar.php"><strong>Voltar</strong></a>
    </div>
</body>
</html>
