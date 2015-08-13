<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
	</head>
	<body>
		<?php
			session_start();
			include "config_upload.php";

			if(isset($_POST['enviar']))
			{
				$nome_arquivo=$_FILES['upload']['name'];  
				$tamanho_arquivo=$_FILES['upload']['size']; 
				$arquivo_temporario=$_FILES['upload']['tmp_name']; 
			}
				if (!empty($nome_arquivo))
				{
					if($sobrescrever=='não' && file_exists('$caminho/$nome_arquivo'))
						die('Arquivo já existe');

					if($limitar_tamanho=='sim' && ($tamanho_arquivo > $tamanho_bytes))  
						die("Arquivo deve ter o no máximo $tamanho_bytes bytes");
				$ext = strrchr($nome_arquivo,'.');
					if (($limitar_ext == 'sim') && !in_array($ext,$extensoes_validas))
						die('Extensão de arquivo inválida para upload');
					if (move_uploaded_file($arquivo_temporario, "imgs/$nome_arquivo"))
						{
							echo ' Upload do arquivo: '. $nome_arquivo.' foi concluído com sucesso.';
							$logo = "imgs/$nome_arquivo";	
							echo "<img src='$logo'></img>";
						}
				}
		
		?>
		<form name='cadastro' action='upload.php' method='post' enctype='multipart/form-data'>
			<table>
				<tr>
					<td>Upload de Arquivo</td>
				</tr>
				<tr>
				<tr>
					<td><input type='file' name='upload' /></td>
				</tr>
				<tr>
					<td class='botao2'><input type='submit' name='enviar' value='Enviar'/></td>
				</tr>
			</table>
		</form>
	</body>
</html>
