<?php
    require "../System/classes.php";
    $user = new Usuario;
    $banco = new BancoBD;
    $new = new Noticia;

    if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
        echo "<script> alert('Falha na autenticação de usuário!')</script>";    
        echo "<script>window.location.href='../index.php'</script>";
        exit;
    }

    if($_SESSION['adm'] == false) {
        echo "<script>alert('Você não tem permissão para entrar nesta área')</script>";
        echo "<script>window.location.href='../index.php'</script>";
        exit;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="../Css/style_noticiaSeleciona.css">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>
    <div id="global">
        <section>
            <table>
                <thead>
                    <tr>
                        <td><strong>ID</strong></td>
                        <td class="title"><strong>Título</strong></td>
                        <td class="data"><strong>Data</strong></td>
                        <td><strong>Funções</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($banco->conectar()){

                            if($new->selecionarNoticias()){

                            }else{
                                echo "<script> document.getElementById(`global`).innerHTML = `<p id='nenhuma_noticia'> Nenhuma noticia cadastrada -> <a href='noticiaCadastro.php' > Cadastrar noticia </a></p>`;</script>";
                            }

                        }else{
                            echo "<script> alert('Não foi possível conectar-se ao Banco') ;</script>";
                            echo "<script> window.location.href = '../Admin/admin.php'</script>";
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
    <?php
        include "../Templates/rodape.php";
    ?>



</body>
</html>