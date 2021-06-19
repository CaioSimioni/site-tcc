<?php
$conexao = mysqli_connect('fdb32.awardspace.net','3863708_polo','bix*/oZm51lVtT5n','3863708_polo') or 
die('Erro ao cadastrar');
if(!$conexao){
    echo "Error: Não posso conectar com o MySQL" . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
   }

?>