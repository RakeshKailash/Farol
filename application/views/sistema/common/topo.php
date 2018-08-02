<!DOCTYPE html>
<html>
<head>
	<title>[Sistema] Farol Espaço Terapêutico</title>
	<script type="text/javascript">
		var RAIZ = "<?=RAIZ?>";
	</script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?=$loads?>
	<script type="text/javascript" src="<?=RAIZ.'js/custom.js'?>"></script>
</head>
<body>
	<div class="row cabecalho">
		<div class="col s1">
			<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="icone_menu_cabecalho material-icons">menu</i></a>
			<!-- <i class="icone_menu_cabecalho material-icons">menu</i> -->
		</div>
		<div class="col s1">
			<img id="logo_cabecalho" src="<?=RAIZ.'img/logo.png'?>">
		</div>
		<div class="col s10"></div>
	</div>

	<ul id="slide-out" class="sidenav menu_lateral_sistema">
		<li>
			<div class="user-view">
				<div class="background">
					<img src="<?=RAIZ.'img/bgmenu.jpg'?>">
				</div>
				<a href="#user"><img class="circle" src="images/yuna.jpg"></a>
				<a href="#name"><span class="white-text name">Marcelo Silveira</span></a>
				<a href="#email"><span class="white-text email">marcelo.boemeke@gmail.com</span></a>
			</div>
		<li>
			<a href="<?=base_url('sistema/Painel')?>"><i class="material-icons">home</i>Início</a>
		</li>
		<li>
			<a href="<?=base_url('sistema/Usuarios')?>"><i class="material-icons">person</i>Usuários</a>
		</li>
		<li>
			<a href="<?=base_url('sistema/Cursos')?>"><i class="material-icons">school</i>Cursos</a>
		</li>
		<li>
			<a href="<?=base_url('sistema/Financeiro')?>"><i class="material-icons">attach_money</i>Financeiro</a>
		</li>
		<li>
			<a href="<?=base_url('sistema/Ecommerce')?>"><i class="material-icons">store</i>E-commerce</a>
		</li>
		<li><div class="divider"></div></li>
		<li>
			<a href="#!"><i class="material-icons">account_circle</i>Minha Conta</a>
		</li>
		<li>
			<a href="#!"><i class="material-icons">power_settings_new</i>Sair</a>
		</li>
		<li>
			<a class="waves-effect" href="#!">Third Link With Waves</a>
		</li>
	</ul>
	<div class="container main_system_container">