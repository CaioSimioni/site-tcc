<?php
require "usuario.php";
$u = new Usuario;
$u->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

print_r($_SESSION);




?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="shortcut icon" href="../ASSETS/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/style_home.css">



</head>
<body onload="ajax()">
    <?php
        include "../COMPONENTS/cabecalho.html";
    ?>
    <div id="global">


        </div>


        <table>
     <tr>
        <td>nome</td>
        <td>E-mail</td>
     </tr>

     <tr>
        <td><?php $usu=$_SESSION['nome_usuario']; echo $usu  ?> </td>
        <td><?php $email= $_SESSION['email_usuario']; echo $email ?>
     </tr>

    </table>

        <div id="conteudo">
            
        </div>

    </div>
    <?php
        include "../COMPONENTS/rodape.html";
    ?>
</body>
</html>