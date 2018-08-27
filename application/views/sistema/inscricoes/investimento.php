<?php 
$userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">assignment_ind</i>Nova inscrição <i class="material-icons">chevron_right</i> Forma de Investimento</p><a href="<?=base_url('sistema/Inscricoes')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" id="form_sistema_inscricao" action="<?=RAIZ.'sistema/inscricoes/inserir_investimento'?>">
	<div class="row">
		<div class="form_group col s6">
			<label>Aluno</label>
			<p><?=$inscricao->nome_usuario?></p>
			<input type="hidden" name="idusuario" value="<?=$inscricao->idusuario?>">
		</div>
		<div class="form_group col s6">
			<label>Curso</label>
			<p><?=$inscricao->curso->nome?></p>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s6">
			<label>Turma</label>
			<p><?=$inscricao->nome_turma?></p>
		</div>
		<div class="form_group col s6">
			<label>Opção</label>
			<p></p>
		</div>
	</div>
	<div class="row investimentos_turma">
		<div class="col s12"><p class="page_minor_title">Forma de Investimento</p></div>
		<div class="col s12 linhas_investimentos_inscricao">
			<?php foreach ($formas_investimento as $investimento): ?>
				<?php if ($investimento->forma == 1): ?>
					<p class="label_formas_investimento col s12">
						<label>
							<input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' />
							<span>À vista: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> (pagamento até o dia <?=$this->parserlib->formatDate($investimento->data_vencimento)?>)</span>
						</label>
					</p>
				<?php endif ?>
				<?php if ($investimento->forma == 2): ?>
					<p class="label_formas_investimento col s12 label_parcelamento_investimento" data-invid="<?=$investimento->idinvestimento?>">
						<label>
							<input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' />
							<span>Parcelado: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> em até <?=$investimento->parcelas?>x</span>
						</label>
					</p>
					<div class="input-field col s5 select_parcelas_investimento" data-invid="<?=$investimento->idinvestimento?>">
						<select class="parcelas_select" disabled name="qnt_parcelas">
							<?php foreach ($this->parserlib->getParcelamento($investimento) as $parcela) : ?>
								<?php if ($parcela->valor_comum != $parcela->valor_diferente): ?>
									<option value='<?=$parcela->qnt?>'><?=$parcela->qnt?>x (1° de R$<?=$this->parserlib->formatMoney($parcela->valor_diferente)?> + <?=$parcela->qnt - 1?>x de R$<?=$this->parserlib->formatMoney($parcela->valor_comum)?>)</option>
								<?php endif ?>
								<?php if ($parcela->valor_comum == $parcela->valor_diferente): ?>
									<option value='<?=$parcela->qnt?>'><?=$parcela->qnt?>x de R$<?=$this->parserlib->formatMoney($parcela->valor_comum)?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
				<?php endif ?>
				<?php if ($investimento->forma == 3): ?>
					<p class="label_formas_investimento col s12">
						<label>
							<input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' />
							<span>Mensalidades: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> em <?=$investimento->parcelas?>x de R$<?=$this->parserlib->formatMoney($investimento->valor_parcela)?> (vencimento todo dia <?=$investimento->dia_vencimento?>)</span>
						</label>
					</p>
				<?php endif ?>
				<?php if ($investimento->forma == 4): ?>
					<p class="label_formas_investimento col s12">
						<label>
							<input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' />
							<span>Cartões: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> em até 12x nos principais cartões (PagSeguro)</span>
						</label>
					</p>
				<?php endif ?>
			<?php endforeach ?>
		</div>
	</div>
	<input type="hidden" name="idturma" value="<?=$inscricao->idturma?>">
	<input type="hidden" name="idinscricao" value="<?=$inscricao->idinscricao?>">
	<input type="hidden" class="cad_hidden" value="Inscricoes">
	<input type="submit" class="btn btn_salvar_investimento" disabled value="Confirmar">
	<input type="reset" class="btn" value="Limpar">
</form>