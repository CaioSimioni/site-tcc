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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="../Css/style_adm.css">
    <link rel="stylesheet" href="../Css/style_campeonatoSelecionar.css">

</head>
<body>

    <?php include "../Templates/cabecalho.php" ?>

    <div id="global">
        <section>
            <table>
                <thead>
                    <tr>
                        <td><strong>Código</strong></td>
                        <td class="title"><strong>Nome</strong></td>
                        <td><strong>Data</strong></td>
                        <td class="data"><strong>Status</strong></td>
                        <td><strong>Funções</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($banco->conectar()){
                            if($esports->selecionarCampeonatos()){

                            }else{
                                echo"<tr><td colspan='5'> Nenhum campeonato encontrado... <a href='./campeonatoCadastrar.php'>Cadastrar Campeonato</a> </td></tr>";
                            }
                        }else{
                            echo"<script> alert('Não foi possível conectar com o Banco de Dados.') </script>";
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <?php include "../Templates/rodape.php" ?>

</body>
</html>