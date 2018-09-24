<p class="page_title"><i class="material-icons">face</i>Professores</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a><a href="<?=base_url('sistema/Professores/novo')?>" class="btn btn_table_action">Novo</a>
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
				<span>Nome</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>E-mail</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>WhatsApp</span>
			</label></p>
		</li>
		<li>
			<p><label>
				<span>Telefone</span>
			</label></p>
		</li>
	</ul>
</div>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>WhatsApp</th>
		<th>Telefone</th>
	</thead>
	<tbody>
	<?php foreach ($professores as $professor) : ?>
		<tr class="linha_cadastro_visualizar">
			<input type="hidden" class="id_hidden" name="idprofessores" value="<?=$professor->idprofessor?>">
			<td><?=$professor->idprofessor?></td>
			<td><?=$professor->nome?></td>
			<td><?=$professor->email?></td>
			<td class="phone_mask"><?=$professor->whatsapp?></td>
			<td class="phone_mask"><?=$professor->fone_1?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Professores">
</table>