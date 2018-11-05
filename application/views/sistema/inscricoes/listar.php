<p class="page_title"><i class="material-icons">assignment_ind</i>Inscrições</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Painel</a><a href="<?=base_url('sistema/Inscricoes/novo')?>" class="btn btn_table_action">Novo</a>
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
				<span>Turma</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Aluno</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Data da Inscrição</span>
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
		<th>Curso</th>
		<th>Turma</th>
		<th>Aluno</th>
		<th>Data da Inscrição</th>
		<th>Status</th>
	</thead>
	<tbody>
	<?php foreach ($inscricoes as $inscricao) : ?>
		<tr class="linha_cadastro_visualizar">
			<input type="hidden" class="id_hidden" name="idinscricao" value="<?=$inscricao->idinscricao?>">
			<td><?=$inscricao->idinscricao?></td>
			<td><?=$inscricao->nome_curso?></td>
			<td><?=$inscricao->nome_turma?></td>
			<td><?=$inscricao->nome_usuario?></td>
			<td><?=$this->parserlib->formatDatetime($inscricao->data_ingresso)?></td>
			<td><?=$this->parserlib->inscStatusParse($inscricao->status)?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Inscricoes">
</table>