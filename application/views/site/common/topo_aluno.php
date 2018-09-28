<!DOCTYPE html>
<html>
<head>
    <title>Espaço Aluno | Farol Espaço Terapeutico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript">
        var RAIZ = "<?=RAIZ?>";
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?=$loads?>
</head>
<body class="full_size">
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
                <li><a class="waves-effect" href="<?=RAIZ?>site/espacoaluno"><i class="material-icons">home</i>Início</a></li>
                <li><a class="waves-effect" href="<?=RAIZ?>site/espacoaluno/cursos"><i class="material-icons">school</i>Meus Cursos</a></li>
                <li><a class="waves-effect" href="<?=RAIZ?>site/espacoaluno/agenda"><i class="material-icons">today</i>Agenda</a></li>
                <li><a class="waves-effect" href="#!"><i class="material-icons">attach_money</i>Financeiro</a></li>
                <li><div class="divider"></div></li>
                <li><a class="waves-effect" href="#!"><i class="material-icons">account_circle</i>Minha Conta</a></li>
                <li><a class="waves-effect" href="#!"><i class="material-icons">power_settings_new</i>Sair</a></li>
                <li><div class="divider"></div></li>
                <li><a class="waves-effect" href="#!"><i class="material-icons">arrow_back</i>Voltar ao Site</a></li>
            </ul>
            <div class="conteudo_espaco_aluno">