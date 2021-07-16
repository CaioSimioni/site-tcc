<?php
    session_start();
    unset($_SESSION['codigo_usuario']);
    unset($_SESSION['nome_usuario']);
    unset($_SESSION['email_usuario']);
    unset($_SESSION['imagem']);
    unset($_SESSION['logged']);
    session_destroy();
    echo "<script> window.location.href = '../index.php'</script>";
?>