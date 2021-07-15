<?php
    require "../User/usuario.php";
    $u = new Usuario;
    $u->conectar();

    require "../Noticia/noticia.php";
    $new = new Noticia;
    global $pdo;

    $id_noticia = addslashes($_POST['id_noticia']);  
    $new->excluirNoticia($id_noticia);
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>
    <div id="global">
        <form method="POST" action="noticiaExcluir.php">
           Id da noticia<input type="text" name="id_noticia">
            <input type="submit" value="Excluir">
        </form>
    </div>
     
     
    <?php
        include "../Templates/rodape.php";
    ?>

</body>
</html>