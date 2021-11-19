<?php

    require "../System/classes.php";
    $user = new Usuario;
    $banco = new BancoBD;
    $new = new Noticia;

    if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
        echo "<script> alert('Falha na autenticação de usuário!')</script>";    
        echo "<script>window.location.href='../index.php'</script>";
        exit;
    }

    if($_SESSION['adm'] == false) {
        echo "<script>alert('Você não tem permissão para entrar nesta área')</script>";
        echo "<script>window.location.href='../index.php'</script>";
        exit;
    }

    $banco->conectar();

    $cod_noticia = isset($_GET['idnoticia']) ? $_GET['idnoticia'] : NULL;

    if($cod_noticia){  
        $noticia = $new->pegarNoticia($cod_noticia);    // Seleciona a notícia que será editada.
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="../Css/style_noticiaEdita.css">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>

    <div id="global">
        <form action="editaNoticia.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="cod_noticia" value="<?php if($noticia['id']){echo $noticia['id'];}?>">
            <div class="campo div-title">
                <p>Título</p>
                <input type="text" id="newNoticia_titulo" name="titulo" value="<?php if($noticia['titulo']){echo $noticia['titulo'];}?>">
            </div>
            <div class="campo div-descricao">
                <p>Descrição</p>
                <textarea id="newNoticia_descricao" name="descricao"><?php if($noticia['descricao']){echo $noticia['descricao'];}?></textarea>
            </div>
            <div class="campo div-fonte">
                <p>Fonte</p>
                <input type="text" id="newNoticia_fonte" name="fonte" value="<?php if($noticia['fonte']){echo $noticia['fonte'];}?>">
            </div>
            <p>Data</p>
            <div class="campo div-data-file">
                <input type="date" id="new_noticia_data" name="data" value="<?php if($noticia['data']){echo $noticia['data'];}?>">
                <div class="imagem">
                    <label onclick="a()" for="imagem">Enviar Imagem</label>
                    <div id="nome-arquivo"><?php if($noticia['imagem']){echo $noticia['imagem'];}?></div>
                </div>
            </div>
            <div class="campo div-nome-arquivo">
            </div>
            <input type="file" id="newNoticia_imagem" oninput="mostrarNomeImagem()" name="imagem">
            <div class="campo div-submit">
                <a class="btn-voltar" href="../Admin/">Voltar</a>
                <input type="submit" class="atrib_noticia" id="newNoticia_submit">
            </div>
        </form>
    </div>

    <?php
        include "../Templates/rodape.php";
    ?>

<script src="../Js/noticia.js"></script>

</body>
</html>