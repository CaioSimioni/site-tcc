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

    $id_noticia = isset($_POST['cod_noticia'])  ? $_POST['cod_noticia'] : NULL;
    $titulo     = isset($_POST['titulo'])       ? $_POST['titulo']      : NULL;
    $descricao  = isset($_POST['descricao'])    ? $_POST['descricao']   : NULL;
    $fonte      = isset($_POST['fonte'])        ? $_POST['fonte']       : NULL;
    $data       = isset($_POST['data'])         ? $_POST['data']        : NULL;
    $imagem     = isset($_FILES['imagem'])      ? $_FILES['imagem']     : NULL;

    if($banco->conectar()){
                    
        $imagemInserirda = false;

        $titulo = str_replace("'", "\'", $titulo);
        $fonte = str_replace("'", "\'", $fonte);
            
        $arquivo = $imagem['name'];
        $sql = $pdo->prepare("UPDATE `noticia` SET `fonte` = '$fonte', `descricao` = '$descricao', `titulo` = '$titulo', `imagem` = '$arquivo' WHERE `noticia`.`id_noticia` = '$id_noticia'");
        $sql->bindValue(":d", strval($data));
        $sql->execute();

        $arquivoExtensao = explode('.', $imagem['name']);

        if($arquivoExtensao[sizeof($arquivoExtensao) - 1] == 'jpg' or $arquivoExtensao[sizeof($arquivoExtensao) - 1] == 'jpeg' or $arquivoExtensao[sizeof($arquivoExtensao) - 1] == 'png'){
            move_uploaded_file($imagem['tmp_name'], '../Materials/ImagensNoticias/'.$imagem['name']);
            $imagemInserirda = true;
        }else{
            $imagemInserirda = false;
        }

        if($sql->rowCount() > 0 && $imagemInserirda){
            echo "<script> alert('Notícia editada com sucesso.');</script>";
            echo "<script> window.location.href = 'noticiaSelecionar.php';</script>";
            exit;
        }else{
            echo "<script> alert('Não foi possível editar a notícia.');</script>";
            echo "<script> window.location.href = 'noticiaSelecionar.php';</script>";
            exit;
        }

    }else{
        echo "<script> alert('Impossível conectar com o Banco.');</script>";
        echo "<script> window.location.href = 'noticiaSelecionar.php';</script>";
        exit;
    }

?>