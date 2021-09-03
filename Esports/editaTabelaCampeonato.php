<?php
require "../System/classes.php";
$esports = new Esports;

if(!isset($_POST['camp_id'])){
    echo"<script> alert('Acesso inválido!'); window.location.href = '../Pages/home.php'; </script>";
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

var_dump($_POST);

if(isset($_POST['camp_id'])){

    if($esports->alterarTabela($_POST['camp_local_arquivo_tab'], $_POST['camp_nova_tab'])){
        $id_camp = $_POST['camp_id'];
        echo "<script>alert('Tabela alterada com SUCESSO!')</script>";
        echo "<script>window.location.href='./campeonatoVisualizar.php?idcampeonato=$id_camp'</script>";
        exit;
    }else{
        echo "<script>alert('[Erro] Falha ao alterar a tabela.')</script>";
        echo "<script>window.location.href='./campeonatoVizualizar.php'</script>";
        exit;
    }

}else{
    echo"<script> alert('Valor de tabela inválido!'); window.location.href = '../Pages/home.php'; </script>";
    exit;
}

?>