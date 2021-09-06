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

    if($banco->conectar()){

        $id_camp = isset($_GET['idcampeonato']) ? $_GET['idcampeonato'] : NULL ;

        if($id_camp){

            $bd_campeonato = $esports->pegarCampeonato($id_camp);

            if($bd_campeonato){

            }else{
                echo"<script> alert('[Erro] Falha em coletar informações do Banco.') </script>";
                echo"<script> window.location.href = '../Pages/home.php' </script>";
                exit;
            }

        }else{
            echo"<script> alert('Valor de campeonato inválido') </script>";
            echo"<script> window.location.href = '../Pages/home.php' </script>";
            exit;
        }

    }else{
        echo"<script> alert('[Erro] Falha na conexão com o banco.') </script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo - Editar Campeonato</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/style_campeonatoEditar.css">
</head>
<body>
    <?php include "../Templates/cabecalho.php"?>
    <div class="global">
        <div class="editaCamp">
            <form class="form" action="editaCampeonato.php" method="post">
                <input type="hidden" name="id_camp" value="<?php echo$bd_campeonato['id_camp']?>">
                <h1>Editar Campeonato</h1>
                <div class="grupo" id="div_nome_camp">
                    <label for="input_name_camp">Nome Campeonato</label>
                    <input type="text" name="name_camp" id="input_name_camp" value="<?php echo$bd_campeonato['nome_camp']?>">
                </div>
                <div class="grupo" id="div_jogo_camp">
                    <label for="categoria_camp">Categoria</label>
                    <select class="campo" name="categoria_camp" id="categoria_camp">
                        <?php
                            foreach($esports->categorias as $value){
                                if($value == $bd_campeonato['categoria_camp']){
                                    echo"<option value='$value' selected>$value</option>";
                                }else{
                                    echo"<option value='$value'>$value</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="grupo" id="div_data_camp">
                    <label for="input_camp_datetime">Data Campeonato: </label>
                    <input type="datetime-local" name="datetime_camp" id="input_camp_datetime" value="<?php echo$bd_campeonato['data_camp']?>">
                </div>
                <div class="grupo" id="div_status_camp">
                    <div class="input_radio embreve">
                        <input type="radio" name="status_camp" id="input_status_camp" value="em breve" <?php if($bd_campeonato['status_camp'] == "0"){echo "checked";}?>>
                        <label id="labelEm" for="input_status_camp">Em Breve</label>
                    </div>
                    <div class="input_radio">
                        <input type="radio" name="status_camp" id="input_status_camp" value="encerrado" <?php if($bd_campeonato['status_camp'] == "1"){echo "checked";}?>>
                        <label id="labelFoi" for="input_status_camp">Encerrado</label>
                    </div>
                </div>
                <div class="grupo" id="buttons">
                    <a class="item voltar" href="./campeonatoSelecionar.php">Voltar</a>
                    <input class="item limpar" type="reset" value="Limpar">
                    <input class="item atu" type="submit" value="Alterar">
                </div>
            </form>
        </div>
    </div>
    <?php include "../Templates/rodape.php"?>
</body>
</html>