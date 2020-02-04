<?php

require('simplehtmldom/simple_html_dom.php');

function e_url( $s ) {
	return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
}
 
function d_url($s) {
	return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
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


function _filter2($arr){
	$ret = [];
	foreach ($arr as $k => $v) {
		if(strpos($v, 'result')){
			array_push($ret, $v);
		}
	}
	if(sizeof($ret)==0){
		foreach ($arr as $k => $v) {
			if(strpos($v, 'creadit') || strpos($v, 'komen') || strpos($v, 'manga.png')){
			}else{
				array_push($ret, $v);
			}
		}	
	}
	//print_r($ret) ;
	return $ret;
}

/*
*
*
*
* //////////////////////////// MANGA AREA ///////////////////////////////////////
*
*
*
*
*/


/*
*
*
*
* //////////////////////////// MANGACANBLOG AREA ///////////////////////////////////////
*
*
*
*
*/


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

	$html = $dom->load($data, true, true);
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


/*$lst = list_chapter("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");
echo '<pre>';
print_r($lst);
echo '</pre>';*/

function list_chapter_page($url='')
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
	$list_manga = array();
	$jd = "";
	$pp = 0;
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
		if($pp==10){
			return $list_manga;
		}
		$pp++;
	}
	return $list_manga;
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
	
	$list_manga = array();
	
	$html = $dom->load($data, true, true);
	$jd = "";
	foreach($html->find('div#imgholder') as $ell){
		foreach($ell->find('div#manga') as $mg){
			$i=0;
			foreach($mg->find('img') as $s){
				//echo "$s->src <br>";
				$src =  $s->src; 
				
				/*$a = file_get_contents($s->src);
				$src =  base64_encode($a); */
				array_push($list_manga, $src);
				$i++;
				if($i==2){return $list_manga;}
			}
		}
	}

	//$list_manga = $list_manga;
	//$list_manga = _filter_($list_manga);
	return $list_manga;
	
}

//$lst = list_manga("http://www.mangacanblog.com/baca-komik-one_piece-968.5-969.5-bahasa-indonesia-one_piece-968.5-terbaru.html");
//$lst = list_manga("https://www.mangacanblog.com/baca-komik-one_piece-968.5-969.5-bahasa-indonesia-one_piece-968.5-terbaru.html");
/*$lst = list_manga("https://mangacanblog.com/baca-komik-one_piece-968-969-bahasa-indonesia-one_piece-968-terbaru.html");
echo '<pre>';
echo "HAHA";
print_r($lst);
*///$a = file_get_contents("https://3.bp.blogspot.com/-viD8muvI7HI/XiJphQCtC-I/AAAAAAAAF1A/wPFJz3ddlQsVTnCt6B2gH-y-TIOmUtVOwCLcBGAsYHQ/s1600/16_dvS3WJS.jpg");
//echo $a; 
/*
$src = base64_encode($a);
echo $src;*/
//echo '</pre>';
/*
*
*
*
* //////////////////////////// MANGAKU.IN AREA ///////////////////////////////////////
*
*
*
*
*/


/*function list_manga($url='')
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

		echo $html;
	foreach($html->find('.FwsLJGSYKCsCm') as $div){
		
		foreach($div->find('.separator>a>img') as $ell){
			//echo $ell->src.'<br>';
			
			$src = base64_encode(file_get_contents($ell->src));
			echo '<img src="data:image/jpg;base64,'.$src.'">';
			echo '<br>'.$ell->src.'<br>';
			array_push($list_manga, $ell->src);
		}
	}
	$fil =  _filter2($list_manga);
	$list_manga2 = array();
	foreach ($fil as $k => $v) {
		array_push($list_manga2, base64_encode(file_get_contents($v)));
	}
	return $list_manga2;
}

function list_chapter($url){
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

	$list_manga = array();
	foreach ($html->find("#content-b") as $div) {
		
		$i = 0;
		foreach ($div->find('a') as $a) {
			$list_manga[$i] = array('judul' => $a->plaintext,
									'link' => $a->href
									);
			$i++;
		}
	}
	return $list_manga;
}


function list_chapter_page($url){
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

	$list_manga = array();
	foreach ($html->find("#content-b") as $div) {
		$i = 0;
		foreach ($div->find('a') as $a) {
			$list_manga[$i] = array('judul' => $a->plaintext,
									'link' => $a->href
									);
			if($i==10){
				return $list_manga;
			}

			$i++;
		}
	}
	
}*/


/*
*
*
*
* //////////////////////////// ANIME AREA ///////////////////////////////////////
*
*
*
*
*/

