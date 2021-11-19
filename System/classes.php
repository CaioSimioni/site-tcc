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

        $nome    = "3863708_polo";
        $host    = "localhost";
        $usuario = "root";
        $senha   = "";

        /*
        $nome    = "3863708_polo";
        $host    = "fdb32.awardspace.net";
        $usuario = "3863708_polo";
        $senha   = "A5Fh9xV)0aY(oP@t";// A5Fh9xV)0aY(oP@t
        */

        try{  // Tenta fazer o PDO
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
            return true;
        }catch(PDOException $e){  // o Erro do PDO = $e
            $msgErro = $e->getMessage();
            return false;
        }
    }

}

Class feedback{
    private $pdo;  
    public $msgErro = "";
   
     public function EnviarFeed($nome,$email,$mensagem){
        //   $to = "fernandoft0p6@gmail.com";
        //   $subjet = "Contato - Programador BR";
        //   $body = "Nome: ".$nome. "\r\n ".
        //           "Email: ".$email."\r\n".
        //            "Mensagem: ".$mensagem;
        //    $header = "From: "."\r\n"."Reply-To: ".$email."\e\n"."x=Mailer:PHP/".phpversion();
        
        //     if (mail($to,$subjet,$body,$header)){
                return true;
        //                                             }
        //      else{
        //  return true;
        //          }
        
       
     }

}

