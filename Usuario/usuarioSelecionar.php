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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/style_selecionarUsuario.css">
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