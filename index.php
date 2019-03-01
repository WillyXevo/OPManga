
<?php

require('../vidurl/simplehtmldom/simple_html_dom.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OPMANGA</title>
	<link rel="shortcut icon" href="assets/img/icons.png" type="image/x-icon"/>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	
</head>
<body>
	<div class="container header-main">
		<h1><span class="color-yellow">O</span>PMANGA</h1>
	</div>
	<nav class="navbar navbar-inverse navbar-main">
  		<div class="container-fluid">
	    	<!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		     	 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</button>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<div class="container">
			      	<ul class="nav navbar-nav">
				        <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
			      	</ul>
		      	</div>
	    	</div><!-- /.navbar-collapse -->
	  	</div><!-- /.container-fluid -->
	</nav>
	<div class="container body-main">
	<?php
		$file = scandir(".");
		unset($file[0], $file[1]);
		if(isset($_GET['p'])){
			$p = $_GET['p'].".php";
			if(in_array($p, $file)){
				include $p;
			}
		}else{
			include "home.php";
		}
	?>
	</div>
    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>