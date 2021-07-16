<?php
require "../User/usuario.php";
$u = new Usuario;
$u->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/style_home.css">
</script>

</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>
    <div id="global">
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>
</body>
</html>