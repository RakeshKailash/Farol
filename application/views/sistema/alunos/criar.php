<form method="post" action="<?=RAIZ.'alunos/inserir'?>">
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
		<label>CPF</label>
		<input type="text" name="cpf">
	</div>
	<div class="form_group">
		<label>RG</label>
		<input type="text" name="rg">
	</div>
	<div class="form_group">
		<label>Data de Nascimento</label>
		<input type="text" name="data_nascimento">
	</div>
	<div class="form_group">
		<label>Ocupação</label>
		<input type="text" name="ocupacao">
	</div>
	<div class="form_group">
		<label>Estado</label>
		<input type="text" name="uf">
	</div>
	<div class="form_group">
		<label>Cidade</label>
		<input type="text" name="cidade">
	</div>
	<div class="form_group">
		<label>Bairro</label>
		<input type="text" name="bairro">
	</div>
	<div class="form_group">
		<label>Rua</label>
		<input type="text" name="rua">
	</div>
	<div class="form_group">
		<label>N°</label>
		<input type="text" name="numero">
	</div>
	<div class="form_group">
		<label>CEP</label>
		<input type="text" name="cep">
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
	<input type="hidden" class="cad_hidden" value="Alunos">
	<input type="submit" value="Salvar">
	<input type="reset" value="Limpar">
</form>