<div class="container main_site_container">
	<nav id="caminhodepao">
		<div class="nav-wrapper">
			<div class="col s12">
				<a href="<?=RAIZ?>site" class="breadcrumb">Home</a>
				<a href="javascript:void(0)" class="breadcrumb">Agende-se</a>
			</div>
		</div>
	</nav>
	<?php 
	$curyear = isset($_GET['curyear']) ? $_GET['curyear'] : date('Y');
	?>

	<p class="page_title"><i class="material-icons">today</i>Agenda</p>
	<a href="<?=base_url('sistema')?>" class="btn btn_table_action"><i class="material-icons">arrow_back</i>Painel</a>
	<?php foreach ($agenda as $num => $ano): ?>
		<a href="<?=base_url('sistema/Agenda?curyear='.$num)?>" class="btn btn_table_action btn_year <?=$num == $curyear ? 'curyear' : ''?>"><?=$num?></a>
	<?php endforeach ?>
	<div class="row">
		<table id="alunos_visualizar_table" class="has_sub_head has_info_lines">
			<thead>
				<th class="col s3">Data</th>
				<th class="col s4">Evento</th>
				<th class="col s3">Facilitador</th>
				<th class="col s2">Inscrições até</th>
			</thead>
			<?php foreach ($agenda as $num => $ano): ?>
				<tbody class="ano_tbody <?=$num != $curyear ? 'hide' : '' ?>">
					<tr class="linha_espaco"><td colspan="4"></td></tr>
					<?php foreach ($ano as $key => $meses) : ?>
						<tr class="linha_mes_agenda"><td colspan="4"><?=$this->parserlib->getMonthFromNum($key)?></td></tr>
						<?php foreach ($meses as $evento) : ?>
							<tr class="linha_agenda_expandir" data-id="<?=$evento->idevento?>">
								<input type="hidden" class="id_hidden" name="idevento" value="<?=$evento->idevento?>">
								<td class="col s3">
									<?php if (isset($evento->dias)): ?>
										<?php foreach ($evento->dias as $dia): ?>
											<p><?=$this->parserlib->formatDaterange($dia->inicio, $dia->fim);?></p>
										<?php endforeach ?>
									<?php endif ?>
								</td>
								<td class="col s4"><?=$evento->nome?></td>
								<td class="col s3"><a href="<?=base_url('sistema/Professores/'.$evento->idprofessor)?>"><?=$evento->nome_professor?></a></td>
								<td class="col s2"><?=$evento->inscricao_status?></td>
							</tr>
							<tr class="linha_info_agenda hide" data-id="<?=$evento->idevento?>">
								<td colspan="4">
									<div class="row row_descricao_agenda"><div class="col s12"><?=$evento->descricao?></div></div>
									<?php if (!!$evento->aceitar_matriculas): ?>
										<div class="row row_matricula_agenda">
											<div class="col s12">
												<a href="javascript:void(0)" data-turma="<?=$evento->idturma?>" class="btn btn_table_action btn_matricula_site">Matricule-se</a>
											</div>
										</div>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach ?>
						<tr class="linha_espaco"><td colspan="4"></td></tr>
					<?php endforeach ?>
				</tbody>
			<?php endforeach ?>
		</table>
	</div>
</div>
<div id="modal_inscricao_site" class="modal modal-fixed-footer">
	<div class="modal-content">
		<div class="conteudo_login_inscricao hide row">
			<form class="col s7 login_inscricao" method="post" action="javascript:void(0)">
					<div class="row">
						<div class="form_group col s12">
							<label>CPF ou E-mail</label>
							<div class="input-field">
								<input type="text" name="login">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form_group col s12">
							<label>Senha</label>
							<div class="input-field">
								<input type="password" name="senha">
							</div>
						</div>
					</div>
					<div class="row row_botoes_login">
						<div class="col s12">
							<input type="button" class="btn btn_login_site btn_login_inscricao" value="Entrar">
							<input type="reset" class="btn btn_login_site" value="Limpar">
						</div>
					</div>
					<div class="row link_recupera_senha">
						<div class="col s12">
							<a href="javascript:void(0)">esqueceu sua senha?</a>
						</div>
					</div>
				</form>
		</div>
		<div class="conteudo_inscricao_site hide">
			<form class="form_inscricao_site" action="javascript:void(0)" method="post">
			<div class="row">
				<div class="form_group col s6">
					<label>Curso</label>
					<div class="input-field">
						<p class="curso_inscricao_site"></p>
					</div>
				</div>
				<div class="form_group col s6">
					<label>Turma</label>
					<div class="input-field">
						<input type="hidden" name="idturma" class="input_id_turma">
						<p class="turma_inscricao_site"></p>
					</div>
				</div>
			</div>
			<div class="divider"></div>
			<div class="row">
				<h6>Selecione uma forma de investimento:</h6>
			</div>
			<!-- <div class="row">
				<div class="form_group col s6">
					<label>Opção</label>
					<div class="input-field">
						<select name="opcao" disabled>
							<option disabled selected>Selecione uma opção</option>
						</select>
					</div>
				</div>
			</div> -->
			<div class="investimentos_inscricao_site"></div>
		</form>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="idturma" value="">
		<a href="#!" class="btn btn_table_action btn_continuar_inscricao" disabled>Continuar</a>
		<a href="#!" class="btn btn_table_action btn_cancelar_inscricao">Cancelar</a>
	</div>
</div>