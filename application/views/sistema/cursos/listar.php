<p class="page_title"><i class="material-icons">school</i>Cursos</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Painel</a><a href="<?=base_url('sistema/Cursos/novo')?>" class="btn btn_table_action">Novo</a>
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
				<span>Curso</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Descrição</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Turma mais recente</span>
			</label></p>
		</li>
	</ul>
</div>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Curso</th>
		<th>Descrição</th>
		<th>Turma mais recente</th>
	</thead>
	<tbody>
		<?php foreach ($cursos as $curso) : ?>
			<tr class="linha_cadastro_visualizar">
				<input type="hidden" class="id_hidden" name="idcursos" value="<?=$curso->idcurso?>">
				<td><?=$curso->idcurso?></td>
				<td><?=$curso->nome?></td>
				<td><?=substr($curso->descricao, 0, 50)?></td>
				<td><a href="<?=base_url('sistema/Turmas/'.$curso->idturma)?>"><?=$curso->turma_recente?></a></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Cursos">
</table>