<?php

$list_manga = list_chapter_page("https://mangaku.in/komik/one-piece/");
$list_episode = list_episode_page("https://www.oploverz.in/series/one-piece/");
?>

<h2>LIST MANGA ONE PIECE INDONESIA</h2>
<table class="table table-list">
	<tbody>
		<?php
		if(sizeof($list_manga)==0){
		?>
		<tr>
			<td>No Manga Found!</td>
		</tr>
		<?php
		}else{
			foreach ($list_manga as $k => $v) {
		?>
		<tr>
			<td><a href="index.php?page=view&judul=<?= e_url($v['judul']);?>&link=<?= e_url($v['link']);?>"><?= trim($v['judul']);?></a></td>
			
			<td><?= '';//$v['date']?></td>
		</tr>
		<?php
			}
		}
		?>
		
	</tbody>
</table>
<hr>
<h2>LIST ANIME ONE PIECE INDONESIA</h2>
<table class="table table-list">
	<tbody>
		<?php
		if(sizeof($list_episode)==0){
		?>
		<tr>
			<td>No Anime Found!</td>
		</tr>
		<?php
		}else{
			foreach ($list_episode as $k => $v) {
		?>
		<tr>
			<td><a href="index.php?page=view_anime&judul=<?= e_url($v['judul']);?>&link=<?= e_url($v['link']);?>"><?= $v['eps']; ?></a></td>
			<td><a href="index.php?page=view_anime&judul=<?= e_url($v['judul']);?>&link=<?= e_url($v['link']);?>"><?= $v['judul']; ?></a></td>
			<td><?= $v['date']; ?></td>
		</tr>
		<?php
			}
		}
		?>
		
	</tbody>
</table>