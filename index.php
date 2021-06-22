<?php
require "./PHP/usuario.php";    // Importo o arquivo usuario.php
$u = new Usuario; // Cria um objeto de Usuario

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLO</title>
    <link rel="stylesheet" href="./CSS/style_index.css">
    <link rel="shortcut icon" href="./ASSETS/LogoArara.png" type="image/x-icon">
</head>

<body>
    <div id="global"> 

        <!-- Cabeçalho do site -->
        <header class="header">
            <img class="logo" src="./ASSETS/LogoPOLO.png" alt="logo">
            <nav>
                <ul class="nav__links">
                    <li><a href="#">E-Sports</a></li>
                    <li><a href="#">Tópicos</a></li>
                </ul>
            </nav>
            <a class="cta" href="./HTML/informacoes.html"><button>Sobre nós</button></a>
        </header>

        <!-- Pate de indrodução do site, Bem vindo e login -->
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
                    <a href="./PHP/cadastrar.php">Cadastrar-se</a>
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
                                    
                                    header("location: ./PHP/home.php");

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

        <div id="esports">
            <h1>E-Sports</h1>
            <button>Acompanhar campeonatos</button>
        </div>

        <div id="noticias_block">
            <div class="not">
                <img src="./ASSETS/FotosNotícias/ApexSesson9.jpg" alt="">
                <h1>Apex Legends</h1>
                <button>Saiba mais</button>
            </div>
            <div class="not">
                <img src="./ASSETS/FotosNotícias/Minecraft.jpg" alt="">
                <h1>Minecraft</h1>
                <button>Saiba mais</button>
            </div>
            <div class="not">
                <img src="./ASSETS/FotosNotícias/valorant.jpeg" alt="">
                <h1>Valorant</h1>
                <button>Saiba mais</button>
            </div>
        </div>

        <!-- Rodapé do site -->
        <footer id="final">
            <img src="./ASSETS/LogoPOLO.png">
            <ul>
                <li><a href="">Contato</a></li>
                <li><a href="">Reclamações</a></li>
                <li><a href="">Suporte</a></li>
            </ul>
            <span>&copy;Copyright POLO-2021</span>
        </footer>
        
    </div>
</body>
</html>