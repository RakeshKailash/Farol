<p class="page_title"><i class="material-icons">person</i>Usuários</p>
<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a><a href="<?=base_url('sistema/Usuarios/novo')?>" class="btn btn_table_action">Novo</a>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>CPF</th>
		<th>Nível</th>
		<th>Status</th>
	</thead>
	<tbody>
	<?php foreach ($usuarios as $usuario) : ?>
		<tr class="linha_cadastro_visualizar">
			<input type="hidden" class="id_hidden" name="idusuarios" value="<?=$usuario->idusuario?>">
			<td><?=$usuario->idusuario?></td>
			<td><?=$usuario->nome?></td>
			<td><?=$usuario->email?></td>
			<td><?=$usuario->cpf?></td>
			<td><?=$this->parserlib->usrAccessParse($usuario->acesso);?></td>
			<td><?=!!$usuario->status ? "Ativo" : "Inativo" ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Usuarios">
</table>