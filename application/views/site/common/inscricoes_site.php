<h4><?=$turma->nome_curso?></h4>
<div class="conteudo_modal_inscricao">
	<form method="post" action="<?=RAIZ?>site/inscricoes/confirma">
		<div class="row">
			<div class="form_group col s6">
				<label>Opção (quando houver)</label>
				<div class="input-field">
					<select name="opcao">
						<option disabled selected>Selecione uma opcao</option>
						<option value="0"></option>
					</select>
				</div>
			</div>
		</div>
	</form>
</div>