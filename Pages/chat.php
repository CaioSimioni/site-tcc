<?php

require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;
$chat = new Chat;

if(!$banco->conectar()){
    echo "<script> alert('Não foi possível acessar o site.')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

// $chat->exibirMensagensChat()

if($chat->exibirMensagensChat()){
    // O chat está funcionando não precisa de nada.
}

?>
