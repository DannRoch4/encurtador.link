<?php
ob_start();
session_start();
require_once 'db.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="styles.css"/>

<head>
<!-- menu link "Encurtador" -->
	<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Encurtador</a>
</nav>
<!-- Titulo pagina browser -->
	<title>Encurtador de Link</title>
</head>
<!-- Texto pagina "Painel de controle"-->
<body>
	<div class="container">
		<h1><b>Painel de Controle</b></h1>
		<img src="enclogoi.png">
	</div>
<!-- Simbolo Inter imagem-->


<div id="main" style="text-align: left;">

	<?php
	if(isset($_GET['out']))
	{
		session_destroy();
		session_unset();
		header("Location: admin.php");
		exit;
	}

	if(!isset($_SESSION['admin']) OR $_SESSION['admin'] != 'xyz0')
	{
	if(isset($_POST['sb']))
	{
		$u = trim(strip_tags($_POST['u']));
		$p = trim(strip_tags($_POST['p']));
		$u = addslashes($u);
		$p = addslashes($p);

		if($u == ADMIN AND $p = PASSWORD)
		{
			$_SESSION['admin'] = 'xyz0';
			session_regenerate_id();
			header("Location: admin.php");
			exit;
		}else{
			print '<h3>Login incorreto!</h3>';
		}

	}

	?>
	<form method="post">
		Usuário : <br/>
		<input type="text" name="u"/><br/>
		Senha : <br />
		<input type="password" name="p"/><br/>
		<input type="submit" name="sb" value="Login" />
	</form>

	<?php
	}else{
		if(isset($_GET['delID']))
		{
			$id = intval($_GET['delID']);
			mysql_query("DELETE FROM enclinks WHERE linkID = $id") or die(mysql_error());
			header("Location: admin.php");
			exit;
		}

		print '<a href="?out=logout">Sair!</a><br/><hr/><br/>';
		$rs = mysql_query("SELECT * FROM enclinks ORDER BY linkID DESC");
		if(mysql_num_rows($rs))
		{
// Menus de dados do link
			?>
			<h3>Você tem um total de <em><?php print mysql_num_rows($rs); ?></em> link(s) encurtados</h3>
			<table width="640">
				<tr style="font-weight: bold">
					<td width="250">Link Original</td>
					<td width="200">Link Encurtado</td>
					<td width="100">Data/Hora</td>
					<td width="70">IP</td>
					<td width="20">Excluir</td>
				</tr>
			<?php
			$i = 0;
			while ($row=mysql_fetch_object($rs)) {
				$i++;
				if ($i % 2 != 0)
				{
			    	$rowColor = "#e9e9e9";
				}else{
			    	$rowColor = "#cccccc";
				}
				print '<tr bgcolor="'.$rowColor.'">
					  <td><a href="'.$row->destination.'" target="_blank">
					  	'.wordwrap($row->destination, 40, '<br/>', true).'
					  	 </a>
					  <td><a href="r.php?short='.$row->string.'" target="_blank">localhost/enc/r.php?short='.$row->string.'</a></td>
					  <td>'.date('d/m/Y H:iA', $row->added).'</td>
					  <td>'.long2ip($row->ip).'</td>
					  <td><a href="?delID='.$row->linkID.'">[x]</a></td>
					  </tr>';
			}
			?>
			</table>
			<?php
		}
	}
	?>

</div>

</body>
</html>
<?php ob_end_flush(); ?>
