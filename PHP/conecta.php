<?php
$conexao = mysqli_connect('localhost','root','','site_polo') or die('Erro ao cadastrar');
if(!$conexao){
    echo "Error: Não posso conectar com o MySQL" . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
   }

?>