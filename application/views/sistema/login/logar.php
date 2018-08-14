<?php 
	// $userdata = $this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>
<div class="col s3 container_login">
	<p class="page_title"><i class="material-icons">account_circle</i>Login</p>
	<?php if ($errors): ?>
		<div class="form_messages">
			<?=$errors;?>
		</div>
	<?php endif ?>
	<form method="post" action="<?=RAIZ.'sistema/login/login'?>">
		<div class="row">
			<div class="form_group col s12">
				<label>CPF ou E-mail</label>
				<div class="input-field">
					<input type="text" name="login">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form_group col s12">
				<label>Senha</label>
				<div class="input-field">
					<input type="password" name="senha">
				</div>
			</div>
		</div>
		<div class="row">
			<input type="submit" class="btn" value="Entrar">
			<input type="reset" class="btn" value="Limpar">
		</div>
	</form>
</div>