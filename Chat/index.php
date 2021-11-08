<?php
/**
 *  Em nessa página o administrador verifica as mensagens enviadas nos chats
 */

require '../System/classes.php';

$banco = new BancoBD;
if(!$banco->conectar()){
    echo "<script> alert('[Erro] Não foi possível se conectar ao sistema.') </script>";
    echo "<script> history.go(-1) </script>";
    exit;
}

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";
    echo "<script> history.go(-1) </script>";
    exit;
}

if($_SESSION['adm'] == false) {
    echo "<script>alert('Você não tem permissão para entrar nesta área')</script>";
    echo "<script> history.go(-1) </script>";
    exit;
}

$chat = new Chat;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="./css/selecionar.css">
</head>
<body>
    <?php include '../Templates/cabecalho.php'?>

    <div class="global">
        <section>
            <table>
                <thead>
                    <tr>
                        <td><strong>Código</strong></td>
                        <td><strong>Chat</strong></td>
                        <td><strong>Mensagem</strong></td>
                        <td><strong>Data</strong></td>
                        <td><strong>Funções</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!$chat->exibirMensagensAdm()){
                            echo"<tr><td colspan='5'> Nenhum mensagem no sistema. <a href='./cadastrar.php'>Inserir Nova Mensagem</a> </td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <?php include '../Templates/rodape.php'?>
</body>
</html>