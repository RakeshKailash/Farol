<form method="post" action="<?=RAIZ.'usuarios/inserir'?>">
	<div class="form_group">
		<label>Nome</label>
		<input type="text" name="nome">
	</div>
	<div class="form_group">
		<label>Sobrenome</label>
		<input type="text" name="sobrenome">
	</div>
	<div class="form_group">
		<label>E-mail</label>
		<input type="text" name="email">
	</div>
	<div class="form_group">
		<label>Data de Nascimento</label>
		<input type="text" name="data_nascimento">
	</div>
	<div class="form_group">
		<label>Telefone 1</label>
		<input type="text" name="fone_1">
	</div>
	<div class="form_group">
		<label>Telefone 2</label>
		<input type="text" name="fone_2">
	</div>
	<div class="form_group">
		<label>Telefone 3</label>
		<input type="text" name="fone_3">
	</div>
	<div class="form_group">
		<label>WhatsApp</label>
		<input type="text" name="whatsapp">
	</div>
	<div class="form_group">
		<label>Função</label>
		<select name="acesso">
			<option value="1">Usuário</option>
			<option value="2">Administrador</option>
			<option value="3">Desenvolvedor</option>
		</select>
	</div>
	<input type="hidden" class="cad_hidden" value="Usuarios">
	<input type="submit" value="Salvar">
	<input type="reset" value="Limpar">
</form>