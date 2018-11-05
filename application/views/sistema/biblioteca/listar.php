<p class="page_title"><i class="material-icons">add</i><i class="material-icons">book</i>Arquivos</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Painel</a><a href="<?=base_url('sistema/Biblioteca/novo')?>" class="btn btn_table_action">Novo</a>
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
				<span>Título</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Autor</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Usuário</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Data</span>
			</label></p>
		</li>
	</ul>
</div>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Título</th>
		<th>Autor</th>
		<th>Usuário</th>
		<th>Data</th>
	</thead>
	<tbody>
	<?php foreach ($materiais as $material) : ?>
		<tr class="linha_cadastro_visualizar">
			<input type="hidden" class="id_hidden" name="idupload" value="<?=$material->idupload?>">
			<td><?=$material->idupload?></td>
			<td><?=$material->titulo?></td>
			<td><?=$material->autor?></td>
			<td><a href="<?=base_url('sistema/Usuarios/'.$material->idusuario)?>"><?=explode(" ", $material->nome_usuario)[0]?></a></td>
			<td><?=$this->parserlib->formatDatetime($material->data_upload)?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Biblioteca">
</table>