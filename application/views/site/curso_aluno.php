<div class="row row_espaco_aluno">
	<h3>Meus cursos <i style="vertical-align: middle;" class="material-icons">chevron_right</i> <?=$curso->nome_curso?></h3>
	<ul id="tabs-swipe-demo" class="tabs tabs_curso">
		<li class="tab col s3"><a class="active" href="#tab_avisos"><i class="material-icons">notifications</i>Avisos</a></li>
		<li class="tab col s3"><a href="#tab_material"><i class="material-icons">description</i>Material de apoio</a></li>
		<li class="tab col s3"><a href="#tab_certificados"><i class="material-icons">verified_user</i>Certificados</a></li>
		<li class="tab col s3"><a href="#tab_financeiro"><i class="material-icons">attach_money</i>Financeiro</a></li>
	</ul>
	<div id="tab_avisos" class="col s12">
		<div class="aviso_aluno">Exemplo de aviso</div>
		<div class="aviso_aluno">Outro exemplo</div>
		<div class="aviso_aluno">Mais um aviso</div>
	</div>
	<div id="tab_material" class="col s12">
		<div class="material_aluno" data-position="bottom" data-tooltip="50 Ideias de Física Quântica">
			<img src="<?=RAIZ?>img/icone_material.svg" class="icone_material">
			<p class="titulo_material">50 Ideias de...</p>
		</div>
		<div class="material_aluno" data-position="bottom" data-tooltip="O Corpo Fala">
			<img src="<?=RAIZ?>img/icone_material.svg" class="icone_material">
			<p class="titulo_material">O Corpo Fala</p>
		</div>
		<div class="material_aluno" data-position="bottom" data-tooltip="Diga-me onde dói e eu te direi por quê">
			<img src="<?=RAIZ?>img/icone_material.svg" class="icone_material">
			<p class="titulo_material">Diga-me onde...</p>
		</div>
		<div class="material_aluno" data-position="bottom" data-tooltip="Linguagem do corpo - vol 1">
			<img src="<?=RAIZ?>img/icone_material.svg" class="icone_material">
			<p class="titulo_material">Linguagem do...</p>
		</div>
		<div class="material_aluno" data-position="bottom" data-tooltip="Metafísica da saúde">
			<img src="<?=RAIZ?>img/icone_material.svg" class="icone_material">
			<p class="titulo_material">Metafísica da s...</p>
		</div>
	</div>
	<div id="tab_certificados" class="col s12">Certificados</div>
	<div id="tab_financeiro" class="col s12">
		<?php if ($financeiro->forma->forma == 1 || $financeiro->forma->forma == 4): ?>
			<h5>Investimento</h5>
				<p class="<?=$financeiro->status == 1? 'inv_pago' : 'inv_devedor'?>">R$<?=$financeiro->forma->total?></p>
		<?php endif ?>
		<?php if ($financeiro->forma->forma == 2): ?>
			<h5>Parcelas do Investimento</h5>
			<?php foreach ($financeiro->forma->parcelas as $parcela): ?>
				<p class="<?=$parcela->status == 1? 'inv_pago' : 'inv_devedor'?>">
					R$<?=$parcela->valor?>
					<?php if ($parcela->vencimento != null): ?>
						<span><?=$parcela->vencimento?></span>
					<?php endif ?>
				</p>
			<?php endforeach ?>
		<?php endif ?>
		<?php if ($financeiro->forma->forma == 3): ?>
			<h5>Mensalidades do Investimento</h5>
			<?php foreach ($financeiro->forma->parcelas as $mensalidade): ?>
				<p class="<?=$mensalidade->status == 1? 'inv_pago' : 'inv_devedor'?>">
					R$<?=$mensalidade->valor?>
					<?php if ($mensalidade->vencimento != null): ?>
						<span><?=$mensalidade->vencimento?></span>
					<?php endif ?>
				</p>
			<?php endforeach ?>
		<?php endif ?>
	</div>
</div>