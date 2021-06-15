<?php
//$list_manga = list_chapter("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");
//$list_manga = list_chapter_kita("https://mangakita.net/manga/one-piece/");
?>

<h2>LIST MANGA ONE PIECE INDONESIA</h2>
<table class="table table-list dataTable">
	<thead>
		<tr>
			<th>Judul</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
		$(".dataTable").DataTable( {
			"ajax": 'ajax.php?load',
		  	"ordering": false,
		  	"lengthMenu": [ [100, -1], [100, "ALL"] ]
		});		
	});
</script>	