Class Usuario{
    private $pdo;  // Fica meio cinza pq ainda não usou.  Biblioteca PDO.
    public $msgErro = "";
    public $usuarioValues;

    public function validarLoginUsario(){
        if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
            echo "<script> alert('Falha na autenticação de usuário!')</script>";    
            echo "<script>window.location.href='../'</script>";
            exit;
        }
    }

    public function validarAdmin(){
        if($_SESSION['adm'] == false) {
            echo "<script>alert('Você não tem permissão para entrar nesta área')</script>";
            echo "<script>window.location.href='../index.php'</script>";
            exit;
        }
    }

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
    public $noticiaValues = false;

    /*
        Atribudos Notícia
        * id_noticia
        * titulo
        * descricao
        * fonte
        * imagem
        * data
    */

    public function cadastrarNoticia($titulo , $descricao, $fonte, $data, $imagem){
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
        
        $sql = $pdo->prepare("SELECT * FROM `noticia` WHERE `id_noticia` = $id_noticia");
        $sql->execute();

        if($sql->rowCount() > 0){

            $dados = $sql->fetch();

            $noticiaValues = array(
                "id" => $dados['id_noticia'],
                "titulo" => $dados['titulo'],
                "descricao" => $dados['descricao'],
                "fonte" => $dados['fonte'],
                "data" => $dados['data'],
                "imagem" => $dados['imagem']
            );

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

        $sql = $pdo->prepare("SELECT `id_noticia`, `titulo`, `descricao`, `fonte`, `data`, `imagem` FROM `noticia` ORDER BY `noticia`.`data` DESC LIMIT 3;");
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
        "Valorant",
        "Free Fire"
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
            $nome_arquivo = "./Tab_Camps/" . $local_arquivo_tabela . ".php";
            if(file_exists($nome_arquivo) && is_file($nome_arquivo)){

            }else{
                file_put_contents($nome_arquivo, PHP_EOL.
                    '<table>'.PHP_EOL.
                    "\t".'<thead>'.PHP_EOL.
                    "\t".'</thead>'.PHP_EOL.
                    "\t".'<tbody>'.PHP_EOL.
                    "\t\t".'<tr>'.PHP_EOL.
                    "\t\t\t".'<td style="text-align: center;">Informações da tabela não encontradas.</td>'.PHP_EOL.
                    "\t\t".'</tr>'.PHP_EOL.
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
                "local_arquivo_tabela" => "../Esports/Tab_Camps/" . $dados['local_arquivo_tabela'] . ".php"
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
                "local_arquivo_tabela" => "../Esports/Tab_Camps/" . $dados['local_arquivo_tabela'] . ".php",
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

            case $this->categorias[4]:
                $res = $res . "_freefire";
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

    public function exibirMensagensChat(){
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM `chat` WHERE `chat` = 'chat-geral' ORDER BY `data` DESC LIMIT 50");
        $sql->execute();
        
        if($sql->rowCount() > 0){

            $dados = $sql->fetchAll();

            foreach($dados as $values){

                /*  Estrutura das mensagens
                    <div class="msg-in OU msg-out">  'out' do usuario local
                        <div class="info-user">
                            <img src="../Materials/UsersAvatar/icon.png">
                            <h1> Pedrinho_gamer </h1>
                        </div>
                        <div class="content-msg">
                            <p> Oi, alguém no chat? </p>
                        </div>
                    </div> 1
                */
                if($values['id_usuario'] == $_SESSION['codigo_usuario']){
                    
                    ?>
                    <div class="vai-pa-direita">
                        <div class="msg-out">
                            <div class="info-user">
                                <img class="avatar-user" src=<?php echo "../Materials/UsersAvatar/".$values['foto_usuario']; ?> alt="img-user">
                                <h1 class="name-user"><?php echo $values['nome_usuario'] ?></h1>
                            </div>
                            <div class="content-msg">
                                <p class="texto"><?php echo $values['texto'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="vai-pa-esquerda">
                        <div class="msg-in">
                            <div class="info-user">
                                <img class="avatar-user" src=<?php echo "../Materials/UsersAvatar/".$values['foto_usuario']; ?> alt="img-user">
                                <h1 class="name-user"><?php echo $values['nome_usuario'] ?></h1>
                            </div>
                            <div class="content-msg">
                                <p class="texto"><?php echo $values['texto'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }

            }
            return true;

        }else{
            //  Exibir que não há mensagens no chat
            //  Falar para a pessoa ser a primeira
            ?>
                <div class="msg-erro">
                    <div class="title-msg">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                    width="28px" height="28px" viewBox="0 0 1218.000000 1280.000000"
                    preserveAspectRatio="xMidYMid meet">
                    <metadata>
                    Created by potrace 1.15, written by Peter Selinger 2001-2017
                    </metadata>
                    <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)"
                    fill="#FFFFFF" stroke="none">
                    <path d="M9020 12775 c-955 -264 -1655 -1028 -1820 -1986 -55 -312 -39 -713
                    40 -1017 l19 -77 -31 -45 c-155 -221 -602 -750 -998 -1180 -462 -503 -1444
                    -1500 -1945 -1976 -674 -639 -1234 -1137 -1647 -1462 l-117 -92 -91 0 c-172 0
                    -423 -39 -625 -97 -738 -212 -1344 -758 -1624 -1461 -76 -191 -126 -379 -162
                    -617 -17 -105 -17 -484 -1 -605 49 -363 169 -710 352 -1010 60 -98 85 -128
                    119 -141 34 -13 83 5 103 39 9 15 144 377 298 803 155 425 300 812 322 859 52
                    109 166 227 273 282 138 72 306 97 447 67 70 -15 1213 -431 1303 -474 178 -86
                    319 -268 355 -456 15 -80 11 -226 -9 -299 -9 -36 -153 -438 -320 -895 -317
                    -867 -315 -862 -275 -907 37 -39 79 -35 293 33 824 263 1455 935 1665 1774 68
                    271 91 556 66 817 -23 240 -84 502 -165 703 l-44 109 87 101 c915 1062 2329
                    2494 3307 3351 450 393 811 678 1108 873 l97 64 258 2 c280 1 379 12 597 65
                    460 111 852 329 1186 660 399 396 628 858 720 1455 17 105 17 484 1 605 -39
                    290 -118 554 -241 805 -64 130 -150 276 -184 314 -53 57 -123 47 -156 -22 -11
                    -23 -146 -388 -301 -812 -154 -423 -296 -804 -317 -845 -48 -99 -167 -220
                    -268 -272 -138 -72 -306 -97 -447 -67 -70 15 -1213 431 -1303 474 -140 68
                    -255 189 -315 332 -38 91 -50 153 -50 259 0 118 10 153 132 489 60 165 200
                    547 310 849 219 604 218 598 155 636 -40 25 -51 24 -157 -5z"/>
                    </g>
                    </svg>
                        <h1 class="title-msg-erro">Ocorreu um Erro</h1>
                    </div>
                    <div class="desc-msg">
                        <p class="desc-msg-erro">Chat está indisponivel, tente mais tarde!</p>
                    </div>
                </div>
            <?php
            return false;
        }
    }

    public function exibirMensagensAdm(){
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM `chat` ORDER BY `chat`.`data` DESC");
        $sql->execute();

        if($sql->rowCount() > 0){

            $dados = $sql->fetchAll();

            foreach($dados as $key => $values){
                ?>
                    <tr>
                        <td><?php echo $values['id_mensagem']?></td>
                        <td><?php echo $values['chat']?></td>
                        <td><?php echo $values['texto']?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($values['data']))?></td>
                        <td class="func"><a class='excluir' href='excluir.php?idmsg=<?php echo $values['id_mensagem']?>'>Excluir</a></td>
                    </tr>
                <?php
            }

            return true;

        }else{
            return false;
        }
    }

    public function deletaMensagem($id_msg){
        global $pdo;

        $sql = $pdo->prepare("SELECT `nome_usuario` FROM `chat` WHERE `chat`.`id_mensagem` = $id_msg");
        $sql->execute();

        if($sql->rowCount() > 0){  // Existe a mensagem

            $dados = $sql->fetchAll();

            $nome_usuario = $dados[0]['nome_usuario'];
            
            $sql2 = $pdo->prepare("DELETE FROM `chat` WHERE `chat`.`id_mensagem` = :id");
            $sql2->bindValue(':id', $id_msg);
            $sql2->execute();

            if($sql2->rowCount() > 0){

                return [
                    "id" => $id_msg,
                    "user" => $nome_usuario
                ];

            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function inserirMensagem($chat, $id_usuario, $nome_usuario, $foto_usuario, $texto){
        global $pdo;

        $sql = $pdo->prepare("INSERT INTO `chat`(`chat`, `id_usuario`, `nome_usuario`, `foto_usuario`, `texto`, `data`) VALUES('$chat', $id_usuario, '$nome_usuario', '$foto_usuario', :txt, :dt)");
        $sql->bindValue(':txt', $texto);
        $sql->bindValue(':dt', date('Y-m-d H:i:s'));
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}

?>