<form method="post" action="<?=RAIZ.'usuarios/atualizar'?>">
	<div class="form_group">
		<label>Nome</label>
		<input type="text" name="nome" value="<?=$usuario->nome?>">
	</div>
	<div class="form_group">
		<label>Sobrenome</label>
		<input type="text" name="sobrenome" value="<?=$usuario->sobrenome?>">
	</div>
	<div class="form_group">
		<label>E-mail</label>
		<input type="text" name="email" value="<?=$usuario->email?>">
	</div>
	<div class="form_group">
		<label>Data de Nascimento</label>
		<input type="text" name="data_nascimento" value="<?=$usuario->data_nascimento?>">
	</div>
	<div class="form_group">
		<label>Telefone 1</label>
		<input type="text" name="fone_1" value="<?=$usuario->fone_1?>">
	</div>
	<div class="form_group">
		<label>Telefone 2</label>
		<input type="text" name="fone_2" value="<?=$usuario->fone_2?>">
	</div>
	<div class="form_group">
		<label>Telefone 3</label>
		<input type="text" name="fone_3" value="<?=$usuario->fone_3?>">
	</div>
	<div class="form_group">
		<label>WhatsApp</label>
		<input type="text" name="whatsapp" value="<?=$usuario->whatsapp?>">
	</div>
	<div class="form_group">
		<label>Função</label>
		<select name="acesso">
			<option <?=$usuario->acesso == 1 ? "selected" : ""?> value="1">Usuário</option>
			<option <?=$usuario->acesso == 2 ? "selected" : ""?> value="2">Administrador</option>
			<option <?=$usuario->acesso == 3 ? "selected" : ""?> value="3">Desenvolvedor</option>
		</select>
	</div>
	<div class="form_group">
		<label>Status:</label>
		<span><?=!!$usuario->status ? "Ativo" : "Inativo";?></span>
	</div>
	<input type="hidden" class="id_form" name="idref" value="<?=$usuario->idusuario?>">
	<input type="hidden" class="cad_hidden" value="Usuarios">
	<input type="submit" value="Salvar">
	<input type="reset" value="Limpar">
	<?php if (!$usuario->status): ?>
		<input type="button" id="btn_ativar_cadastro" value="Ativar usuário">
	<?php else: ?>
		<input type="button" id="btn_desativar_cadastro" value="Desativar usuário">
	<?php endif ?>
	<input type="button" id="btn_excluir_cadastro" value="Excluir usuário">
</form>