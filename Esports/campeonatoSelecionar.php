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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/style_adm.css">

    <!-- Testes de Style -->
    <style>
        table{
            margin: auto;
        }

        th, tr, td{
            border: 1px solid black;
            padding: 5px;
        }

        th{
            background-color: #d17771;
        }

        table{
            border-collapse: collapse;
        }
    </style>

</head>
<body>

    <?php include "../Templates/cabecalho.php" ?>

    <div id="global">
    <section class="section">
        <h1>Campeonatos</h1>
            <table class="tabela">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Funções</th>
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