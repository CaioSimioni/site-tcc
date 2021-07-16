<?php
    require "./test.php";
    $test = new Testes;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testes de data</title>
    <link rel="stylesheet" href="test.css">
</head>
<body onload="limparCampos()">
    <div id="global">
        <form method="POST">
            <p>Data: <input type="date" name="input-data" value="0"></p>
            <input type="submit" value="Enviar">
        </form>
        <div id="mensagem"></div>
    </div>

    <?php
        $data = isset($_POST['input-data']) ? $_POST['input-data'] : NULL;

        if ($data){

            if (!empty($data)){

                $test->conectaBD();

                if($test->inserirData($data)){

                    echo "<script> document.getElementById('mensagem').innerHTML = 'foi'; </script>";

                }else{
                    echo "<script> document.getElementById('mensagem').innerHTML = '[Erro:] Não foi possível inserir os valores'; </script>";
                }

            }else{
                echo "<script> document.getElementById('mensagem').innerHTML = '[Erro:] Campo data vazia.'; </script>";
            }
        }else{
            echo "<script> document.getElementById('mensagem').innerHTML = ' Escolha uma data primeiro.'; </script>";
        }
    ?>

    <script>
        
    </script>
</body>
</html>