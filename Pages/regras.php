<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "../Templates/head.php"?>
    <link rel="stylesheet" href="../Css/style_sobre_nos.css">
</head>
<body>
    <div id="global">
        <?php
            include "../Templates/cabecalho.php";
        ?>
        <div class="div_principal">
            <div class="card">
                <h1>O que são as regras de convivência?</h1>
                <p>
                    Bem, em nosso site existe um sitema de conversas, por isso, é necessário que haja certas regras, sendo
                  elas importantíssimas para que haja uma boa convivência entre nossos amigos (usuários), por isso, por favor
                  siga as regras
                </p>
            </div>
            <div class="card">
                <h1>REGRAS</h1>
                <p> 1- NÃO FALAR SOBRE POLÍTICA OU QUALQUER ASSUNTO RELACIONADO.  </p> <br>
                <p> 2- NÃO DESRESPEITAR QUALQUER RELIGIÃO. </p> <br>
                <p> 3- EVITE FALAR PALAVRAS DE BAIXO CALÃO, PODE HAVER CRIANÇAS NO CHAT. </p> <br>
                <p> 4- SEJA RESPEITOSO COM TODOS. </p> <br>
                <p> 5- MACHISMO NÃO SERÁ TOLERADO. </p> <br>
                <p> 6- SEM RICHAS TÓXICAS SOBRE JOGOS. </p> <br>
                <p> 7- SE DIVIRTA!! </p>
                
            </div>
            <div class="card">
                <h1> Quais as punições?</h1>
                <p>
                 Dependendo do quão grave foi sua infração, nós iremos decidir o que será feito </p> <br>
               <p>  GRAVE- Caso tenha sido muito grave, iremos te banir e excluir sua conta. mandaremos um email explicando o motivo do banimento. </p><br> 
               <p> MEDIANA- Caso tenha sido mediana, mandaremos um email explicando qual regra descumpriu, e caso cometa algum erro dentro
                  de 30 dias  iremos te banir. Mandaremos um email explicando o motivo do banimento.</p><br>
               <p>  LEVE= Caso tenha sido leve, mandaremos um email explicando qual regra descumpriu, e caso cometa algum erro dentro de 15 dias
                 iremos te banir. Mandaremos um email explicando o motivo do banimento.</p><br>
                 
                 <p> Nossas medidas são de certa forma brutas pois buscamos uma comunidade saudável. </p>
                
            </div>
        </div>
        <?php
            
            include "../Templates/rodape.php";
        ?>
    </div>
</body>
</html>