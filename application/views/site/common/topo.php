<!DOCTYPE html>
<html>
<head>
	<title>Farol Espaço Terapeutico</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript">
		var RAIZ = "<?=RAIZ?>";
	</script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?=$loads?>
	<!-- <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script> --> <!-- Para produção -->
	<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->

</head>
<body>
	<header id="cabecalho">
		<div class="container big_header_container">
			<img id="logo_home" src="<?=RAIZ?>img/logo_antigo.png">
		</div>
	</header>
	<div id="med_header">
		<ul id="menu_topo">
			<li class="item_menu_topo"><a href="<?=RAIZ?>site">Home</a></li>
			<li class="item_menu_topo"><a class='dropdown-trigger m_dd_trigger' href='#' data-target='dropdown_sobrenos'>Sobre nós</a></li>
			<li class="item_menu_topo"><a href="javascript:void(0)">Técnicas Terapêuticas</a></li>
			<li class="item_menu_topo"><a class='dropdown-trigger m_dd_trigger' href='#' data-target='dropdown_atividades'>Atividades</a></li>
			<li class="item_menu_topo"><a href="<?=RAIZ?>site/agenda">Agende-se</a></li>
			<li class="item_menu_topo"><a href="<?=RAIZ?>site/espacoaluno">Espaço Aluno</a></li>
		</ul>
		<ul class='dropdown-content' id="dropdown_sobrenos">
			<li><a href="<?=RAIZ?>site/sobrenos/equipe">Equipe</a></li>
			<li><a href="<?=RAIZ?>site/sobrenos/missao">Missão</a></li>
			<li><a href="javascript:void(0)">Galeria de Imagens</a></li>
			<li><a href="javascript:void(0)">Depoimentos</a></li>
		</ul>
		<ul class='dropdown-content' id="dropdown_atividades">
			<li><a href="javascript:void(0)">Cursos</a></li>
			<li><a href="javascript:void(0)">Consultorias</a></li>
			<li><a href="javascript:void(0)">Oficinas/Workshops</a></li>
		</ul>
	</div>		
	<!-- <div class="row cabecalho">
		<div class="col s1">
		</div>
		<div class="col s1">
			<a href="#" data-target="slide-out" class="sidenav-trigger hide"><i class="icone_menu_cabecalho material-icons">menu</i></a>
		</div>
		<div class="col s10"></div>
	</div> -->