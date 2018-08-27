Number.prototype.format = function(c, d, t){
	var n = this, 
	c = isNaN(c = Math.abs(c)) ? 2 : c, 
	d = d == undefined ? "." : d, 
	t = t == undefined ? "," : t, 
	s = n < 0 ? "-" : "", 
	i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
	j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

function getHtmlInvestimento(investimento) {

	if (investimento == null) {
		investimento = {
			forma: 1,
			parcelas: "",
			valor_parcela: "",
			total: "",
			dia_vencimento: "",
			data_vencimento: ""
		};
	}

	var selected = ["", "", "", ""];
	selected[(investimento.forma-1)] = "selected";

	var investimento_html = "<div class='form_group col s12 linha_pagamento_turma'>";
	investimento_html += "<div class='col s3 col_tipo'>";
	investimento_html += "<label>Forma</label>";
	investimento_html += "<div class='input-field'>";
	investimento_html += "<select name='forma[]' class='select_tipo_investimento'>";
	investimento_html += "<option "+selected[0]+" value='1'>À vista</option>";
	investimento_html += "<option "+selected[1]+" value='2'>Parcelas</option>";
	investimento_html += "<option "+selected[2]+" value='3'>Mensalidade</option>";
	investimento_html += "<option "+selected[3]+" value='4'>Cartão</option>";
	investimento_html += "</select>";
	investimento_html += "</div>";
	investimento_html += "</div>";
	investimento_html += "<div class='col s4 col_total'>";
	investimento_html += "<label>Total</label>";
	investimento_html += "<div class='input-field'>";
	investimento_html += "<input type='text' class='money_mask' name='total[]' value='"+investimento.total+"'>";
	investimento_html += "</div>";
	investimento_html += "</div>";
	investimento_html += "<div class='col s1 col_parcelas hide'>";
	investimento_html += "<label>Parcelas</label>";
	investimento_html += "<div class='input-field'>";
	investimento_html += "<input type='text' name='parcelas[]' value='"+investimento.parcelas+"'>";
	investimento_html += "</div>";
	investimento_html += "</div>";
	investimento_html += "<div class='col s2 col_val_parcelas hide'>";
	investimento_html += "<label>Valor das parcelas</label>";
	investimento_html += "<div class='input-field'>";
	investimento_html += "<input type='text' class='money_mask' name='valor_parcela[]' value='"+investimento.valor_parcela+"'>";
	investimento_html += "</div>";
	investimento_html += "</div>";
	investimento_html += "<div class='col s2 col_dia_vencimento hide'>";
	investimento_html += "<label>Dia de vencimento</label>";
	investimento_html += "<div class='input-field'>";
	investimento_html += "<input type='text' name='dia_vencimento[]' value='"+investimento.dia_vencimento+"'>";
	investimento_html += "</div>";
	investimento_html += "</div>";
	investimento_html += "<div class='col s4 col_vencimento'>";
	investimento_html += "<label>Vencimento</label>";
	investimento_html += "<div class='input-field'>";
	investimento_html += "<input type='text' placeholder='00/00/0000' class='date_mask' name='data_vencimento[]' value='"+investimento.data_vencimento+"'>";
	investimento_html += "</div>";
	investimento_html += "</div>";
	investimento_html += "<div class='col s1'>";
	investimento_html += "<i class='material-icons exclui_item_linha'>close</i>";
	investimento_html += "</div>";
	investimento_html += "</div>";

	return investimento_html;
}

function getHtmlDias() {
	var dias_html = "<div class='row dias_aulas_linha'>";
	dias_html += "<div class='form_group col s12'>";
	dias_html += "<div class='col s5'>";
	dias_html += "<p>Início</p>";
	dias_html += "<div class='col s6'>";
	dias_html += "<label>Dia</label>";
	dias_html += "<div class='input-field'>";
	dias_html += "<input type='text' name='data_inicio[]' class='datepicker'>";
	dias_html += "</div>";
	dias_html += "</div>";
	dias_html += "<div class='col s6'>";
	dias_html += "<label>Início</label>";
	dias_html += "<div class='input-field'>";
	dias_html += "<input type='text' name='hora_inicio[]' class='timepicker'>";
	dias_html += "</div>";
	dias_html += "</div>";
	dias_html += "</div>";
	dias_html += "<div class='col s4'>";
	dias_html += "<p>Pausa (opcional)</p>";
	dias_html += "<div class='col s6'>";
	dias_html += "<label>Das</label>";
	dias_html += "<div class='input-field'>";
	dias_html += "<input type='text' name='almoco_inicio[]' class='timepicker'>";
	dias_html += "</div>";
	dias_html += "</div>";
	dias_html += "<div class='col s6'>";
	dias_html += "<label>Até as</label>";
	dias_html += "<div class='input-field'>";
	dias_html += "<input type='text' name='almoco_fim[]' class='timepicker'>";
	dias_html += "</div>";
	dias_html += "</div>";
	dias_html += "</div>";
	dias_html += "<div class='col s3'>";
	dias_html += "<p>Término</p>";
	dias_html += "<div class='col s6'>";
	dias_html += "<label>Hora</label>";
	dias_html += "<div class='input-field'>";
	dias_html += "<input type='text' name='hora_fim[]' class='timepicker'>";
	dias_html += "</div>";
	dias_html += "</div>";
	dias_html += "</div>";
	dias_html += "<div class='col s1'>";
	dias_html += "<i class='material-icons exclui_item_linha'>close</i>";
	dias_html += "</div>";
	dias_html += "</div>";
	dias_html += "</div>";

	return dias_html;
}

function handleInvestimentos() {
	$.each($('.select_tipo_investimento'), function () {
		handleFormaPagamento($(this));
	});
}

function setInvestimentosSelectOnly() {
	$(".linha_pagamento_turma").find("input, select").prop("disabled", "disabled");
	$(".linha_pagamento_turma").addClass("select-only");
	$(".linha_pagamento_turma").find(".exclui_item_linha").parent(".col.s1").addClass("select_investimento");
}

function getInvestimentoOpcoes(investimento) {
	// if (!investimento) {
	// 	return null;
	// }

	var texto_investimento = "";
	var html_investimento = "";

	if (investimento.forma == 1) {
		texto_investimento = "À vista: <b>R$"+investimento.total_formatado+"</b> (pagamento até o dia "+investimento.data_vencimento+")";
	}

	if (investimento.forma == 2) {
		texto_investimento = "Parcelado: <b>R$"+investimento.total_formatado+"</b> em até "+investimento.parcelas+"x de R$"+investimento.valor_parcela;
	}

	if (investimento.forma == 3) {
		texto_investimento = "Mensalidades: <b>R$"+investimento.total_formatado+"</b> em "+investimento.parcelas+"x de R$"+investimento.valor_parcela+" (vencimento todo dia "+investimento.dia_vencimento+")";
	}

	if (investimento.forma == 4) {
		texto_investimento = "Cartões: <b>R$"+investimento.total_formatado+"</b> em até 12x nos principais cartões (PagSeguro)";
	}

	// html_investimento = "<div class='linha_pagamento_turma linha_pagamento_inscricao'>";
	html_investimento = "<p><label>";
	html_investimento += "<input class='with-gap' name='forma_investimento' type='radio' value='"+investimento.forma+"' />";
	html_investimento += "<span>"+texto_investimento+"</span>";
	html_investimento += "</label></p>";

	if (investimento.forma == 2) {
		html_investimento += "<div class='input-field'><select class='parcelas_select' name='parcelas'>";
		for (var i=1;i<=investimento.parcelas;i++) {
			html_investimento += "<option value='"+i+"'>"+i+"x de R$"+(investimento.total/i)+"</option>";
		}
		html_investimento += "</select></div>";
	}

	return html_investimento;

}

$(".linha_cadastro_visualizar").click(function () {
	var id = $(this).find(".id_hidden").val();
	var cadtype = $(this).parents("table").find(".cad_hidden").val();
	if (!id) {
		return false;
	}

	window.location = RAIZ+"sistema/"+cadtype+"/"+id;
});

$("#btn_ativar_cadastro").click(function () {
	var id = $(this).parent("form").find(".id_form").val();
	var cadtype = $(this).parent("form").find(".cad_hidden").val();

	window.location = RAIZ+"sistema/"+cadtype+"/ativar/"+id;
});

$("#btn_desativar_cadastro").click(function () {
	var id = $(this).parent("form").find(".id_form").val();
	var cadtype = $(this).parent("form").find(".cad_hidden").val();

	window.location = RAIZ+"sistema/"+cadtype+"/desativar/"+id;
});

$("#btn_excluir_cadastro").click(function () {
	var id = $(this).parent("form").find(".id_form").val();
	var cadtype = $(this).parent("form").find(".cad_hidden").val();

	window.location = RAIZ+"sistema/"+cadtype+"/excluir/"+id;
});

$(".btn_novo_investimento").click(function () {
	var pagamento_html = getHtmlInvestimento();
	$(".investimentos_turma").append(pagamento_html);
	$('select').formSelect();
	initMasks();
});

$(".btn_novo_dia_evento").click(function () {
	var dia_html = getHtmlDias();
	$(".dias_aula").append(dia_html);
	initPickers();
	initMasks();
});

$(".investimentos_turma").on("change", ".col_parcelas", function (e) {
	var linha = $(e.target).parents(".linha_pagamento_turma").first()
	, parcelas = $(e.target).closest("input").val()
	, total = $(linha).find(".col_total").find("input").val()
	, valor_parcelas = $(linha).find(".col_val_parcelas").find("input").val()
	;

	total = total.replace(/\./g, '');
	total = total.replace(/\,/g, '.');
	valor_parcelas = valor_parcelas.replace(/\,/g, '.');

	if (parcelas <= 0 || ((!$.isNumeric(total) || total <= 0) && (!$.isNumeric(valor_parcelas) || valor_parcelas <= 0)) ) {
		return;
	}

	if ($.isNumeric(total) && total >= 0) {
		valor_parcelas = total / parcelas;
		valor_parcelas = valor_parcelas.format(2, ',', '.');
		valor_parcelas = valor_parcelas.toString();

		$(linha).find(".col_val_parcelas").find("input").val(valor_parcelas);
		return;
	}

	total = parcelas * valor_parcelas;
	total = total.format(2, ',', '.');
	total = total.toString();

	$(linha).find(".col_total").find("input").val(total);
	initMasks();
	return;
});

$(".investimentos_turma").on("change", ".col_total", function (e) {
	var linha = $(e.target).parents(".linha_pagamento_turma").first()
	, total = $(e.target).closest("input").val()
	, parcelas = $(linha).find(".col_parcelas").find("input").val()
	, valor_parcelas
	;

	total = total.replace(/\./g, '');
	total = total.replace(/\,/g, '.');

	if (total <= 0 || parcelas <= 0) {
		return;
	}

	valor_parcelas = total / parcelas;
	valor_parcelas = valor_parcelas.format(2, ',', '.');
	valor_parcelas = valor_parcelas.toString();

	$(linha).find(".col_val_parcelas").find("input").val(valor_parcelas);
	initMasks();
	return;
});

$(".investimentos_turma").on("change", ".col_val_parcelas", function (e) {
	var linha = $(e.target).parents(".linha_pagamento_turma").first()
	, val_parcelas = $(e.target).closest("input").val()
	, num_parcelas = $(linha).find(".col_parcelas").find("input").val()
	, val_total
	;

	val_parcelas = val_parcelas.replace(/\./g, '');
	val_parcelas = val_parcelas.replace(/\,/g, '.');

	if (val_parcelas <= 0 || num_parcelas <= 0) {
		return;
	}

	val_total = num_parcelas * val_parcelas;
	val_total = val_total.format(2, ',', '.');
	val_total = val_total.toString();

	$(linha).find(".col_total").find("input").val(val_total);
	return;
});

$(".investimentos_turma").on("click", ".exclui_item_linha", function (e) {
	$(e.target).parents(".linha_pagamento_turma").first().remove();
	initMasks();
});

$(".dias_aula").on("click", ".exclui_item_linha", function (e) {
	$(e.target).parents(".dias_aulas_linha").first().remove();
	initMasks();
});

$(document).ready(function () {
	$(".t_editor").trumbowyg({
		lang: 'pt_br',
		removeformatPasted: true,
		btns: [
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'underline'],
        ['superscript', 'subscript'],
        ['link'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
        ]
    });

	$("p", $(".linha_info_agenda")).each(function() {
		if ($(this).html() != "") {
			$(this).addClass("spaced_p");
		}
	});

	handleInvestimentos();

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
	})

	$(".form_visualizar").find("input").attr('disabled', 'disabled');
	$(".form_visualizar").find("textarea").attr('disabled', 'disabled');
	$(".form_visualizar").find("select").attr('disabled', 'disabled');
});

