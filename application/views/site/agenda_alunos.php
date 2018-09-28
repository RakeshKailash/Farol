<?php 
$curyear = isset($_GET['curyear']) ? $_GET['curyear'] : date('Y');
?>
<div class="row row_espaco_aluno">
    <h3>Agenda</h3>
    <h6>Confira abaixo as próximas aulas dos seus cursos!</h6> <br>
    <?php if (isset($agenda) && count($agenda)): ?>
    <?php foreach ($agenda as $num => $ano): ?>
        <a href="<?=base_url('site/Agenda?curyear='.$num)?>" class="btn btn_table_action btn_year <?=$num == $curyear ? 'curyear' : ''?>"><?=$num?></a>
    <?php endforeach ?>
    <table id="alunos_visualizar_table" class="has_sub_head has_info_lines">
        <thead>
            <th class="col s4">Data</th>
            <th class="col s5">Evento</th>
            <th class="col s3">Facilitador</th>
        </thead>
        <?php foreach ($agenda as $num => $ano): ?>
            <tbody class="ano_tbody <?=$num != $curyear ? 'hide' : '' ?>">
                <tr class="linha_espaco"><td colspan="4"></td></tr>
                <?php foreach ($ano as $key => $meses) : ?>
                    <tr class="linha_mes_agenda"><td colspan="4"><?=$this->parserlib->getMonthFromNum($key)?></td></tr>
                    <?php foreach ($meses as $evento) : ?>
                        <tr class="linha_agenda_expandir" data-id="<?=$evento->idevento?>">
                            <input type="hidden" class="id_hidden" name="idevento" value="<?=$evento->idevento?>">
                            <td class="col s4">
                                <?php if (isset($evento->dias)): ?>
                                    <?php foreach ($evento->dias as $dia): ?>
                                        <p><?=$this->parserlib->formatDaterange($dia->inicio, $dia->fim);?></p>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </td>
                            <td class="col s5"><?=$evento->nome?></td>
                            <td class="col s3"><a href="<?=base_url('sistema/Professores/'.$evento->idprofessor)?>"><?=$evento->nome_professor?></a></td>
                        </tr>
                        <tr class="linha_info_agenda hide" data-id="<?=$evento->idevento?>">
                            <td colspan="4">
                                <div class="row row_descricao_agenda"><div class="col s12"><?=$evento->descricao?></div></div>
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