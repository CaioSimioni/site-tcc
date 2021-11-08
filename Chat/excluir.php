<?php

require "../System/classes.php";
    $chat = new Chat;
    $banco = new BancoBD;
    if(!$banco->conectar()){
        echo "<script> alert('[Erro] Não foi possível se conectar ao sistema.') </script>";
        echo "<script> history.go(-1) </script>";
        exit;
    }

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

    $id_msg = isset($_GET['idmsg']) ? $_GET['idmsg'] : NULL;

    if($id_msg){

        $bd_msg = $chat->deletaMensagem($id_msg);
        
        if($bd_msg){  // Se o meu retorno foi verdadeiro.
            $n = $bd_msg['user'];
            $d = $bd_msg['id'];
            echo "<script> alert('Mensagem [".$d."] do usuário [".$n."] foi excluída com sucesso.') </script>";
            echo "<script> window.location.href='../Chat' </script>";
            exit;

        }else{
            echo"<script> alert('[Error] Não foi pessível excluir a Mensagem') </script>";
            echo "<script>window.location.href='../Chat'</script>";
            exit;
        }

    }else{
        echo"<script> alert('[Error] Não foi pessível excluir a Mensagem') </script>";
        echo "<script>window.location.href='../Chat'</script>";
        exit;
    }
?>