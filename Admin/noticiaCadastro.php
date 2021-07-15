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
    <link rel="stylesheet" href="../Css/style_noticiaADM.css">
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>
    <div id="global">
        <form method="POST" action="noticiaCadastro.php" id="forms_newNoticia">
            Título<input type="text" class="atrib_noticia">
            Descrição<input type="text" class="atrib_noticia">
            Data<input type="date" class="atrib_noticia">
            imagem<input type="file" class="atrib_noticia">
            <input type="submit" class="atrib_noticia">
        </form>
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>

</body>
</html>