<?php
require "usuario.php";
$banco = new BancoBD;
$banco->conectar();

$sql = $pdo->query("SELECT * FROM `chat-geral` ORDER BY id_mensagem");

foreach($sql->fetchAll() as $key){
    echo "<div id='msg'><p class='name'>".$key['nome_usuario']."</p><p class='message'>".$key['mensagem']."</p></div>";
}


?>