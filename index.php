<?php
    require "./System/classes.php";    // Importo o arquivo usuario.php
    $banco = new BancoBD;
    $user = new Usuario; // Cria um objeto de Usuario

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
                    <li><a href="./index.php">Inicio</a></li>
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
                            
                            $banco->conectar(); //Faz a conexão com o banco
                            
                            if($banco->msgErro == ""){  // Verifica se o retorno foi uma mensagem de erro
                                
                                if($user->entrarUsuario($usuario, $senha)){
                                    
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

        <!-- Rodapé do site 
        <footer id="final">
            <img src="../Materials/polo_logo_white@2x.png">
            <span>&copy;Copyright POLO-2021</span>
            <ul>
                <li><a href="../Pages/sobre_nos.php">Sobre nós</a></li>
                <li><a href="">Fale conosco </a></li>
                <li><a href="">Política de privacidade </a></li>
                <li>
                    <a href="https://github.com/CaioSimioni/site-tcc">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </footer>
        -->
        <?php
            include "./Templates/rodape.php"
        ?>
        
    </div>
</body>
</html>