<?php
require "usuario.php";
$u = new Usuario;
$u->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
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
    <link rel="shortcut icon" href="../ASSETS/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/style_home.css">

<script type="text/javascript">

    function ajax(){

        var req = new XMLHttpRequest();
        req.onreadystatechange = function(){

            if(req.readyState == 4 && req.status == 200){
                document.getElementById('chat-mensagens').innerHTML = req.responseText;
            }
        }
        req.open('GET', 'chat.php', true)
        req.send();
    }

    setInterval(function(){ajax();}, 1000)

</script>

</head>
<body onload="ajax()">
    <?php
        include "../COMPONENTS/cabecalho.html";
    ?>
    <div id="global">

        <div id="chat">

            <h1>Chat geral</h1>
            <div id="chat-mensagens">

            </div>
            <form method="POST" action="home.php">
                <input placeholder="Diga ola :D" type="text" name="mensagem" maxlength="100">
                <input type="submit" valeu="Enviar">
            </form>
            <?php
                $idUsuario = $_SESSION['codigo_usuario'];
                $nomeUsuario = $_SESSION['nome_usuario'];
                $msgUsuario = $_POST['mensagem'] ?? NULL;
                /* Ele tá erro mas é por causa do Leitor do PHP, mas essa função ?? já existe no PHP.*/

                if($msgUsuario){
                    $sql = $pdo->query("INSERT INTO `chat-geral` (`id_usuario`, `nome_usuario`, `mensagem`) VALUES ('$idUsuario', '$nomeUsuario', '$msgUsuario')");
                }

            ?>

        </div>


        <div id="conteudo">
            
        </div>

    </div>
    <?php
        include "../COMPONENTS/rodape.html";
    ?>
</body>
</html>