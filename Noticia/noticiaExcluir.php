<?php
    require "../System/classes.php";
    $user = new Usuario;
    $banco = new BancoBD;
    $new = new Noticia;
    $banco->conectar(); 

    global $pdo;
    if(isset($_POST['id_noticia'])){
        $id_noticia = addslashes($_POST['id_noticia']);  
        $new->excluirNoticia($id_noticia);
    }
    
?>