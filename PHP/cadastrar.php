<?php
require_once "usuario.php";  //  Importo o arquivo usuario.php
$u = new Usuario;   // Crio um objeto de Usuario

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="stylesheet" href="../css/style_cadastrar.css">
    <link rel="shortcut icon" href="../ASSETS/polo_icon.png" type="image/x-icon">
</head>
<body>
    <div id="global">

        <!-- Cabeçalho do site -->
        <header class="header">
            <img class="logo" src="../ASSETS/polo_logo_white@2x.png" alt="logo">
            <nav>
                <ul class="nav__links">
                    <li><a href="../index.php">Início</a></li>
                </ul>
            </nav>
            <a class="cta" href="../HTML/sobre_nos.html"><button>Sobre nós</button></a>
        </header>

        <?php
            // verificar se clicou no  botao
            if(isset($_POST['usuario'])){
                $usuario = addslashes($_POST['usuario']);
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);
                $confirmarSenha = addslashes($_POST['conf_senha']);

                if(!empty($usuario) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){

                    $u->conectar(); //Faz a conexão com o banco

                    if($u->msgErro == ""){

                        if($senha == $confirmarSenha){
                            
                            if($u->cadastrar($usuario, $email, $senha, $confirmarSenha)){
                                
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
        
        <!-- Rodapé do site -->
        <footer id="final">
            <img src="../ASSETS/polo_logo_white@2x.png">
            <span>&copy;Copyright POLO-2021</span>
            <ul>
                <li><a href="../PHP/sobre_nos.php">Sobre nós</a></li>
                <li><a href="">Fale conosco </a></li>
                <li><a href="">Política de privacidade </a></li>
                <li><a href="">aqui são redes sociais</a></li>
            </ul>
        </footer>

    </div>

</body>
</html>
