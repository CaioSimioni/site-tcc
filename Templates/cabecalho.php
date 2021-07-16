<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="../Css/style_cabecalho.css">
</head>
<body>
    <header class="header">
        <img class="logo" src="../Materials/polo_logo_white@2x.png" alt="logo">
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

</body>
</html>
