var sticky
;

$(document).ready(function() {
	$('.m_dd_trigger').dropdown({
		constrainWidth: false,
		coverTrigger: false,
		hover: true
	});

	sticky = $("#cabecalho").offset().top + 40;
	if ($("#caminhodepao").length) {
		sticky = 200;
	}
	handleStickyHeader();

	var count_l = 1;

	$.each($(".linha_agenda_expandir"), function () {
		var data_id = $(this).data('id');
		if (count_l > 2) {
			count_l = 1;
		}
		if (count_l < 2) {
			$(this).css("background", "#E6DBEC");
			$(".linha_info_agenda[data-id='"+data_id+"']").css("background", "#E6DBEC");
		} else {
			$(this).css("background", "#eeeeee");
			$(".linha_info_agenda[data-id='"+data_id+"']").css("background", "#eeeeee");
		}
		count_l++;

	});
	
	$("#alunos_visualizar_table").on("click", ".linha_agenda_expandir", function () {
		var data_id = $(this).data('id');
		$(".linha_info_agenda[data-id='"+data_id+"']").toggleClass("hide");
	});
});

$(document).on("scroll", function() {
	handleStickyHeader();
});

function handleStickyHeader() {
	if ($(document).scrollTop() >= sticky && $("html").height() >= 732) {
		if (!$("#cabecalho").hasClass('sticky')) {
			$("#cabecalho").addClass("sticky");
		}

		if (!$("#menu_topo").hasClass('sticky')) {
			$("#menu_topo").addClass("sticky");
		}

		return;
	}

	$("#cabecalho").removeClass("sticky");
	$("#menu_topo").removeClass("sticky");
}