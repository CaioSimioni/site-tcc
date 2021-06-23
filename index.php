<?php
require "./PHP/usuario.php";    // Importo o arquivo usuario.php
$u = new Usuario; // Cria um objeto de Usuario

if(isset($_SESSION['codigo_usuario'])){
    echo "<script> window.location.href='./PHP/home.php' </script>";
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
    <link rel="stylesheet" href="./CSS/style_index.css">
    <link rel="shortcut icon" href="./ASSETS/polo_icon.png" type="image/x-icon">
</head>

<body>
    <div id="global"> 

        <!-- Cabeçalho do site -->
        <header class="header">
            <img class="logo" src="./ASSETS/polo_logo_white@2x.png" alt="logo">
            <nav>
                <ul class="nav__links">
                    <li><a href="#">E-Sports</a></li>
                    <li><a href="#">Notícias</a></li>
                </ul>
            </nav>
            <a class="cta" href="./HTML/sobre_nos.html"><button>Sobre nós</button></a>
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

        <!-- Parte de esports do site, alguns campeonatos -->
        <div id="esports">

            <h1>E-Sports</h1>

            <div id="esports_cards"> <!-- Divisão para os cards com os campeonatos -->
            <!-- MODELO DE CARD DE CAMPEONATO
                <div class="campeonato" >
                    <h2></h2>           
                    <img src="" alt=""> 
                    <p></p>             
                </div>
             -->
                <div class="campeonato" >
                    <center>
                    <h2>AGLS</h2>           <!-- Título -->
                    <img src="./ASSETS/Icons/icon_campeonato_apex_legends.png" alt=""> <!-- Logo Jogo -->
                    <p>Data: 23/06</p>             <!-- Data do camp -->
                    </center>
                </div>

                <div class="campeonato" >
                    <center>
                    <h2>CBolão</h2>           <!-- Título -->
                    <img src="./ASSETS/Icons/icon_campeonato_league_of_legends.png" alt=""> <!-- Logo Jogo -->
                    <p>Data: 23/06</p>             <!-- Data do camp -->
                    </center>
                </div>

                <div class="campeonato" >
                    <center>
                    <h2>Major</h2>           <!-- Título -->
                    <img src="./ASSETS/Icons/icon_campeonato_valorant.png" alt=""> <!-- Logo Jogo -->
                    <p>Data: 23/06</p>             <!-- Data do camp -->
                    </center>
                </div>
            </div>
                
            <a href=""><button>Acompanhar campeonatos</button></a>
            

        </div>

        <div id="noticia">
            <h1 id="titulo_div_noticia">Notícias</h1>
            <div id="noticias_block">
                <div class="not">
                    <img src="./ASSETS/FotosNotícias/apexlegends.jpg" alt="">
                    <h1>Apex Legends</h1>
                    <button>Saiba mais</button>
                </div>
                <div class="not">
                    <img src="./ASSETS/FotosNotícias/league-of-legends.png" alt="">
                    <h1>League of Legends</h1>
                    <button>Saiba mais</button>
                </div>
                <div class="not">
                    <img src="./ASSETS/FotosNotícias/valorant.jpg" alt="">
                    <h1>Valorant</h1>
                    <button>Saiba mais</button>
                </div>
            </div>
        </div>

        <!-- Rodapé do site -->
        <footer id="final">
            <img src="./ASSETS/polo_logo_white.png">
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