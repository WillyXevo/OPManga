
<style>
	.nav_bottom{
		padding: 0;
	}
	.nav_bottom>.col-xs-4{
		padding: 0;
	}
	.btn-nav-bottom{
		width: 100%;
		padding: 10px 0;
	}

	.btn-seb{
		border-radius: 4px 0px 0px 4px;
		-moz-border-radius: 4px 0px 0px 4px;
		-webkit-border-radius: 4px 0px 0px 4px;
	}
	.btn-lis{
		border-radius:0;
	}
	.btn-nex{
		border-radius: 0px 4px 4px 0px;
		-moz-border-radius: 0px 4px 4px 0px;
		-webkit-border-radius: 0px 4px 4px 0px;
	}
	@media (min-width: 320px) and (max-width: 480px) {
		.btn-nav-bottom{
			font-size: 0.8em;
		}
	}
</style>
<?php if(isset($_GET['id'])): 

	$id = (int)$_GET['id'];
	$data_anime = json_decode(file_get_contents("anime.json"), true);
	//$data_anime = array_reverse($data_anime);
	$data = $data_anime[$id];

	$seb = (int)$id-1;
	$nex = (int)$id+1;
	$dis = ($seb<0)?'disabled':'';

	$judul = trim($data['judul']);
	if(strlen($judul) < 8){
		$judul = trim($data['eps']);
	}else{
		$judul = trim($data['eps']).", ".trim($data['judul']);
	}
?>
<h2><?= $judul; ?></h2>
<br><br>
<iframe style="width:100%; height:500px;" src="<?= $data['video']; ?>" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe" __idm_frm__="1931"></iframe>
<div id="video"></div>
<br><br>
<div class="container nav_bottom">
	<div class="col-xs-4">
		<a href="index.php?page=view_anime2&id=<?= $seb; ?>" class="btn btn-success btn-nav-bottom btn-seb <?= $dis; ?>">	
			Episode Sebelumnya
		</a>
	</div>

	<div class="col-xs-4">
		<a href="index.php?p=anime2" class="btn btn-warning btn-nav-bottom btn-lis">List Episode</a>
	</div>
	<div class="col-xs-4">
		<a href="index.php?page=view_anime2&id=<?= $nex; ?>" class="btn btn-success btn-nav-bottom btn-nex">
			Episode Berikutnya
		</a>
	</div>
</div>
<br><br>
<?php endif; ?>


<!-- 
-->