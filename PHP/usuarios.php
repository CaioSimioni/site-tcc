<?php

Class Usuario{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;
        global $msgErro;

        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
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
            $sql = $pdo->prepare("INSERT INTO usuarios(nome, email, senha) VALUES(:n, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true; //Novo usuário cadastrado.
        }
    }

    public function entrar($email, $senha){
        global $pdo;
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0){

            $dados = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dados['id_usuario'];
            return true;  //Login com sucesso.
        }else{
            return false; //Login não funcionou.
        }

    }
}


?>