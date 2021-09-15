<?php
require "../System/classes.php";
$user = new Usuario;
$banco = new BancoBD;
$esports = new Esports;

$banco->conectar();

if(!$banco->conectar()){
	echo "<script> alert('[Erro] Falha na conexão com o banco de dados.') </script>";
	echo "<script> window.location.href('../Pages/home.php') </script>";
	exit;
}

if(!isset($_SESSION['logged']) or !isset($_SESSION['codigo_usuario'])){
    echo "<script> alert('Falha na autenticação de usuário!')</script>";    
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polo - Campenatos</title>
    <link rel="shortcut icon" href="../Materials/polo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/style_campeonatos.css">
</head>
<body>
    <?php
        include "../Templates/cabecalho.php";
    ?>

    <div class="global">
		<?php

			if($banco->conectar()){

				$campeonatos = $esports->pegarTodosCampeonatos();
				$categorias_camp = $esports->getCategorias();

				if($campeonatos){

					foreach($campeonatos as $chave => $camps){
						/**
						 * 	$campeonatos é a variável que veio do banco de dados.
						 * 	$chave é a das categoria, ou seja, apex, lol, valorant, cs ...
						 * 	$
						 */
						if(empty($camps)){
							?>
								<h1>Campeonatos - <?php echo $chave?></h1>
								<section class="section-camps" style="color: #fff;">
									<p style="text-align: center;">Não há campeonatos de <?echo $chave?> no sistema.</p>
								</section>
							<?php
						}else{
							?>
							<!-- HMTL -->
							<h1>Campeonatos - <?php echo $chave?></h1>
							<section class="section-camps" style="color: #fff;">
								<?php
									foreach($camps as $camp){
										?>
											<div class="camp">
												<h2><?php echo ucfirst($camp['nome_camp'])?></h2>
												<div class="stats">
													<p class="status"><?php
														if(!$camp['status_camp']) {
															echo "<p style='color: #0004f9;'>Acontecerá⠀</p>";
														}
														else {
															echo "<p style='color: #ff2020;'>Encerrado⠀</p>";
														}
													?></p>
													<p id="data"><?php echo '|⠀'.date("d/m/y - h:i", strtotime($camp['data_camp']))?></p>
												</div>
												<img src="<?php echo$esports->nomeFotoPadraoCampHome($camp['categoria_camp'])?>" alt="">
												<div class="div-btn">
													<a href="">Ver Mais</a>
												</div>
											</div>
										<?php
									}
								?>
							
							</section>
							<!-- Fim HMTL -->
							<?php
						}
					}

				}else{
					echo "[Erro] Nenhum campeonato encontrado.";
					echo "<script> window.location.href('../Pages/home.php') </script>";
					exit;
				}

			}else{
				echo "<script> alert('[Erro] Falha na conexão com o banco de dados.') </script>";
				echo "<script> window.location.href('../Pages/home.php') </script>";
				exit;
			}
		?>

    </div>

    <?php
        include "../Templates/rodape.php";
    ?>
</body>
</html>