<?php

include "func.php";

if(isset($_GET["load"])){
	$list_manga = list_chapter_kita("https://mangakita.net/manga/one-piece/");
	$ret["data"] = [];
	foreach ($list_manga as $key => $v) {
		$tmp = [
				"<a href='index.php?page=view&judul=".e_url($v["judul"])."&link=".e_url($v["link"])."'>".trim($v["judul"])."</a>",
				$v["date"]
				];
		$ret["data"][] = $tmp;
	}
	/*pre($ret);*/
	echo json_encode($ret, JSON_UNESCAPED_SLASHES);
}


function pre($isi)
{
	echo "<pre>";
	print_r($isi);
	echo "</pre>";
}

?>