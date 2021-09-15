<?php
require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;
$new = new Noticia;
$esp = new Esports;

$banco->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

$noticias_cards = $new->exibirNoticiasHome();
// var_dump($noticias_cards);

$esports_cards = $esp->exibirEsportsHome();
// var_dump($esports_cards);

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

</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>

<!-- -->

    <div id="global">

        <section class="firts">
            <?php 
                if($esports_cards){
                    ?>
                    <h1 class="titulo">Últimos Campeonatos</h1>
                    <div class="box" id="section-campeonatos">
                        <?php
                            foreach($esports_cards as $key => $values){
                                ?>
                                    <a href="campeonato.php?idcamp=<?php echo$esports_cards[$key]['id_camp']?>" class="link">
                                        <div class="camp">
                                            <div class="div-title">
                                                <h1 id="camp-title"><?php echo ucfirst($esports_cards[$key]['nome_camp'])?></h1>
                                                <img class="img" src="<?php echo$esp->nomeFotoPadraoCampHome($esports_cards[$key]['categoria_camp'])?>" alt="">
                                            </div>
                                            <div class="div-cate">
                                                <p><?php echo ucfirst($esports_cards[$key]['categoria_camp'])?></p>
                                            </div>
                                            <div class="div-date">
                                                <p><?php echo date('H:i - d M, Y', strtotime($esports_cards[$key]['data_camp']))?></p>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                            }
                        ?>
                    </div>
                    <?php
                }else{
                    ?>
                    <div align="center">
                        <p> Opss! Nenhuma campeonato encontrada. </p>
                    </div>
                    <?php
                }
            ?>
        </section>

        <section id="section">
            <?php
                if($noticias_cards){
                    ?>
                    <h1 class="titulo">Últimas notícias</h1>
                    <div id="box">
                        <?php
                            foreach($noticias_cards as $key => $values){
                                ?>
                                    <div class="card">
                                        <img  class="img" src="../Materials/ImagensNoticias/<?php echo $noticias_cards[$key]['imagem']?>">
                                        <p class="title"><?php echo $noticias_cards[$key]['titulo']?></p>
                                        <p class="data"><?php echo $noticias_cards[$key]['data']?></p>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                <?php
                }else{
                ?>
                <div align="center">
                    <p> Opss! Nenhuma notícia encontrada. </p>
                </div>
                <?php
                }
            ?>
        </section>
    
    </div> <!-- fim Global -->
    <?php
        include "../Templates/rodape.php";
    ?>
    <div id="popup">
        <div id="box-popup"></div>
    </div>
    <script src="../Js/home.js"></script>
</body>
</html>