$(".investimentos_turma").on("change", ".select_tipo_investimento", function (e) {
	handleFormaPagamento($(e.target));
});

$(".check_aula_unica").change(function () {
	$(".container_aula_unica").toggleClass("hide");
})

$("#form_sistema_inscricao").on("change", "#select_curso_inscricao", function () {
	var idcurso = $(this).val();
	
	if (!idcurso) {
		if ($("#select_turma_inscricao").prop("disabled") == false) {
			$("#select_turma_inscricao").attr("disabled","disabled");
			$("#select_turma_inscricao").formSelect();
		}
	}

	$(".opcao_turma_inscricao").removeAttr("disabled");
	$(".opcao_turma_inscricao[data-idcurso!='"+idcurso+"']").attr("disabled","disabled");
	
	if ($("#select_turma_inscricao").prop("disabled") != false) {
		$("#select_turma_inscricao").removeAttr("disabled");
	}

	$("#select_turma_inscricao").formSelect();
	$("#select_turma_inscricao").parent(".select-wrapper").find("li.disabled").addClass("hide");
});

$("#form_sistema_inscricao").on("change", "#select_turma_inscricao", function () {
	var idturma = $(this).val();

	if (idturma != null) {
		$(".btn_continuar_inscricao").removeAttr('disabled');
	} else {
		if ($(".btn_continuar_inscricao:disabled").length > 0) {
			$(".btn_continuar_inscricao").attr('disabled', 'disabled');
		}
	}

});

