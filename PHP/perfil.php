<?php
require "usuario.php";
$u = new Usuario;
$u->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

// credito do css para 


//funcionou, porém sempre que da F5 ele manda a imagem dnv, e tem que descobrir um jeito de sempre que a pessoa fizer
//o update de uma imagem, excluir a que ele tinha, tenho uma ideia de no processo de clicar em salvar, descobrir o
// nome da imagem anterior e excluir a que tinha antes. A Pagina Upload serve pra guardar as imagens.

$msg=false;
$cod_usu=$_SESSION['codigo_usuario'];
 $imagem=$_SESSION['imagem']; 

//acredito que aqui que esteja causando a falha do F5

if(isset($_FILES['arquivo'])){
    $extensao = strtolower(substr($_FILES['arquivo'] ['name'],-4));
    $novo_nome =$cod_usu.$extensao;
    $diretorio="upload/";
    
   // aqui ele move a imagem que fica flutuando por ai pra pasta
   array_map('unlink',glob("upload/$novo_nome"));
   move_uploaded_file($_FILES['arquivo'] ['tmp_name'],$diretorio.$novo_nome);
   
   //aqui ele manda o comando update com o nome da imagem e a data do upload, da pra usar a data pra alguma coisa talvez.
    $sql_code="UPDATE `usuario` SET `imagem` = '$novo_nome',data=now() WHERE `usuario`.`codigo_usuario` = $cod_usu;";
    $_FILES['arquivo']=null;
    
    //Usei o $pdo pq ele é basicamente a variável conexão.
        if($pdo->query($sql_code)){ $msg="Arquivo enviado com sucesso"; }
        else{$msg="Arquivo na enviado com sucesso"; }
        echo "<script> window.location.href='redirecionar.php' </script>";
}


?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="shortcut icon" href="../ASSETS/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/estilo_perfil.css">

</head>
<body onload="ajax()">
    <?php
        include "../COMPONENTS/cabecalho.html";
    ?>
    <div id="global">         </div>

    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <div class="perfil-usuario-avatar">
                    <img src="upload/<?php echo $imagem; ?>"  width=160px height=170px alt="img-avatar">

                <button  onclick="inicialModal('modal-promocao');" type="button" class="boton-avatar" >
                    <i class="far fa-image">
                 <a>   <img src="upload/icon.png" alt="img-avatar"> </a>
                                 
                    </i>
                    </button>
                    
                </div>
                
                
            </div>


        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo"><?php $usu=$_SESSION['nome_usuario']; echo $usu   ?></h3>
                <p class="texto">Email: <?php $email= $_SESSION['email_usuario']; echo $email ?></p>
            </div>
            </div>


        </div>
    </section>



            <div id="conteudo">
            
        </div>
    </div>

    <?php
        include "../COMPONENTS/rodape.html";
    ?>
  

<style>

</style>

   <div id="modal-promocao" class="modal-container">
       <div class="modal">
       <button class="fechar">x</button>
       <section class="seccion-perfil-usuario">

       <div class="perfil-usuario-portadaa">
                <div class="perfil-usuario-avatar-upload">
                    <img src="upload/<?php echo $imagem; ?>" width=160px height=150px alt="img-avatar">     </div>                
            </div>


   <form class="forms" action="perfil.php" method="POST" enctype="multipart/form-data">
                    <input type="file"  required name="arquivo">
                    <input type="submit" value="Editar">
    </form>

  </div>
</div> 


 <script>
   function inicialModal(modalId){
       const modal=document.getElementById(modalId);
       if(modal){
       modal.classList.add('mostrar');
       modal.addEventListener('click',(e)=>{
           if(e.target.id==modalId || e.target.className=='fechar'){
         modal.classList.remove('mostrar');
           }
       });
       }

   }
   

     </script>
 
</body>



</html>