<?php 
// $userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
$investimento = $userdata->investimento->forma;
?>

<p class="page_title"><i class="material-icons">assignment_ind</i>Inscrição <?=$userdata->idinscricao?></p><a href="<?=base_url('sistema/Inscricoes')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" id="form_sistema_inscricao" class="form_visualizar" action="<?=RAIZ.'sistema/inscricoes/atualizar'?>">
	<div class="row">
		<div class="form_group col s4">
			<label>Aluno</label>
			<p><?=$userdata->nome_usuario?></p>
			<input type="hidden" name="idusuario" value="<?=$userdata->idusuario?>">
		</div>
		<div class="form_group col s4">
			<label>Curso</label>
			<p><?=$userdata->curso->nome?></p>
		</div>
		<div class="form_group col s4">
			<label>Turma</label>
			<p><?=$userdata->nome_turma?></p>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s4">
			<label>Opção</label>
			<p></p>
		</div>
		<div class="form_group col s4">
			<label>Data da Inscrição</label>
			<p><?=$this->parserlib->formatDatetime($userdata->data_ingresso)?></p>
		</div>
		<div class="form_group col s4">
			<label>Situação</label>
			<p><?=$this->parserlib->inscStatusParse($userdata->status)?></p>
		</div>
	</div>
	<div class="row investimentos_turma">
		<div class="col s12"><p class="page_minor_title">Forma de Investimento</p></div>
		<div class="col s12 linhas_investimentos_inscricao">
			<?php if ($investimento->forma == 1): ?>
				<p class="label_formas_investimento col s12">
					<label>
						<!-- <input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' /> -->
						<span>À vista: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> (pagamento até o dia <?=$this->parserlib->formatDate($investimento->data_vencimento)?>)</span>
					</label>
				</p>
			<?php endif ?>
			<?php if ($investimento->forma == 2): ?>
				<p class="label_formas_investimento col s12 label_parcelamento_investimento" data-invid="<?=$investimento->idinvestimento?>">
					<label>
						<span>Parcelado: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> em <?=$userdata->investimento->parcelas?>x</span>
					</label>
				</p>
				<?php foreach ($investimento->parcelas as $parcela) : ?>
					<p class="parcelas_investimento_visualizar"><label>
						<span>R$<?=$this->parserlib->formatMoney($parcela->valor)?></span>
						<?php if (!!$parcela->status): ?>
							<i class="material-icons">check</i>
						<?php endif ?>
					</label></p>
				<?php endforeach ?>
			<?php endif ?>
			<?php if ($investimento->forma == 3): ?>
				<p class="label_formas_investimento col s12">
					<label>
						<!-- <input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' /> -->
						<span>Mensalidades: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> em <?=$investimento->parcelas?>x de R$<?=$this->parserlib->formatMoney($investimento->valor_parcela)?> (vencimento todo dia <?=$investimento->dia_vencimento?>)</span>
					</label>
				</p>
			<?php endif ?>
			<?php if ($investimento->forma == 4): ?>
				<p class="label_formas_investimento col s12">
					<label>
						<!-- <input class='with-gap' name='forma_investimento' type='radio' value='<?=$investimento->forma?>' /> -->
						<span>Cartões: <b>R$<?=$this->parserlib->formatMoney($investimento->total)?></b> em até 12x nos principais cartões (PagSeguro)</span>
					</label>
				</p>
			<?php endif ?>
		</div>
	</div>
	<!-- <div class="row investimentos_turma hide">
		<div class="col s12"><p class="page_minor_title">Forma de Investimento</p></div>
		<div class="col s12 linhas_investimentos_inscricao"></div>
	</div> -->
	<input type="hidden" class="cad_hidden" value="Inscricoes">
	<input type="reset" class="btn" value="Limpar">
</form>