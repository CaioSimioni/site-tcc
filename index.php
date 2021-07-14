<?php
    require "./User/usuario.php";    // Importo o arquivo usuario.php
    $u = new Usuario; // Cria um objeto de Usuario

    if(isset($_SESSION['codigo_usuario']) ){
        echo "<script> window.location.href='./Pages/home.php' </script>";
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
    <link rel="stylesheet" href="./Css/style_index.css">
    <link rel="shortcut icon" href="./Materials/polo_icon.png" type="image/x-icon">
</head>

<body>
    <div id="global"> 

        <!-- Cabeçalho do site -->
        <header class="header">
            <img class="logo" src="./Materials/polo_logo_white@2x.png" alt="logo">
            <nav>
                <ul class="nav__links">
                    <li><a href="./Pages/cadastrar.php">Cadastrar</a></li>
                </ul>
            </nav>
            <a class="cta" href="./Pages/sobre_nos.php"><button>Sobre nós</button></a>
        </header>

        <!-- Parte de indrodução do site, Bem vindo e login -->
        <div id="indroducao">

            <!-- Parte do Bem vindo -->
            <div class="bem_vindo">
                <h1>Bem vindo ao POLO</h1><br>
                <p>
                    O POLO é um site de nóticias e entreterimento que existe para te manter
                    informado sobre o mundo dos games.  Onde você fica por dentro dos
                    principais campeonatos acontecendo dos seus jogos favoritos.
                    Aqui você pode interagir com outras pessoas, e discutindo sobre as 
                    nóticias e torcendo pelo seu time favorito.<br> Cadastrar-se ->
                </p>
            </div>

            <!-- Formulário de login -->
            <div class="formulario">
                <h1>Login</h1>
                <form method="POST">
                    <input type="text" name="usuario" placeholder="Usuário">
                    <input type="password" name="senha" placeholder="Senha">
                    <input type="submit" value="ACESSAR">
                    <a href="./Pages/cadastrar.php">Cadastrar-se</a>
                </form>

                <!-- Parte do PHP de Login -->
                <?php
                    if(isset($_POST['usuario']) && isset($_POST['senha'])){  // Verifica se o Post de usuario foi feito

                        // Recebe os valores do POST
                        $usuario = addslashes($_POST['usuario']);
                        $senha = addslashes($_POST['senha']);
                        
                        // Verifica se os campos estão vazios
                        if(!empty($usuario) && !empty($senha)){
                            
                            $u->conectar(); //Faz a conexão com o banco
                            
                            if($u->msgErro == ""){  // Verifica se o retorno foi uma mensagem de erro
                                
                                if($u->entrar($usuario, $senha)){
                                    
                                    echo "<script> window.location.href='./Pages/home.php' </script>";
                                    exit;

                                }else{
                                    echo "<p class='erromsg'>Usuário e/ou senha estão incorretos!</p>";
                                }
                            }else{
                                echo "Erro:".$u->msgErro."";
                            }
                        }else{
                            echo "Peencha todos os campos";
                        }
                    }
                ?>
            </div>

        </div>

        <!-- Rodapé do site -->
        <footer id="final">
            <img src="../Materials/polo_logo_white@2x.png">
            <span>&copy;Copyright POLO-2021</span>
            <ul>
                <li><a href="../Pages/sobre_nos.php">Sobre nós</a></li>
                <li><a href="">Fale conosco </a></li>
                <li><a href="">Política de privacidade </a></li>
                <li><a href="">aqui são redes sociais</a></li>
            </ul>
        </footer>
        
    </div>
</body>
</html>