<?php
require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;
$chat = new Chat;

$banco->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="../Css/style_topicos.css">

    <script type="text/javascript">
        function ajax(){
            var req = new XMLHttpRequest();
            req.onreadystatechange = function(){
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('GET', 'chat.php', true);
            req.send();
        }
        setInterval(function(){ajax();},1000);
   </script>

</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>

<!-- -->

    <div id="global">
        <h1 class="title-page">Chat Geral</h1>
        <div class="box_form">
            <form class="form" method="post" action="topicos.php">
                <input class="input msg" type="text" name="mensagem" placeholder="Mensagem">
                <input class="input btn" type="submit" value="Enviar">
            </form>
        </div>

        <div id="chat">
        </div>
    
    </div> <!-- fim Global -->
    <?php
        include "../Templates/rodape.php";
    ?>
   
   <?php
        // Pegando os valores.
        $categoria_chat = $chat->chats['geral'];
        $id_usuario = $_SESSION['codigo_usuario'];
        $nome_usuario = $_SESSION['nome_usuario'];
        $foto_usuario = $_SESSION['imagem'];
        $texto = isset($_POST['mensagem']) ? $_POST['mensagem'] : null;  // Se existir $_POST['mensagem'] faça $mensagem = $_POST['mensagem'] senão $mensagem = null

        if($texto){ // Verifico se mensagem existe.

            if(!empty($texto)){  // Se a Mensagem não for vazia.

                if($banco->conectar()){   // Se existe conexão com o banco de dados

                    if($chat->inserirMensagem($categoria_chat, $id_usuario, $nome_usuario, $foto_usuario, $texto)){
                        //  Se cadastrada com Sucesso.
                        echo "<script> window.location.href = 'topicos.php' </script>";  // É cambiara eu sei :D
                    }else{
                        //  Se falhar a mensagem.
                        echo "<script> alert('Falha ao enviar a mensagem.') </script>";
                    }
                }

            }
        }
        exit;
    ?>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>