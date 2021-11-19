<?php
    require "../System/classes.php";
    $banco = new BancoBD;
    $camp = new Esports;
    $user = new Usuario;

    $user->validarLoginUsario();

    // Valida o id do campeonato.
    if(!isset($_GET['id'])){
        echo"<script> alert('Acesso inválido!'); window.location.href = '../Pages/home.php'; </script>";
        exit;
    }elseif($_GET['id'] == NULL){
        echo"<script> alert('Acesso inválido!'); window.location.href = '../Pages/home.php'; </script>";
        exit;
    }

    if($banco->conectar() == false){
        echo"<script> alert('[Erro] Falha ao conectar ao servidor'); window.location.href = '../Pages/home.php'; </script>";
        exit;
    }

    $bd_camp = $camp->vizualizarCampeonato($_GET['id']);
    if($bd_camp){
        if(file_exists($bd_camp['local_arquivo_tabela']) && is_file($bd_camp['local_arquivo_tabela'])){
            $bd_camp['tabela'] = file_get_contents($bd_camp['local_arquivo_tabela']);
        }else{
            file_put_contents($bd_camp['local_arquivo_tabela'], PHP_EOL.
            '<table>'.PHP_EOL.
            "\t".'<thead>'.PHP_EOL.
            "\t".'</thead>'.PHP_EOL.
            "\t".'<tbody>'.PHP_EOL.
            "\t\t".'<tr>'.PHP_EOL.
            "\t\t\t".'<td style="text-align: center;">Informações da tabela não encontradas.</td>'.PHP_EOL.
            "\t\t".'</tr>'.PHP_EOL.
            "\t".'</tbody>'.PHP_EOL.
            '</table>');
            $bd_camp['tabela'] = file_get_contents($bd_camp['local_arquivo_tabela']);
        }

    }else{
        echo"<script> alert('[Erro] Falha na conexão com o Banco.') </script>";
        echo"<script> window.location.href = '../Pages/home.php' </script>";
        exit;
    }

?>

<html>
<head>
    <?php include '../Templates/head.php'?>
    <link rel="stylesheet" href="../Css/style_exibirCampeonato.css">
</head>
<body>
    <?php include '../Templates/cabecalho.php'?>
    <div class="global">
        <div class="view_camp">
            <div class="info_camp">
                <h1>Informações Campeonato</h1>
                <div class="camp">
                    <p class="nome">Nome</p>
                    <label class="resultado"><?php echo $bd_camp['nome']?></label>
                </div>
                <div class="camp">
                    <p class="data">Data</p>
                    <label class="resultado"><?php echo date("d/m/y - h:m", strtotime($bd_camp['data'])) . " BRT"?></label>
                </div>
                <div class="camp">
                    <p class="status">Status</p>
                    <label class="resultado"><?php if($bd_camp['status'] == '0'){echo "Em breve";}else{echo "Encerrado";}?></label>
                </div>
            </div>
            <div class="view_tabela">
                <h1 class="title_tab">Tabela atual</h1>
                <?php echo $bd_camp['tabela']?>
            </div>
        </div>
    </div>
    <?php include '../Templates/rodape.php'?>
    </body>
</html>
