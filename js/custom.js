var datepickeri = {
	'cancel' : "Cancelar",
	'clear' : "Limpar",
	'months' : [
	'Janeiro',
	'Fevereiro',
	'Março',
	'Abril',
	'Maio',
	'Junho',
	'Julho',
	'Agosto',
	'Setembro',
	'Outubro',
	'Novembro',
	'Dezembro'
	],
	'monthsShort' : [
	'Jan',
	'Fev',
	'Mar',
	'Abr',
	'Mai',
	'Jun',
	'Jul',
	'Ago',
	'Set',
	'Out',
	'Nov',
	'Dez'
	],
	'weekdays' : [
	'Domingo',
	'Segunda',
	'Terça',
	'Quarta',
	'Quinta',
	'Sexta',
	'Sábado'
	],
	'weekdaysShort' : [
	'Dom',
	'Seg',
	'Ter',
	'Qua',
	'Qui',
	'Sex',
	'Sab'
	],
	'weekdaysAbbrev' : ['D','S','T','Q','Q','S','S']
}, timepickeri = {
	'cancel' : "Cancelar",
	'clear' : "Limpar",
	'done' : "Ok"
};

$(document).ready(function(){
	$('.sidenav').sidenav();
	$('select').formSelect();
	$('.dropdown-trigger').dropdown();
	$('.dd_trigger_busca').dropdown({
		constrainWidth: false,
		onCloseEnd: function () {
			$(".search_input").focus();
		}
	});
	
	initPickers();
	initMasks();
});

function initPickers()
{
	$('.datepicker').datepicker({
		'format' : 'dd/mm/yyyy',
		'i18n' : datepickeri
	});
	$('.timepicker').timepicker({'twelveHour' : false, 'i18n' : timepickeri, 'showClearBtn' : true});
}

function initMasks()
{
	$(".phone_mask").mask("(00)0000-00000");
	$(".date_mask").mask("00/00/0000");
	$(".cpf_mask").mask("000.000.000-00");
	$(".cep_mask").mask("00000-000");
	$(".money_mask").mask('#.##0,00', {reverse: true});
}