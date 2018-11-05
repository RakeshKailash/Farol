<?php 
	// $userdata = $this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">person</i>Usuários - Editar</p><a href="<?=base_url('sistema/Usuarios')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Usuários</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/usuarios/atualizar'?>">
	<div class="row">
		<div class="form_group col s12">
			<label>Nome</label>
			<div class="input-field">
				<input type="text" name="nome" value="<?=$userdata->nome?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s4">
			<label>E-mail</label>
			<div class="input-field">
				<input type="text" name="email" value="<?=$userdata->email?>">
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
		<div class="form_group col s4">
			<label>Data de Nascimento</label>
			<div class="input-field">
				<input type="text" placeholder="00/00/0000" class="date_mask" name="data_nascimento" value="<?=$userdata->data_nascimento?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Nível de acesso</label>
			<div class="input-field">
				<select name="acesso">
					<option <?=$userdata->acesso== 1 ? "selected" : ''?> value="1">Usuário</option>
					<option <?=$userdata->acesso== 2 ? "selected" : ''?> value="2">Aluno</option>
					<option <?=$userdata->acesso== 3 ? "selected" : ''?> value="3">Equipe</option>
					<option <?=$userdata->acesso== 4 ? "selected" : ''?> value="4">Administrador</option>
					<option <?=$userdata->acesso== 5 ? "selected" : ''?> value="5">Desenvolvedor</option>
				</select>
			</div>
		</div>
		<div class="form_group col s4">
			<label>Status</label>
			<div class="input-field">
				<select name="status">
					<option <?=$userdata->status== 1 ? "selected" : ''?> value="1">Ativo</option>
					<option <?=$userdata->status== 0 ? "selected" : ''?> value="0">Inativo</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s4">
			<label>CPF</label>
			<div class="input-field">
				<input type="text" placeholder="000.000.000-00" class="cpf_mask" name="cpf" value="<?=$userdata->cpf?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>RG</label>
			<div class="input-field">
				<input type="text" placeholder="0000000000" name="rg" value="<?=$userdata->rg?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Atividade/Profissão</label>
			<div class="input-field">
				<input type="text" name="atividade" value="<?=$userdata->atividade?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s4">
			<label>CEP</label>
			<div class="input-field">
				<input type="text" placeholder="00000-000" class="cep_mask" name="cep" value="<?=$userdata->cep?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Estado</label>
			<div class="input-field">
				<select name="uf">
					<?php foreach ($estados as $estado): ?>
						<option <?=isset($userdata->uf) && $userdata->uf == $estado['sigla'] ? "selected" : ''?> value="<?=$estado['sigla']?>"><?=$estado['nome']?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form_group col s4">
			<label>Cidade</label>
			<div class="input-field">
				<input type="text" name="cidade" value="<?=isset($userdata->cidade) ? $userdata->cidade : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s3">
			<label>Bairro</label>
			<div class="input-field">
				<input type="text" name="bairro" value="<?=isset($userdata->bairro) ? $userdata->bairro : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Rua/Avenida</label>
			<div class="input-field">
				<input type="text" name="rua" value="<?=isset($userdata->rua) ? $userdata->rua : ''?>">
			</div>
		</div>
		<div class="form_group col s1">
			<label>Número</label>
			<div class="input-field">
				<input type="text" name="numero" value="<?=isset($userdata->numero) ? $userdata->numero : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Complemento</label>
			<div class="input-field">
				<input type="text" name="complemento" value="<?=isset($userdata->complemento) ? $userdata->complemento : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s3">
			<label>WhatsApp</label>
			<div class="input-field">
				<input type="text" placeholder="(00)0000-00000" class="phone_mask" name="whatsapp" value="<?=$userdata->whatsapp?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>Telefone 1</label>
			<div class="input-field">
				<input type="text" placeholder="(00)0000-00000" class="phone_mask" name="fone_1" value="<?=$userdata->fone_1?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>Telefone 2</label>
			<div class="input-field">
				<input type="text" placeholder="(00)0000-00000" class="phone_mask" name="fone_2" value="<?=$userdata->fone_2?>">
			</div>
		</div>
		<div class="form_group col s3">
			<label>Telefone 3</label>
			<div class="input-field">
				<input type="text" placeholder="(00)0000-00000" class="phone_mask" name="fone_3" value="<?=$userdata->fone_3?>">
			</div>
		</div>
	</div>
	<div class="row">
		<a class="btn modal-trigger" href="#modal_permissoes_usuario">Alterar permissões</a>
	</div>
	<input type="hidden" class="id_form" name="idref" value="<?=$userdata->idusuario?>">
	<input type="hidden" class="cad_hidden" value="Usuarios">
	<input type="submit" class="btn right" value="Salvar">
	<input type="reset" class="btn right" value="Limpar">
	<a href="javascript:void(0)" class="btn" id="btn_excluir_cadastro"><i class="material-icons">delete</i> Excluir</a>
</form>

<div id="modal_excluir" class="modal">
	<div class="modal-content">
		<h4>Excluir usuário <?=explode(" ", $userdata->nome)[0]?></h4>
		<p>Deseja excluir o usuário <?=$userdata->nome?>?</p>
		<p>Com isso, ele não aparecerá mais na listagem, mas seus registros financeiros e de cursos continuarão em nosso sistema.</p>
	</div>
	<div class="modal-footer">
		<a href="#!" class="btn left btn_confirma_exclusao">Sim, excluir</a>
		<a href="#!" class="modal-close btn left btn_cancela_exclusao">Cancelar</a>
	</div>
</div>
<div id="modal_permissoes_usuario" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h3>Editar Permissões</h3>
		<div class="col s3 check_mod_acao">
			<label><input type="checkbox" class="check_all_mod_acao" /><span></span></label>
			<p style="display: inline-block;">Todas</p>
		</div>
		<?php foreach ($lista_permissoes as $modulo): ?>
			<?php if (sizeof($modulo->mod_acoes) > 0): ?>
				<div class="row">
					<div class="col s12">
						<h5><?=$modulo->descricao?></h4>
						</div>
						<?php foreach ($modulo->mod_acoes as $permissao): ?>
							<div class="col s3 check_mod_acao">
								<label><input name="mod_acao[]" value="<?=$permissao->idmoduloacao?>" <?=in_array($permissao->idmoduloacao, $permissoes_usuario) ? 'checked' : '';?> type="checkbox" /><span></span></label>
								<p style="display: inline-block;"><?=$permissao->acao?></p>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif ?>
			<?php endforeach ?>
		</div>
		<div class="modal-footer">
			<!-- <input type="hidden" name="idusuario" value=""> -->
			<a href="#!" class="btn btn_table_action btn_salvar_permissoes">Salvar</a>
			<a href="#!" class="modal-close btn btn_table_action">Cancelar</a>
		</div>
	</div>