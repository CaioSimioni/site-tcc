<?php
    require "../User/usuario.php";
    $u = new Usuario;
    $u->conectar();

    require "../Noticia/noticia.php";
    $new = new Noticia;
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
        <form method="POST" action="noticiaCadastro.php">
            Título<input type="text">
            Descrição<input type="text">
            Data<input type="date">
            imagem<input type="file">
            <input type="submit">
        </form>
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>

</body>
</html>