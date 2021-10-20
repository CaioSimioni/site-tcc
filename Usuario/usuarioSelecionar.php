<?php
    require "../System/classes.php";
    $banco = new BancoBD;
    $usuario = new Usuario;

    $banco->conectar();

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
    <link rel="stylesheet" href="../Css/style_usuarioSelecionar.css">
</head>
<body>
    
    <?php include "../Templates/cabecalho.php"; ?>

    <div id="global">
        <section class="section">
            <table class="tabela">
                <thead>
                    <tr>
                        <td>Código</td>
                        <td>Nome</td>
                        <td>Cargo</td>
                        <td>Funções</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($banco->conectar()){

                            if($usuario->selecionarUsuarios()){

                            }else{
                                echo "<script> alert('[Erro] Não foi possível selecionar os usuários.') </script>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <?php include "../Templates/rodape.php"; ?>

</body>
</html>