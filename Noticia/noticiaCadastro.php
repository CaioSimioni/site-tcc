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


    $titulo    = isset($_POST['titulo'])    ? $_POST['titulo']    : NULL;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : NULL;
    $fonte     = isset($_POST['fonte'])     ? $_POST['fonte']     : NULL;
    $data      = isset($_POST['data'])      ? $_POST['data']      : NULL;
    $imagem    = isset($_FILES['imagem'])    ? $_FILES['imagem']    : NULL;

    if($titulo && $descricao && $fonte && $data && $imagem){

        if(!empty($titulo) || !empty($descricao) || !empty($fonte) || !empty($data) || !empty($imagem)){

            if($banco->conectar()){

                if($noticia->cadastrarNoticia($titulo, $descricao, $fonte, $data, $imagem)){

                    echo "<script> alert('Notícia cadastrada com sucesso.');</script>";
                    echo "<script> window.location.href = 'noticiaSelecionar.php';</script>";

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="stylesheet" href="../Css/style_newNoticia.css">
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
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
                <label onclick="a()" for="imagem">Enviar Imagem</label>
            </div>
            <div class="campo div-nome-arquivo">
                <div id="nome-arquivo">1382647fe3534eb1fde7cfb3fc2886b9.jpg</div>
            </div>
            <input type="file" id="newNoticia_imagem" oninput="mostrarNomeImagem()" name="imagem" accept=".jpg">
            <div class="campo div-submit">
                <input type="submit" class="atrib_noticia" id="newNoticia_submit">
            </div>
        </form>
        <div id="mensagem"></div>
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>

    <script src="../Js/newNot.js"></script>



</body>
</html>