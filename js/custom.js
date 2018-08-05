$(document).ready(function(){
	$('.sidenav').sidenav();
	$('select').formSelect();

	initMasks();
});

function initMasks()
{
	$(".phone_mask").mask("(00)0000-00000");
	$(".date_mask").mask("00/00/0000");
	$(".cpf_mask").mask("000.000.000-00");
	$(".cep_mask").mask("00000-000");
}