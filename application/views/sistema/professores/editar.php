<?php 
	// $userdata = $this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">face</i>Editar professor</p><a href="<?=base_url('sistema/Professores')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/professores/atualizar'?>">
	<div class="row">
		<div class="form_group col s6">
			<label>Nome</label>
			<div class="input-field">
				<input type="text" name="nome" value="<?=$userdata->nome?>">
			</div>
		</div>
		<div class="form_group col s6">
			<label>Sobrenome</label>
			<div class="input-field">
				<input type="text" name="sobrenome" value="<?=$userdata->sobrenome?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s6">
			<label>Atividade</label>
			<div class="input-field">
				<input type="text" name="atividade" value="<?=$userdata->atividade?>">
			</div>
		</div>
		<div class="form_group col s6">
			<label>E-mail</label>
			<div class="input-field">
				<input type="text" name="email" value="<?=$userdata->email?>">
			</div>
		</div>
	</div>
	<input type="hidden" class="id_form" name="idref" value="<?=$userdata->idprofessor?>">
	<input type="hidden" class="cad_hidden" value="Professores">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
	<input type="button" class="btn" id="btn_excluir_cadastro" value="Excluir professor">
</form>