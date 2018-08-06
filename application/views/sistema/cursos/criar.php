<?php 
$userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">school</i>Novo curso</p><a href="<?=base_url('sistema/Cursos')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/cursos/inserir'?>">
	<div class="row">
		<div class="form_group col s12">
			<label>Nome</label>
			<div class="input-field">
				<input type="text" name="nome" value="<?=isset($userdata['nome']) ? $userdata['nome'] : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s12">
			<label>Descrição</label>
			<div class="input-field">
				<textarea class="materialize-textarea" name="descricao"><?=isset($userdata['descricao']) ? $userdata['descricao'] : ''?></textarea>
			</div>
		</div>
	</div>
	<input type="hidden" class="cad_hidden" value="Cursos">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
</form>