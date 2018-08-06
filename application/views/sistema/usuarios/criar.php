<?php 
$userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">person_add</i>Novo usuário</p><a href="<?=base_url('sistema/Usuarios')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/usuarios/inserir'?>">
	<div class="row">
		<div class="form_group col s4">
			<label>Nome</label>
			<div class="input-field">
				<input type="text" name="nome" value="<?=isset($userdata['nome']) ? $userdata['nome'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Sobrenome</label>
			<div class="input-field">
				<input type="text" name="sobrenome" value="<?=isset($userdata['sobrenome']) ? $userdata['sobrenome'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Login</label>
			<div class="input-field">
				<input type="text" name="login" value="<?=isset($userdata['login']) ? $userdata['login'] : ''?>">
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
					<option <?=isset($userdata['acesso']) && $userdata['acesso'] == 2 ? "selected" : ''?> value="2">Aluno</option>
					<option <?=isset($userdata['acesso']) && $userdata['acesso'] == 3 ? "selected" : ''?> value="3">Funcionário</option>
					<option <?=isset($userdata['acesso']) && $userdata['acesso'] == 4 ? "selected" : ''?> value="4">Administrador</option>
					<option <?=isset($userdata['acesso']) && $userdata['acesso'] == 5 ? "selected" : ''?> value="5">Desenvolvedor</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s4">
			<label>CPF</label>
			<div class="input-field">
				<input type="text" placeholder="000.000.000-00" class="cpf_mask" name="cpf" value="<?=isset($userdata['cpf']) ? $userdata['cpf'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>RG</label>
			<div class="input-field">
				<input type="text" placeholder="0000000000" name="rg" value="<?=isset($userdata['rg']) ? $userdata['rg'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Ocupação</label>
			<div class="input-field">
				<input type="text" name="ocupacao" value="<?=isset($userdata['ocupacao']) ? $userdata['ocupacao'] : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s4">
			<label>CEP</label>
			<div class="input-field">
				<input type="text" placeholder="00000-000" class="cep_mask" name="cep" value="<?=isset($userdata['cep']) ? $userdata['cep'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Estado</label>
			<div class="input-field">
				<select name="uf">
					<?php foreach ($estados as $estado): ?>
						<option <?=isset($userdata['uf']) && $userdata['uf'] == $estado['sigla'] ? "selected" : ''?> value="<?=$estado['sigla']?>"><?=$estado['nome']?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form_group col s4">
			<label>Cidade</label>
			<div class="input-field">
				<input type="text" name="cidade" value="<?=isset($userdata['cidade']) ? $userdata['cidade'] : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s4">
			<label>Bairro</label>
			<div class="input-field">
				<input type="text" name="bairro" value="<?=isset($userdata['bairro']) ? $userdata['bairro'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Rua</label>
			<div class="input-field">
				<input type="text" name="rua" value="<?=isset($userdata['rua']) ? $userdata['rua'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Número</label>
			<div class="input-field">
				<input type="text" name="numero" value="<?=isset($userdata['numero']) ? $userdata['numero'] : ''?>">
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
	<div class="row">
		<div class="form_group col s3">
			<label>Status</label>
			<div class="input-field">
				<select name="status">
					<option <?=isset($userdata['status']) && $userdata['status'] == 1 ? "selected" : ''?> value="1">Ativo</option>
					<option <?=isset($userdata['status']) && $userdata['status'] == 0 ? "selected" : ''?> value="0">Inativo</option>
				</select>
			</div>
		</div>
	</div>
	<input type="hidden" class="cad_hidden" value="Usuarios">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
</form>