<?php

if (!isset($_POST['idCamp'])) {
	echo "<script> alert('Acesso inválido!'); window.location.href = 'index.php'; </script>";
	exit;
}

var_dump($_POST);

echo "\n" . $_POST['tabCamp'];

?>