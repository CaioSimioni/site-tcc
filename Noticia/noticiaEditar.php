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
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/style_noticiaEdita.css">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>

    <div id="global">
        <form action="" method="post">
            <div class="campo div-title">
                <p>Título</p>
                <input type="text" id="newNoticia_titulo"    name="titulo">
            </div>
            <div class="campo div-descricao">
                <p>Descrição</p>    
                <textarea id="newNoticia_descricao" name="descricao"></textarea>
            </div>
            <div class="campo div-fonte">
                <p>Fonte</p>
                <input type="text" id="newNoticia_fonte"     name="fonte">
            </div>
            <p>Data</p>
            <div class="campo div-data-file">
                <input type="date" id="new_noticia_data"     name="data">
                <div class="imagem">
                    <label onclick="a()" for="imagem">Enviar Imagem</label>
                    <div id="nome-arquivo">Nenhum Arquivo Selecionado</div>
                </div>
            </div>
            <div class="campo div-nome-arquivo">
            </div>
            <input type="file" id="newNoticia_imagem" oninput="mostrarNomeImagem()" name="imagem">
            <div class="campo div-submit">
                <input type="submit" class="atrib_noticia" id="newNoticia_submit">
            </div>
        </form>
    </div>

    <?php
        include "../Templates/rodape.php";
    ?>

</body>
</html>