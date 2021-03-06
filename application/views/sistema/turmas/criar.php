<?php 
$userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">school</i>Turmas - Nova</p>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" action="<?=RAIZ.'sistema/turmas/inserir'?>"><a href="<?=base_url('sistema/Turmas')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Turmas</a>
	<div class="row">
		<div class="form_group col s4">
			<label>Turma</label>
			<div class="input-field">
				<input type="text" name="identificacao" value="<?=isset($userdata['identificacao']) ? $userdata['identificacao'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Curso</label>
			<div class="input-field">
				<select name="idcurso">
					<?php foreach ($cursos as $curso): ?>
						<option <?=isset($userdata['idcurso']) && $userdata['idcurso'] == $curso->idcurso ? "selected" : ''?> value="<?=$curso->idcurso?>"><?=$curso->nome?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form_group col s4">
			<label>Status</label>
			<div class="input-field">
				<select name="status">
						<option <?=isset($userdata['status']) && $userdata['status'] == 1 ? "selected" : ''?> value="1">Aguarde</option>
						<option <?=isset($userdata['status']) && $userdata['status'] == 2 ? "selected" : ''?> value="2">Ativa</option>
						<option <?=isset($userdata['status']) && $userdata['status'] == 3 ? "selected" : ''?> value="3">Encerrada</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s4">
			<label>Investimento da Inscrição</label>
			<div class="input-field">
				<input type="text" class="money_mask" name="taxa_inscricao" value="<?=isset($userdata['taxa_inscricao']) ? $userdata['taxa_inscricao'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Inscrições até</label>
			<div class="input-field">
				<input type="text" class="date_mask" name="data_limite_inscricao" value="<?=isset($userdata['data_limite_inscricao']) ? $userdata['data_limite_inscricao'] : ''?>">
			</div>
		</div>
		<div class="form_group col s4">
			<label>Vagas</label>
			<div class="input-field">
				<input type="text" name="vagas" value="<?=isset($userdata['vagas']) ? $userdata['vagas'] : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12"><p class="page_minor_title">Investimento</p></div>
	</div>
	<div class="row investimentos_turma">
		
	</div>
	<div class="row"><a href="javascript:void(0)" class="btn btn_table_action btn_novo_investimento"><i class="material-icons">add</i>Forma de investimento</a></div>
	<div class="row">
		<div class="col s12 check_title_container">
			<label><input class="check_aula_unica" name="aula_unica" value="1" type="checkbox" /><span></span></label>
			<p class="page_minor_title">Aula única</p>
		</div>
	</div>
	<div class="row container_aula_unica hide">
		<div class="row">
			<div class="form_group col s12 l6">
				<label>Título da Aula</label>
				<div class="input-field">
					<input type="text" name="nome" value="<?=isset($userdata['nome']) ? $userdata['nome'] : ''?>">
				</div>
			</div>
			<div class="form_group col s12 l6">
				<label>Professor</label>
				<div class="input-field">
					<select name="idprofessor" placeholder="Selecione um professor">
						<option disabled <?=!isset($userdata['idprofessor']) ? "selected" : ""?>>Selecione um professor</option>
						<?php foreach ($professores as $professor): ?>
							<option <?=isset($userdata['idprofessor']) && $userdata['idprofessor'] == $professor->idprofessor ? "selected" : ''?> value="<?=$professor->idprofessor?>"><?=$professor->nome?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12"><p class="page_minor_title">Dias</p></div>
		</div>
		<div class="row dias_aula">
			<div class="row dias_aulas_linha">
				<div class="form_group col s12">
					<div class="col s12 l5">
						<p>Início</p>
						<div class="col s6 l6">
							<label>Dia</label>
							<div class="input-field">
								<input type="text" name="data_inicio[]" class="datepicker">
							</div>
						</div>
						<div class="col s6 l6">
							<label>Início</label>
							<div class="input-field">
								<input type="text" name="hora_inicio[]" class="timepicker">
							</div>
						</div>
					</div>
					<div class="col s12 l4">
						<p>Pausa (opcional)</p>
						<div class="col s6 l6">
							<label>Das</label>
							<div class="input-field">
								<input type="text" name="almoco_inicio[]" class="timepicker">
							</div>
						</div>
						<div class="col s6 l6">
							<label>Até as</label>
							<div class="input-field">
								<input type="text" name="almoco_fim[]" class="timepicker">
							</div>
						</div>
					</div>
					<div class="col s12 l3">
						<p>Término</p>
						<div class="col s6 l6">
							<label>Hora</label>
							<div class="input-field">
								<input type="text" name="hora_fim[]" class="timepicker">
							</div>
						</div>
					</div>
					<div class="col s1 l1">
						<i class="material-icons exclui_item_linha">close</i>
					</div>
				</div>
			</div>
		</div>
		<div class="row"><a href="javascript:void(0)" class="btn btn_table_action btn_novo_dia_evento"><i class="material-icons">add</i>Dia</a></div>
	</div>
	<input type="hidden" class="cad_hidden" value="Turmas">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar">
</form>