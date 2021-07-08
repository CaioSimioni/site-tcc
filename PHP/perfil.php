<?php
require "usuario.php";
$u = new Usuario;
$u->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

//funcionou, porém sempre que da F5 ele manda a imagem dnv, e tem que descobrir um jeito de sempre que a pessoa fizer
//o update de uma imagem, excluir a que ele tinha, tenho uma ideia de no processo de clicar em salvar, descobrir o
// nome da imagem anterior e excluir a que tinha antes. A Pagina Upload serve pra guardar as imagens.


$cod_usu=$_SESSION['codigo_usuario'];
$msg=false;

//acredito que aqui que esteja causando a falha do F5

if(isset($_FILES['arquivo'])){
    $extensao = strtolower(substr($_FILES['arquivo'] ['name'],-4));
    $novo_nome = md5(time()).$extensao;
    $diretorio="upload/";
    
   // aqui ele move a imagem que fica flutuando por ai pra pasta
   move_uploaded_file($_FILES['arquivo'] ['tmp_name'],$diretorio.$novo_nome);
   
   //aqui ele manda o comando update com o nome da imagem e a data do upload, da pra usar a data pra alguma coisa talvez.
    $sql_code="UPDATE `usuario` SET `imagem` = '$novo_nome',data=now() WHERE `usuario`.`codigo_usuario` = $cod_usu;";
    $_FILES['arquivo']=null;
    
    //Usei o $pdo pq ele é basicamente a variável conexão.
        if($pdo->query($sql_code)){ $msg="Arquivo enviado com sucesso"; }
        else{$msg="Arquivo na enviado com sucesso"; }
}

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

  <h1>      Upload de Imagem </h1>
  <!--Aqui da pra por uma mensagezinha de que a imagem concluiu o upload ou não.-->
   <form action="perfil.php" method="POST" enctype="multipart/form-data">
   Arquivo: <input type="file" required name="arquivo">
             <input type="submit" value="salvar">
    </form>

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