<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="../Css/style_cabecalho.css">
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
                        <li><a href="#">Tópicos</a></li>
                        <?php
                            if($_SESSION['adm']) {
                                echo "<li><a href='../Admin/admin.php'>Administração</a></li>";
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
