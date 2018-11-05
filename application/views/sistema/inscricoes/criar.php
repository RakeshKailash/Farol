<?php 
$userdata = isset($this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>

<p class="page_title"><i class="material-icons">assignment_ind</i>Inscrições - Nova</p><a href="<?=base_url('sistema/Inscricoes')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Inscrições</a>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<form method="post" id="form_sistema_inscricao" action="<?=RAIZ.'sistema/inscricoes/inserir'?>">
	<div class="row">
		<div class="form_group col s6">
			<label>Aluno</label>
			<div class="input-field">
				<select name="idusuario">
					<option disabled <?=!isset($userdata['idusuario']) ? "selected" : ""?>>Selecione um aluno</option>
					<?php foreach ($usuarios as $usuario): ?>
						<option <?=isset($userdata['idusuario']) && $userdata['idusuario'] == $usuario->idusuario ? "selected" : ''?> value="<?=$usuario->idusuario?>"><?=$usuario->nome?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form_group col s6">
			<label>Curso</label>
			<div class="input-field">
				<select name="idcurso" id="select_curso_inscricao">
					<option disabled <?=!isset($userdata['idcurso']) ? "selected" : ""?>>Selecione um curso</option>
					<?php foreach ($cursos as $curso): ?>
						<option <?=isset($userdata['idcurso']) && $userdata['idcurso'] == $curso->idcurso ? "selected" : ''?> value="<?=$curso->idcurso?>"><?=$curso->nome?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form_group col s6">
			<label>Turma</label>
			<div class="input-field">
				<select name="idturma" id="select_turma_inscricao" disabled>
					<option class="default_select_option" disabled <?=!isset($userdata['idturma']) ? "selected" : ""?>>Selecione uma turma</option>
					<?php foreach ($turmas as $turma): ?>
						<option class="opcao_turma_inscricao" data-idcurso="<?=$turma->idcurso?>" <?=isset($userdata['idturma']) && $userdata['idturma'] == $turma->idturma ? "selected" : ''?> value="<?=$turma->idturma?>"><?=$turma->identificacao?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form_group col s6">
			<label>Opção (quando houver)</label>
			<div class="input-field">
				<select name="opcao" disabled>
					<option disabled <?=!isset($userdata['opcao']) ? "selected" : ""?>>Selecione uma opcao</option>
					<?php foreach ($cursos as $curso): ?>
						<option <?=isset($userdata['idcurso']) && $userdata['idcurso'] == $curso->idcurso ? "selected" : ''?> value="<?=$curso->idcurso?>"><?=$curso->nome?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row investimentos_turma hide">
		<div class="col s12"><p class="page_minor_title">Forma de Investimento</p></div>
		<div class="col s12 linhas_investimentos_inscricao"></div>
	</div>
	<input type="hidden" class="cad_hidden" value="Inscricoes">
	<input type="submit" class="btn btn_continuar_inscricao" disabled value="Continuar">
	<input type="reset" class="btn" value="Limpar">
</form>