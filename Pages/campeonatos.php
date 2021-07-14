<?php
require "../User/usuario.php";
$u = new Usuario;
$u->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

$nomecamp = "ALGS - North America";
$statuscamp = false;
$datacamp = "11/07/2021";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo - Campenatos</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/style_campeonatos.css">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>

    <div class="global">
        <h1>Campeonatos - Apex Legends</h1>
        <section class="sec-apex">
            <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <div class="stats">
                    <p class="status"><?php
                        if($statuscamp) {
                            echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
                        }
                        else {
                            echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
                        }
                    ?></p>
                    <p id="data"><?php echo '|⠀'.$datacamp?></p>
                </div>
                <img src="../Materials/ImagesNoticias/apexlegends.jpg" alt="">
                <div class="div-btn">
                    <a href=""><button class="btn">Ver Mais</button></a>
                </div>
            </div>
            <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <div class="stats">
                    <p class="status"><?php
                        if($statuscamp) {
                            echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
                        }
                        else {
                            echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
                        }
                    ?></p>
                    <p id="data"><?php echo '|⠀'.$datacamp?></p>
                </div>
                <img src="../Materials/ImagesNoticias/apexlegends.jpg" alt="">
                <div class="div-btn">
                    <a href=""><button class="btn">Ver Mais</button></a>
                </div>
            </div>
            <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <div class="stats">
                    <p class="status"><?php
                        if($statuscamp) {
                            echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
                        }
                        else {
                            echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
                        }
                    ?></p>
                    <p id="data"><?php echo '|⠀'.$datacamp?></p>
                </div>
                <img src="../Materials/ImagesNoticias/apexlegends.jpg" alt="">
                <div class="div-btn">
                    <a href=""><button class="btn">Ver Mais</button></a>
                </div>
            </div>
        </section>
        <h1>Campeonatos - League Of Legends</h1>
        <section class="sec-apex">
        <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <div class="stats">
                    <p class="status"><?php
                        if($statuscamp) {
                            echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
                        }
                        else {
                            echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
                        }
                    ?></p>
                    <p id="data"><?php echo '|⠀'.$datacamp?></p>
                </div>
                <img src="../Materials/ImagesNoticias/league-of-legends.png" alt="">
                <div class="div-btn">
                    <a href=""><button class="btn">Ver Mais</button></a>
                </div>
            </div>
            <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <div class="stats">
                    <p class="status"><?php
                        if($statuscamp) {
                            echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
                        }
                        else {
                            echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
                        }
                    ?></p>
                    <p id="data"><?php echo '|⠀'.$datacamp?></p>
                </div>
                <img src="../Materials/ImagesNoticias/league-of-legends.png" alt="">
                <div class="div-btn">
                    <a href=""><button class="btn">Ver Mais</button></a>
                </div>
            </div>
            <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <div class="stats">
                    <p class="status"><?php
                        if($statuscamp) {
                            echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
                        }
                        else {
                            echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
                        }
                    ?></p>
                    <p id="data"><?php echo '|⠀'.$datacamp?></p>
                </div>
                <img src="../Materials/ImagesNoticias/league-of-legends.png" alt="">
                <div class="div-btn">
                    <a href=""><button class="btn">Ver Mais</button></a>
                </div>
            </div>
        </section>
        <h1>Campeonatos - Valorant</h1>
        <section class="sec-apex">
            <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <div class="stats">
                    <p class="status"><?php
                        if($statuscamp) {
                            echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
                        }
                        else {
                            echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
                        }
                    ?></p>
                    <p id="data"><?php echo '|⠀'.$datacamp?></p>
                </div>
                <img src="../Materials/ImagesNoticias/valorant" alt="">
                <div class="div-btn">
                    <a href=""><button class="btn">Ver Mais</button></a>
                </div>
            </div>
            <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <div class="stats">
                    <p class="status"><?php
                        if($statuscamp) {
                            echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
                        }
                        else {
                            echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
                        }
                    ?></p>
                    <p id="data"><?php echo '|⠀'.$datacamp?></p>
                </div>
                <img src="../Materials/ImagesNoticias/valorant.jpg" alt="">
                <div class="div-btn">
                    <a href=""><button class="btn">Ver Mais</button></a>
                </div>
            </div>
            <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <div class="stats">
                    <p class="status"><?php
                        if($statuscamp) {
                            echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
                        }
                        else {
                            echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
                        }
                    ?></p>
                    <p id="data"><?php echo '|⠀'.$datacamp?></p>
                </div>
                <img src="../Materials/ImagesNoticias/valorant.jpg" alt="">
                <div class="div-btn">
                    <a href=""><button class="btn">Ver Mais</button></a>
                </div>
            </div>
        </section>
    </div>

    <?php
        include "../Templates/rodape.php";
    ?>
</body>
</html>