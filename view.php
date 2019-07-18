<?php
	$judul = $_GET['judul'];
	$link = $_GET['link'];

	$list_manga = _filter_(ini($link));
	//$list_manga = ini($link);

	function _filter_($arr){
		$ret = [];
		foreach ($arr as $k => $v) {
			if(strpos($v, 'lowongan') || strpos($v, 'iklan') || strpos($v, 'OneMangaDay')){
				//echo "$v <br>";
			}else{
				array_push($ret, $v);
			}
		}
		//print_r($ret) ;
		return $ret;
	}


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

	//$html = file_get_html($url);

	$html = $dom->load($data, true, true);
	$list_manga = array();
	$jd = "";
	foreach($html->find('div#imgholder') as $ell){
		foreach($ell->find('div#manga') as $mg){
			foreach($mg->find('img') as $s){
				//array_push($list_manga, $s->src);
				$a = $s->src;
				if(strpos($a, '.com') !== false){
					array_push($list_manga, $s->src);
				}else{
					array_push($list_manga, "http://www.mangacanblog.com/".$s->src);
				}
			}
		}
	}
	return $list_manga;
}



?>
<h2><?= $judul; ?></h2>
<br><br>
<div class="imgholder" style="width:100%;">
	<center>
	<?php
		foreach ($list_manga as $k => $v) {
	?>
	<figure class="img_fig" id="<?= $k; ?>">
		<img src="<?= $v; ?>" alt="<?= $k; ?>" class="img-responsive"> 
	</figure>
	<?php
		}
	?>
	</center>
</div>
<a href="index.php"><h4>&#60;&#60; Kembali</h4></a>

<!-- 
-->