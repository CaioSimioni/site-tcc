<?php
    require "../System/classes.php";
    $user = new Usuario;
    $banco = new BancoBD;
    $new = new Noticia;

    $banco->conectar();

    $cod_noticia = isset($_GET['idnoticia']) ? $_GET['idnoticia'] : NULL;

    if($cod_noticia){

        $noticia = $new->pegarNoticia($cod_noticia);

        $titulo_new     = isset($noticia[0]) ? $noticia[0] : NULL;
        $descricao_new  = isset($noticia[1]) ? $noticia[1] : NULL;
        $fonte_new      = isset($noticia[2]) ? $noticia[2] : NULL;
        $data_new       = isset($noticia[3]) ? $noticia[3] : NULL;
        $imagem_new     = isset($noticia[4]) ? $noticia[4] : NULL;

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
        <form action="" method="post">
            <div class="campo div-title">
                <p>Título</p>
                <input type="text" id="newNoticia_titulo" name="titulo" value="<?php echo $titulo_new;?>">
            </div>
            <div class="campo div-descricao">
                <p>Descrição</p>    
                <textarea id="newNoticia_descricao" name="descricao"> <?php echo$descricao_new;?></textarea>
            </div>
            <div class="campo div-fonte">
                <p>Fonte</p>
                <input type="text" id="newNoticia_fonte" name="fonte" value="<?php echo $fonte_new;?>">
            </div>
            <p>Data</p>
            <div class="campo div-data-file">
                <input type="date" id="new_noticia_data" name="data" value="<?php echo $data_new;?>">
                <div class="imagem">
                    <label onclick="a()" for="imagem">Enviar Imagem</label>
                    <div id="nome-arquivo">Nenhum Arquivo Selecionado</div>
                </div>
            </div>
            <div class="campo div-nome-arquivo">
            </div>
            <input type="file" id="newNoticia_imagem" oninput="mostrarNomeImagem()" name="imagem" value="<?php echo $imagem_new;?>">
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