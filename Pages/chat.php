<?php

require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;



$banco->conectar();

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

    <link rel="stylesheet" href="../Css/style_chat.css">

</head>
<body>


<div id="global">

 <div class = "chat" >
 <?php

global $pdo;
$sql = $pdo->query("SELECT * FROM `chat`"); 

foreach($sql->fetchAll() as $key){
    
    $nome = $key['nome'];


       $sqli = $pdo ->query( "SELECT `imagem` FROM `usuario` WHERE usuario ='$nome'");
       foreach($sqli->fetchAll() as $keyy){
       $imagem = $keyy['imagem'];
        echo '<img class="img-perfil"  src="../Materials/UsersAvatar/' .$imagem. ' "> ' ;
        
       }
             if($nome == $_SESSION['nome_usuario']){
                 echo '<h3 class= "user">' .$key['nome']. '</h3>';
             }
              else{
                echo '<h3 class ="OUser">' .$key['nome']. '</h3>';

              }
  
  echo "<p>" .$key['mensagem']. "</p>";

   }

   ?>
 </div>
</div>

</body>
</html>