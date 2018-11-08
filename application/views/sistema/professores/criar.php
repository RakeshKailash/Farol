<?php 
$userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">face</i>Professores - Novo</p>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/Professores/inserir'?>" enctype="multipart/form-data"><a href="<?=base_url('sistema/Professores')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Professores</a>
	<div class="row">
		<div class="form_group col s4">
			<label>Nome</label>
			<div class="input-field">
				<input type="text" name="nome" value="<?=isset($userdata['nome']) ? $userdata['nome'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>E-mail</label>
			<div class="input-field">
				<input type="text" name="email" value="<?=isset($userdata['email']) ? $userdata['email'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Formação</label>
			<div class="input-field">
				<input type="text" name="formacao" value="<?=isset($userdata['formacao']) ? $userdata['formacao'] : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s3">
			<label>WhatsApp</label>
			<div class="input-field">
				<input type="text" name="whatsapp" class="phone_mask" placeholder="(00)0000-00000" value="<?=isset($userdata['whatsapp']) ? $userdata['whatsapp'] : ''?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>Telefone 1</label>
			<div class="input-field">
				<input type="text" name="fone_1" class="phone_mask" placeholder="(00)0000-00000" value="<?=isset($userdata['fone_1']) ? $userdata['fone_1'] : ''?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>Telefone 2</label>
			<div class="input-field">
				<input type="text" name="fone_2" class="phone_mask" placeholder="(00)0000-00000" value="<?=isset($userdata['fone_2']) ? $userdata['fone_2'] : ''?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>Telefone 3</label>
			<div class="input-field">
				<input type="text" name="fone_3" class="phone_mask" placeholder="(00)0000-00000" value="<?=isset($userdata['fone_3']) ? $userdata['fone_3'] : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s3">
			<div class="switch">
				<label>
					Equipe?
					<input type="checkbox" name="equipe" value="1">
					<span class="lever"></span>
				</label>
			</div>
		</div>
		<div class="form_group col s9">
			<div class="file-field input-field">
				<div class="btn">
					<span>Imagem</span>
					<input type="file" name="imagem_professor">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" class="cad_hidden" value="Professores">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
</form>