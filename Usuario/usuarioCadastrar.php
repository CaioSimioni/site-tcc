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
    <link rel="stylesheet" href="../Css/style_usuarioCadastrar.css">
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
            <h1 class="title">Cadastrar novo usuário</h1>
            <div class="content">
                
                <div class="group name">
                    <p>Nome</p>
                    <input required class="campo" type="text" name="usuario">
                </div>

                <div class="group email">
                    <p>E-mail</p>
                    <input required class="campo" type="email" name="email">
                </div>

                <div class="group senha">
                    <p>Senha</p>
                    <input required class="campo" type="password" name="senha" id="senha">
                </div>

                <div class="group confsenha">
                    <p>Confirmar Senha</p>
                    <input required class="campo" type="password" name="conf_senha" id="conf_senha">
                </div>

                <div class="group radio">
                    
                    <h2 class="title-radio">Cargos</h2>

                    <div class="user">
                        <input type="radio" name="cargo" class="cargo-user che" id="cargo_comum" value="Usuario" checked>
                        <label for="cargo_comum">Usuario</label>
                    </div>

                    <div class="adm">
                        <input type="radio" name="cargo" class="cargo-adm" id="cargo_admin" value="Admin">
                        <label for="cargo_admin">Administrador</label>
                    </div>
                
                </div>
                
                
                
                
                <input type="submit" value="Cadastrar" class="btn">
            </div>
        </form>

    </div>
    <?php include "../Templates/rodape.php" ?>
    <script src="../Js/usuario_cadastro.js"></script>
</body>
</html>