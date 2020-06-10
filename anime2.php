<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<style>
	
</style>
<?php
	$data_anime = json_decode(file_get_contents("anime.json"), true);
	$data_anime = array_reverse($data_anime);
?>
<h2>LIST ANIME ONE PIECE INDONESIA</h2>
<hr>
<table class="table table-hover table-list" id="myTable">
	<thead>
		<tr>
			<th width="1%">No</th>
			<th>Episode</th>
			<th width="50%">Judul</th>
			<th>Tanggal</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$i = 0;
		foreach ($data_anime as $k => $v):
	?>
		<tr id="<?= $k; ?>">
			<td><?= ++$i; ?></td>		
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
