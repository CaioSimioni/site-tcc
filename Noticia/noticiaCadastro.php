<?php

    require "../System/classes.php";
    $user  = new Usuario;
    $noticia = new Noticia;
    $banco = new BancoBD;

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

    $titulo    = isset($_POST['titulo'])     ? $_POST['titulo']    : NULL;
    $descricao = isset($_POST['descricao'])  ? $_POST['descricao'] : NULL;
    $fonte     = isset($_POST['fonte'])      ? $_POST['fonte']     : NULL;
    $data      = isset($_POST['data'])       ? $_POST['data']      : NULL;
    $imagem    = isset($_FILES['imagem'])    ? $_FILES['imagem']   : NULL;

    if($titulo && $descricao && $fonte && $data && $imagem){

        if(!empty($titulo) or !empty($descricao) or !empty($fonte) or !empty($data) or !empty($imagem)){

            if($banco->conectar()){

                if($noticia->cadastrarNoticia($titulo, $descricao, $fonte, $data, $imagem)){

                    echo "<script> alert('Notícia cadastrada com sucesso.');</script>";
                    echo "<script> window.location.href = 'noticiaSelecionar.php';</script>";
                    exit;

                }else{
                    echo "<script> alert('Não foi possível cadastrar a notícia.');</script>";
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
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="../Css/style_newNoticia.css">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>
    
    <div id="global">
        <h1>Nova notícia</h1>
        <form method="POST" action="noticiaCadastro.php" id="forms_newNoticia" enctype="multipart/form-data">
            <div class="campo div-title">
                <p>Título</p>
                <input type="text" id="newNoticia_titulo"    name="titulo" required>
            </div>
            <div class="campo div-descricao">
                <p>Descrição</p>    
                <textarea id="newNoticia_descricao" required name="descricao"></textarea>
            </div>
            <div class="campo div-fonte">
                <p>Fonte</p>
                <input type="text" id="newNoticia_fonte"  required   name="fonte">
            </div>
            <p>Data</p>
            <div class="campo div-data-file">
                <input type="date" id="new_noticia_data"  required   name="data">
                <div class="imagem">
                    <label onclick="a()" for="imagem">Enviar Imagem</label>
                    <div id="nome-arquivo">Nenhum Arquivo Enviado. (800 x 450) pixels</div>
                </div>
            </div>
            <div class="campo div-nome-arquivo">
            </div>
            <input type="file" id="newNoticia_imagem" oninput="mostrarNomeImagem()" name="imagem" accept=".png,.jpg,.jpeg">
            <div class="campo div-submit">
                <a class="btn-voltar" href="../Admin/admin.php">Voltar</a>
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