<?php
require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;
$noticia = new Noticia;

    if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
        echo "<script> alert('Falha na autenticação de usuário!')</script>";    
        echo "<script>window.location.href='../index.php'</script>";
        exit;
    }

    if($banco->conectar()){ // Verifico a conexão com o bando de dados.

        $id_noticia = isset($_GET['id']) ? $_GET['id'] : NULL;  

        if($id_noticia){    // verifico se o valor de noticia vindo pelo GET é valido.

            $bd_noticia = $noticia->pegarNoticia($id_noticia);  

            if($bd_noticia){    // verifico se houve o retorno do Backend das informações sobre a noticia.

                /**
                 * Aqui não foi preciso nenhum comando pois as informações vindas do
                 * Backend já estão devidamente tradadas, somente precisando exibilas.
                 */

            }else{
                echo"<script> alert('[Erro] Falha em coletar informações do Banco.') </script>";
                echo"<script> window.location.href = '../Pages/home.php' </script>";
                exit;
            }

        }else{
            echo"<script> alert('Valor de noticia inválido') </script>";
            echo"<script> window.location.href = '../Pages/home.php' </script>";
            exit;
        }

    }else{
        echo"<script> alert('[Erro] Falha na conexão com o banco.') </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="../Css/style_verNoticia.css">
</head>
<body>
<?php
        include "../Templates/cabecalho.php";
    ?>

    <div id="global">
        <div id="head-noticia">
            <h1 class="head-titulo-noticia"><?php echo $bd_noticia['titulo']?></h1>
        </div>
        <div id="body-noticia">
            <div class="body-info">
                <img class="body-img-noticia" src="../Materials/ImagensNoticias/<?php echo $bd_noticia['imagem']?>" alt="img_noticia">
                <div class="info-creds">
                    <p class="body-creditos-noticia"><?php echo $bd_noticia['fonte']?></p>
                    <p class="body-data-noticia"><?php echo date('d/m/Y', strtotime($bd_noticia['data']))?></p>
                </div>
            </div>
        </div>
        <div id="footer-noticia">

            <p class="footer-desc-noticia"><?php echo $bd_noticia['descricao']?></p>
            
        </div>
    </div>

    <?php
        include '../Templates/rodape.php';
    ?>
</body>
</html>