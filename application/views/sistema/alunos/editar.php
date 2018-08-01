<form method="post" action="<?=RAIZ.'alunos/atualizar'?>">
	<div class="form_group">
		<label>Nome</label>
		<input type="text" name="nome" value="<?=$aluno->nome?>">
	</div>
	<div class="form_group">
		<label>Sobrenome</label>
		<input type="text" name="sobrenome" value="<?=$aluno->sobrenome?>">
	</div>
	<div class="form_group">
		<label>E-mail</label>
		<input type="text" name="email" value="<?=$aluno->email?>">
	</div>
	<div class="form_group">
		<label>CPF</label>
		<input type="text" name="cpf" value="<?=$aluno->cpf?>">
	</div>
	<div class="form_group">
		<label>RG</label>
		<input type="text" name="rg" value="<?=$aluno->rg?>">
	</div>
	<div class="form_group">
		<label>Data de Nascimento</label>
		<input type="text" name="data_nascimento" value="<?=$aluno->data_nascimento?>">
	</div>
	<div class="form_group">
		<label>Ocupação</label>
		<input type="text" name="ocupacao" value="<?=$aluno->ocupacao?>">
	</div>
	<div class="form_group">
		<label>Estado</label>
		<input type="text" name="uf" value="<?=$aluno->uf?>">
	</div>
	<div class="form_group">
		<label>Cidade</label>
		<input type="text" name="cidade" value="<?=$aluno->cidade?>">
	</div>
	<div class="form_group">
		<label>Bairro</label>
		<input type="text" name="bairro" value="<?=$aluno->bairro?>">
	</div>
	<div class="form_group">
		<label>Rua</label>
		<input type="text" name="rua" value="<?=$aluno->rua?>">
	</div>
	<div class="form_group">
		<label>N°</label>
		<input type="text" name="numero" value="<?=$aluno->numero?>">
	</div>
	<div class="form_group">
		<label>CEP</label>
		<input type="text" name="cep" value="<?=$aluno->cep?>">
	</div>
	<div class="form_group">
		<label>Telefone 1</label>
		<input type="text" name="fone_1" value="<?=$aluno->fone_1?>">
	</div>
	<div class="form_group">
		<label>Telefone 2</label>
		<input type="text" name="fone_2" value="<?=$aluno->fone_2?>">
	</div>
	<div class="form_group">
		<label>Telefone 3</label>
		<input type="text" name="fone_3" value="<?=$aluno->fone_3?>">
	</div>
	<div class="form_group">
		<label>WhatsApp</label>
		<input type="text" name="whatsapp" value="<?=$aluno->whatsapp?>">
	</div>
	<div class="form_group">
		<label>Status:</label>
		<span><?=!!$aluno->status ? "Ativo" : "Inativo";?></span>
	</div>
	<input type="hidden" class="id_form" name="idref" value="<?=$aluno->idaluno?>">
	<input type="hidden" class="cad_hidden" value="Alunos">
	<input type="submit" value="Salvar">
	<input type="reset" value="Limpar">
	<?php if (!$aluno->status): ?>
		<input type="button" id="btn_ativar_cadastro" value="Ativar aluno">
	<?php else: ?>
		<input type="button" id="btn_desativar_cadastro" value="Desativar aluno">
	<?php endif ?>
	<input type="button" id="btn_excluir_cadastro" value="Excluir aluno">
</form>