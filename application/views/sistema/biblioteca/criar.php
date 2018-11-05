<?php 
$userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">school</i>Arquivos - Novo</p><a href="<?=base_url('sistema/Biblioteca')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Arquivos</a>
<div class="form_messages hide">
	<?=$errors;?>
</div>
<form method="post" id="upload_material_form" action="<?=RAIZ.'sistema/biblioteca/upload/material'?>" enctype="multipart/form-data">
	<div class="row">
		<div class="form_group col s6">
			<label>Título</label>
			<div class="input-field">
				<input type="text" name="titulo" value="<?=isset($userdata['titulo']) ? $userdata['titulo'] : ''?>">
			</div>
		</div>
		<div class="form_group col s6">
			<label>Autor</label>
			<div class="input-field">
				<input type="text" name="autor" value="<?=isset($userdata['autor']) ? $userdata['autor'] : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="file-field input-field">
			<div class="btn">
				<span>Arquivo</span>
				<input type="file" name="material" class="input_material">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text" placeholder="Selecione o material para carregar">
			</div>
		</div>
	</div>
	<input type="hidden" class="cad_hidden" value="Cursos">
	<input type="submit" class="btn btn_salvar" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
</form>