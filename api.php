<?php


	require('simplehtmldom/simple_html_dom.php');

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");


	function list_op($url='')
	{
		/*$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_PROXY, null);

		$data = curl_exec($ch);
		$info = curl_getinfo($ch);
		$error = curl_error($ch);

		curl_close($ch);*/

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_PROXY, null);

		$data = curl_exec($ch);
		$info = curl_getinfo($ch);
		$error = curl_error($ch);
/*
		echo "<pre>";
		print_r($info);
		print_r($error);
		echo "</pre>";*/

		curl_close($ch);

		$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

		$html = str_get_html($data);
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
					$tmp["judul"] = trim($td->plaintext);
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

		$html = file_get_html($url);
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
		//print_r($ret) ;
		return $ret;
	}

	//list_op("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");
	
	//list_op("http://www.komikid.com/manga/one-piece/934/1");
	//echo '<pre>';
	if(!isset($_GET['judul'])){
		$list_manga = list_op("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");
		//print_r($list_manga);
		echo json_encode($list_manga);
	}else{

		$judul = $_GET['judul'];
		$link = $_GET['link'];

		$list_manga = ini($link);
		//_filter_($list_manga);
		/*$ret['judul'] = $judul;
		$ret['img'] = _filter_($list_manga);*/
		$ret = array('judul' => $judul, 
					'img' => _filter_($list_manga)
						);
		//print_r($ret);
		echo json_encode($ret);
	}
	///echo '</pre>';

?>