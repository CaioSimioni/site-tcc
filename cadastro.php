
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLO</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="ASSETS/LogoArara.png" type="image/x-icon">

<!--- aqui e o script que se o usuario nao colocar os dados, aparece o pop-up --->
    <script type="text/javascript">
     function validar(){
        var usu = formu.usuario.value;
        if( usu == ""){
             alert('preencha o campo usuário');
             formu.usuario.focus();
             return false;
         }

         var em = formu.email.value;
         if(em == "" ){
            alert('preencha o campo email');
             formu.email.focus();
             return false;
         }         



        var senha = formu.senha.value;
        var conf_senha = formu.conf_senha.value;
        if(senha == "" || senha.length<=5 ||conf_senha == ""  || conf_senha.length <= 5 ){
             alert('preencha o campo senha com minimo 6 caracteres');
             formu.senha.focus();
             return false;
         }         
        if(senha != conf_senha){
               alert('Senhas diferentes');
               formu.senha.focus();
               return false;
        }  
            } 

    </script>
    
    <!-- retorno se o usuario ou email ja foi utilizado-->
    <?php
      session_start();
      $exi =$_SESSION['usuario_e'];
      if($exi==0){
      echo "<script> alert('Usuario ou email ja utilizado!') </script>";
      $_SESSION['usuario_e']=1;    }
    
    ?>



</head>
<body>
    <div id="global">

        <header class="header">
            <img class="logo" src="./ASSETS/LogoPOLO.png" alt="logo">
            <nav>
                <ul class="nav__links">
                    <li><a href="#">E-Sports</a></li>
                    <li><a href="#">Tópicos</a></li>
                    <li><a href="#">Perfil</a></li>
                </ul>
            </nav>
            <a class="cta" href="./PHP/informacoes.php"><button>Mais informações</button></a>
        </header>
                <?php
              
                ?>
       

            </div>
            <div class="formulario">
                <form  name="formu"  method="POST" action="PHP/registrar.php">
                  <h1>Junte-se a nós</h1>
        <p align="center"> <input placeholder="Nome do Usuário" type="text" name="usuario" size="20"></p>
        <p align="center"> <input placeholder="Email@endereco.com" type="text" name="email" size="20"></p>
        <p align="center"> <input placeholder="Senha"  type="password" name="senha" size="20"></p>
        <p align="center"> <input placeholder="Confirmar Senha"  type="password" name="conf_senha" size="20"></p>
        <p align="center"> <input type="submit" value="Criar Conta" name="btn_criar" onclick="return validar()"></p>
        
    </form>

            </div>
        </div>

      
      

        <footer id="final">
            <img src="ASSETS/LogoPOLO.png" alt="">
            <ul>
                <li><a href="">Contato</a></li>
                <li><a href="">Reclamações</a></li>
                <li><a href="">Suporte</a></li>
            </ul>
            <span>&copy;Copyright POLO-2021</span>
        </footer>
        
    </div>
</body>
</html>