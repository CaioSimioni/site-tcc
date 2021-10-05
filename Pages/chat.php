<?php

require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;



$banco->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

global $pdo;

$sql = $pdo->query("SELECT * FROM `chat` WHERE `chat` = 'chat-geral'");

if($sql->rowCount() > 0){

    $dados = $sql->fetchAll();

    foreach($dados as $values){

        /*  Estrutura das mensagens
            <div class="msg-in OU msg-out">  'out' do usuario local
                <div class="info-user">
                    <img src="../Materials/UsersAvatar/icon.png">
                    <h1> Pedrinho_gamer </h1>
                </div>
                <div class="content-msg">
                    <p> Oi, alguém no chat? </p>
                </div>
            </div> 
        */
        if($values['id_usuario'] == $_SESSION['codigo_usuario']){
            ?>
            <div class="msg-out">
                <div class="info-user">
                    <img src=<?php echo "../Materials/UsersAvatar/".$values['foto_usuario']; ?> alt="img-user">
                    <h1><?php echo $values['nome_usuario'] ?></h1>
                </div>
                <div class="content-msg">
                    <p><?php $values['texto'] ?></p>
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="msg-in">
                <div class="info-user">
                    <img src=<?php echo "../Materials/UsersAvatar/".$values['foto_usuario']; ?> alt="img-user">
                    <h1><?php echo $values['nome_usuario'] ?></h1>
                </div>
                <div class="content-msg">
                    <p><?php $values['texto'] ?></p>
                </div>
            </div>
            <?php
        }

    }

}else{
    //  Exibir que não há mensagens no chat
    //  Falar para a pessoa ser a primeira
}

?>
