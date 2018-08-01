$(".linha_cadastro_visualizar").click(function () {
	var id = $(this).find(".id_hidden").val();
	var cadtype = $(this).parents("table").find(".cad_hidden").val();
	if (!id) {
		return false;
	}

	window.location = RAIZ+cadtype+"/"+id;
});

$("#btn_ativar_cadastro").click(function () {
	var id = $(this).parent("form").find(".id_form").val();
	var cadtype = $(this).parent("form").find(".cad_hidden").val();

	window.location = RAIZ+cadtype+"/ativar/"+id;
});

$("#btn_desativar_cadastro").click(function () {
	var id = $(this).parent("form").find(".id_form").val();
	var cadtype = $(this).parent("form").find(".cad_hidden").val();

	window.location = RAIZ+cadtype+"/desativar/"+id;
});

$("#btn_excluir_cadastro").click(function () {
	var id = $(this).parent("form").find(".id_form").val();
	var cadtype = $(this).parent("form").find(".cad_hidden").val();

	window.location = RAIZ+cadtype+"/excluir/"+id;
});