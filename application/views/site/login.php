<?php 
	// $userdata = $this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<div class="container login_site_container">
	<a href="<?=RAIZ?>site" class="link_voltar_site"><i class="material-icons">arrow_back</i>Voltar ao site</a>
	<div class="row">
		<div class="col s6">
			<div class="col s6 centered_container">
				<div class="col s12 img_bg_container" style="background-image: url(<?=RAIZ?>img/logo_antigo.png); height: 100px;"></div>
				<div class="info_login">
					<p><i class="material-icons">school</i>Espaço Aluno</p>
				</div>
			</div>
		</div>
		<div class="vertical_divider"></div>
		<div class="col s6" style="position: relative; height: 100%;">
			<div class="col s6 container_login centered_container">
				<p class="page_title"><i class="material-icons">account_circle</i>Login</p>
				<?php if ($errors): ?>
					<div class="form_messages">
						<?=$errors;?>
					</div>
				<?php endif ?>
				<form method="post" action="<?=RAIZ.'site/espacoaluno/logar'?>">
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
					<div class="row row_botoes_login">
						<div class="col s12">
							<input type="submit" class="btn btn_login_site" value="Entrar">
							<input type="reset" class="btn btn_login_site" value="Limpar">
						</div>
					</div>
					<div class="row link_recupera_senha">
						<div class="col s12">
							<a href="javascript:void(0)">esqueceu sua senha?</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>