<?php 
// $userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">calendar_today</i>Editar aula</p><a href="<?=base_url('sistema/Aulas')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Voltar</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" class="form_visualizar" action="<?=RAIZ.'sistema/aulas/atualizar'?>">
	<div class="row">
		<div class="form_group col s12 l6">
			<label>Título</label>
			<div class="input-field">
				<input type="text" name="nome" value="<?=isset($userdata->nome) ? $userdata->nome : ''?>">
			</div>
		</div>
		<div class="form_group col s12 l6">
			<label>Descrição</label>
			<div class="input-field">
				<input type="text" name="descricao" value="<?=isset($userdata->descricao) ? $userdata->descricao : ''?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s12 l6">
			<label>Turma</label>
			<div class="input-field">
				<select name="idturma">
					<?php foreach ($turmas as $turma): ?>
						<option <?=isset($userdata->idturma) && $userdata->idturma == $turma->idturma ? "selected" : ''?> value="<?=$turma->idturma?>"><?=$turma->identificacao." (".$this->parserlib->resume($turma->nome_curso, 0, 50).")"?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form_group col s12 l6">
			<label>Professor</label>
			<div class="input-field">
				<select name="idprofessor">
					<?php foreach ($professores as $professor): ?>
						<option <?=isset($userdata->idprofessor) && $userdata->idprofessor == $professor->idprofessor ? "selected" : ''?> value="<?=$professor->idprofessor?>"><?=$professor->nome?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>
	<?php if (!!count($userdata->dias)): ?>
		<div class="row">
			<div class="col s12"><p class="page_minor_title">Dias</p></div>
		</div>
		<div class="row dias_aula">
			<?php foreach ($userdata->dias as $dia): ?>
				<div class="row dias_aulas_linha">
					<div class="form_group col s12">
						<div class="col s12 l5">
							<p>Início</p>
							<div class="col s6 l6">
								<label>Dia</label>
								<div class="input-field">
									<input type="text" name="data_inicio[]" value="<?=$this->parserlib->dtExtractDate($dia->inicio, false, true)?>" class="datepicker">
								</div>
							</div>
							<div class="col s6 l6">
								<label>Hora</label>
								<div class="input-field">
									<input type="text" name="hora_inicio[]" value="<?=$this->parserlib->dtExtractTime($dia->inicio, false, true)?>" class="timepicker">
								</div>
							</div>
						</div>
						<div class="col s12 l4">
							<p>Pausa</p>
							<div class="col s6 l6">
								<label>Das</label>
								<div class="input-field">
									<input type="text" name="almoco_inicio[]" value="<?=$this->parserlib->dtExtractTime($dia->almoco_inicio, false, true)?>" class="timepicker">
								</div>
							</div>
							<div class="col s6 l6">
								<label>Até as</label>
								<div class="input-field">
									<input type="text" name="almoco_fim[]" value="<?=$this->parserlib->dtExtractTime($dia->almoco_fim, false, true)?>" class="timepicker">
								</div>
							</div>
						</div>
						<div class="col s12 l3">
							<p>Fim</p>
							<div class="col s6 l6">
								<label>Hora</label>
								<div class="input-field">
									<input type="text" name="hora_fim[]" value="<?=$this->parserlib->dtExtractTime($dia->fim, false, true)?>" class="timepicker">
								</div>
							</div>
						</div>
						<div class="col s1 l1">
							<i class="material-icons exclui_item_linha">close</i>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	<?php endif ?>
	<!-- <div class="row"><a href="javascript:void(0)" class="btn btn_table_action btn_novo_dia_evento"><i class="material-icons">add</i>Dia</a></div>
	<input type="hidden" class="cad_hidden" value="Aulas">
	<input type="submit" class="btn" value="Salvar">
	<input type="reset" class="btn" value="Limpar"> -->
</form>