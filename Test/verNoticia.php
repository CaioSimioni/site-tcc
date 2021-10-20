<?php
require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;

$banco->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/style_verNoticia.css">
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <title>Polo - Ver Noticia</title>
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>

    <div id="global">
        <div id="head-noticia">
            <h1 class="head-titulo-noticia">Próximo God of war é adiado para 2022</h1>
        </div>
        <div id="body-noticia">
            <div class="body-info">
                <img class="body-img-noticia" src="../Materials/ImagensNoticias/godofwar.jpg" alt="">
                <div class="info-creds">
                    <p class="body-creditos-noticia">Por: G1</p>
                    <p class="body-data-noticia">02/06/2021</p>
                </div>
            </div>
        </div>
        <div id="footer-noticia">

            <p class="footer-desc-noticia">Steam Deck é o nome do novo PC portátil da Valve. A plataforma promete rodar todos os jogos disponíveis nas bibliotecas dos usuários no Steam e também aceitará Sistemas Operacionais, além de outros programades, de terceiros. Ou seja, quem for criativo terá ótimas oportunidades em mãos.<br>Abaixo, o The Enemy compilou todas as informações disponíveis atualmente sobre o Steam Deck. Se você está interessado em adquirir um, mesmo que no futuro muito distante, é só continuar lendo. Aliás, vamos atualizar esta matéria conforme novidades forem anunciadas, então, volte sempre que puder.</p>
            
        </div>
    </div>

    <?php
        include '../Templates/rodape.php';
    ?>
</body>
</html>