<?php
    if(isset($_POST['usuario'])){
        $usuario = addslashes($_POST['usuario']);
        $senha = addslashes($_POST['senha']);

        if(!empty($email) && !empty($senha)){
            $u->conectar(); //Faz a conexão com o banco
                    
            if($u->msgErro == ""){

                if($u->entrar($usuario, $senha)){
                    header("location: home.php");

                }else{
                    ?>
                    <div class="msg-erro">Usuário e/ou senha estão incorretos!</div>
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