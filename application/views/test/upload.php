<!DOCTYPE html>
<html>
<head>
	<title>Teste de Upload de Material</title>
</head>
<body>
	<form action="<?=RAIZ?>sistema/Biblioteca/compareInputFile/pdf" method="post" enctype="multipart/form-data">
		<input type="file" name="pdf[]" id="pdf" />
		<input type="submit" name="envia" value="Enviar" />
	</form>
</body>
</html>