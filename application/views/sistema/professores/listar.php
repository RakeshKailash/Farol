<p class="page_title"><i class="material-icons">face</i>Professores</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a><a href="<?=base_url('sistema/Professores/novo')?>" class="btn btn_table_action">Novo</a>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Nome</th>
		<th>Atividade</th>
		<th>E-mail</th>
	</thead>
	<tbody>
	<?php foreach ($professores as $professor) : ?>
		<tr class="linha_cadastro_visualizar">
			<input type="hidden" class="id_hidden" name="idprofessores" value="<?=$professor->idprofessor?>">
			<td><?=$professor->idprofessor?></td>
			<td><?=$professor->nome." ".$professor->sobrenome?></td>
			<td><?=$professor->atividade?></td>
			<td><?=$professor->email?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Professores">
</table>