<?php
/* Arquivo usuado para a orientação a objeto. */
session_start();

class BancoBD{
    private $pdo;
    public $msgErro = "";

    //  Testa a conexão com o banco de dados
    public function conectar(){
        global $pdo;    // As variaveis globais serão usadas
        global $msgErro;

        $nome    = "polo";
        $host    = "localhost";
        $usuario = "root";
        $senha   = "";

        try{  // Tenta fazer o PDO
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
            return true;
        }catch(PDOException $e){  // o Erro do PDO = $e
            $msgErro = $e->getMessage();
            return false;
        }
    }

}

Class Usuario{
    private $pdo;  // Fica meio cinza pq ainda não usou.  Biblioteca PDO.
    public $msgErro = "";

    public function cadastrarUsuario($usuario, $email, $senha, $confirmarSenha, $adm){
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
                // $sql = $pdo->prepare("INSERT INTO `usuario`( `usuario`, `email`, `senha`, `imagem`, `data`, `adm`) VALUES(:u, :e, :s,'icon.png',now()),0");

                $sql = $pdo->prepare("INSERT INTO `usuario` (`codigo_usuario`, `usuario`, `senha`, `email`, `adm`, `imagem`, `data`) VALUES (NULL, :u, :s, :e, :a, 'icon.png', now())");
                $sql->bindValue(":u", $usuario);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->bindValue(":a", $adm);
                $sql->execute();

                if($sql->rowCount() > 0){
                    return true; //Novo usuário cadastrado.
                }else{
                    return false; // Não foi possível cadastrar o usuário.
                }
                
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

    public function editarUsuario($codUsuario, $nomeUsuario, $emailUsuario, $admin){
        global $pdo;

        

    }

    public function selecionarUsuarios(){
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM `usuario` ORDER BY `usuario`.`codigo_usuario` DESC");
        $sql->execute();

        if($sql->rowCount() > 0){

            while($row = $sql->fetch()){
                echo "<tr class='conteudo'>";
                $codigo_usuario = $row['codigo_usuario'];
                echo "<td>".$row['codigo_usuario']."</td>";
                echo "<td>".$row['usuario']."</td>";
                if($row['adm'] == 1){
                    echo "<td> Admin </td>";
                }else{
                    echo "<td> Usuário </td>";
                }
                echo "<td class='func'><a class='editar' href='usuarioEditar.php?idusuario=$codigo_usuario'>Editar</a>";
                echo "<a class='excluir' href='deletaUsuario.php?idusuario=$codigo_usuario'>Excluir</a></td>";
                echo "</tr>";
            }
            return true;

        }else{
            return false;
        }
    }

}

class Noticia{
    private $pdo;
    public $msgError = "";
    public $noticiaValues;

    /*
        Atribudos Notícia
        * id_noticia
        * titulo
        * descricao
        * fonte
        * imagem
        * data
    */

    public function cadastrarNoticia ($titulo , $descricao, $fonte, $data, $imagem){
        global $pdo;
        $imagemInserirda = false;

        $titulo = str_replace("'", "\'", $titulo);
        $fonte = str_replace("'", "\'", $fonte);
        
        $arquivo = $imagem['name'];
        $sql = $pdo->prepare("INSERT INTO `noticia` (`fonte`, `data`, `descricao`, `titulo`, `imagem`) VALUES ('$fonte', :d, '$descricao', '$titulo', '$arquivo');");
        $sql->bindValue(":d", strval($data));
        $sql->execute();

        $arquivoExtensao = explode('.', $imagem['name']);

        if($arquivoExtensao[sizeof($arquivoExtensao) - 1] == 'jpg' or $arquivoExtensao[sizeof($arquivoExtensao) - 1] == 'jpeg' or $arquivoExtensao[sizeof($arquivoExtensao) - 1] == 'png'){
            move_uploaded_file($imagem['tmp_name'], '../Materials/ImagensNoticias/'.$imagem['name']);
            $imagemInserirda = true;
        }else{
            $imagemInserirda = false;
        }

        if($sql->rowCount() > 0 && $imagemInserirda){
            return true;
        }else{
            return false;
        }
    }

    public function pegarNoticia($id_noticia){
        global $pdo;
        global $noticiaValues;
        
        $sql = $pdo->prepare("SELECT * FROM `noticia` WHERE `id_noticia` = '$id_noticia'");
        $sql->execute();

        if($sql->rowCount() > 0){

            $dados = $sql->fetch();

            $titulo_noticia = $dados['titulo'];
            $descricao_noticia = $dados['descricao'];
            $fonte_noticia = $dados['fonte'];
            $data_noticia = $dados['data'];
            $imagem_noticia = $dados['imagem'];

            $noticiaValues = array($titulo_noticia, $descricao_noticia, $fonte_noticia, $data_noticia, $imagem_noticia);

            return $noticiaValues;

        }else{
            return false;
        }

    }

    public function selecionarNoticias(){
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM `noticia` ORDER BY `noticia`.`id_noticia` DESC");
        $sql->execute();

        if($sql->rowCount() > 0){

            while($row = $sql->fetch()){
                echo "<tr class='conteudo'>";
                $id_noticia = $row['id_noticia'];
                echo "<td>".$row['id_noticia']."</td>";
                echo "<td>".$row['titulo']."</td>";
                echo "<td class='dataDb'>".$row['data']."</td>";
                echo "<td class='func'><a class='editar' href='noticiaEditar.php?idnoticia=$id_noticia'>Editar</a>";
                echo "<a class='excluir' href='deletaNoticia.php?idnoticia=$id_noticia'>Excluir</a></td>";
                echo "</tr>";
            }
            return true;

        }else{
            return false;
        }
    }

    public function exibirNoticiasHome(){
        global $pdo;

        $sql = $pdo->prepare("SELECT `titulo`, `descricao`, `fonte`, `data`, `imagem` FROM `noticia` ORDER BY `noticia`.`data` DESC LIMIT 3;");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetchAll();
            
            $noticias_cards = array(
                "noticia 1" => $row[0],
                "noticia 2" => $row[1],
                "noticia 3" => $row[2]
            );
            return $noticias_cards;

        }else{
            return false;
        }
    }

}

?>