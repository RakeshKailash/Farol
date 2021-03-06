<p class="page_title"><i class="material-icons">school</i>Turmas</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Painel</a><a href="<?=base_url('sistema/Turmas/novo')?>" class="btn btn_table_action">Nova</a>
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
				<span>Turma</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Curso</span>
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
		<th>Turma</th>
		<th>Curso</th>
		<th>Status</th>
	</thead>
	<tbody>
	<?php foreach ($turmas as $turma) : ?>
		<?php if (!$turma->status_reg)continue; ?>
		<tr class="linha_cadastro_visualizar">
			<input type="hidden" class="id_hidden" name="idturmas" value="<?=$turma->idturma?>">
			<td><?=$turma->idturma?></td>
			<td><?=$turma->identificacao?></td>
			<td><a href="<?=base_url('sistema/Cursos/'.$turma->idcurso)?>"><?=$turma->curso?></a></td>
			<td><?=$turma->status == 1 ? "A iniciar" : ($turma->status == 2 ? "Em andamento" : ($turma->status == 3 ? "Encerrada" : "")) ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Turmas">
</table>