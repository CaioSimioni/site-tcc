<?php
require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;

$banco->conectar();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

if($_SESSION['adm'] == false) {
    echo "<script>alert('Você não tem permissão para entrar nesta área')</script>";
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/style_adm.css">

    <script src=""></script>



</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>

    <div class="global">
        <section class="sec">
            <h1>Funções De Notícias</h1>
            <div class="box">
                <a href="../Noticia/noticiaCadastro.php">
                    <div class="cards">
                        <h3>Nova Notícia</h3>
                        <p>Crie uma notícia que poderá ser vista na home do site.</p>
                    </div>
                </a>
                <a href="../Noticia/noticiaSelecionar.php">
                    <div class="cards">
                        <h3>Selecionar Notícia</h3>
                        <p>Selecione uma notícia para editar ou excluir.</p>
                    </div>
                </a> 
            </div>
        </section>

        <section class="sec">
            <h1>Funções De Campeonatos</h1>
            <div class="box">
                <a href="">
                    <div class="cards">
                        <h3>Novo Campeonato</h3>
                        <p>Crie um campeonato que poderá ser visto na haba E-sports do site</p>
                    </div>
                </a>
                <a href="">
                    <div class="cards">
                        <h3>Editar Campeonato</h3>
                        <p>Edite dados de um campeonato</p>
                    </div>
                </a>
                <a href="">
                    <div class="cards">
                        <h3>Excluir Campeonato</h3>
                        <p>Exclua totalmente os dados de um campeonato que desejar</p>
                    </div>
                </a>
            </div>
        </section>

        <section class="sec">
            <h1>Funções Sobre Usuários</h1>
            <div class="box">
                <a href="">
                    <div class="cards">
                        <h3>Novo Usuario</h3>
                        <p>Crie um usuário que poderá ter as informações que você colocar</p>
                    </div>
                </a>
                <a href="">
                    <div class="cards">
                        <h3>Editar Usuário</h3>
                        <p>Edite dados de um usuário</p>
                    </div>
                </a>
                <a href="">
                    <div class="cards">
                        <h3>Excluir Usuário</h3>
                        <p>Exclua totalmente os dados de um usuário que desejar</p>
                    </div>
                </a>
                <a href="">
                    <div class="cards">
                        <h3>Banir Usuário</h3>
                        <p>Dê banimento em um usuário que desejar</p>
                    </div>
                </a>
            </div>
        </section>
        
    </div>

    <?php
        include "../Templates/rodape.php";
    ?>
</body>
</html>