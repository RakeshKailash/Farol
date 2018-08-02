<?php 
	$userdata = isset($this->session->formdata) ? $this->session->formdata : array();
	$errors = isset($this->session->errors) ? $this->session->errors : null;
 ?>

<p class="page_title"><i class="material-icons">person_add</i>Novo usuário</p>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/usuarios/inserir'?>">
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
		<div class="form_group col s4">
			<label>E-mail</label>
			<div class="input-field">
				<input type="text" name="email" value="<?=isset($userdata['email']) ? $userdata['email'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Senha</label>
			<div class="input-field">
				<input type="password" name="senha">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Repita a senha</label>
			<div class="input-field">
				<input type="password" name="confirma_senha">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s6">
			<label>Data de Nascimento</label>
			<div class="input-field">
				<input type="text" placeholder="00/00/0000" class="date_mask" name="data_nascimento" value="<?=isset($userdata['data_nascimento']) ? $userdata['data_nascimento'] : ''?>">
			</div>
		</div>
		<div class="form_group col s6">
			<label>Função</label>
			<div class="input-field">
				<select name="acesso">
					<option <?=isset($userdata['acesso']) && $userdata['acesso'] == 1 ? "selected" : ''?> value="1">Usuário</option>
					<option <?=isset($userdata['acesso']) && $userdata['acesso'] == 2 ? "selected" : ''?> value="2">Administrador</option>
					<option <?=isset($userdata['acesso']) && $userdata['acesso'] == 3 ? "selected" : ''?> value="3">Desenvolvedor</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s3">
			<label>Telefone 1</label>
			<div class="input-field">
				<input type="text" placeholder="(00)0000-00000" class="phone_mask" name="fone_1" value="<?=isset($userdata['fone_1']) ? $userdata['fone_1'] : ''?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>Telefone 2</label>
			<div class="input-field">
				<input type="text" placeholder="(00)0000-00000" class="phone_mask" name="fone_2" value="<?=isset($userdata['fone_2']) ? $userdata['fone_2'] : ''?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>Telefone 3</label>
			<div class="input-field">
				<input type="text" placeholder="(00)0000-00000" class="phone_mask" name="fone_3" value="<?=isset($userdata['fone_3']) ? $userdata['fone_3'] : ''?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>WhatsApp</label>
			<div class="input-field">
				<input type="text" placeholder="(00)0000-00000" class="phone_mask" name="whatsapp" value="<?=isset($userdata['whatsapp']) ? $userdata['whatsapp'] : ''?>">
			</div>
		</div>
	</div>
	<input type="hidden" class="cad_hidden" value="Usuarios">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
</form>