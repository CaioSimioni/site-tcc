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

        $bd_campeonato = $esports->vizualizarCampeonato($id_camp);

        if($bd_campeonato){

            if(file_exists($bd_campeonato['local_arquivo_tabela']) && is_file($bd_campeonato['local_arquivo_tabela'])){
                $bd_campeonato['tabela'] = file_get_contents($bd_campeonato['local_arquivo_tabela']);
            }else{
                file_put_contents($bd_campeonato['local_arquivo_tabela'], PHP_EOL.
                '<table>'.PHP_EOL.
                "\t".'<thead>'.PHP_EOL.
                "\t".'</thead>'.PHP_EOL.
                "\t".'<tbody>'.PHP_EOL.
                "\t".'</tbody>'.PHP_EOL.
                '</table>');
                $bd_campeonato['tabela'] = file_get_contents($bd_campeonato['local_arquivo_tabela']);
            }

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
    <title>Polo</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">

</head>
<body>

<?php include "../Templates/cabecalho.php"?>

<div class="global">
    <div class="view_camp">
        <?php
            var_dump($bd_campeonato);

        ?>
        <form action="editaTabelaCampeonato.php" method="post">
                
                    <input type="hidden" name="camp_id" value="<?php echo $bd_campeonato['id'] ?>">
                    <input type="hidden" name="camp_local_arquivo_tab" value="<?php echo$bd_campeonato['local_arquivo_tabela'] ?>">
                
                <div class="info_camp">
                    <h1>Informações Campeonato</h1>
                    <div class="camp_nome">
                        <label>Nome: <?php echo $bd_campeonato['nome']?></label>
                    </div>
                    <div class="camp_data">
                        <label>Data: <?php echo$bd_campeonato['data']?></label>
                    </div>
                    <div class="camp_status">
                        <label>Status: <?php if($bd_campeonato['status'] == '0'){echo "Em breve";}else{echo "Encerrado";}?></label>
                    </div>
                </div>
                <div class="view_tabela">
                    <h1>Tabela atual</h1>
                    <?php echo $bd_campeonato['tabela']?>
                </div>
                <div class="code_tabela">
                    <h1>Código da tabela</h1>
                    <textarea name="camp_nova_tab" id="txta_tabs" cols="30" rows="10"><?php print $bd_campeonato['tabela'] ?></textarea>
                </div>
                <div class="buttons">
                    <button><a href="campeonatoSelecionar.php">Voltar</a></button>
                    <input type="reset" value="Limpar">
                    <input type="submit" value="Atualizar">
                </div>
            </form>
    </div>
</div>

<?php include "../Templates/rodape.php"?>

</body>
</html>