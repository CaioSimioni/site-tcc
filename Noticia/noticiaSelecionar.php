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
    <link rel="stylesheet" href="../Css/style_noticiaSeleciona.css">
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>
    <div id="global">
        <table>
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Título</strong></td>
                    <td><strong>Data</strong></td>
                    <td><strong>Funções</strong></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($banco->conectar()){

                        if($new->selecionarNoticias()){

                        }else{
                            echo "<script> document.getElementById(`global`).innerHTML = `<p id='nenhuma_noticia'> Nenhuma noticia cadastrada. <a href='noticiaCadastro.php' > Cadastrar noticia </a></p>`;</script>";
                        }

                    }else{
                        echo "<script> alert('Não foi possível conectar-se ao Banco') ;</script>";
                        echo "<script> window.location.href = '../Admin/admin.php'</script>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>



</body>
</html>