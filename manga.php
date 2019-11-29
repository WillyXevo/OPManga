<?php


$list_manga = list_chapter("http://www.mangacanblog.com/baca-komik-one_piece-bahasa-indonesia-online-terbaru.html");
//$list_manga = list_chapter("https://mangaku.in/komik/one-piece/");


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
			<td><a href="index.php?page=view&judul=<?= e_url($v['judul']);?>&link=<?= e_url($v['link']);?>"><?= trim($v['judul']);?></a></td>
			
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
	      	<a href="index.php?page=manga&hal=1" aria-label="Previous">
	        	<span aria-hidden="true">&laquo;</span>
	      	</a>
	    </li>
	    <?php
	    	$link_pagination = "";
	    	if($fr>1){
    			$link_pagination.= '<li><a href="index.php?page=manga&hal=1">1</a></li>';
    			$link_pagination.= '<li class="disabled"><a href="#">...</a></li>';
    		}
	    	
    		for($i = $fr; $i <= $ls; $i++){
	    		
	    		if($curr_page==$i){
    				$link_pagination.= "<li class='active'><a href='index.php?page=manga&hal=$i'>$i</a></li>";
	    		}else{
    				$link_pagination.= "<li><a href='index.php?page=manga&hal=$i'>$i</a></li>";
	    		}
	    		
	    	}
	    	if($ls<$page_count){
    			$link_pagination.= "<li class='disabled'><a href='#'>...</a></li>";
	    		$link_pagination.= "<li><a href='index.php?page=manga&hal=$page_count'>$page_count</a></li>";
    		}
	    	echo $link_pagination;
	    ?>	    
	    <li>
	      	<a href="index.php?page=manga&hal=<?= $page_count; ?>" aria-label="Next">
	        	<span aria-hidden="true">&raquo;</span>
	      	</a>
	    </li>
  	</ul>
</nav>