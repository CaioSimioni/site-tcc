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
    public $usuarioValues;

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

    public function pegarUsuario($codigo_usuario){
        global $pdo;
        global $usuarioValues;
        
        $sql = $pdo->prepare("SELECT `usuario`,`email`,`adm` FROM `usuario` WHERE `codigo_usuario` = '$codigo_usuario'");
        $sql->execute();

        if($sql->rowCount() > 0){

            $dados = $sql->fetch();

            $usuario_nome = $dados['usuario'];
            $usuario_email = $dados['email'];
            $usuario_cargo = $dados['adm'];

            $usuarioValues = array($usuario_nome, $usuario_email, $usuario_cargo);

            return $usuarioValues;

        }else{
            return false;
        }
    }

    public function editarUsuario($usuario_codigo, $usuario_nome, $usuario_email, $usuario_cargo){
        global $pdo;

        $sql = $pdo->prepare("UPDATE `usuario` SET `usuario`= '$usuario_nome',`email`='$usuario_email',`adm`= $usuario_cargo WHERE `usuario`.`codigo_usuario` = $usuario_codigo");
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }

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
        $noticias_cards = false;

        $sql = $pdo->prepare("SELECT `titulo`, `descricao`, `fonte`, `data`, `imagem` FROM `noticia` ORDER BY `noticia`.`data` DESC LIMIT 3;");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetchAll();
            
            foreach($row as $key => $values){
                $noticias_cards['notica '.$key] = $values;
            }
            return $noticias_cards;

        }else{
            return $noticias_cards;
        }
    }

}

class Esports{
    private $pdo;
    public $msgErro = "";
    public $categorias = array(
        "Apex Legends",
        "League of Legends",
        "Counter Strike",
        "Valorant"
    );
    public $campeonatoValues;

	public function getCategorias(){
		return $this->categorias;
	}

    public function cadastrarEsports($nome, $categoria, $data, $local_arquivo_tabela, $status){
        global $pdo;

        $sql = $pdo->prepare("INSERT `esports`(`nome_camp`, `categoria_camp`, `data_camp`, `local_arquivo_tabela`, `status_camp`) VALUES ('$nome', '$categoria', :d, '$local_arquivo_tabela', $status)");
        $sql->bindValue(':d', strval($data));
        $sql->execute();

        if($sql->rowCount() > 0){
            $nome_arquivo = ".\\Tab_Camps\\" . $local_arquivo_tabela . ".php";
            if(file_exists($nome_arquivo) && is_file($nome_arquivo)){

            }else{
                file_put_contents($nome_arquivo, PHP_EOL.
                '<table>'.PHP_EOL.
                "\t".'<thead>'.PHP_EOL.
                "\t".'</thead>'.PHP_EOL.
                "\t".'<tbody>'.PHP_EOL.
                "\t".'</tbody>'.PHP_EOL.
                '</table>');
            }
            return true;
        }else{
            return false;
        }
    }

    public function selecionarCampeonatos(){
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM `esports`");
        $sql->execute();

        if($sql->rowCount() > 0){

            while($row = $sql->fetch()){
                $id_campeonato = $row['id_camp'];

                echo "<tr class='conteudo'>";
                echo "<td>".$row['id_camp']."</td>";
                echo "<td>".$row['nome_camp']."</td>";
                echo "<td class='dataDb'>".$row['data_camp']."</td>";
                
                if($row['status_camp'] == 0){
                    $row['status_camp'] = "Em Breve";
                    echo "<td><p style='color: #20c93f'>".$row['status_camp']."</p></td>";
                } else {
                    $row['status_camp'] = "Encerrado";
                    echo "<td><p style='color: #c92020'>".$row['status_camp']."</p></td>";
                };#c92020

                echo "<td class='func'><a class='editar' href='campeonatoEditar.php?idcampeonato=$id_campeonato'>Editar</a>";
                echo "<a class='vil' href='campeonatoVisualizar.php?idcampeonato=$id_campeonato'>Visualizar</a>";
                echo "<a class='excluir' href='deletaCampeonato.php?idcampeonato=$id_campeonato'>Excluir</a></td>";
                echo "</tr>";
            }

            return true;
        }else{
            return false;
        }

    }

	public function pegarTodosCampeonatos(){
		global $pdo;
		$camps = false;

		$sql = $pdo->prepare("SELECT * FROM `esports`");
		$sql->execute();

		if($sql->rowCount() > 0){

			$dados = $sql->fetchAll();
			$camps = [];
			foreach($this->categorias as $categoria){
				$camps[$categoria] = [];
				foreach($dados as $key => $values){
					if($categoria == $values['categoria_camp']){
						$camps[$categoria]['camp '.$key] = $values;
					}
				}
			}
			return $camps;

		}else{
			return $camps;
		}
	}

