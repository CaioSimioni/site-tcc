<?php
    require_once 'usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../CSS/estilo.css">
</head>
<body>
    <div id="corpo-form">
        <h1>Cadastrar</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" maxlength="40">
            <input type="email" name="email" placeholder="E-mail" maxlength="40">
            <input type="password" name="senha" placeholder="Senha">
            <input type="password" name="confirmarSenha" placeholder="Confirmar senha">
            <input type="submit" value="CADASTRAR">
            <a href="entrar.php">Já está cadastrado? <strong>Entrar</strong></a>
        </form>
    </div>
<?php
// verificar se clicou no  botao
if(isset($_POST['nome'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confirmarSenha']);

    if(!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){

        $u->conectar("testes_login", "localhost", "root", ""); //Faz a conexão com o banco

        if($u->msgErro == ""){

            if($senha == $confirmarSenha){
                
                if($u->cadastrar($nome, $email, $senha, $confirmarSenha)){
                    
                    ?>
                    <div id="msg-sucesso">
                        Cadastrado com sucesso! Acesse para entrar.
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="msg-erro">E-mail já  cadastrado.</div>
                    <?php
                }
                
            }else{
                ?>
                <div class="msg-erro">Senha e Confirmar senha estão diferentes.</div>
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