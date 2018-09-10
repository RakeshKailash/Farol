var sticky
;

$(document).ready(function() {
	handleStickyHeader();
	$('.m_dd_trigger').dropdown({
		constrainWidth: false,
		coverTrigger: false,
		hover: true
	});

	sticky = $("#cabecalho").offset().top + 40;
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