<?php
session_start();
include "conecta.php";

$usuario=mysqli_real_escape_string($conexao ,$_POST['nome']);
$email=mysqli_real_escape_string($conexao ,$_POST['email']);
$senha=mysqli_real_escape_string($conexao ,md5($_POST['senha']));

$query = "select * from usuario where usuario='{$usuario}' or email='{$email}' ";
$result=mysqli_query($conexao,$query);
$row = mysqli_num_rows($result);
 
if($row == 1){
  echo "usu existe";
  exit();
}else{
  $sql= "insert into usuario(email,senha,usuario)
  values('$email','$senha','$usuario')";
  if (mysqli_query($conexao, $sql)) {
    echo "Registro gravado com sucesso";
    header('login.html');
  }else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conexao);
  }
mysqli_close($conexao);
}
?>

<html>
<head>
</head>
<body onload="exit()">
<script>
  function exit(){
    window.location.href = "http://127.0.0.1/edsa-tcc/login.html";}

</script>

</body>
</html>