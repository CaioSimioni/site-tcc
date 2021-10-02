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
    <link rel="shortcut icon" href="../Materials/polo_icon.png">
    <link rel="stylesheet" href="../Css/style_home.css">
    <link rel="stylesheet" href="../Css/style_perfil.css">

   <script type="text/javascript">


function ajax(){
  var req = new XMLHttpRequest();
  req.onreadystatechange = function(){
   if(req.readyState == 4 && req.status == 200){
       document.getElementById('chat').innerHTML = req.responseText;
   }
  }
  req.open('GET','chat.php',true);
  req.send();
}

setInterval(function(){ajax();},1000)

   </script>


</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>

<!-- -->

 <div id="global">

 <div id = 'chat'>

</div>

      <form method="post" action="topicos.php">
       <input type="text" name="mensagem" placeholder="Mensagem">
       <input type="submit" value="enviar" >
       
     </form>    
    
    </div> <!-- fim Global -->
    <?php
        include "../Templates/rodape.php";
    ?>
   
   <?php
  
  $mensagem = $_POST['mensagem'];
  $usu = $_SESSION['nome_usuario'];

  global $pdo;
  $sql = $pdo->prepare("INSERT INTO `chat`(`nome`, `mensagem`) VALUES ('$usu','$mensagem')");
  $sql->execute();
  
   
  exit;
  

      ?>
</body>
</html>