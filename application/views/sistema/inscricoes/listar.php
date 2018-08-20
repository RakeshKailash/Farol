<p class="page_title"><i class="material-icons">assignment_ind</i>Inscrições</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a><a href="<?=base_url('sistema/Inscricoes/novo')?>" class="btn btn_table_action">Novo</a>
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