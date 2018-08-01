<a href="<?=base_url('usuarios/novo')?>" class="btn">Novo</a>
<table id="alunos_visualizar_table">
	<thead>
		<th>ID</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Função</th>
		<th>Telefone</th>
		<th>Status</th>
	</thead>
	<tbody>
	<?php foreach ($usuarios as $usuario) : ?>
		<tr class="linha_cadastro_visualizar">
			<input type="hidden" class="id_hidden" name="idusuarios" value="<?=$usuario->idusuario?>">
			<td><?=$usuario->idusuario?></td>
			<td><?=$usuario->nome." ".$usuario->sobrenome?></td>
			<td><?=$usuario->email?></td>
			<td><?=$this->parserlib->usrAccessParse($usuario->acesso);?></td>
			<td><?=$usuario->fone_1?></td>
			<td><?=!!$usuario->status ? "Ativo" : "Inativo" ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<input type="hidden" class="cad_hidden" value="Usuarios">
</table>