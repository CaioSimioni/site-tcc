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
                $msgUsuario = isset($_POST['mensagem']) ? $_POST['mensagem'] : NULL;
                /* 
                Se exitir $_POST['mensagem'] receba $_POST['mensagem'] senão receba NULL
                Poderia colocar ->  $msgUsuario = $_POST['mensagem'] ?? NULL;
                mas para sumir o erro quefica tanto no leitor de PHP do VSCode dexei desse jeito  mesmo.
                */

                if($msgUsuario){
                    $sql = $pdo->query("INSERT INTO `chat-geral` (`id_usuario`, `nome_usuario`, `mensagem`) VALUES ('$idUsuario', '$nomeUsuario', '$msgUsuario')");
                    $_POST['mensagem'] = NULL;
                    $msgUsuario = NULL;
                }

                

            ?>

        </div>


        <div id="conteudo">
            <h1>Noticias Mais Recentes</h1>
            <div class="noticia">
                <h1>Nova temporada Apex Legends</h1> <!--Titulo da notica-->
                <img src="../ASSETS/FotosNotícias/apexlegends.jpg" alt=""> <!--Imagem da notica-->
                <p>Nova temporada do apex legends chega cheia de bugs e erros</p><!--Descrição da notica-->
            </div>
            
        </div>

    </div>
    <?php
        include "../COMPONENTS/rodape.html";
    ?>
</body>
</html>