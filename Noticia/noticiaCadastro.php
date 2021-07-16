<?php
    require "../System/classes.php";
    $user = new Usuario;
    $banco = new BancoBD;

    $banco->conectar();
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
            <h1>Nova notícia</h1>
            <p class="atrib_noticia">Título: <input type="text" id="newNoticia_titulo"></p> 
            <p class="atrib_noticia">Descrição: <input type="text" id="newNoticia_descricao"></p>
            <p class="atrib_noticia">Fonte: <input type="text" id="newNoticia_fonte"></p>
            <p class="atrib_noticia">Data: <input type="date" id="new_noticia_data"></p>
            <p class="atrib_noticia">Imagem: <input type="file" id="newNoticia_imagem"></p>
            <input type="submit" class="atrib_noticia" id="newNoticia_submit">
        </form>
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>

</body>
</html>