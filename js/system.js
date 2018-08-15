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
	var pagamento_html = "<div class='form_group col s12 linha_pagamento_turma'>";
	pagamento_html += "<div class='col s3 col_tipo'>";
	pagamento_html += "<label>Forma</label>";
	pagamento_html += "<div class='input-field'>";
	pagamento_html += "<select name='forma[]' class='select_tipo_investimento'>";
	pagamento_html += "<option value='1'>À vista</option>";
	pagamento_html += "<option value='2'>À prazo</option>";
	pagamento_html += "<option value='3'>Cartão</option>";
	pagamento_html += "</select>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	pagamento_html += "<div class='col s4 col_total'>";
	pagamento_html += "<label>Total</label>";
	pagamento_html += "<div class='input-field'>";
	pagamento_html += "<input type='text' class='money_mask' name='total[]'>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	pagamento_html += "<div class='col s1 col_parcelas hide'>";
	pagamento_html += "<label>Parcelas</label>";
	pagamento_html += "<div class='input-field'>";
	pagamento_html += "<input type='text' name='parcelas[]'>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	pagamento_html += "<div class='col s2 col_val_parcelas hide'>";
	pagamento_html += "<label>Valor das parcelas</label>";
	pagamento_html += "<div class='input-field'>";
	pagamento_html += "<input type='text' class='money_mask' name='valor_parcela[]'>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	pagamento_html += "<div class='col s2 col_dia_vencimento hide'>";
	pagamento_html += "<label>Dia de vencimento</label>";
	pagamento_html += "<div class='input-field'>";
	pagamento_html += "<input type='text' name='dia_vencimento[]'>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	pagamento_html += "<div class='col s4 col_vencimento'>";
	pagamento_html += "<label>Vencimento</label>";
	pagamento_html += "<div class='input-field'>";
	pagamento_html += "<input type='text' placeholder='00/00/0000' class='date_mask' name='data_vencimento[]'>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	pagamento_html += "<div class='col s1'>";
	pagamento_html += "<i class='material-icons exclui_item_linha'>close</i>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	$(".investimentos_turma").append(pagamento_html);
	$('select').formSelect();
	initMasks();
});

$(".btn_novo_dia_evento").click(function () {
	var dia_html = "<div class='row dias_aulas_linha'>";
	dia_html += "<div class='form_group col s12'>";
	dia_html += "<div class='col s5'>";
	dia_html += "<p>Início</p>";
	dia_html += "<div class='col s6'>";
	dia_html += "<label>Dia</label>";
	dia_html += "<div class='input-field'>";
	dia_html += "<input type='text' name='data_inicio[]' class='datepicker'>";
	dia_html += "</div>";
	dia_html += "</div>";
	dia_html += "<div class='col s6'>";
	dia_html += "<label>Início</label>";
	dia_html += "<div class='input-field'>";
	dia_html += "<input type='text' name='hora_inicio[]' class='timepicker'>";
	dia_html += "</div>";
	dia_html += "</div>";
	dia_html += "</div>";
	dia_html += "<div class='col s4'>";
	dia_html += "<p>Pausa (opcional)</p>";
	dia_html += "<div class='col s6'>";
	dia_html += "<label>Das</label>";
	dia_html += "<div class='input-field'>";
	dia_html += "<input type='text' name='almoco_inicio[]' class='timepicker'>";
	dia_html += "</div>";
	dia_html += "</div>";
	dia_html += "<div class='col s6'>";
	dia_html += "<label>Até as</label>";
	dia_html += "<div class='input-field'>";
	dia_html += "<input type='text' name='almoco_fim[]' class='timepicker'>";
	dia_html += "</div>";
	dia_html += "</div>";
	dia_html += "</div>";
	dia_html += "<div class='col s3'>";
	dia_html += "<p>Término</p>";
	dia_html += "<div class='col s6'>";
	dia_html += "<label>Hora</label>";
	dia_html += "<div class='input-field'>";
	dia_html += "<input type='text' name='hora_fim[]' class='timepicker'>";
	dia_html += "</div>";
	dia_html += "</div>";
	dia_html += "</div>";
	dia_html += "<div class='col s1'>";
	dia_html += "<i class='material-icons exclui_item_linha'>close</i>";
	dia_html += "</div>";
	dia_html += "</div>";
	dia_html += "</div>";
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
	$.each($('.select_tipo_investimento'), function () {
		console.log("rolou");
		handleFormaPagamento($(this));
	});

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

function handleFormaPagamento(e)
{
	var select_tipo = $(e);
	var linha = $(select_tipo).parents(".linha_pagamento_turma").first();
	switch($(select_tipo).val()) {
		case "1":
		investimentoVista(linha);
		break;
		case "2":
		investimentoPrazo(linha);
		break;
		case "3":
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

function investimentoPrazo(linha)
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