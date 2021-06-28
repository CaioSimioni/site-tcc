<?php
session_start();

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
</head>
<body>
    <?php
        include "../COMPONENTS/cabecalho.html";
    ?>
    <div id="global">

    <!-- Parte de esports do site, alguns campeonatos -->
    <div id="esports">

        <h1>E-Sports</h1>

        <div id="esports_cards"> <!-- Divisão para os cards com os campeonatos -->
        <!-- 
            MODELO DE CARD DE CAMPEONATO
            <div class="campeonato" >
                <h2></h2>           
                <img src="" alt=""> 
                <p></p>             
            </div>
        -->
            <div class="campeonato" >
                <center>
                <h2>AGLS</h2>           <!-- Título -->
                <img src="../ASSETS/Icons/icon_campeonato_apex_legends.png" alt=""> <!-- Logo Jogo -->
                <p>Data: 23/06</p>             <!-- Data do camp -->
                </center>
            </div>

            <div class="campeonato" >
                <center>
                <h2>CBolão</h2>           <!-- Título -->
                <img src="../ASSETS/Icons/icon_campeonato_league_of_legends.png" alt=""> <!-- Logo Jogo -->
                <p>Data: 23/06</p>             <!-- Data do camp -->
                </center>
            </div>

            <div class="campeonato" >
                <center>
                <h2>Major</h2>           <!-- Título -->
                <img src="../ASSETS/Icons/icon_campeonato_valorant.png" alt=""> <!-- Logo Jogo -->
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
                    <img src="../ASSETS/FotosNotícias/apexlegends.jpg" alt="">
                    <h1>Apex Legends</h1>
                    <button>Saiba mais</button>
                </div>
                <div class="not">
                    <img src="../ASSETS/FotosNotícias/league-of-legends.png" alt="">
                    <h1>League of Legends</h1>
                    <button>Saiba mais</button>
                </div>
                <div class="not">
                    <img src="../ASSETS/FotosNotícias/valorant.jpg" alt="">
                    <h1>Valorant</h1>
                    <button>Saiba mais</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        include "../COMPONENTS/rodape.html";
    ?>
</body>
</html>