<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<style>
	
</style>
<?php
	$data_anime = json_decode(file_get_contents("anime.json"), true);
?>
<h2>LIST ANIME ONE PIECE INDONESIA</h2>
<hr>
<table class="table table-hover table-list" id="myTable">
	<thead>
		<tr>
			<th width="1%">No</th>
			<th width="10%">Episode</th>
			<th width="79%">Judul</th>
			<th width="10%">Tanggal</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$i = 0;
		foreach ($data_anime as $k => $v):
			
	?>
		<tr id="<?= $k; ?>">
			<td><?= $k; ?></td>		
			<td><?= $v['eps']?></td>		
			<td><?= $v['judul']?></td>		
			<td><?= $v['date']?></td>	
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<hr>
<script type="text/javascript">
	var table = $('#myTable').DataTable();
	$(document).ready( function () {
	    $('#myTable tbody').on( 'click', 'tr', function () {
			var id = $(this).attr("id");
			window.open("index.php?page=view_anime2&id="+id, '_blank');
		});
	});
</script>
