
<?php

require('func.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");

$title = 'OPManga - Read one piece manga online.'; 
$og_desc = 'Read one piece manga online.'; 
$og_img = 'opmanga.herokuapp.com/assets/img/icons.png'; 
$og_url = "https://opmanga.herokuapp.com/index.php";
if(isset($_GET['page'])){
	$p = $_GET['page'];
	if($p == 'view'){
		$og_url .= "?page=$p";
		if(isset($_GET['judul']) &&  isset($_GET['link'])){
			$judul = d_url($_GET['judul']);
			$link = d_url($_GET['link']);
			//echo $link;
			$judul = trim($judul);
			//$link = $_GET['link'];
			$list_manga = list_manga($link);
			$_judul = urlencode($judul);
			$_link = urlencode($link);
			$og_url .= "&judul=".e_url($judul)."&link=".e_url($link);
			$title = 'OPManga - '.$judul; 
			$og_desc = 'Read one piece manga online. '.$judul; 
			$og_img = $list_manga[0]; 
		}
	}else{
		$og_url .= "?page=$p";
		if(isset($_GET['judul']) &&  isset($_GET['link'])){
			$judul = d_url($_GET['judul']);
			$link = d_url($_GET['link']);

			$judul = trim($judul);
			$list_anime = list_anime($link);
			$_judul = urlencode($judul);
			$_link = urlencode($link);
			$og_url .= "&judul=".e_url($judul)."&link=".e_url($link);
			$title = 'OPManga - Stream One Piece | '.$judul; 
			$og_desc = 'Read one piece manga online. '.$judul; 
			$og_img = "https://www.oploverz.in/wp-content/uploads/2015/09/Screenshot_1.jpg";
		}

		if($p == "view_anime2"){

		}
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#3C9CCD">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#3C9CCD">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#3C9CCD">
    <meta property="og:url"           content="<?= $og_url; ?>" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="<?= $title; ?>" />
  	<meta property="og:description"   content="<?= $og_desc; ?>" />
  	<meta property="og:image"         content="<?= $og_img; ?>" />
	<title><?= $title; ?></title>
	<link rel="shortcut icon" href="assets/img/icons.png" type="image/x-icon"/>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.css">
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
	<div class="container header-main">
		<a href="index.php"><h1><span class="color-yellow">O</span>PMANGA</h1></a>
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
				        <li id="link-menu-home" class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
			      	</ul>
		      	</div>
	    	</div><!-- /.navbar-collapse -->
	  	</div><!-- /.container-fluid -->
	</nav>
	<div class="container body-main">
	<?php

		$file = scandir(".");
		unset($file[0], $file[1]);
		if(isset($_GET['page'])){
			$q = $_GET['page'];
			$p = $q.".php";
			if(in_array($p, $file)){
				include $p;
			}else{
				include "404.php";
			}
		}else{
			include "home.php";
		}
	?>
	</div>
	<div class="footer">
		<div class="container">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 footer-left">
						<h1><span class="color-yellow">O</span>PMANGA</h1>
						<p>Powered by <a href="http://heroku.com/" target="blank">heroku</a></p>
					</div>
					<div class="col-xs-6 social-btn text-right">				
						<a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($og_url); ?>', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes')" title="Facebook">
							<div class="btn-social">
								<i class="fa fa-facebook"></i>
							</div>
						</a>
						<a href="javascript:void(0)" onclick="window.open('https://twitter.com/share?url=<?= urlencode($og_url); ?>', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes')" title="Twitter">
							<div class="btn-social">
								<i class="fa fa-twitter"></i>
							</div>
						</a>
						<a href="https://github.com/WillyXevo/OPManga" target="blank" title="Github">
							<div class="btn-social">
								<i class="fa fa-github"></i>
							</div>
						</a>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".dataTable").DataTable( {
			  	"ordering": false
			});
		});
	</script>
</body>
</html>