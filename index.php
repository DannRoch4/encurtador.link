<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css"/>
  	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
<link rel="shortcut icon" href="favicon.png"/>
	<title>Encurtador de Link</title>
	<script type="text/javascript">
		$(function()
		{
			$("#ajaxShorten").click(function() {

				$(this).hide();
				$("#load").show();
				$("#error").hide();

			 	$.post('ajax.php', {url : $("#longURL").val()}, function(data)
			 	{
			 		if(data.indexOf("http") == -1)
			 		{
			 			$("#error").show();
			 			$("#error").html(data);
			 		}else{
			 			$("#longURL").val(data);
			 		}
			 		$("#load").hide();
			 		$("#ajaxShorten").show();
			 	});
			});
		});
	</script>
</head>

<body>
  <nav class="navbar navbar-dark" style="background-color: #CC0000;">
<!-- Botão painel -->
    <div class="container">
      <img src="inter.png" width="30" height="30" alt="">
<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="admin.php">Painel</a>
</nav>
</div>
  </nav>
<title>Encurtador de Link</title>
<!-- Logo encurtador -->
<div class="container">
  <img src="enclogoi.png">
</div>
<div id="main">
	<div id="shorten">
		<input type="text" id="longURL" value="" onclick="if(this.value=='') { this.value = '';}else{this.select();}"/>
		<br/><br/><br/>
		<a href="javascript:void(0);" id="ajaxShorten" style="text-decoration: none;border:0">
			<img src="btn.png" alt="shorten button" border="0" />
		</a>
		<img src="ajax-loader.gif" id="load" style="display: none;" alt=""/>
	</div>

	<div style="display: none;position:relative;margin:0 auto; background-color:#cc0000;color:white;padding:10px;width:500px;font-size:18px;" id="error"></div>
<br>
<br>
<!-- Texto pós botao encurtar -->
  <h3>Encurte, compartilhe e acompanhe os seus seus links curtos com o encurtador de url</h3>
  <p><strong>Exemplo:</strong><br>URL Larga › https://olhardigital.com.br/games-e-consoles/noticia/playstation-5-patente-revela-design-do-novo-controle-do-ps5/93084<br>URL Curta › http://localhost/enc/r.php?short=Q<br></p>
<br>
<br>
<!-- Imagem infos -->

<div class="row">
  <div class="col-12">
<img class="img-fluid" src="inf.png">
</div>
</div>


</div>
<!-- Footer -->
</body>
<nav class="navbar navbar-light" style="background-color: #000000;">
<footer class="page-footer font-small #CC0000">
  <div class="footer-copyright text-center py-3">© 2019 Copyright:
    <a href=""> Daniel </a><img src="inter.png" width="20" height="20"/>
  </div>
</footer>
</nav>
</html>
