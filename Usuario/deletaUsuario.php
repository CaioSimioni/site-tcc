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

    if($banco->conectar()){

        $cod = $_GET['idusuario'];
        $sql=$pdo->prepare( "DELETE * FROM `usuario` WHERE `usuario`.`codigo_usuario` = $cod");
        $sql->execute();

        if($sql->rowCount() > 0){
            echo"<script> alert('Usuário de código ".$cod." foi excluído com sucesso.') </script>";
            echo "<script>window.location.href='usuarioSelecionar.php'</script>";
            exit;
        }else{
            echo"<script> alert('[Error] Não foi pessível excluir usuário') </script>";
            echo "<script>window.location.href='usuarioSelecionar.php'</script>";
            exit;
        }

    }else{
        echo"<script> alert('Falha na conexão. Tente mais tarde.') </script>";
        echo"<script> window.location.href = 'selecionarUsuario.php' </script>";
        exit;
    }

?>