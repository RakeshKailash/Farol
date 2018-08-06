<p class="page_title"><i class="material-icons">add</i><i class="material-icons">school</i>Turmas</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a><a href="<?=base_url('sistema/Turmas/novo')?>" class="btn btn_table_action">Nova</a>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Turma</th>
		<th>Curso</th>
		<th>Status</th>
	</thead>
	<tbody>
	<?php foreach ($turmas as $turma) : ?>
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