<?php 
$curyear = isset($_GET['curyear']) ? $_GET['curyear'] : date('Y');
?>

<header id="cabecalho_alunos">
    <img src="<?=RAIZ?>img/farol.svg">
</header>
<div class="row">
    <div class="col s12">
        <ul id="menu_alunos" class="sidenav sidenav-fixed sidenav_alunos">
            <li>
                <div class="user-view">
                    <div class="background bg_menu_alunos">
                        <img src="<?=RAIZ?>img/metafora_farol.jpg">
                    </div>
                    <a href="#user"><img class="circle" src="<?=RAIZ?>img/perfil_farol.svg"></a>
                    <a href="#name"><span class="white-text name">Olá, <?=explode(" ", $this->session->nome)[0]?>!</span></a>
                    <a href="#email"><span class="white-text email"><?=$this->session->email?></span></a>
                </div>
            </li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">school</i>Meus Cursos</a></li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">today</i>Agenda</a></li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">attach_money</i>Financeiro</a></li>
            <li><div class="divider"></div></li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">account_circle</i>Minha Conta</a></li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">power_settings_new</i>Sair</a></li>
            <li><div class="divider"></div></li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">arrow_back</i>Voltar ao Site</a></li>
        </ul>
        <div class="conteudo_home_alunos">
            <h2>Bem-vindo ao Espaço Aluno do Farol!</h2>
            <div class="row proximos_cursos">
                <h3>Próximas aulas</h3>
                <?php if (isset($agenda) && count($agenda)): ?>
                    <?php foreach ($agenda as $num => $ano): ?>
                        <a href="<?=base_url('sistema/Agenda?curyear='.$num)?>" class="btn btn_table_action btn_year <?=$num == $curyear ? 'curyear' : ''?>"><?=$num?></a>
                    <?php endforeach ?>
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
                                                            <a href="<?=base_url('sistema')?>" class="btn btn_table_action">Matricule-se</a>
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
                <?php endif ?>
            </div>
        </div>
    </div>
</div>