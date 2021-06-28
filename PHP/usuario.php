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

        //informações do banco de dados  !!! COLOCAR PARA FUNCIONAR !!!
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
        $sql->bindValue(":e", $email);
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
                $sql = $pdo->prepare("INSERT INTO usuario(usuario, email, senha) VALUES(:u, :e, :s)");
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

        $sql = $pdo->prepare("SELECT codigo_usuario FROM usuario WHERE usuario = :u AND senha = :s");
        $sql->bindValue(":u", $usuario);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0){

            $dados = $sql->fetch();
            $_SESSION['codigo_usuario'] = $dados['codigo_usuario'];
            $_SESSION['logged'] = True;
            return true;  //Login com sucesso.
        }else{
            return false; //Login não funcionou.
        }
    }

    public function sair(){
        unset($_SESSION['codigo_usuario']);
        unset($_SESSION['logged']);
        session_destroy();

        echo "<script> window.location.href = '../index.php'</script>";
    }
}

?>