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

$cod = $_GET['idnoticia'];
$sql=$pdo->prepare( "DELETE FROM `noticia` WHERE `noticia`.`id_noticia` = '$cod'");
$sql->execute();
echo "<script>window.location.href='noticiaSelecionar.php'</script>";
?>