    public function pegarCampeonato($codigo_campeonato){
        global $pdo;
        global $campeonatoValues;
        
        $sql = $pdo->prepare("SELECT `nome_camp`, `categoria_camp`, `data_camp`, `local_arquivo_tabela`, `status_camp` FROM `esports` WHERE `esports`.`id_camp` = '$codigo_campeonato'");
        $sql->execute();

        if($sql->rowCount() > 0){

            $dados = $sql->fetch();

            $d = new DateTime($dados['data_camp']);

            $campeonatoValues = array(
                "id_camp" => "$codigo_campeonato",
                "nome_camp" => $dados['nome_camp'],
                "categoria_camp" => $dados['categoria_camp'],
                "data_camp" => $d->format('Y-m-d\TH:i:s'),
                "local_arquivo_tabela" => $dados['local_arquivo_tabela'],
                "status_camp" => $dados['status_camp']
            );

            return $campeonatoValues;

        }else{
            return false;
        }
    }

    public function editarCampeonato($cod_camp, $nome_camp, $categoria_camp, $data_camp, $status_camp){
        global $pdo;

        if($status_camp == "em breve"){
            $status_camp = 0;
        }else{
            $status_camp = 1;
        }

        $sql = $pdo->prepare("UPDATE `esports` SET `nome_camp` = '$nome_camp', `categoria_camp` = '$categoria_camp', `data_camp` = :d, `status_camp` = $status_camp WHERE `esports`.`id_camp` = $cod_camp");
        $sql->bindValue(':d', strval($data_camp));
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }

        return false;
    }

    public function vizualizarCampeonato($id_camp){
        global $pdo;
        global $campeonatoValues;

        $sql = $pdo->prepare("SELECT `nome_camp`, `status_camp`, `data_camp`, `local_arquivo_tabela` FROM `esports` WHERE `esports`.`id_camp` = $id_camp");
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetch();
            $d = new DateTime($dados['data_camp']);

            $campeonatoValues = array(
                "id" => "$id_camp",
                "nome" => $dados['nome_camp'],
                "data" => $d->format('Y-m-d\TH:i:s'),
                "status" => $dados['status_camp'],
                "local_arquivo_tabela" => "..\\Esports\\Tab_Camps\\" . $dados['local_arquivo_tabela'] . ".php"
            );

            return $campeonatoValues;
            
        }else{
            return false;
        }
    }

    public function alterarTabela($camp_local_arquivo_tabela, $camp_nova_tabela){

        if(file_put_contents($camp_local_arquivo_tabela, $camp_nova_tabela)){
            return true;
        }else{
            return false;
        }
    }

    public function deletaCampeonato($id_camp){
        global $pdo;
        global $campeonatoValues;

        $sql = $pdo->prepare("SELECT `nome_camp`, `local_arquivo_tabela` FROM `esports` WHERE `esports`.`id_camp` = $id_camp");
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetch();

            $campeonatoValues = array(
                "id" => $id_camp,
                "nome_camp" => $dados['nome_camp'],
                "local_arquivo_tabela" => "..\\Esports\\Tab_Camps\\" . $dados['local_arquivo_tabela'] . ".php",
                "excluido" => false
            );

            $sql = $pdo->prepare("DELETE FROM `esports` WHERE `esports`.`id_camp` = $id_camp");
            $sql->execute();

            if($sql->rowCount() > 0){

                if(unlink($campeonatoValues['local_arquivo_tabela'])){
                    $campeonatoValues['excluido'] = true;
                    return $campeonatoValues;
                }else{
                    return false;
                }

            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function exibirEsportsHome(){
        global $pdo;
        $esports_cards = false;

        $sql = $pdo->prepare("SELECT `id_camp`, `nome_camp`, `categoria_camp`, `status_camp`, `data_camp` FROM `esports` ORDER BY `esports`.`data_camp` DESC LIMIT 3;");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetchAll();

            foreach($row as $key => $values){
                $esports_cards['camp ' . $key] = $values;
            }
            return $esports_cards;

        }else{
            return $esports_cards;
        }
    }

    public function nomeFotoPadraoCampHome($categoria_camp){
        
        $res = "..\Materials\ImagensCamps\default";

        switch($categoria_camp){

            case $this->categorias[0]:
                $res = $res . "_apex";
                break;

            case $this->categorias[1]:
                $res = $res . "_lol";
                break;

            case $this->categorias[2]:
                $res = $res . "_csgo";
                break;

            case $this->categorias[3]:
                $res = $res . "_valorant";
                break;

            default:
                $res = $res . "";
                break;
        }

        $res = $res . ".jpg";
        return $res;
    }


}

class Chat{
    private $pdo;
    public $msgErro = "";
    public $mensagem = [
        'id_mensagem' => '',
        'chat' => '',
        'id_usuario' => '',
        'nome_usuario' => '',
        'foto_usuario' => '',
        'texto' => '',
        'data' => ''
    ];
    public $chats = [
        'geral' => 'chat-geral'
    ];

    public function getChats(){
        return $this->chats;
    }

    public function inserirMensagem($chat, $id_usuario, $nome_usuario, $foto_usuario, $texto){
        global $pdo;

        $sql = $pdo->prepare("INSERT INTO `chat`(`chat`, `id_usuario`, `nome_usuario`, `foto_usuario`, `texto`, `data`) VALUES('$chat', $id_usuario, '$nome_usuario', '$foto_usuario', :txt, :dt)");
        $sql->bindValue(':txt', $texto);
        $sql->bindValue('dt', date('Y-m-d H:i:s'));
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}

?>