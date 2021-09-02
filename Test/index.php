<?php

$path_pasta = 'tabs_camps';

if(!is_dir($path_pasta)){
    mkdir($path_pasta);
}

$date = new DateTime('2021-08-26 19:42:00');

//  Informações do Banco de Dados.

$camp = array(
    'id' => 3,
    'title' => 'ALGS 2021',
    'tab_name' => 'algs-2021',
    'data' => $date->format('Y-m-d\TH:i:s')
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
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

    <div class="global">
        <main class="maintag">
            <form action="setTab.php" method="post">
                <div class="input_hidden">
                    <input type="hidden" name="camp_id" value="<?php echo $camp['id'] ?>">
                    <input type="hidden" name="camp_nameTab" value="<?php echo$camp['tab_name'] ?>">
                </div>
                <div class="view_tabela">
                    <h1>Tabela atual</h1>
                    <?php echo $tabela?>
                </div>
                <div class="input_camp">
                    <div class="input_camp_nome">
                        <label for="input_title">Nome campeonato: </label>
                        <input type="text" name="camp_title" id="input_title" value="<?php echo $camp['title']?>">
                    </div>
                    <div class="input_camp_data">
                        <label for="input_datetime">Data Campeonato: </label>
                        <input type="datetime-local" name="camp_datetime" id="input_datetime" value="<?php echo$camp['data']?>">
                    </div>
                </div>
                <div class="code_tabela">
                    <h1>Código da tabela</h1>
                    <textarea name="camp_newTab" id="txta_tabs" cols="30" rows="10"><?php print $tabela ?></textarea>
                </div>
                <div class="buttons">
                    <input type="reset" value="Limpar">
                    <input type="submit" value="Atualizar">
                </div>
                <p>&copy; CaioR.S.</p>
            </form>
        </main>
    </div>

    <script type="text/javascript" src="script.js" defer="defer" ></script>
</body>
</html>
