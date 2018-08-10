<?php 
// $userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">school</i><?=$userdata->identificacao?></p>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" class="form_visualizar" action="<?=RAIZ.'sistema/turmas/atualizar'?>"><a href="<?=base_url('sistema/Turmas')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
	<div class="row">
		<div class="form_group col s6">
			<label>Turma</label>
			<div class="input-field">
				<input type="text" name="identificacao" value="<?=isset($userdata->identificacao) ? $userdata->identificacao : ''?>">
			</div>
		</div>
		<div class="form_group col s6">
			<label>Curso</label>
			<div class="input-field">
				<select name="idcurso">
					<?php foreach ($cursos as $curso): ?>
						<option <?=isset($userdata->idcurso) && $userdata->idcurso == $curso->idcurso ? "selected" : ''?> value="<?=$curso->idcurso?>"><?=$curso->nome?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s4">
			<label>Investimento da Inscrição</label>
			<div class="input-field">
				<input type="text" class="money_mask" name="taxa_inscricao" value="<?=isset($userdata->taxa_inscricao) ? $userdata->taxa_inscricao : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Inscrições até</label>
			<div class="input-field">
				<input type="text" class="date_mask" name="data_limite_inscricao" value="<?=isset($userdata->data_limite_inscricao) ? $userdata->data_limite_inscricao : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Vagas</label>
			<div class="input-field">
				<input type="text" name="vagas" value="<?=isset($userdata->vagas) ? $userdata->vagas : ''?>">
			</div>
		</div>
	</div>
	<?php if (!!count($investimentos)): ?>
		<div class="row">
			<div class="col s12"><p class="page_minor_title">Investimento</p></div>
		</div>
		<div class="row investimentos_turma">
			<?php foreach ($investimentos as $investimento): ?>
				<div class="form_group col s12 linha_pagamento_turma">
					<div class="col s3 col_tipo">
						<label>Forma</label>
						<div class="input-field">
							<select name="forma[]" class="select_tipo_investimento">
								<option <?=$investimento->forma == "1" ? "selected" : "";?> value="1">À vista</option>
								<option <?=$investimento->forma == "2" ? "selected" : "";?> value="2">À prazo</option>
								<option <?=$investimento->forma == "3" ? "selected" : "";?> value="3">Cartão</option>
							</select>
						</div>
					</div>
					<div class="col s4 col_total">
						<label>Total</label>
						<div class="input-field">
							<input type="text" class="money_mask" name="total[]" value="<?=$investimento->total?>">
						</div>
					</div>
					<div class="col s1 col_parcelas hide">
						<label>Parcelas</label>
						<div class="input-field">
							<input type="text" name="parcelas[]" value="<?=$investimento->parcelas?>">
						</div>
					</div>
					<div class="col s2 col_val_parcelas hide">
						<label>Valor das parcelas</label>
						<div class="input-field">
							<input type="text" class="money_mask" name="valor_parcela[]" value="<?=$investimento->valor_parcela?>">
						</div>
					</div>
					<div class="col s2 col_dia_vencimento hide">
						<label>Dia de vencimento</label>
						<div class="input-field">
							<input type="text" name="dia_vencimento[]" value="<?=$investimento->dia_vencimento?>">
						</div>
					</div>
					<div class="col s4 col_vencimento">
						<label>Vencimento</label>
						<div class="input-field">
							<input type="text" placeholder="00/00/0000" class="date_mask" name="data_vencimento[]" value="<?=$this->parserlib->formatDate($investimento->data_vencimento)?>">
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	<?php endif ?>
	<!-- <div class="row"><a href="javascript:void(0)" class="btn btn_table_action btn_novo_investimento"><i class="material-icons">add</i>Forma de investimento</a></div>
	<input type="hidden" class="cad_hidden" value="Turmas">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar"> -->
</form>
<?php if (!!count($aulas)): ?>
<form method="post" class="form_visualizar" action="<?=RAIZ.'sistema/turmas/atualizar'?>">
	<div class="row">
		<div class="col s12"><p class="page_minor_title">Aulas</p></div>
	</div>
	<div class="row aulas_turma">
		<table id="alunos_visualizar_table">
			<thead>
				<th>ID</th>
				<th>Descrição</th>
				<th>Professor</th>
				<th>Data</th>
				<th></th>
			</thead>
			<tbody>
				<?php foreach ($aulas as $aula) : ?>
					<tr class="linha_cadastro_visualizar">
						<input type="hidden" class="id_hidden" name="idaula" value="<?=$aula->idaula?>">
						<td><?=$aula->idaula?></td>
						<td><?=$aula->descricao?></td>
						<td><?=$aula->nome_professor." ".$aula->sobrenome_professor?></td>
						<td>
							<?php foreach ($aula->dias as $dia): ?>
								<p><?=$this->parserlib->formatDaterange($dia->inicio, $dia->fim);?> <?=!empty($dia->obs) ? "<p>(".$dia->obs.")</p>" : ""?></p>
							<?php endforeach ?>
						</td>
						<td><?=$this->parserlib->aulaStatusParse($aula->status);?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
			<input type="hidden" class="cad_hidden" value="Aulas">
		</table>
	</div>
</form>
<?php endif ?>
<div class="row">
	<a href="<?=base_url('sistema/Aulas/novo?preid='.$userdata->idturma)?>" class="btn btn_table_action btn_nova_aula"><i class="material-icons">add</i>Nova aula</a>
</div>