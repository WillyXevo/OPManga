<?php


	require('simplehtmldom/simple_html_dom.php');

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");


	function e_url( $s ) {
		return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
	}
	 
	function d_url($s) {
		return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
	}

	function list_op($url='')
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


		$html = $dom->load($data, true, true);
		//$html = str_get_html($data);
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
					$tmp['id'] = md5(trim($td->plaintext));//date("YmdHis", strtotime(explode(", ", $td->plaintext)[1]));
					$tmp["link"] = $a;
					$tmp["judul"] = trim($td->plaintext);
					$tmp["d_link"] = "index.php?page=view&judul=".e_url(trim($td->plaintext))."&link=".e_url($a);
				}
				if($i==3){
					$tmp['date'] = $td->plaintext;
					$date = $td->plaintext;
					$date = explode(" ", $date);
					$srt = str_replace(",", "", $date[0])." ".$date[1]." ".$date[2];
					$tmp['date_act'] = date("Y-m-d", strtotime($srt));
				}
				$i++;
			}
			array_push($list_manga, $tmp);
		}
		return $list_manga;
	}

	function list_cb($url='')
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


		$html = $dom->load($data, true, true);
		//$html = str_get_html($data);
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
					$tmp['id'] = md5(trim($td->plaintext));//date("YmdHis", strtotime(explode(", ", $td->plaintext)[1]));
					$tmp["link"] = $a;
					$tmp["judul"] = trim($td->plaintext);
					$tmp["d_link"] = "index.php?page=view&judul=".e_url(trim($td->plaintext))."&link=".e_url($a);
				}
				if($i==3){
					$tmp['date'] = $td->plaintext;
					$date = $td->plaintext;
					$date = explode(" ", $date);
					$srt = str_replace(",", "", $date[0])." ".$date[1]." ".$date[2];
					$tmp['date_act'] = date("Y-m-d", strtotime($srt));
				}
				$i++;
			}
			array_push($list_manga, $tmp);
		}
		return $list_manga;
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


		$html = $dom->load($data, true, true);
		//$html = str_get_html($data);
		$list_manga = array();
		$jd = "";
		foreach($html->find('div#imgholder') as $ell){
			foreach($ell->find('div#manga') as $mg){
				foreach($mg->find('img') as $s){
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

	function _filter_($arr){
		$ret = [];
		foreach ($arr as $k => $v) {
			if(strpos($v, 'lowongan') || strpos($v, 'iklan')){
				//echo "$v <br>";
			}else{
				array_push($ret, $v);
			}
		}
		return $ret;
	}

	if(!isset($_POST['judul'])){
		$list_manga = list_op("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");
		echo json_encode($list_manga, JSON_UNESCAPED_SLASHES);
	}

	if(isset($_GET['cb'])){
		$list_manga = list_cb("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");
		echo json_encode($list_manga, JSON_UNESCAPED_SLASHES);
	}

	if(isset($_POST['judul'])){

		$judul = $_POST['judul'];
		$link = $_POST['link'];

		$list_manga = ini($link);
		$ret = array('judul' => $judul, 
					'img' => _filter_($list_manga)
						);
		echo json_encode($ret, JSON_UNESCAPED_SLASHES);
	}

?>