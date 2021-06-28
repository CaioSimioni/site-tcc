<?php
session_start();

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
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
    <link rel="stylesheet" href="../CSS/style_sobre_nos.css">
    <link rel="shortcut icon" href="../ASSETS/polo_icon.png" type="image/x-icon">
</head>
<body>
    <div id="global">
        <?php
            include "../COMPONENTS/cabecalho.html";
        ?>
        <div class="div_principal">
        <div class="card">
                <h1>O que é o Polo?</h1>
                <p>
                     O Polo tratasse de um projeto de TCC(Trabalho de conclusão de curso) para o curso de 
                    Desenvolvimento de Sistemas Integrado com Ensino Médio no ano de 2021.  Que busca criar
                    um Software de Web voltado para Video Games e E-sports, além de cobrir as principais 
                    notícias desse universo.  Junto de um sistema de Chat na parte de Tópicos os usuários
                    podem interagir entre si e discutir sobre os principais assuntos.
                </p>
            </div>
            <div class="card">
                <h1>Quem somos?</h1>
                <p>
                    Toda a equipe é formata por: Caio, Felipe, Fernando, Giselle, Gustavo.
                </p>
                <p>
                    Todos alunos do 3º ETIM de Desenvolvimento de Sistemas da escola ETEC Tenente Aviador Gustavo 
                    Klug no ano de 2021.
                </p>
            </div>
            <div class="card">
                <h1>Por que usar o polo?</h1>
                <p>
                Ao usar polo, você automaticamente incentiva jovens criadores a continuarem o seu trabalho. Cada acesso seu é um sorriso no rosto da equipe
                </p>
            </div>
        </div>
        <?php
            include "../COMPONENTS/rodape.html";
        ?>
    </div>
</body>
</html>