<?php 
	// $userdata = $this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">school</i>Editar curso</p><a href="<?=base_url('sistema/Cursos')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
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
	<input type="hidden" class="id_form" name="idref" value="<?=$userdata->idcurso?>">
	<input type="hidden" class="cad_hidden" value="Cursos">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
	<input type="button" class="btn" id="btn_excluir_cadastro" value="Excluir curso">
</form>