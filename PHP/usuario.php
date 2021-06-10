<?php

// Origem do código: https://youtube.com/playlist?list=PLYGFJHWj9BYq5zosbRaY7XM5vM0ISLkWS

Class Usuario{
    private $pdo;  // Fica meio cinza pq ainda não usou.  Biblioteca PDO.
    public $msgErro = "";

    //  Testa a conexão com o banco de dados
    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;    // As variaveis globais serão usadas
        global $msgErro;

        try{
            // Tenta fazer o PDO
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
        }catch(PDOException $e){  // o Erro do PDO = $e
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $email, $senha, $confirmarSenha){
        global $pdo;

        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");  // Faz o comando no Banco de dados
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

    public function entrar($nome, $senha){
        global $pdo;

        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE nome = :n AND senha = :s");
        $sql->bindValue(":n", $nome);
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