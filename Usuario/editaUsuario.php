<?php
    require "../System/classes.php";
    $user = new Usuario;
    $banco = new BancoBD;

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

    $usuario_codigo = isset($_POST['cod_usuario']) ? $_POST['cod_usuario'] : NULL;
    $usuario_nome   = isset($_POST['usuario'])     ? addslashes($_POST['usuario'])     : NULL;
    $usuario_email  = isset($_POST['email'])       ? addslashes($_POST['email'])       : NULL;
    if(isset($_POST['cargo'])){
        $usuario_cargo = $_POST['cargo'] == "admin" ? 1 : 0;
    }

    if($banco->conectar()){

        if($user->editarUsuario($usuario_codigo, $usuario_nome, $usuario_email, $usuario_cargo)){
            echo"<script> alert('Usuário editado com SUCESSO') </script>";
            echo"<script> window.location.href = 'usuarioSelecionar.php' </script>";
        }else{
            echo"<script> alert('[Erro] Não foi possível editar o usuário.') </script>";
            echo"<script> window.location.href = 'usuarioSelecionar.php' </script>";
        }

    }else{
        echo"<script> alert('[Erro] Falha na conexãocom o banco de dados.') </script>";
    }
?>