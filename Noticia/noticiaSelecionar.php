<?php
    require "../System/classes.php";
    $user = new Usuario;
    $banco = new BancoBD;
    $new = new Noticia;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="stylesheet" href="../Css/style_noticiaADM.css">
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>
    <div id="global">
        <table border="1">
            <tr>
                <td> Codigo</td>
                <td> titulo</td>
                <td> Data </td>
            </tr> 
            <?php
                if($banco->conectar()){

                    $new->selecionarNoticias();

                }else{
                    echo "<script> alert('Não foi possível conectar-se ao Banco') ;</script>";
                    echo "<script> window.location.href = '../Admin/admin.php'</script>";
                }
            ?>
        </table>
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>

</body>
</html>