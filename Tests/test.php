<?php
class Testes{
    private $pdo;
    public $msgErro = "";

    public function conectaBD(){
        global $pdo;
        global $msgErro;

        $nome    = "testes";
        $host    = "localhost";
        $usuario = "root";
        $senha   = "";

        try{  // Tenta fazer o PDO
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
        }catch(PDOException $e){  // o Erro do PDO = $e
            $msgErro = $e->getMessage();
        }
    }

    public function inserirData($valorData){
        global $pdo;
        global $msgErro;
        
        $sql = $pdo->prepare("INSERT INTO testes(`data`) VALUE(:d)");
        $sql->bindValue(":d", strval($valorData));
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
        
    }

}
?>