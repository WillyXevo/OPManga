<?php
//$list_manga = list_chapter("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");
$list_manga = list_chapter_kita("https://mangakita.net/manga/one-piece/");
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
				if($k==0){
					$next = "#";
					$p = $list_manga[$k+1];
					$prev = "index.php?page=view&judul=".e_url($p['judul'])."&link=".e_url($p['link']);
				}else if($k==sizeof($list_manga)-1){
					$n = $list_manga[$k-1];
					$next = "index.php?page=view&judul=".e_url($n['judul'])."&link=".e_url($n['link']);
					$prev = "#";
				}else{
					$n = $list_manga[$k-1];
					$next = "index.php?page=view&judul=".e_url($n['judul'])."&link=".e_url($n['link']);
					$p = $list_manga[$k+1];
					$prev = "index.php?page=view&judul=".e_url($p['judul'])."&link=".e_url($p['link']);
				}
				$next = e_url($next);
				$prev = e_url($prev);
				$link = "index.php?page=view&judul=".e_url($v['judul'])."&link=".e_url($v['link']);
				$link .= "&next=".$next."&prev=".$prev;
		?>
		<tr>
			<td><a href="<?= $link; ?>"><?= trim($v['judul']);?></a></td>
			<td><?= $v['date']?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

