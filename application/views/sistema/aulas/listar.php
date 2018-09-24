<p class="page_title"><i class="material-icons">calendar_today</i>Aulas</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a><a href="<?=base_url('sistema/Aulas/novo')?>" class="btn btn_table_action">Nova</a>
<div class="col s6 right col_busca_topo">
	<label class="buscar_label">Busca</label>
	<a class='dropdown-trigger btn dd_trigger_busca' href='#' data-target='dropdown_busca'>Onde?</a>
	<input type="text" name="buscar" class="search_input browser-default">
	<a href="javascript:void(0)" class="btn btn_table_action search_btn"><i class="material-icons">search</i></a>
	<ul id='dropdown_busca' class='dropdown-content'>
		<li>
			<p><label>
				<span>ID</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Data</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Turma</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Título</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Professor</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Status</span>
			</label></p>
		</li>
	</ul>
</div>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Data</th>
		<th>Turma</th>
		<th>Título</th>
		<th>Professor</th>
		<th>Status</th>
	</thead>
	<tbody>
		<?php foreach ($aulas as $aula) : ?>
			<tr class="linha_cadastro_visualizar">
				<input type="hidden" class="id_hidden" name="idevento" value="<?=$aula->idevento?>">
				<td><?=$aula->idevento?></td>
				<td>
					<?php if (isset($aula->dias)): ?>
						<?php foreach ($aula->dias as $dia): ?>
							<p><?=$this->parserlib->formatDaterange($dia->inicio, $dia->fim);?> <?=!empty($dia->obs) ? "<p>(".$dia->obs.")</p>" : ""?></p>
						<?php endforeach ?>
					<?php endif ?>
				</td>
				<td><a href="<?=base_url('sistema/Turmas/'.$aula->idturma)?>"><?=$aula->nome_turma?></a></td>
				<td><?=$aula->nome?></td>
				<td><?=$aula->nome_professor?></td>
				<td><?=$this->parserlib->aulaStatusParse($aula->status);?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Aulas">
</table>