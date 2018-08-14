<p class="page_title"><i class="material-icons">school</i>Cursos</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a><a href="<?=base_url('sistema/Cursos/novo')?>" class="btn btn_table_action">Novo</a>
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