$("#form_sistema_inscricao").on("click", ".select_investimento", function () {
	
});

$("#form_sistema_inscricao").on("change","input[type='radio']", function () {
	if ($(this).val() == 2) {
		var invid = $(this).parents(".label_parcelamento_investimento").data('invid');
		$(".select_parcelas_investimento[data-invid='"+invid+"']").find("select").removeAttr('disabled').formSelect();
	} else {
		$(".select_parcelas_investimento").find("select").attr('disabled', 'disabled').formSelect();
	}

	if ($(".btn_salvar_investimento:disabled").length > 0) {
		$(".btn_salvar_investimento").removeAttr('disabled');
	}
});

function handleFormaPagamento(e)
{
	var select_tipo = $(e);
	var linha = $(select_tipo).parents(".linha_pagamento_turma").first();
	switch($(select_tipo).val()) {
		case "1":
		investimentoVista(linha);
		break;
		case "2":
		investimentoParcelas(linha);
		break;
		case "3":
		investimentoMensalidade(linha);
		break;
		case "4":
		investimentoCartao(linha);
		break;
	}
}

function investimentoVista(linha)
{
	$(linha).find(".col_tipo").removeClass().addClass("col_tipo col s3");
	$(linha).find(".col_total").removeClass().addClass("col_total col s4");
	$(linha).find(".col_vencimento").removeClass().addClass("col_vencimento col s4");
	
	$(linha).find(".col_parcelas").removeClass().addClass("col_parcelas hide");
	$(linha).find(".col_val_parcelas").removeClass().addClass("col_val_parcelas hide");
	$(linha).find(".col_dia_vencimento").removeClass().addClass("col_dia_vencimento hide");
}

