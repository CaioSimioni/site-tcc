<?php
// Origem do código: https://youtube.com/playlist?list=PLYGFJHWj9BYq5zosbRaY7XM5vM0ISLkWS
session_start();

Class Usuario{
    private $pdo;  // Fica meio cinza pq ainda não usou.  Biblioteca PDO.
    public $msgErro = "";

    //  Testa a conexão com o banco de dados
    public function conectar(){
        global $pdo;    // As variaveis globais serão usadas
        global $msgErro;

        /*
        //informações do banco de dados  !!! TESTE !!!
        $nome    = "polo";
        $host    = "localhost";
        $usuario = "root";
        $senha   = "";

        //informações do banco de dados  !!! AWARDSPACE !!!
        $nome    = "3863708_polo";
        $host    = "fdb32.awardspace.net";
        $usuario = "3863708_polo";
        $senha   = "g3k;vPz;8hJ%3eHc";
        */

        $nome    = "polo";
        $host    = "localhost";
        $usuario = "root";
        $senha   = "";

        try{  // Tenta fazer o PDO
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
        }catch(PDOException $e){  // o Erro do PDO = $e
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($usuario, $email, $senha, $confirmarSenha){
        global $pdo;

        $sql = $pdo->prepare("SELECT codigo_usuario FROM usuario WHERE email = :e");  // Faz o comando no Banco de dados
        $sql->bindValue(":e", $email);  // Substitui o valor de :e pelo valor da variavel $email
        $sql->execute();

        if($sql->rowCount() > 0){
            return false; //Email já cadastrado.

        }else{
            $sql = $pdo->prepare("SELECT codigo_usuario FROM usuario WHERE usuario = :u");
            $sql->bindValue(":u", $usuario);
            $sql->execute();

            if($sql->rowCount() > 0){
                return false; //Usuario já cadastrado
                
            }else{
                $sql = $pdo->prepare("INSERT INTO usuario(usuario, email, senha, imagem,data) VALUES(:u, :e, :s,'icon.png',now())");
                $sql->bindValue(":u", $usuario);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->execute();
                return true; //Novo usuário cadastrado.
            }
        }
    }

    public function entrar($usuario, $senha){
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :u AND senha = :s");
        $sql->bindValue(":u", $usuario);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0){

            $dados = $sql->fetch();
            $_SESSION['codigo_usuario']= $dados['codigo_usuario'];
            $_SESSION['nome_usuario']  =  $dados['usuario'];
            $_SESSION['email_usuario'] = $dados['email'];
            $_SESSION['imagem'] = $dados['imagem'];
            $_SESSION['logged'] = True;
            return true;  //Login com sucesso.
        }else{
            return false; //Login não funcionou.
        }
    }

    public function sair(){
        unset($_SESSION['codigo_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['email_usuario']);
        unset($_SESSION['imagem']);
        unset($_SESSION['logged']);
        session_destroy();
        echo "<script> window.location.href = '../index.php'</script>";
    }
}

?>