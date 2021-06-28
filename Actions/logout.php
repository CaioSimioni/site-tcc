<?php
session_start();
unset($_SESSION['codigo_usuario']);
unset($_SESSION['logged']);
session_destroy();
echo "<script> window.location.href = '../index.php'</script>";
?>