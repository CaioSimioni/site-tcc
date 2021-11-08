<!DOCTYPE html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
        *{
            padding: 0;
            margin: 0;
        }

        .header li,.header a,.header button{
            font-family: "Fredoka One", cursive;
            font-weight: 500;
            font-size: 16px;
            color: #e9ebf5;
            text-decoration: none;
        }

        header{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 30px 10%;
            background-color: #1a1922;
        }

        .logo{
            cursor: pointer;
            margin-right: auto;
            width: 180px;
            height: 60px;
        }

        .nav__links{
            list-style: none;
        }

        .nav__links li{
            display: inline-block;
            padding: 10px;
            
        }

        .nav__links li a{
            transition: all 0.3s ease 0s;
        }

        .nav__links li a:hover{
            color: #30508b;
        }
        ::-webkit-scrollbar {
            width: 15px;
        }
        ::-webkit-scrollbar-thumb {
            background: #1a1922;
            border-radius: 0px;
        }
        ::-webkit-scrollbar-track {
            background: #90909a;
        }
        .header button{
            padding: 9px 25px;
            background-color: rgb(17, 49, 87, 1);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease 0s;
            outline: none;
        }

        .header button:hover{
            background-color: rgb(17, 49, 87, 0.6);
        }

        @media (max-width: 1020px) {
            header{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 30px;
            }
            header img{
                margin: 0 auto;
            }
        }

        @media (max-width: 770px) {
            .nav__links{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 20px;
            }
            header nav .nav__links li a{
                font-size: 14pt;
            }
        }
    </style>
</head>
<body>
    <?php
        if(isset($_SESSION['logged'])){
            ?>
            <header class="header">
                <img class="logo" src="../Materials/polo_logo_white@2x.png" alt="logo" onclick="goHomeLogged()">
                <nav>
                    <ul class="nav__links">
                        <li><a href="../Pages/home.php">Home</a></li>
                        <li><a href="../Pages/campeonatos.php">E-Sports</a></li>
                        <li><a href="../Pages/topicos.php">Tópicos</a></li>
                        <?php
                            if($_SESSION['adm']) {
                                echo "<li><a href='../Admin/'>Administração</a></li>";
                            }
                        ?>
                        <li><a href="../System/logout.php">Sair</a></li>
                    </ul>
                </nav>
                <a class="cta" href="../Pages/perfil.php"><button>Perfil</button></a>
            </header>
            <?php
        }else{
            ?>
            <header class="header">
                <img class="logo" src="../Materials/polo_logo_white@2x.png" alt="logo" onclick="goHome()">
                <nav>
                    <ul class="nav__links">
                        <li><a href="../index.php">Inicio</a></li>
                        <li><a href="../Pages/cadastrar.php">Cadastrar</a></li>
                    </ul>
                </nav>
                <a class="cta" href="../Pages/sobre_nos.php"><button>Sobre nós</button></a>
            </header>
            <?php
        }
    ?>
    
<script>
    function goHome(){
        window.location.href = "../index.php"
    }
    function goHomeLogged(){
        window.location.href = "../Pages/home.php"
    }
</script>
</body>
</html>
