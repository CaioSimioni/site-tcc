<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo</title>
    <link rel="stylesheet" href="../Css/style_sobre_nos.css">
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
</head>
<body>
    <div id="global">
        <?php
            include "../Templates/cabecalho.php";
        ?>
        <div class="div_principal">
            <div class="card">
                <h1>O que é o Polo?</h1>
                <p>
                     O Polo é de um projeto de TCC(Trabalho de Conclusão de Curso) para o curso de 
                    Desenvolvimento de Sistemas Integrado com Ensino Médio no ano de 2021.  Que busca criar
                    um Software de Web voltado para Video Games e E-sports, além de cobrir as principais 
                    notícias desse universo.  Junto de um sistema de Chat na parte de Tópicos os usuários
                    podem interagir entre si e discutir sobre os principais assuntos.
                </p>
            </div>
            <div class="card">
                <h1>Quem somos?</h1>
                <p>
                    Toda a equipe é formata por: Caio, Felipe, Fernando, Giselle e Gustavo.
                    Alunos do 3º ETIM de Desenvolvimento de Sistemas da escola ETEC Tenente Aviador Gustavo 
                    Klug no ano de 2021.
                </p>
            </div>
            <div class="card">
                <h1>Por que usar o polo?</h1>
                <p>
                    Ao usar polo, você automaticamente incentiva jovens criadores a continuarem o seu trabalho. Cada acesso seu 
                    é um sorriso no rosto da equipe. Além claro de poder interagir com outros usuários no chat e poder torcer para o seu
                    time favorito, trazendo uma experiência único.
                </p>
            </div>
        </div>
        <?php
            
            include "../Templates/rodape.php";
        ?>
    </div>
</body>
</html>