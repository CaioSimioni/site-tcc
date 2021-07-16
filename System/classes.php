<?php
// Origem do código: https://youtube.com/playlist?list=PLYGFJHWj9BYq5zosbRaY7XM5vM0ISLkWS
session_start();

class BancoBD{

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

}

Class Usuario{
    private $pdo;  // Fica meio cinza pq ainda não usou.  Biblioteca PDO.
    public $msgErro = "";

    public function cadastrarUsuario($usuario, $email, $senha, $confirmarSenha){
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
                $sql = $pdo->prepare("INSERT INTO usuario(usuario, email, senha, imagem,data,adm) VALUES(:u, :e, :s,'icon.png',now()),0");

                $sql->bindValue(":u", $usuario);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->execute();
                return true; //Novo usuário cadastrado.
            }
        }
    }

    public function entrarUsuario($usuario, $senha){
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
            $_SESSION['adm'] = $dados['adm'];
            $_SESSION['imagem'] = $dados['imagem'];
            $_SESSION['logged'] = True;
            return true;  //Login com sucesso.
        }else{
            return false; //Login não funcionou.
        }
    }

}

class Noticia{
    private $pdo;
    public $msgError = "";

    /*
        Atribudos Notícia
        * id_noticia
        * titulo
        * descricao
        * fonte
        * path_imagem
        * data
    */

    public function cadastrarNoticia ($titulo , $descricao, $fonte, $data, $imagem){
        global $pdo;
        
        $sql = $pdo->prepare("INSERT INTO `noticia`(`fonte`,`data`,`descricao`,`titulo`,`imagem`) VALUES($fonte, :d, $descricao, $titulo, :i)");
        $sql->bindValue(":d", strval($data));
        $sql->bindValue(":i", strval($imagem));
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function editarNoticia ($id_noticia, $titulo, $descricao){
        global $pdo;
    }


    public function excluirNoticia ($id_noticia){
        global $pdo;

        $sql=$pdo->prepare( "DELETE FROM `noticia` WHERE `noticia`.`id_noticia` = '$id_noticia'");
        $sql->execute();
    }

}

?>