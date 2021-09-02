<?php

if (!isset($_POST['camp_id'])) {
    echo "<script> alert('Acesso inválido!'); window.location.href = 'index.php'; </script>";
    exit;
}

var_dump($_POST);

if(file_put_contents('tabs_camps\\' . $_POST['camp_nameTab'] . '.php', $_POST['camp_newTab'])){
    echo PHP_EOL . "Tabela atualizada com SUCESSO! <br>" . PHP_EOL;
}

echo "<button><a href='index.php'>Voltar</a></button>";

?>

