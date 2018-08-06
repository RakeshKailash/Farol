<a href="<?=base_url('alunos/novo')?>" class="btn">Novo</a>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>CPF</th>
		<th>RG</th>
		<th>Status</th>
	</thead>
	<tbody>
	<?php foreach ($alunos as $aluno) : ?>
		<tr class="linha_cadastro_visualizar">
			<input type="hidden" class="id_hidden" name="idaluno" value="<?=$aluno->idaluno?>">
			<td><?=$aluno->idaluno?></td>
			<td><?=$aluno->nome." ".$aluno->sobrenome?></td>
			<td><?=$aluno->email?></td>
			<td><?=$aluno->cpf?></td>
			<td><?=$aluno->rg?></td>
			<td><?=!!$aluno->status ? "Ativo" : "Inativo" ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Alunos">
</table>