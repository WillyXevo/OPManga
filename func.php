<?php

		
function list_chapter($url='')
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

	$html = $dom->load($data, true, true);
	//$html = file_get_html($url);
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


function list_manga($url='')
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


function e_url( $s ) {
	return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
}
 
function d_url($s) {
	return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
}

?>