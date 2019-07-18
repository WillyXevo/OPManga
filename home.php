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

$list_manga = ini("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");


$per_page = 10;
$page_count = ceil(sizeof($list_manga)/$per_page);
if(isset($_GET['hal'])){
	$curr_page = $_GET['hal'];
	$first = ((int)$curr_page * $per_page) - ($per_page-1) ;
	$last = ($first+$per_page)-1;
}else{
	$curr_page = 1;
	$first = 1;
	$last = ($first+$per_page)-1;
}
$fr = $curr_page>4?$curr_page-3:1;
$ls = $fr+4;
if($ls>=$page_count){
	$ls = $page_count;
}
if($last>sizeof($list_manga)){
	$last = sizeof($list_manga);
}/*
echo "page_count : $page_count <br>"; 
echo "first : $first <br>"; 
echo "last : $last <br>"; 
echo "curr_page : $curr_page <br>"; 
echo "fr : $fr <br>"; 
echo "ls : $ls <br>"; */
/*echo '<pre>';
print_r($list_manga);
echo '</pre>';*/
?>

<h2>LIST MANGA ONE PIECE INDONESIA</h2>
<table class="table table-list">
	<tbody>
		<?php
			for ($i=($first-1); $i < ($last) ; $i++) { 
				$v = $list_manga[$i];
		?>
		<tr>
			<td><a href="index.php?p=view&judul=<?= $v['judul']?>&link=<?= $v['link']?>"><?= $v['judul']?></a></td>
			<td><?= $v['date']?></td>
		</tr>
		<?php
			}
		?>
		
	</tbody>
</table>
<hr>
<nav>
  	<ul class="pagination">
	    <li>
	      	<a href="index.php?p=home&hal=1" aria-label="Previous">
	        	<span aria-hidden="true">&laquo;</span>
	      	</a>
	    </li>
	    <?php
	    	$link_pagination = "";
	    	if($fr>1){
    			$link_pagination.= '<li><a href="index.php?p=home&hal=1">1</a></li>';
    			$link_pagination.= '<li class="disabled"><a href="#">...</a></li>';
    		}
	    	
    		for($i = $fr; $i <= $ls; $i++){
	    		
	    		if($curr_page==$i){
    				$link_pagination.= "<li class='active'><a href='index.php?p=home&hal=$i'>$i</a></li>";
	    		}else{
    				$link_pagination.= "<li><a href='index.php?p=home&hal=$i'>$i</a></li>";
	    		}
	    		
	    	}
	    	if($ls<$page_count){
    			$link_pagination.= "<li class='disabled'><a href='#'>...</a></li>";
	    		$link_pagination.= "<li><a href='index.php?p=home&hal=$page_count'>$page_count</a></li>";
    		}
	    	echo $link_pagination;
	    ?>	    
	    <li>
	      	<a href="index.php?p=home&hal=<?= $page_count; ?>" aria-label="Next">
	        	<span aria-hidden="true">&raquo;</span>
	      	</a>
	    </li>
  	</ul>
</nav>