<?php
require "./usuario.php";
$u = new Usuario;
$u->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

$nomecamp = "ALGS - North America";
$statuscamp = "Acontecerá";
$datacamp = "11/07/2021";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo - Campenatos</title>
    <link rel="shortcut icon" href="../ASSETS/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/style_home.css">
    <link rel="stylesheet" href="../CSS/style_campeonatos.css">
</head>
<body>
    <?php
        include "../COMPONENTS/cabecalho.html";
    ?>

    <div class="global">
        <h1>Campeonatos - Apex Legends</h1>
        <section class="sec-apex">
            <div class="camp">
                <h2><?php echo ucfirst($nomecamp)?></h2>
                <p>Status: <?php echo $statuscamp?><br>Data: <?php echo $datacamp?></p>
            </div>
        </section>
    </div>

    <?php
        include "../COMPONENTS/rodape.html";
    ?>
</body>
</html>