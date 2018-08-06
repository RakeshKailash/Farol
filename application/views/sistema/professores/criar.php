<?php 
$userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">face</i>Novo professor</p>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/professores/inserir'?>"><a href="<?=base_url('sistema/Professores')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
	<div class="row">
		<div class="form_group col s6">
			<label>Nome</label>
			<div class="input-field">
				<input type="text" name="nome" value="<?=isset($userdata['nome']) ? $userdata['nome'] : ''?>">
			</div>
		</div>
		<div class="form_group col s6">
			<label>Sobrenome</label>
			<div class="input-field">
				<input type="text" name="sobrenome" value="<?=isset($userdata['sobrenome']) ? $userdata['sobrenome'] : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s6">
			<label>Atividade</label>
			<div class="input-field">
				<input type="text" name="atividade" value="<?=isset($userdata['atividade']) ? $userdata['atividade'] : ''?>">
			</div>
		</div>
		<div class="form_group col s6">
			<label>E-mail</label>
			<div class="input-field">
				<input type="text" name="email" value="<?=isset($userdata['email']) ? $userdata['email'] : ''?>">
			</div>
		</div>
	</div>
	<input type="hidden" class="cad_hidden" value="Professores">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
</form>