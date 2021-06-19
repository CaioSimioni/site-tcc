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
   // transferir para a pagina de registro com uma mensagem dizendo que o email ou usuario ja foram usados
   // no link abaixo redireciona pra pagina do cadastro, ja que deu ruim
   echo "<script> window.location.replace('./cadastro.php') </script>";
  $_SESSION['usuario_e']=0;
 exit();
 }

else{
$sql= "insert into usuario(email,senha,usuario)
values('$email','$senha','$usuario')";
  if (mysqli_query($conexao, $sql)) {
   echo "Registro gravado com sucesso";
   header('#');
    } 
else {
 echo "Error: " . $sql . "<br>" . mysqli_error($conexao); }
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