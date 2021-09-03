<?php

require "../System/classes.php";
    $esports = new Esports;
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

        $bd_camp = $esports->deletaCampeonato($_GET['idcampeonato']);

        if($bd_camp){
            $n = $bd_camp['nome_camp'];
            $d = $bd_camp['id'];
            echo"<script> alert('[ Código => ".$d.", Nome => ".$n." ] Foi excluído com sucesso.') </script>";
            echo "<script>window.location.href='CampeonatoSelecionar.php'</script>";
            exit;
        }else{
            echo"<script> alert('[Error] Não foi pessível excluir o campeonato') </script>";
            echo "<script>window.location.href='campeonatoSelecionar.php'</script>";
            exit;
        }

    }else{
        echo"<script> alert('Falha na conexão. Tente mais tarde.') </script>";
        echo"<script> window.location.href = 'campeonatoSelecionar.php' </script>";
        exit;
    }
?>