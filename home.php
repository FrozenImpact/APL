<script src='extended_features.js'></script>
<script src='jquery.cookie.js'></script>
<div id="postarea">
<script>
function perioodiliselt_tehtav() {
	$.post( 
	'drawPosts.php', 
	{ lecture: '<?php if (isset($_GET['lecture'])) echo $_GET['lecture']; ?>', page: '<?php if (isset($_GET['page'])) echo $_GET['page']; ?>'}, 
	function( data ){ 
		$('#postarea').empty();
		$( '#postarea').append( data );
	});
		
}
//perioodiliselt_tehtav();
</script>
<?php
include_once 'drawPosts.php';
?>
</div>