<?php
     require "../System/classes.php";
     $user = new Usuario;
     $banco = new BancoBD;
     $new = new Noticia;

     $banco->conectar();
   
     global $pdo;
        $sql=$pdo->prepare("SELECT * FROM noticia");
        $sql->execute();
        


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
      <td> Fonte </td>
      <td> Data </td>
      <td>descricao</td>
      <td> titulo</td>
      <td> Imagem </td>
    </tr> 
 <?php  while($dado=$sql->fetch()){  ?>
     <tr>
     <td><?php  echo $dado['id_noticia']; $not= $dado['id_noticia']; ?> </td>
     <td> <?php echo $dado['fonte']; ?></td>
     <td> <?php echo date("d/m/Y",strtotime($dado['data']));  ?> </td>
     <td> <?php echo $dado['descricao']; ?> </td>
     <td> <?php echo $dado['titulo']; ?></td>
     <td> <?php echo $dado['imagem']; ?> </td>
     <td><a href=" <?php echo $not; $new->excluirNoticia($not);  ?>"> <button> Excluir  </button><a> </td>
   
 </tr>
<?php } ?>
 
</table>



    <?php
        include "../Templates/rodape.php";
    ?>

</body>
</html>