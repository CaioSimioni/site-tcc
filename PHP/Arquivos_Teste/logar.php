<?php
include "conecta.php";
session_start();

 if(empty($_POST['nome']) || empty($_POST['senha'])  ){
    echo "ta vazio,vou colocar algo aqui";
     exit();
 }

 $usuario=mysqli_real_escape_string($conexao ,$_POST['nome']);
 $senha=mysqli_real_escape_string($conexao,md5($_POST['senha']));


$query = "select codigo_usuario,usuario from usuario where usuario='{$usuario}' and senha='{$senha}'  ";
$result=mysqli_query($conexao,$query);
$row = mysqli_num_rows($result);

 if($row == 1){
    $_SESSION['usuario']=$usuario;
   echo "deu bom";
   exit();  
 } 
    else {
    echo "usuario n existente ou senha incorreta";
    exit();

 }
