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
        $titulo_new     = isset($noticia[0]) ? $noticia[0] : NULL;
        $descricao_new  = isset($noticia[1]) ? $noticia[1] : NULL;
        $fonte_new      = isset($noticia[2]) ? $noticia[2] : NULL;
        $data_new       = isset($noticia[3]) ? $noticia[3] : NULL;
        $imagem_new     = isset($noticia[4]) ? $noticia[4] : NULL;
    }

    $titulo     = isset($_POST['titulo'])     ? $_POST['titulo']    : NULL;
    $descricao  = isset($_POST['descricao'])  ? $_POST['descricao'] : NULL;
    $fonte      = isset($_POST['fonte'])      ? $_POST['fonte']     : NULL;
    $data       = isset($_POST['data'])       ? $_POST['data']      : NULL;
    $imagem     = isset($_POST['imagem'])     ? $_POST['imagem']    : NULL;

    if($titulo && $descricao && $fonte && $data && $imagem){

        if(!empty($titulo) or !empty($descricao) or !empty($fonte) or !empty($data) or !empty($imagem)){

            if($banco->conectar()){

                if($noticia->editarNoticia($cod_noticia, $titulo, $descricao, $fonte, $data, $imagem)){

                    echo "<script> alert('Notícia editada com sucesso.');</script>";
                    echo "<script> window.location.href = 'noticiaSelecionar.php';</script>";

                }else{
                    echo "<script> alert('Não foi possível editar a notícia.');</script>";
                }

            }else{
                echo "<script> alert('Impossível conectar com o Banco.');</script>";
            }

        }else{
            echo "<script> alert('Preencha todos os campos!');</script>";
        }
    }

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
        <form action="noticiaEditar.php" method="POST" enctype="multipart/form-data">
            <div class="campo div-title">
                <p>Título</p>
                <input type="text" id="newNoticia_titulo" name="titulo" value="<?php if($titulo_new){echo $titulo_new;}?>">
            </div>
            <div class="campo div-descricao">
                <p>Descrição</p>    
                <textarea id="newNoticia_descricao" name="descricao"> <?php if($descricao_new){echo $descricao_new;}?></textarea>
            </div>
            <div class="campo div-fonte">
                <p>Fonte</p>
                <input type="text" id="newNoticia_fonte" name="fonte" value="<?php if($fonte_new){echo $fonte_new;}?>">
            </div>
            <p>Data</p>
            <div class="campo div-data-file">
                <input type="date" id="new_noticia_data" name="data" value="<?php if($data_new){echo $data_new;}?>">
                <div class="imagem">
                    <label onclick="a()" for="imagem">Enviar Imagem</label>
                    <div id="nome-arquivo"><?php if($imagem_new){echo $imagem_new;}?></div>
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

<script src="../Js/noticia.js"></script>

</body>
</html>