<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Backup and restore</title>
</head>
<body>
	<a href="../../controller/backup.php">Realizar copia de seguridad</a>
	<form action="../../controller/restore.php" method="POST" enctype="multipart/form-data">
		<label>Subir archivo para restauración</label><br>
		<input type="file" name="restoreFile" accept=".sql" required>
		<button type="submit">Restaurar</button>
	</form>
</body>
</html>
