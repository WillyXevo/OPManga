<?php

$list_manga = list_chapter("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");
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
		<?php
			$i=0;
			foreach ($list_manga as $k => $v) {
		?>
		<tr>
			<td><a href="index.php?page=view&judul=<?= e_url($v['judul']);?>&link=<?= e_url($v['link']);?>"><?= trim($v['judul']);?></a></td>
			<td><?= $v['date']?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

