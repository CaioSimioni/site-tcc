<?php
    require "../System/classes.php";
    $user  = new Usuario;
    $noticia = new Noticia;
    $banco = new BancoBD;

    $titulo    = isset($_POST['titulo'])    ? $_POST['titulo']    : NULL;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : NULL;
    $fonte     = isset($_POST['fonte'])     ? $_POST['fonte']     : NULL;
    $data      = isset($_POST['data'])      ? $_POST['data']      : NULL;
    $imagem    = isset($_POST['imagem'])    ? $_POST['imagem']    : NULL;

    if($titulo && $descricao && $fonte && $data && $imagem){

        if(!empty($titulo) || !empty($descricao) || !empty($fonte) || !empty($data) || !empty($imagem)){

            if($banco->conectar()){

                if($noticia->cadastrarNoticia($titulo, $descricao, $fonte, $data, $imagem)){
                    echo "<script> alert('Notícia cadastrada com sucesso.');</script>";

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
            <p class="atrib_noticia">Título: <input    type="text" id="newNoticia_titulo"    name="titulo"    ></p> 
            <p class="atrib_noticia">Descrição: <input type="text" id="newNoticia_descricao" name="descricao" ></p>
            <p class="atrib_noticia">Fonte: <input     type="text" id="newNoticia_fonte"     name="fonte"     ></p>
            <p class="atrib_noticia">Data: <input      type="date" id="new_noticia_data"     name="data"      ></p>
            <p class="atrib_noticia">Imagem: <input    type="file" id="newNoticia_imagem"    name="imagem"    ></p>
            <input type="submit" class="atrib_noticia" id="newNoticia_submit">
        </form>
        <div id="mensagem"></div>
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
</html>