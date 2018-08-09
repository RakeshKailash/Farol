<p class="page_title"><i class="material-icons">calendar_today</i>Aulas</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a><a href="<?=base_url('sistema/Aulas/novo')?>" class="btn btn_table_action">Nova</a>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Turma</th>
		<th>Descrição</th>
		<th>Professor</th>
		<th>Data</th>
		<th>Status</th>
	</thead>
	<tbody>
		<?php foreach ($aulas as $aula) : ?>
			<tr class="linha_cadastro_visualizar">
				<input type="hidden" class="id_hidden" name="idaula" value="<?=$aula->idaula?>">
				<td><?=$aula->idaula?></td>
				<td><?=$aula->nome_turma?></td>
				<td><?=$aula->descricao?></td>
				<td><?=$aula->nome_professor." ".$aula->sobrenome_professor?></td>
				<td>
					<?php if (isset($aula->dias)): ?>
						<?php foreach ($aula->dias as $dia): ?>
							<p><?=$this->parserlib->formatDaterange($dia->inicio, $dia->fim);?> <?=!empty($dia->obs) ? "<p>(".$dia->obs.")</p>" : ""?></p>
						<?php endforeach ?>
					<?php endif ?>
				</td>
				<td><?=$this->parserlib->aulaStatusParse($aula->status);?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Aulas">
</table>