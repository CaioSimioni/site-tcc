<?php
/**
 *  Manipulando arquivos e pastas com PHP - Aula 33 | Otávio Miranda |
 *  Link da vídeo aula: https://youtu.be/rtylAeHo3oA
 */

$pasta = 'pasta';   // Nome da futura pasta.

//  Verfico se a pasta que pretendo criar é um diretório.
if(!is_dir($pasta)){
    mkdir($pasta);
}

/**
 *  Nome do arquivo que será criado.
 *  [nome].[data].[extenção]
 */
$nome_arquivo = 'nome_arquivo_' . date('Y-m-d-H-i-s') . '.txt';

$arquivo = fopen($nome_arquivo, 'w+');  //  Abro o arquivo, com o parâmetro de escrever.  E atribuo a variável '$arquivo'.

//  Escrevo as linhas do arquivo.
fwrite($arquivo, 'Minha linha 1' . PHP_EOL);    // PHP_EOL faz pular a linha.
fwrite($arquivo, 'Minha linha 2' . "\n");       // "\n" faz pular a linha.
fwrite($arquivo, 'Minha...');
fwrite($arquivo, "\n");

fclose($arquivo);   //  Fecha o arquivo.  IMPORTANTE SEMPRE FECHAR O ARQUIVO!

/**
 *  Local para onde vou mover o arquivo.
 *  [/]  -> Linux
 *  [\\] -> Windows
 */
$move_arquivo = "$pasta\\$nome_arquivo";

/**
 *  O comando rename() renomeia o arquivo.
 *  Mas também é usadopara mover arquivo entre pastas.
 */
rename($nome_arquivo, $move_arquivo);

/**
 *  Para ler o conteúdo de um arquivo existem duas maneiras.
 * 
 *  1º Lê linha por linha.
 * 
 *  2º Lê o arquivo por inteiro.
 */

// ↓↓ 1º Forma ↓↓
if(file_exists($move_arquivo) && is_file($move_arquivo)){   //  Verifico se o arquivo EXISTE e se É UM ARQUIVO.

    $ler_arquivo = fopen($move_arquivo, 'r');   //  Abro o arquivo somente para leitura.

    /**
     *  foef() -> verifica se o ponteiro do arquivo está no final.
     *  Ou seja, enquanto o ponteiro não chegano ninal do arquivo.
     */
    while(!feof($ler_arquivo)){
        echo fgets($ler_arquivo);   // Pegue a linha onde o ponteiro está.
    }

    fclose($ler_arquivo);   // Fecho a leitura do arquivo.
}

// ↓↓ 2º Forma ↓↓
if(file_exists($move_arquivo) && is_file($move_arquivo)){   //  Verifico se o arquivo EXISTE e se É UM ARQUIVO.

    echo file_get_contents($move_arquivo);  //  Pegua todo o conteúdo do arquivo.
}

/**
 *  Para excluir uma pasta e todo o seu conteúdo.
 */

if(is_dir($pasta)){     // Verifico se $pasta é um diretório
    /**
     *  Faço uma estrutura de repetição para cada item do diretório.
     *  Usando scandir() para cada item da pasta como arquivo.
     */
    foreach(scandir($pasta) as $arquivo){
        $caminho_arquivo = "$pasta\\$arquivo";  //  O caminho do arquivo, ou seja, o arquivo em si para o PC.

        if(is_file($caminho_arquivo)){  //  Verifico se o arquivo é realmente um arquivo.
            unlink($caminho_arquivo);   //  Removo o arquivo de $caminho_arquivo.
        }
    }

    rmdir($pasta);  //  Removo a pasta de $pasta.
}

/**
 *  Além de todas essas formas exite o jeito simplificado e direto.
 *  ↓   ↓   ↓
 */

$arquivo = ('arquivo.txt');

/**
 *  Com o comando file_put_contents() é possível:
 *  - Criar o arquivo
 *  - Inserir informações no arquivo
 *  - Salvar o arquivo
 *  
 *  Com o comando file_get_contents() é possível:
 *  - Abri oarquivo
 *  - Ler o arquivo
 *  - Fechar o arquivo
 */
file_put_contents($arquivo, 'Hello world.');
echo file_get_contents($arquivo);

//  Criar um novo arquivo, copia de outro arquivo.
copy('arquivo.txt', 'arquivo_copy.txt');