function list_episode($url){
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
	$list_episode = array();

	foreach ($html->find(".episodelist") as $div) {
		foreach ($div->find("li") as $li) {
			$eps = $li->find(".leftoff",0);
			$judul = $li->find(".lefttitle",0);
			$dt = $li->find(".rightoff",0);
			array_push($list_episode, array(
											'link'	=> $eps->find("a",0)->href,
											'eps'	=> $eps->plaintext,
											'judul'	=> $judul->plaintext,
											'date'	=> $dt->plaintext
											));
		}
	}
	return $list_episode;
}


function list_episode_page($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Upgrade-Insecure-Requests: 1",
        //"User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
        "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
        "Accept-Language: en-US,en;q=0.9",
        "cookie: __cfduid=da5a43c33c765d8c5ecc8757d17acbaa21573400863; cf_clearance=dbdc95a38f52919ba3c14d5e8473195aa022b0e3-1573400868-0-150; _ga=GA1.2.1782458.1573400868; _gid=GA1.2.1987219291.1573400868; HstCfa4135177=1573400875080; HstCmu4135177=1573400875080; HstCnv4135177=1; HstCns4135177=1; __dtsu=1EE704453831C85D33301B0402D15797; __atuvc=3%7C46; __atuvs=5dc8312478a5a8d9002; HstCla4135177=1573401070454; HstPn4135177=3; HstPt4135177=3"
    ));

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$list_episode = array();
	//echo $html;
	//echo htmlentities($html);
	foreach ($html->find(".episodelist") as $div) {
		$i=0;
		foreach ($div->find("li") as $li) {

			$eps = $li->find(".leftoff",0);
			$judul = $li->find(".lefttitle",0);
			$dt = $li->find(".rightoff",0);
			array_push($list_episode, array(
											'link'	=> $eps->find("a",0)->href,
											'eps'	=> $eps->plaintext,
											'judul'	=> $judul->plaintext,
											'date'	=> $dt->plaintext
											));

			if($i==10){
				return $list_episode;
			}
			$i++;
		}
	}
}

/*$list_episode = list_episode_page("https://www.oploverz.in/series/one-piece/");
echo "ANIME <br>";
print_r($list_episode);*/

function list_anime($url){
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
	$list_anime = array();
	foreach ($html->find('.idframe') as $vid) {
		$list_anime['video'] = $vid->attr["src"];
	}
	
	foreach ($html->find('.epsc') as $epsc) {
		$mkv_text = '';//$epsc->find('h2',0)->plaintext;
		$mp4_text = '';//$epsc->find('h2',1)->plaintext;
		if($epsc->find('h2',0)){
			$mkv_text = $epsc->find('h2',0)->plaintext;
		}
		if($epsc->find('h2',1)){
			$mp4_text = $epsc->find('h2',1)->plaintext;
		}
		
		$mkv_array = array();
		$mp4_array = array();

		$mkv_box = $epsc->find('.op-download',0);
		$mp4_box = $epsc->find('.op-download',1);
		
		$i = 0;
		foreach ($mkv_box->find(".title-download") as $td) {
			$mkv_array[$i]['text'] = $td->plaintext;
			$i++;
		}
		$i = 0;
		foreach ($mkv_box->find(".list-download") as $ld) {
			$j=0;
			foreach ($ld->find('strong') as $strong) {
				foreach ($strong->find('a') as $link) {
					$mkv_array[$i]['server'][$j] = array('text' => $link->plaintext, 'link' => $link->href); 
					$j++;
				}
			}
			$i++;
		}
		$i = 0;
		if($mp4_box){
			foreach ($mp4_box->find(".title-download") as $td) {
				$mp4_array[$i]['text'] = $td->plaintext;
				$i++;
			}
			$i = 0;
			foreach ($mp4_box->find(".list-download") as $ld) {
				$j=0;
				foreach ($ld->find('strong') as $strong) {
					foreach ($strong->find('a') as $link) {
						$mp4_array[$i]['server'][$j] = array('text' => $link->plaintext, 'link' => $link->href);
						$j++;
					}
				}
				$i++;
			}
		}

		$list_anime['download'] = array(
										'mkv' => array('text' => $mkv_text, 'quality' => $mkv_array),
										'mp4' => array('text' => $mp4_text, 'quality' => $mp4_array),
		);
	}
	return $list_anime;

}

/*$anime = list_anime("https://www.oploverz.in/one-piece-episode-902-subtitle-indonesia/");
echo '<pre>';
print_r($anime);
echo '</pre>';*/

?>