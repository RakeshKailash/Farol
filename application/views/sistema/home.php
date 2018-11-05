<?php 
	// $userdata = $this->session->formdata) ? $this->session->formdata : array();
$errors = isset($this->session->errors) ? $this->session->errors : null;
?>
<p class="page_title"><i class="material-icons">home</i>Painel de Controle</p>
<?php if ($errors): ?>
	<div class="form_messages">
		<?=$errors;?>
	</div>
<?php endif ?>
<div class="row">
	<div class="col s12">
		<a href="<?=base_url('sistema/Usuarios')?>" class="btn btn_table_action btn_painel"><i class="material-icons">person</i>Usuários</a>
		<a href="<?=base_url('sistema/Professores')?>" class="btn btn_table_action btn_painel"><i class="material-icons">face</i>Professores</a>
		<a href="<?=base_url('sistema/Cursos')?>" class="btn btn_table_action btn_painel"><i class="material-icons">book</i>Cursos</a>
		<a href="<?=base_url('sistema/Turmas')?>" class="btn btn_table_action btn_painel"><i class="material-icons">school</i>Turmas</a>
		<a href="<?=base_url('sistema/Aulas')?>" class="btn btn_table_action btn_painel"><i class="material-icons">calendar_today</i>Aulas</a>
		<a href="<?=base_url('sistema/Biblioteca')?>" class="btn btn_table_action btn_painel"><i class="material-icons">book</i>Arquivos</a>
		<a href="<?=base_url('sistema/Inscricoes')?>" class="btn btn_table_action btn_painel"><i class="material-icons">assignment_ind</i>Inscrições</a>
		<a href="<?=base_url('sistema/Agenda')?>" class="btn btn_table_action btn_painel"><i class="material-icons">today</i>Agenda</a>
		<a href="<?=base_url('sistema/Financeiro')?>" class="btn btn_table_action btn_painel"><i class="material-icons">attach_money</i>Financeiro</a>
		<a href="<?=base_url('sistema/Ecommerce')?>" class="btn btn_table_action btn_painel"><i class="material-icons">store</i>E-commerce</a>
	</div>
	<div class="col s12">
		<a href="<?=base_url('sistema/Minha_conta')?>" class="btn btn_table_action btn_painel"><i class="material-icons">account_circle</i>Minha Conta</a>
		<a href="<?=base_url('sistema/Logout')?>" class="btn btn_table_action btn_painel"><i class="material-icons">power_settings_new</i>Sair</a>
	</div> 
</div>