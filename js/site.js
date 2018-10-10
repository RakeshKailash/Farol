var sticky
;

$(document).ready(function() {
	$("body.full_size").css("height", $("html").height()+"px");

	initSlider();

	$('.m_dd_trigger').dropdown({
		constrainWidth: false,
		coverTrigger: false,
		hover: true
	});

	$(".tabs_curso").tabs({swipeable: true});
	$('.material_aluno').tooltip({outDuration: 0, exitDelay: 0});
	$('.tooltiped[data-tooltip]').tooltip({outDuration: 0, exitDelay: 0, margin: -10});

	if ($("#cabecalho").length) {
		sticky = $("#cabecalho").offset().top + 40;
		if ($("#caminhodepao").length) {
			sticky = 90;
		}
		
		handleStickyHeader();
	}

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

	$.each($(".material_aluno > .icone_material"), function () {
		var $img = jQuery(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		jQuery.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');

                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                	$svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                	$svg = $svg.attr('class', imgClass+' replaced-svg');
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                $svg.css("fill", getRandomColor());

                // Replace image with new SVG
                $img.replaceWith($svg);

            }, 'xml');
		// $(this).css("fill", getRandomColor());
	})
	
	$("#alunos_visualizar_table").on("click", ".linha_agenda_expandir", function () {
		var data_id = $(this).data('id');
		$(".linha_info_agenda[data-id='"+data_id+"']").toggleClass("hide");
	});

	$(".row_espaco_aluno").on("click", ".card", function () {
		console.log("foi");
		var idinscricao = $(this).data("insc");

		if (idinscricao) {
			window.location = RAIZ+"site/espacoaluno/curso/"+idinscricao;
		}
	});
});

$(document).on("scroll", function() {
	handleStickyHeader();
});

function initSlider() {
	var size = $("#imagens_slider").find("a").length
	, current = 0
	, timer
	, proximo
	, generica
	;

	for (var i = 0; i < size; i++) {
		$("#controles").append("<span class='controle'></span>");
	}

	$("#imagens_slider").find("a").eq(0).addClass("current");
	$("#controles").find(".controle").eq(0).addClass("current");

	function troca(num) {
		current = $("#imagens_slider").find("a.current").index();
		
		$("#imagens_slider").find("a").removeClass('current');
		$("#controles").find(".controle").removeClass("current");

		if (num == "+") {
			proximo = current + 1;
			generica = 0;
		}

		if (num == "-") {
			proximo = current - 1;
			generica = size - 1;
		}

		if (num != "+" && num != "-") {
			proximo = num;
			generica = 0;
		}
		
		if ($("#imagens_slider").find("a").eq(proximo).length) {
			$("#imagens_slider").find("a").eq(proximo).addClass("current");
			$("#controles").find(".controle").eq(proximo).addClass("current");
		} else {
			$("#imagens_slider").find("a").eq(generica).addClass("current");
			$("#controles").find(".controle").eq(generica).addClass("current");
		}
	}

	function ligaSlider() {
		timer = window.setInterval(function () {
			troca("+");
		}, 10000);
	}

	function resetaSlider() {
		clearInterval(timer);
		ligaSlider();
	}

	$("#proxima_img").click(function () {
		troca("+");
		resetaSlider();
	});

	$("#anterior_img").click(function () {
		troca("-");
		resetaSlider();
	});

	$("#controles > .controle").click(function() {
		var controle_num = $(this).index();
		troca(controle_num);
		resetaSlider();
	});

	// Inicia tudo
	ligaSlider();
}

function getRandomColor() {
	var letters = '56789ABCD';
	var color = '#';
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 8)];
	}
	return color;
}

function handleStickyHeader() {
	if ($(document).scrollTop() >= sticky && ($("html").height() - $(window).innerHeight()) >= sticky) {
		if (!$("#cabecalho").hasClass('sticky')) {
			$("#cabecalho").addClass("sticky");
		}

		if (!$("#menu_topo").hasClass('sticky')) {
			$("#menu_topo").addClass("sticky");
		}

		if (!$("body").hasClass("sticky")) {
			$("body").addClass("sticky");
		}

		return;
	}

	$("#cabecalho").removeClass("sticky");
	$("#menu_topo").removeClass("sticky");
	$("body").removeClass("sticky");
}