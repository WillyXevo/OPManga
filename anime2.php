<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<style>
	
</style>
<h2>LIST ANIME ONE PIECE INDONESIA</h2>
<hr>
<table class="table table-hover table-list" id="myTable">
	<thead>
		<tr>
			<th width="1%">No</th>
			<th>Episode</th>
			<th width="50%">Judul</th>
			<th>Tanggal</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>
<hr>
<script type="text/javascript">
	var table = $('#myTable').DataTable({
		 columns: [
		        { data: 'no' },
		        { data: 'eps' },
		        { data: 'judul' },
		        { data: 'date' }
		    ]
	});
	$(document).ready( function () {
	    $('#myTable tbody').on( 'click', 'tr', function () {
		  	var rowData = table.row( this ).data();
		  	//console.log(rowData);
		  	var id = rowData.id;
		  	console.log(id);
		  	window.open("index.php?page=view_anime2&id="+id, '_blank');
		  	// ... do something with `rowData`
		} );
	});
</script>
<script src="https://www.gstatic.com/firebasejs/7.15.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-database.js"></script>
<script src="fbase.js"></script>
<script type="text/javascript">
var ddb;

ddb = firebase.database().ref();

var data = ddb.child("tanime");
/*ddb.on("value", function(snapshot) {
    var v = snapshot.child('tanime');
    var da = v.val();
    var data_set = [];
    console.log(v.child("judul").val());
    //console.log(v.val());
}, function (error) {
    console.log("Error: " + error.code);
});*/
var i = 1;
data.on("child_added", snap => {
   
    var data_set = {
                    "id" : snap.key, 
                    "no" : i, 
                    "eps" : snap.child("eps").val(), 
                    "judul" : snap.child("judul").val(), 
                    "date" : snap.child("date").val(), 
                    };
    //console.log(data_set);
    //console.log(i);
    table.rows.add([data_set]).draw();
    i++;
});
/*
data.orderByKey().equalTo("-M9J3JJsOXgm4nUX0PhJ").on("child_added", function(data) {
    console.log(data);
    console.log("Equal to filter: " + data.val().judul);
});*/

</script>
