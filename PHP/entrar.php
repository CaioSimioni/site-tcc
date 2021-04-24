<?php
    require_once 'usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Entrar</title>
    <link rel="stylesheet" href="../CSS/estilo.css">
</head>
<body>
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="senha" placeholder="Senha">
            <input type="submit" value="ACESSAR">
            <a href="cadastrar.php">Ainda não está cadastrado? <strong>Cadastre-se</strong></a>
        </form>
    </div>
<?php
if(isset($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if(!empty($email) && !empty($senha)){
        $u->conectar("testes_login", "localhost", "root", ""); //Faz a conexão com o banco
        
        if($u->msgErro == ""){

            if($u->entrar($email, $senha)){
                header("location: areaUsuario.php");

            }else{
                ?>
                <div class="msg-erro">Email e/ou senha estão incorretos!</div>
                <?php
            }
        }else{
            ?>
            <div>
                <?php echo "Erro:".$u->msgErro.""; ?>
            </div>
            <?php
        }
    }else{
        ?>
        <div class="msg-erro">Peencha todos os campo!</div>
        <?php
    }
}
?>
</body>
</html>