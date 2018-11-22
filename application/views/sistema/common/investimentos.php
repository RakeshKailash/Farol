<?php foreach ($formas_investimento as $investimento): ?>
	<?php if ($investimento->forma == 1): ?>
		<div class="row">
			<p class="label_formas_investimento col s12">
				<label>
					<input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' />
					<span>À vista: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> (pagamento até o dia <?=$this->parserlib->formatDate($investimento->data_vencimento)?>)</span>
				</label>
			</p>
		</div>
	<?php endif ?>
	<?php if ($investimento->forma == 2): ?>
		<div class="row">
			<p class="label_formas_investimento col s12 label_parcelamento_investimento" data-invid="<?=$investimento->idinvestimento?>">
				<label>
					<input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' />
					<span>Parcelado: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> em até <?=$investimento->parcelas?>x</span>
				</label>
			</p>
			<div class="input-field col s7 select_parcelas_investimento" data-invid="<?=$investimento->idinvestimento?>">
				<select class="parcelas_select" disabled name="qnt_parcelas">
					<?php foreach ($this->parserlib->getParcelamento($investimento) as $parcela) : ?>
							<option value='<?=$parcela->qnt?>'>1 de R$<?=$this->parserlib->formatMoney($parcela->valor_diferente)?> + <?=$parcela->qnt - 1?>x de R$<?=$this->parserlib->formatMoney($parcela->valor_comum)?>)</option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	<?php endif ?>
	<?php if ($investimento->forma == 3): ?>
		<div class="row">
			<p class="label_formas_investimento col s12">
				<label>
					<input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' />
					<span>Mensalidades: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> em <?=$investimento->parcelas?>x de R$<?=$this->parserlib->formatMoney($investimento->valor_parcela)?> (vencimento todo dia <?=$investimento->dia_vencimento?>)</span>
				</label>
			</p>
		</div>
	<?php endif ?>
	<?php if ($investimento->forma == 4): ?>
		<div class="row">
			<p class="label_formas_investimento col s12">
				<label>
					<input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' />
					<span>Cartões: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> em até 12x nos principais cartões (PagSeguro)</span>
				</label>
			</p>
		</div>
	<?php endif ?>
<?php endforeach ?>