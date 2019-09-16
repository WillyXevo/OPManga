<?php

?>
<h2><?= $judul; ?></h2>
<br><br>
<iframe style="width:100%; height:500px;" src="<?= $list_anime['video']; ?>" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe" __idm_frm__="1931"></iframe>
<br><br>
<h3>Download</h3>

<?php
	foreach ($list_anime['download'] as $k => $v) {
?>
<div class="panel panel-primary">
  	<div class="panel-heading">
    	<h3 class="panel-title"><strong><?= $v['text']; ?></strong></h3>
  	</div>
  	<div class="panel-body">
    	<div class="panel panel-primary">
		  	<div class="list-group">
		  		<?php
		  			foreach ($v['quality'] as $a => $b) {
		  		?>
		  		<p class="list-group-item active"><strong><?= $b['text']; ?></strong></p>
			  	<span class="list-group-item">
			  		<?php
		  				foreach ($b['server'] as $c => $d) {
		  			?>
			  		<a href="<?= $d['link']; ?>" target="blank"><?= $d['text']; ?></a> | 
			  		<?php } ?>
			  	</span>
			  	<?php } ?>
			</div>
		</div>
  	</div>
</div>
<?php
	}
?>

<br>
<a href="index.php"><h4 class="link_back">&#60;&#60; Kembali</h4></a>


<!-- 
-->