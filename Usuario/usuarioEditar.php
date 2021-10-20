<?php
    require "../System/classes.php";
    $banco = new BancoBD;
    $user = new Usuario;

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

    if($banco->conectar()){

        $cod_usuario = isset($_GET['idusuario']) ? $_GET['idusuario'] : NULL;  // Variável vai ser igual a idusuario ou Null.

        if($cod_usuario){

            $bd_usuario = $user->pegarUsuario($cod_usuario);

            if($bd_usuario){

                $usuario_nome  = isset($bd_usuario[0]) ? $bd_usuario[0] : NULL;
                $usuario_email = isset($bd_usuario[1]) ? $bd_usuario[1] : NULL;
                $usuario_cargo = isset($bd_usuario[2]) ? $bd_usuario[2] : NULL;

            }else{
                echo"<script> alert('[Erro] Falha em coletar informações do Banco.') </script>";
                echo"<script> window.location.href = '../Pages/home.php' </script>";
                exit;
            }

        }else{
            echo"<script> alert('Valor de usuário inválido') </script>";
            echo"<script> window.location.href = '../Pages/home.php' </script>";
            exit;
        }

    }else{
        echo"<script> alert('[Erro] Falha na conexão com o Banco de Dados.') </script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="../Css/style_usuarioEditar.css">
</head>
<body>

    <?php include "../Templates/cabecalho.php" ?>
    <div id="global">

        <form action="editaUsuario.php" method="post" id="info_usuario">
            <h1>Editar Usuário</h1>

            <input type="hidden" name="cod_usuario" value="<?php echo$cod_usuario ?>">

            <div class="usuario nome">
                <label for="in_usuario">Nome</label>
                <input type="text" name="usuario" id="in_usuario" class="campo" value="<?php echo $usuario_nome ?>">
            </div>

            <div class="usuario email">
                <label for="in_email">Email</label>
                <input type="text" name="email" id="in_email" class="campo" value="<?php echo $usuario_email ?>">
            </div>

            <div class="usuario cargo">
                <?php
                    if($usuario_cargo == 1){ ?>
                        <div class="radio rU">
                            <input type="radio" name="cargo" id="in_cargo_comum" value="comum">
                            <label for="in_cargo_comum">Usuario </label>
                        </div>
                        <div class="radio rA">
                            <input type="radio" name="cargo" id="in_cargo_admin" value="admin" checked>
                            <label for="in_cargo_admin">Admin </label>
                        </div>
                    <?php }else{ ?>
                        <div class="radio rU">
                            <input type="radio" name="cargo" id="in_cargo_comum" value="comum" checked>
                            <label for="in_cargo_comum">Usuario </label>
                        </div>
                        <div class="radio rA">
                            <input type="radio" name="cargo" id="in_cargo_admin" value="admin">
                            <label for="in_cargo_admin">Admin </label>
                        </div>
                    <?php }
                ?>
            </div>

            <input type="submit" class="btn" value="Editar">
        </form>

    </div>
    <?php include "../Templates/rodape.php" ?>

</body>
</html>