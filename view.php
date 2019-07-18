<?php
	//$list_manga = ini($link);




?>
<h2><?= $judul; ?></h2>
<br><br>
<div class="imgholder" style="width:100%;">
	<center>
	<?php
		foreach ($list_manga as $k => $v) {
	?>
	<figure class="img_fig" id="<?= $k; ?>">
		<img src="<?= $v; ?>" alt="<?= $k; ?>" class="img-responsive"> 
	</figure>
	<?php
		}
	?>
	</center>
</div>
<br>
<a href="index.php"><h4>&#60;&#60; Kembali</h4></a>

<!-- 
-->