<div class="row row_espaco_aluno">
	<h3>Meus cursos</h3>
	<?php if (isset($cursos) && count($cursos)): ?>
		<div class="legenda">
			<p><i class="material-icons green-text">done_all</i> Inscrição confirmada</p>
			<p><i class="material-icons orange-text">schedule</i> Inscrição aguardando confirmação</p>
		</div>
		<?php foreach ($cursos as $curso) : ?>
			<div class="card" data-curso="<?=$curso['curso']->idcurso?>">
				<div class="cover"></div>
				<div class="status_circle" data-status="<?=$curso['inscricao']->status?>"></div>
				<div class="content"><p><?=$curso['curso']->nome?></p></div>
			</div>
		<?php endforeach ?>
	<?php else: ?>
		<h6>Você ainda não está inscrito em nenhum curso <i style="vertical-align: middle;" class="material-icons">sentiment_very_dissatisfied</i></h6>
		<h6>Aproveite e comece agora!</h6> <br>
		<a class="btn" href="<?=RAIZ?>site/agenda" target="_blank">Agenda de Cursos</a>
	<?php endif ?>
</div>