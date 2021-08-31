<?php

if (!isset($_POST['tabCamp'])) {
    echo "<script> alert('Acesso inválido!'); window.location.href = 'index.php'; </script>";
    exit;
}

var_dump($_POST);
file_put_contents('tabs_camps\\' . $_POST['nameTabCamp'] . '.php', $_POST['tabCamp']);

echo "<button><a href='index.php'>Voltar</a></button>";

?>

