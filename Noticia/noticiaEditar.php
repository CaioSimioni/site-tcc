<?php
    require "../User/usuario.php";
    $u = new Usuario;
    $u->conectar();

    require "../Noticia/noticia.php";
    $new = new Noticia;

        global $pdo;
        $consultar="SELECT id_noticia FROM noticia";
        $con=$pdo->query($consultar) or die($pdo->error);
        


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="stylesheet" href="../Css/style_noticiaADM.css">
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>
    
    <table border="1">
     <tr>
      <td> Codigo</td>
      <td> titulo </td>
      <td> fonte </td>
      <td> Data de Upload </td>
      <td> Imagem </td>
      <td> Descricao </td>
    </tr> 
 <?php  while($dado=$con->fetch_array()){  ?>
     <tr>
     <td><?php echo $dado['id_noticia']; ?> </td>
     <td> <?php echo $dado['titulo']; ?></td>
     <td> <?php echo $dado['fonte']; ?></td>
     <td> <?php echo $dado['data']; ?> </td>
     <td> <?php echo $dado['imagem']; ?> </td>
     <td> <?php echo $dado['descricao']; ?> </td>
 </tr>
<?php } ?>
 
</table>


 

    <?php
        include "../Templates/rodape.php";
    ?>

</body>
</html>