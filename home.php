<?php
	
function ini($url='')
{
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$content = 
	//$html = $dom->load($content, true, true);
	//$html = $dom->load_file($url);//$dom->load($content, true, true);
	$html = file_get_html($url);
	$list_manga = array();
	$jd = "";
	foreach($html->find('tr.c3') as $ell){
		$i=1;
		$tmp = [];
		
		foreach ($ell->find('td') as $td) {
			if($i==2){
				$sp = explode(" ", $td->plaintext);
				$txt = $sp[5];
				$nt = $txt+1;
				$a = "http://www.mangacanblog.com/baca-komik-one_piece-$txt-$nt-bahasa-indonesia-one_piece-$txt-terbaru.html";
				$tmp["link"] = $a;
				$tmp["judul"] = $td->plaintext;
			}
			if($i==3){
				$tmp['date'] = $td->plaintext;
			}
			$i++;
		}
		array_push($list_manga, $tmp);
	}
	return $list_manga;
}

$list_manga = ini("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");

?>

<h2>LIST MANGA ONE PIECE INDONESIA</h2>
<table class="table table-list">
	<tbody>
		<?php
			foreach ($list_manga as $key => $v):
		?>
		<tr>
			<td><a href="index.php?p=view&judul=<?= $v['judul']?>&link=<?= $v['link']?>"><?= $v['judul']?></a></td>
			<td><?= $v['date']?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>