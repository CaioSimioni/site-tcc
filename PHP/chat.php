<?php
require "usuario.php";
$u = new Usuario;
$u->conectar();

$sql = $pdo->query("SELECT * FROM `chat-geral` ORDER BY id_mensagem");

foreach($sql->fetchAll() as $key){
    echo "<div id='msg'><h3>".$key['nome_usuario']."</h3><p>".$key['mensagem']."</p></div>";
}


?>