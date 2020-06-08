<script src="https://www.gstatic.com/firebasejs/7.15.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-database.js"></script>
<script src="fbase.js"></script>
<style>
	.btn-nav-bottom{
		width: 100%;
	}
</style>
<script type="text/javascript">
	var ddb;

	ddb = firebase.database().ref();

	var data = ddb.child("tanime");

	<?php if(isset($_GET['id'])): ?>
	data.orderByKey().equalTo("<?= $_GET['id']; ?>").on("child_added", function(data) {
	    console.log(data);
	    console.log("Equal to filter: " + data.val().judul);
	    $("#judul").html(data.val().judul);
	    console.log(data.val().video);
	    gen_video(data.val().video);
	    gen_name(<?= $_GET['id']; ?>);
	});

	function gen_video(data){
		var ret = '<iframe style="width:100%; height:500px;" src="'+data+'" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe" __idm_frm__="1931"></iframe>';
		$("#video").html(ret);
	}

	function gen_name(id) {
		var seb = id--;
		var nex = id++;
		var ret = '<div class="row">';
		ret += '<div class="col-xs-4">';
			ret += '<a href="index.php?page=view_anime2&id='+nex+'" class="btn btn-success btn-nav-bottom">Episode Berikutnya</a>';
		ret += '</div>';
		ret += '<div class="col-xs-4">';
			ret += '<a href="index.php?p=anime2" class="btn btn-warning btn-nav-bottom">List Episode</a>';
		ret += '</div>';
		ret += '<div class="col-xs-4">';
			ret += '<a href="index.php?page=view_anime2&id='+seb+'" class="btn btn-success btn-nav-bottom">Episode Sebelumnya</a>';
		ret += '</div>';
		ret += '</div>';
		$(".nav_bottom").html(ret);
	}

	<?php endif; ?>
</script>
<h2 id="judul"></h2>
<br><br>
<div id="video"></div>
<br><br>
<div class="container nav_bottom">
	
</div>
<br><br>

<a href="index.php"><h4 class="link_back">&#60;&#60; Kembali</h4></a>


<!-- 
-->