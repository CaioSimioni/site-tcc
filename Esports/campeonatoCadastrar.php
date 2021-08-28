<?php
require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;
$esports = new Esports;

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
    <link rel="stylesheet" href="../Css/style_campeonatoCadastrar.css">

</head>
<body>

    <?php include "../Templates/cabecalho.php" ?>

    <div id="global">

        <?php
            if(isset($_POST['nome_camp'])){
                $nome_camp = isset($_POST['nome_camp']) ? addslashes($_POST['nome_camp']) : NULL;
                $categoria_camp = isset($_POST['categoria_camp']) ? addslashes($_POST['categoria_camp']) : NULL;
                $data_camp = isset($_POST['data_camp']) ? $_POST['data_camp'] : NULL;
                $nome_arquivo_camp = isset($_POST['nome_arquivo_camp']) ? addslashes($_POST['nome_arquivo_camp']) : NULL;

                if($_POST['status_camp'] == "Em Breve"){
                    $status_camp = 0;
                }else if($_POST['status_camp'] == "Encerrado"){
                    $status_camp = 1;
                }

                if(!empty($nome_camp) && !empty($categoria_camp) && !empty($data_camp) && !empty($nome_arquivo_camp)){
                    
                    if($banco->conectar()){

                        if($esports->cadastrarEsports($nome_camp, $categoria_camp, $data_camp, $nome_arquivo_camp, $status_camp)){

                            echo"<script> alert('Campeonato cadastrado com SUCESSO.') </script>";
                            echo"<script> window.location.href = 'campeonatoSelecionar.php' </script>";
                            exit;

                        }else{
                            echo"<script> alert('Não foi possível cadastrar o Campeonato') </script>";
                        }

                    }else{
                        echo"<script> alert('[Erro] Não foi possível conectar ao Banco de Dados.') </script>";
                    }
                    
                }else{
                    echo"<script> alert('Preencha todos os campos.') </script>";
                }
            }

        ?>

        <form class="form" action="./campeonatoCadastrar.php" method="post">
            <h1>Cadastrar Campeonato</h1>
            <div class="inputs">
                <div class="grupo">
                    Nome
                    <input type="text" class="campo" name="nome_camp" id="nome_camp">
                </div>

                <div class="grupo">
                    Jogo
                    <select class="campo" name="categoria_camp" id="categoria_camp">
                        <?php
                            foreach($esports->categorias as $value){
                                echo"<option value='$value'>$value</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="grupo">
                    Data
                    <input type="datetime-local" class="campo" name="data_camp" id="data_camp">
                </div>

                <div class="grupo">
                    Nome Arquivo
                    <input type="text" class="campo" name="nome_arquivo_camp" id="nome_arquivo_camp">
                </div>

                <div class="grupo ra">
                    Status
                    <div class="status_radios">
                        <input type="radio" name="status_camp" id="status_camp_embreve" value="Em Breve" checked>
                        <label for="status_camp_embreve">Em breve</label>
                    </div>
                    <div class="status_radios">
                        <input type="radio" name="status_camp" id="status_camp_encerrado" value="Encerrado">
                        <label for="status_camp_encerrado">Encerrado</label>
                    </div>
                </div>
            </div>
            <div class="submit">
                <input class="btn" type="submit" value="Cadastrar">
            </div>
        </form>
    </div>

    <?php include "../Templates/rodape.php" ?>

</body>
</html>
