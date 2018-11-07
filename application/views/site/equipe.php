<div class="container main_site_container">
	<nav id="caminhodepao">
		<div class="nav-wrapper">
			<div class="col s12">
				<a href="<?=RAIZ?>site" class="breadcrumb">Home</a>
				<a href="javascript:void(0)" class="breadcrumb">Sobre nós</a>
				<a href="#!" class="breadcrumb">Equipe</a>
			</div>
		</div>
	</nav>
	<div class="row">
		<?php foreach ($equipe as $professor): ?>
			<div class="professor_equipe_site col s4 center">
				<p><?=$professor->nome?></p>
				<div class="container_img_professor_site">
					<img src="<?=RAIZ.$professor->imagem_professor?>">
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>