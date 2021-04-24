<?php

Class Usuario{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;
        global $msgErro;

        try {
            $pdo = new PDO("mysql:dbname=".$name.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $email, $senha, $confirmarSenha){
        global $pdo;

        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return false; //Usuário já cadastrado.
        }else{
            $sql = $pdo->prepare("INSERT INTO usuarios()");   // PAREI AQUI parte3-20:45
        }
    }

    public function entrar($email, $senha){
        global $pdo;

    }
}


?>