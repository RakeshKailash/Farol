<?php 
$curyear = isset($_GET['curyear']) ? $_GET['curyear'] : date('Y');
?>

<p class="page_title"><i class="material-icons">today</i>Agenda</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
<?php foreach ($agenda as $num => $ano): ?>
	<a href="<?=base_url('sistema/Agenda?curyear='.$num)?>" class="btn btn_table_action btn_year <?=$num == $curyear ? 'curyear' : ''?>"><?=$num?></a>
<?php endforeach ?>
<div class="row">
	<table id="alunos_visualizar_table" class="has_sub_head">
		<thead>
			<th class="col s3">Data</th>
			<th class="col s4">Evento</th>
			<th class="col s3">Facilitador</th>
			<th class="col s2">Inscrições até</th>
		</thead>
		<?php foreach ($agenda as $num => $ano): ?>
			<tbody class="ano_tbody <?=$num != $curyear ? 'hide' : '' ?>">
				<tr class="linha_espaco"><td colspan="4"></td></tr>
				<?php foreach ($ano as $key => $meses) : ?>
					<tr class="linha_mes_agenda"><td colspan="4"><?=$this->parserlib->getMonthFromNum($key)?></td></tr>
					<?php foreach ($meses as $evento) : ?>
						<tr class="linha_agenda_expandir">
							<input type="hidden" class="id_hidden" name="idevento" value="<?=$evento->idevento?>">
							<td class="col s3">
								<?php if (isset($evento->dias)): ?>
									<?php foreach ($evento->dias as $dia): ?>
										<p><?=$this->parserlib->formatDaterange($dia->inicio, $dia->fim);?></p>
									<?php endforeach ?>
								<?php endif ?>
							</td>
							<td class="col s4"><?=$evento->nome?></td>
							<td class="col s3"><a href="<?=base_url('sistema/Professores/'.$evento->idprofessor)?>"><?=$evento->nome_professor?></a></td>
							<td class="col s2"><?=$evento->prazo_inscricao?></td>
						</tr>
					<?php endforeach ?>
					<tr class="linha_espaco"><td colspan="4"></td></tr>
				<?php endforeach ?>
			</tbody>
		<?php endforeach ?>
	</table>
</div>