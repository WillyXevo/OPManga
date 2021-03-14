<?php
	//$list_manga = ini($link);
?>
<h2><?= $judul; ?></h2>
<div class="navig">
	<select class="cb_chapter" name="episode" id="slch" onchange="window.open(this.options[this.selectedIndex].value,'_self')" text="Search Here…">
		<option value="">Select Chapter Manga</option>
	</select>
	<!-- <button class="btn btn-primary btn-sm pull-right">Download</button> -->
</div>
<div class="imgholder">
	<?php
		foreach ($list_manga as $k => $v) {
	?>
	<figure class="img_fig" id="<?= $k; ?>">
		<img src="<?= $v; ?>" alt="<?= $k; ?>" class="img-responsive">
	</figure>
	<?php
		}
	?>
</div>
<div class="navig">
	<select class="cb_chapter" name="episode" id="slch" onchange="window.open(this.options[this.selectedIndex].value,'_self')" text="Search Here…">
		<option value="">Select Chapter Manga</option>
	</select>
	<!-- <button class="btn btn-primary btn-sm pull-right">Download</button> -->
</div>
<script type="text/javascript" src="assets/js/jquery.zoom.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".cb_chapter").html('<option value="">Select Chapter Manga</option>');
		$.getJSON("api.php", function(response) {
			$.each(response, function(index, element) {
				var lk = "<?= d_url($_GET['link']); ?>";
				var sel = lk==element.link?"selected":'';
		        $(".cb_chapter").append('<option value="'+element.d_link+'" '+sel+'>'+element.judul+'</option>');
		    });
		});

		$(".img_fig").zoom({ on:'click', magnify:1.5 });
	});
</script>