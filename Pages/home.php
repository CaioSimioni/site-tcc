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
$esports_cards = $esp->exibirEsportsHome();



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
    <link rel="stylesheet" href="../Css/style_campeonatos.css">
<script src="../Js/home.js"></script>

</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>



<?php
  if($esports_cards){
?>

 <section id="section">
    <h1 class="titulo">Últimos campeonatos</h1>
 <section class="sec-apex">
<?php
for($i = count($esports_cards); $i >= 1; $i--){     
?>
  
          <div class="camp">
                <h2><?php echo  $esports_cards['esports '.$i]['nome_camp'] ?></h2>
                <div class="stats">
                <p class="status">
                
                <?php
                   if( $esports_cards['esports '.$i]['status_camp']) {
                   echo "<p style='color: #0004f9;'>Acontecerá⠀</p>"; }

                    else { echo "<p style='color: #ff2020;'>Encerrado⠀</p>"; }
                 ?>

                </p>
                <p id="data"><?php echo '|⠀'. $esports_cards['esports '.$i]['data_camp'] ?></p>
           </div>
           <div class="div-btn">
                <a href=""><button class="btn">Ver Mais</button></a>
                </div>
              </div>
    

<?php
  }
?>
       </section>        
 </div>
</section>

 <?php //parte final caso nao tenha nenhuma notica
 }else{
?>
                <div align="center">
                    <p> Opss! Nenhum campeonato encontrado. </p>
                </div>
                <?php
            }
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
                                    <img  class="img" src="../Materials/ImagensNoticias/<?php echo $noticias_cards['noticia '.$i]['imagem']?>">
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