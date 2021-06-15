<?php
	//$list_manga = ini($link);
?>
<h2><?= $judul; ?></h2>
<div class="navig">
	<select class="cb_chapter" name="episode" id="slch" onchange="window.open(this.options[this.selectedIndex].value,'_self')" text="Search Here…" aria-label="Seacrh Chapter">
		<option value="">Select Chapter Manga</option>
	</select>
</div>
<div class="imgholder">
	<?php
		foreach ($list_manga as $k => $v) {
	?>
	<img class="lozad" data-src="<?= $v; ?>" alt="<?= $k; ?>" data-placeholder-background="#000000" data-index="<?= $k; ?>" >
	<!-- 
	<img src="<?= $v; ?>" alt="<?= $k; ?>" loading="lazy" class="img-responsive">
	<figure class="img_fig" id="<?= $k; ?>">
	</figure> -->
	<?php
		}
	?>
</div>
<div class="container-fluid nav_bottom">
	<div class="col-xs-4">
		<a href="#" class="btn btn-info btn-nav-bottom btn-seb disabled">	
			<i class="fa fa-angle-double-left"></i> Next Chapter
		</a>
	</div>
	<div class="col-xs-4">
		<a href="index.php" class="btn btn-default2 btn-nav-bottom btn-lis">List Chapter</a>
	</div>
	<div class="col-xs-4">
		<a href="#" class="btn btn-info btn-nav-bottom btn-nex disabled">
			Previous Chapter <i class="fa fa-angle-double-right"></i> 
		</a>
	</div>
</div>
<script src="https://raw.githubusercontent.com/w3c/IntersectionObserver/master/polyfill/intersection-observer.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		var observer = lozad(); // lazy loads elements with default selector as '.lozad'
		observer.observe();

		$(".cb_chapter").html('<option value="">Select Chapter Manga</option>');
		$.getJSON("api.php", function(response) {
			$.each(response, function(index, element) {
				var lk = "<?= d_url($_GET['link']); ?>";
				var sel = lk==element.link?"selected":'';
		        $(".cb_chapter").append('<option value="'+element.d_link+'" '+sel+'>'+element.judul+'</option>');
		    	if(lk==element.link){
		    		var prev = response[index+1];
		    		var next = response[index-1];

		    		if(next!=undefined){
		    			$(".btn-seb").attr("href",next.d_link);
		    			$(".btn-seb").removeClass("disabled");
		    		}
		    		if(prev!=undefined){
		    			$(".btn-nex").attr("href",prev.d_link);
		    			$(".btn-nex").removeClass("disabled");
		    		}

		    	}
		    });
		});
	});
</script>