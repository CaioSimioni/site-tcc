<?php
require_once "../System/classes.php";  //  Importo o arquivo usuario.php
$user = new Usuario;   // Crio um objeto de Usuario
$banco = new BancoBD;
$feed = new feedback;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="../Css/style_cadastrar.css">
</head>
<body>
    <div id="global">

        <!-- Cabeçalho do site -->
        <?php
            include "../Templates/cabecalho.php";
        ?>

       
            <div class="formulario">
                <form method="POST">
                    <h1>Envie-nos seu Feedback</h1>
                    <input placeholder="Nome" type="text" name="nome" size="20">
                    <input placeholder="Email" type="text" name="email" size="20">
                    <input placeholder="Mensagem" type="text" name="feedback" size="20"> 
                    <input type="submit" value="Enviar Feedback">
                </form>
            </div>
            <?php
            // verificar se clicou no  botao
            if(isset($_POST['nome'])){
                $usuario = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                $mensagem = addslashes($_POST['feedback']);

                if(!empty($usuario) && !empty($email) && !empty($mensagem) ){

                    if($banco->conectar()){
                            if($feed->EnviarFeed($usuario, $email, $mensagem)){ 
                                ?>
                                <div id="msg-sucesso">
                                   Feedback enviado com sucesso !!
                                </div>
                                <?php
                            }
                            
                        }
                        
                    }else{
                        ?>
                        <div class="msg-erro">
                            <?php echo "Erro:".$u->msgErro.""; ?>
                        </div>
                        <?php
                    }
                }else{
                    ?>
                    <div class="msg-erro">Peencha todos os campo!</div>
                    <?php
                }
            
            ?>
        <!-- Rodapé do site 
        <footer id="final">
            <img src="../Materials/polo_logo_white@2x.png">
            <span>&copy;Copyright POLO-2021</span>
            <ul>
                <li><a href="../Pages/sobre_nos.html">Sobre nós</a></li>
                <li><a href="">Fale conosco </a></li>
                <li><a href="">Política de privacidade </a></li>
                <li><a href="">aqui são redes sociais</a></li>
            </ul>
        </footer>

        -->

        <?php
            include "../Templates/rodape.php"
        ?>

    </div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
</html>
