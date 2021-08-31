<?php

$path_pasta = 'tabs_camps';

if(!is_dir($path_pasta)){
    mkdir($path_pasta);
}

//  Informações do Banco de Dados.

$camp = array(
    'id' => 3,
    'title' => 'ALGS 2021',
    'tab_name' => 'algs-2021',
    'data' => date('2021-10-08')
);

/**
 * if(file_exists($camp['tab_name']) && is_file($camp['tab_name'])){
 *   echo $camp['tab_name'] . '-> exist and is a file';
 * }else{
 *  echo $camp['tab_name'] . '-> dont exist and isnt a file';
 * }
 */

$nome_arquivo = $path_pasta . "\\" . $camp['tab_name'] . '.php';


if(file_exists($nome_arquivo) && is_file($nome_arquivo)){ 
    $tabela = file_get_contents($nome_arquivo);
}else{
    file_put_contents($nome_arquivo, '<table>'.PHP_EOL.
    '<thead>'.PHP_EOL.
    '</thead>'.PHP_EOL.
    '<tbody>'.PHP_EOL.
    '</tbody>'.PHP_EOL.
    '</table>');
    $tabela = file_get_contents($nome_arquivo);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Polo</title>
    <style>
        textarea {
            font-size: .8rem;
            letter-spacing: 1px;
        }
        textarea {
            padding: 10px;
            max-width: 100%;
            min-width: 500px;
            line-height: 1.5;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: 1px 1px 1px #999;
        }
        table {
            border-collapse: collapse;
            max-width: 100%;
            min-width: 500px;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #d6d6d6;
        }

        tr:nth-child(even) {background-color: #f2f2f2;}

        main{
            display: block;
            margin: 20px auto;
        }
    </style>
    
</head>
<body>
    <main>
        <strong>Tabela </strong>
        <div id="tabela_camp_rederizada">
            <?php echo $tabela?>
        </div>
        <br>
        <form action="setTab.php" method="post">
            <input type="hidden" name="nameTabCamp" value="<?php echo $nome_arquivo ?>">
            <label for="txta_tabs" style="display: block;"><strong>Nome Campeonato:</strong> <?php print $camp['title']?></label>
            <br>
            <textarea name="tabCamp" id="txta_tabs" cols="30" rows="10"><?php print $tabela ?></textarea>
            <div class="bottons">
                <input type="reset" value="Limpar">
                <input type="submit" value="Atualizar">
            </div>
        </form>
    </main>

    <script type="text/javascript" defer>

        document.getElementById('txta_tabs').addEventListener("keydown", function(e) {
        if(e.key === "Tab") { // TAB
            var posAnterior = this.selectionStart;
            var posPosterior = this.selectionEnd;

            e.target.value = e.target.value.substring(0, posAnterior)
                            + '\t'
                            + e.target.value.substring(posPosterior);

            this.selectionStart = posAnterior + 1;
            this.selectionEnd = posAnterior + 1;

            // não move pro próximo elemento
            e.preventDefault();
        }
        });
    </script>
</body>
</html>
