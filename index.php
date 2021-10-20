<?php
    require "./System/classes.php";    // Importo o arquivo usuario.php
    $banco = new BancoBD;
    $user = new Usuario; // Cria um objeto de Usuario

    if(isset($_SESSION['codigo_usuario']) ){
        echo "<script> window.location.href='./Pages/home.php' </script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "./Templates/head.php" ?>
    <link rel="stylesheet" href="./Css/style_index.css">
</head>

<body>
        <!-- Cabeçalho do site -->
        <?php
            include "./Templates/cabecalho.php";
        ?>

        <div id="global">
            <!-- Parte de indrodução do site, Bem vindo e login -->
            <div id="indroducao">

                <!-- Parte do Bem vindo -->
                <div class="bem_vindo">
                    <h1>Bem vindo ao POLO</h1><br>
                    <p>
                        O POLO é um site de notícias e entreterimento que existe para te manter
                        informado sobre o mundo dos games.  Onde você fica por dentro dos
                        principais campeonatos acontecendo dos seus jogos favoritos.
                        Aqui você pode interagir com outras pessoas, torcer pelo seu time favorito,
                        e discutindo com outros usuários sobre os jogos que gostam.<br> 
                        Cadastrar-se ->
                    </p>
                </div>

                <!-- Formulário de login -->
                <div class="formulario">
                    <h1>Login</h1>
                    <form method="POST">
                        <input type="text" name="usuario" placeholder="Usuário">
                        <input type="password" name="senha" placeholder="Senha">
                        <input type="submit" value="ACESSAR">
                        <a href="./Pages/cadastrar.php">Cadastrar-se</a>
                    </form>

                    <!-- Parte do PHP de Login -->
                    <?php
                        if(isset($_POST['usuario']) && isset($_POST['senha'])){  // Verifica se o Post de usuario foi feito

                            // Recebe os valores do POST
                            $usuario = addslashes($_POST['usuario']);
                            $senha = addslashes($_POST['senha']);
                            
                            // Verifica se os campos estão vazios
                            if(!empty($usuario) && !empty($senha)){
                                
                                $banco->conectar(); //Faz a conexão com o banco
                                
                                if($banco->msgErro == ""){  // Verifica se o retorno foi uma mensagem de erro
                                    
                                    if($user->entrarUsuario($usuario, $senha)){
                                        
                                        echo "<script> window.location.href='./Pages/home.php' </script>";
                                        exit;

                                    }else{
                                        echo "<p class='erromsg'>Usuário e/ou senha estão incorretos!</p>";
                                    }
                                }else{
                                    echo "Erro:".$u->msgErro."";
                                }
                            }else{
                                echo "Peencha todos os campos";
                            }
                        }
                    ?>
                </div>

            </div>
        </div>
        <!-- Rodapé do site -->
        <?php
            include "./Templates/rodape.php"
        ?>
        
</body>
</html>