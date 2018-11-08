<?php 
	// $userdata = $this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">school</i>Cursos - Editar</p><a href="<?=base_url('sistema/Cursos')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Cursos</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/cursos/atualizar'?>">
	<div class="row">
		<div class="form_group col s12">
			<label>Nome</label>
			<div class="input-field">
				<input type="text" name="nome" value="<?=isset($userdata->nome) ? $userdata->nome : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s12">
			<label>Descrição</label>
			<div class="input-field">
				<textarea class="materialize-textarea" name="descricao"><?=isset($userdata->descricao) ? $userdata->descricao : ''?></textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<a href="<?=base_url('sistema/Turmas/novo?preid='.$userdata->idcurso)?>" class="btn btn_table_action btn_nova_turma"><i class="material-icons">add</i>Nova turma</a>
	</div>
	<table id="alunos_visualizar_table">
		<thead>
			<th>ID</th>
			<th>Turma</th>
			<th>Status</th>
		</thead>
		<tbody>
			<?php foreach ($userdata->turmas as $turma) : ?>
				<?php if (!$turma->status_reg)continue; ?>
				<tr class="linha_cadastro_visualizar">
					<input type="hidden" class="id_hidden" name="idturmas" value="<?=$turma->idturma?>">
					<td><?=$turma->idturma?></td>
					<td><?=$turma->identificacao?></td>
					<td><?=$turma->status == 1 ? "A iniciar" : ($turma->status == 2 ? "Em andamento" : ($turma->status == 3 ? "Encerrada" : "")) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
		<input type="hidden" class="cad_hidden" value="Turmas">
	</table>
	<input type="hidden" class="id_form" name="idref" value="<?=$userdata->idcurso?>">
	<input type="hidden" class="cad_hidden" value="Cursos">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
	<input type="button" class="btn" id="btn_excluir_cadastro" value="Excluir curso">
</form>