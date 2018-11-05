<?php 
// $userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">school</i>Arquivos - Editar</p><a href="<?=base_url('sistema/Biblioteca')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Arquivos</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/biblioteca/atualizar'?>">
	<div class="row">
		<div class="form_group col s5">
			<label>Título</label>
			<div class="input-field">
				<input type="text" name="titulo" value="<?=$userdata->titulo?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Autor</label>
			<div class="input-field">
				<input type="text" name="autor" value="<?=$userdata->autor?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>Usuário</label>
			<div class="input-field">
				<p class="display_text"><?=explode(' ', $userdata->nome_usuario)[0]?></p>
			</div>
		</div>
	</div>
	<div class="row no-margin">
		<div class="form_group col s6">
			<label>Arquivo</label>
			<div class="input-field">
				<p class="display_text"><a target="_blank" href="<?=RAIZ.$userdata->caminho_arquivo?>"><?=$userdata->caminho_arquivo?></a></p>
			</div>
		</div>
		<div class="form_group col s2">
			<label>Tamanho</label>
			<div class="input-field">
				<p class="display_text"><?=$userdata->tamanho.'Kb'?></p>
			</div>
		</div>
		<div class="form_group col s4">
			<label>Data</label>
			<div class="input-field">
				<p class="display_text"><?=$this->parserlib->formatDatetime($userdata->data_upload)?></p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s3">
			<a href="<?=RAIZ.'sistema/Biblioteca/download/'.$userdata->idupload;?>" class="btn btn_table_action">Baixar</a>
		</div>
	</div>
	<input type="hidden" class="id_form" name="idref" value="<?=$userdata->idupload?>">
	<input type="hidden" class="cad_hidden" value="Cursos">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
</form>