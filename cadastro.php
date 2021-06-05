<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLO</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="ASSETS/LogoArara.png" type="image/x-icon">
</head>
<body>
    <div id="global">

        <header class="header">
            <img class="logo" src="./ASSETS/LogoPOLO.png" alt="logo">
            <nav>
                <ul class="nav__links">
                    <li><a href="#">E-Sports</a></li>
                    <li><a href="#">Tópicos</a></li>
                    <li><a href="#">Perfil</a></li>
                </ul>
            </nav>
            <a class="cta" href="./PHP/informacoes.php"><button>Mais informações</button></a>
        </header>

       
            </div>
            <div class="formulario">
                <h1>Cadastrar</h1>
                <form action="PHP/registrar.php" method="POST">
                    <input type="text" name="nome" placeholder="Usuário">
                    <input type="text" name="email" placeholder="email">
                    <input type="password" name="confi_senha" placeholder="Senha">
                    <input type="password" name="senha" placeholder="Confirmar senha">
                    <input type="submit" value="ACESSAR">
                </form>
            </div>
        </div>

      
      

        <footer id="final">
            <img src="ASSETS/LogoPOLO.png" alt="">
            <ul>
                <li><a href="">Contato</a></li>
                <li><a href="">Reclamações</a></li>
                <li><a href="">Suporte</a></li>
            </ul>
            <span>&copy;Copyright POLO-2021</span>
        </footer>
        
    </div>
</body>
</html>