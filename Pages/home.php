<?php
require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;
$new = new Noticia;

$banco->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

$noticias_cards = $new->exibirNoticiasHome();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png">
    <link rel="stylesheet" href="../Css/style_home.css">
<script src="../Js/home.js"></script>

</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>
    <div id="global">

        <?php
            if($noticias_cards){
                ?>
                <section id="section">
                    <h1 class="titulo">Últimas notícias</h1>
                    <div id="box">
                        <?php
                            for($i = count($noticias_cards); $i >= 1; $i--){
                                ?>
                                <div class="card">
                                    <img  class="img" src="../Materials/ImagensNoticias/<?php echo $noticias_cards['noticia '.$i]['imagem']?>" alt="">
                                    <p class="title"><?php echo $noticias_cards['noticia '.$i]['titulo']?></p>
                                    <p class="data"><?php echo $noticias_cards['noticia '.$i]['data']?></p>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </section>
                <?php
            }else{
                ?>
                <div align="center">
                    <p> Opss! Nenhuma notícia encontrada. </p>
                </div>
                <?php
            }
        ?>
    
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>
    <div id="popup">
        <div id="box-popup"></div>
    </div>
    <script src="../Js/home.js"></script>
</body>
</html>