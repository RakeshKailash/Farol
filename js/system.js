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
	pagamento_html += "<div class='col s4'>";
	pagamento_html += "<label>Tipo</label>";
	pagamento_html += "<div class='input-field'>";
	pagamento_html += "<select name='tipo[]'>";
	pagamento_html += "<option value='1'>À vista</option>";
	pagamento_html += "<option value='2'>À prazo</option>";
	pagamento_html += "<option value='3'>Cartão</option>";
	pagamento_html += "</select>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	pagamento_html += "<div class='col s4'>";
	pagamento_html += "<label>Total</label>";
	pagamento_html += "<div class='input-field'>";
	pagamento_html += "<input type='text' class='money_mask' name='total[]'>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	pagamento_html += "<div class='col s3'>";
	pagamento_html += "<label>Vencimento</label>";
	pagamento_html += "<div class='input-field'>";
	pagamento_html += "<input type='text' placeholder='00/00/0000' class='date_mask' name='data_vencimento[]'>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	pagamento_html += "<div class='col s1'>";
	pagamento_html += "<i class='material-icons exclui_forma_pagamento'>close</i>";
	pagamento_html += "</div>";
	pagamento_html += "</div>";
	$(".investimentos_turma").append(pagamento_html);
	$('select').formSelect();
})