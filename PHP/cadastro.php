<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLO</title>
    <link rel="stylesheet" href="../css/style_cadastro.css">
    <link rel="shortcut icon" href="../ASSETS/LogoArara.png" type="image/x-icon">

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
        $exi = $_SESSION['usuario_e'];
        if($exi==0){
            echo "<script> alert('Usuario ou email ja utilizado!') </script>";
            $_SESSION['usuario_e']=1;
        }
    ?>

</head>
<body>
    <div id="global">
        <?php
            include "../HTML/cabecalho.html";
        ?>
        <div class="global">
            <div class="formulario">
                <form  name="formu"  method="POST" action="../PHP/registrar.php">
                    <h1>Cadastrar</h1>
                    <input placeholder="Nome do Usuário" type="text" name="usuario" size="20">
                    <input placeholder="Email" type="text" name="email" size="20">
                    <input placeholder="Senha"  type="password" name="senha" size="20">
                    <input placeholder="Confirmar Senha"  type="password" name="conf_senha" size="20">
                    <input type="submit" value="Criar Conta" name="btn_criar" onclick="return validar()">
                </form>
            </div>
        </div>
        <?php
            include "../HTML/rodape.html";
        ?>
    </div>
</body>
</html>
