<?php
    require "../System/classes.php";
    $user = new Usuario;
    $banco = new BancoBD;
    $new = new Noticia;

    $banco->conectar();

$cod = $_GET['cod'];
$sql=$pdo->prepare( "DELETE FROM `noticia` WHERE `noticia`.`id_noticia` = '$cod'");
$sql->execute();
echo "<script>window.location.href='noticiaEditar.php'</script>";
?>