function investimentoParcelas(linha)
{
	$(linha).find(".col_tipo").removeClass().addClass("col_tipo col s4");
	$(linha).find(".col_total").removeClass().addClass("col_total col s3");
	$(linha).find(".col_parcelas").removeClass().addClass("col_parcelas col s2");
	$(linha).find(".col_val_parcelas").removeClass().addClass("col_val_parcelas col s2");
	
	$(linha).find(".col_dia_vencimento").removeClass().addClass("col_dia_vencimento hide");
	$(linha).find(".col_vencimento").removeClass().addClass("col_vencimento hide");
}

function investimentoMensalidade(linha)
{
	$(linha).find(".col_tipo").removeClass().addClass("col_tipo col s3");
	$(linha).find(".col_total").removeClass().addClass("col_total col s3");
	$(linha).find(".col_parcelas").removeClass().addClass("col_parcelas col s1");
	$(linha).find(".col_val_parcelas").removeClass().addClass("col_val_parcelas col s2");
	$(linha).find(".col_dia_vencimento").removeClass().addClass("col_dia_vencimento col s2");
	
	$(linha).find(".col_vencimento").removeClass().addClass("col_vencimento hide");
}

function investimentoCartao(linha)
{
	$(linha).find(".col_tipo").removeClass().addClass("col_tipo col s6");
	$(linha).find(".col_total").removeClass().addClass("col_total col s5");
	
	$(linha).find(".col_parcelas").removeClass().addClass("col_parcelas hide");
	$(linha).find(".col_val_parcelas").removeClass().addClass("col_val_parcelas hide");
	$(linha).find(".col_dia_vencimento").removeClass().addClass("col_dia_vencimento hide");
	$(linha).find(".col_vencimento").removeClass().addClass("col_vencimento hide");
}