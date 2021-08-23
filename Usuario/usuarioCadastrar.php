<?php
    require "../System/classes.php";
    $banco = new BancoBD;
    $user = new Usuario;

    $banco->conectar();

    if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
        echo "<script> alert('Falha na autenticação de usuário!')</script>";    
        echo "<script>window.location.href='../index.php'</script>";
        exit;
    }

    if($_SESSION['adm'] == false) {
        echo "<script>alert('Você não tem permissão para entrar nesta área')</script>";
        echo "<script>window.location.href='../index.php'</script>";
        exit;
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/style_cadastrarUsuario.css">
</head>
<body>

    <?php include "../Templates/cabecalho.php" ?>
    <div id="global">

        <?php
            // verificar se clicou no  botao
            if(isset($_POST['usuario'])){
                $usuario = addslashes($_POST['usuario']);
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);
                $confirmarSenha = addslashes($_POST['conf_senha']);
                if ($_POST['cargo'] == "Usuario") {
                    $cargo = 0;
                }if($_POST['cargo'] == "Admin"){
                    $cargo = 1;
                }

                if(!empty($usuario) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){

                    if($senha == $confirmarSenha){

                        if($banco->conectar()){

                            if($user->cadastrarUsuario($usuario, $email, $senha, $confirmarSenha, $cargo)){

                                echo"<script> alert('Cadastrado com sucesso!') </script>";
                                echo"<script> window.location.href = '../Usuario/usuarioSelecionar.php' </script>";

                            }else{
                                echo"<script> alert('Não foi possível cadastrar.  Nome de usuário ou Email já cadastrados.') </script>";
                            }

                        }else{
                            echo"<script> alert('Falha na conexão com o Banco de Dados.  Tente mais tarde.') </script>";
                        }

                    }else{
                        echo"<script> alert('As senhas são diferentes.') </script>";
                    }

                }else{
                    echo"<script> alert('Preencha todos os campos.') </script>";
                }
            }
        ?>

        <form action="#" method="post" id="form_cadastrar">
            <h1 class="form_element">Cadastrar novo usuário</h1>
            <p class="form_element">
                Nome: <input type="text" name="usuario">
            </p>
            <p class="form_element">
                Email: <input type="email" name="email">
            </p>
            <p class="form_element">
                Senha: <input type="password" name="senha" id="senha">
            </p>
            <p class="form_element">
                Confirmar senha: <input type="password" name="conf_senha" id="conf_senha">
            </p>
            <p class="form_element" id="cargos">
                Cargo: 
                <input type="radio" name="cargo" id="cargo_comum" value="Usuario" checked><label for="cargo_comum">Usuario</label>
                <input type="radio" name="cargo" id="cargo_admin" value="Admin"><label for="cargo_admin">Administrador</label>
            </p>
            <input type="submit" value="Cadastrar" class="form_element">
        </form>

    </div>
    <?php include "../Templates/rodape.php" ?>

</body>
</html>