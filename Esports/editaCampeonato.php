<?php
    require "../System/classes.php";
    $user = new Usuario;
    $banco = new BancoBD;
    $esports = new Esports;

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

    $campeonato = array(
        "id" => isset($_POST['id_camp']) ? $_POST['id_camp'] : NULL,
        "nome" => isset($_POST['name_camp']) ? $_POST['name_camp'] : NULL,
        "categoria" => isset($_POST['categoria_camp']) ? $_POST['categoria_camp'] : NULL,
        "data" => isset($_POST['datetime_camp']) ? $_POST['datetime_camp'] : NULL,
        "status" => isset($_POST['status_camp']) ? $_POST['status_camp'] : NULL
    );

    foreach($campeonato as $key => $value){
        if(!$value){
            echo"<script> alert('Valores de $key é inválido. [ $key => $value ]') </script>";
            echo "<script> window.location.href='./campeonatoSelecionar.php' </script>";
            exit;
        }
    }

    if($banco->conectar()){

        if($esports->editarCampeonato($campeonato['id'],  $campeonato['nome'], $campeonato['categoria'], $campeonato['data'], $campeonato['status'])){
            echo"<script> alert('Campeonato editado com SUCESSO') </script>";
            echo"<script> window.location.href = 'campeonatoSelecionar.php' </script>";
            exit;
        }else{
            echo"<script> alert('[Erro] Não foi possível editar o campeonato.') </script>";
            /*
            echo"<script> window.location.href = 'campeonatoSelecionar.php' </script>";
            exit;
            */
        }

    }else{
        echo"<script> alert('[Erro] Falha na conexão com o banco de dados.') </script>";
        echo"<script> window.location.href = 'campeonatoSelecionar.php' </script>";
        exit;
    }

?>