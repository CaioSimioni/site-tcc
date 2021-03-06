<?php
require_once "../System/classes.php";  //  Importo o arquivo usuario.php
$user = new Usuario;   // Crio um objeto de Usuario
$banco = new BancoBD;

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

        <?php
            // verificar se clicou no  botao
            if(isset($_POST['usuario'])){
                $usuario = addslashes($_POST['usuario']);
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);
                $confirmarSenha = addslashes($_POST['conf_senha']);

                if(!empty($usuario) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){

                    if($banco->conectar()){

                        if($senha == $confirmarSenha){
                            
                            if($user->cadastrarUsuario($usuario, $email, $senha, $confirmarSenha, 0)){  // O valor 0 correponde ao cargo Comum
                                
                                ?>
                                <div id="msg-sucesso">
                                    Cadastrado com sucesso! Acesse para entrar.
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="msg-erro">Usuário ou Email já cadastrado</div>
                                <?php
                            }
                            
                        }else{
                            ?>
                            <div class="msg-erro">Senha e Confirmar senha estão diferentes</div>
                            <?php
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
            }
            ?>
            <div class="formulario">
                <form method="POST">
                    <h1>Cadastrar</h1>
                    <input placeholder="Nome do Usuário" type="text" name="usuario" size="20">
                    <input placeholder="Email" type="text" name="email" size="20">
                    <input placeholder="Senha" type="password" name="senha" size="20">
                    <input placeholder="Confirmar Senha" type="password" name="conf_senha" size="20">
                    <input type="submit" value="Criar Conta">
                    <a href="../index.php">Já está cadastrado? <strong>Entrar</strong></a>
                </form>
            </div>
        
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
