<script src='extended_features.js'></script>
<script src='jquery.cookie.js'></script>
<script>
function perioodiliselt_tehtav() {
	$.post( 
	'drawPosts.php', 
	{ lecture: '<?php if (isset($_GET['lecture'])) echo $_GET['lecture']; ?>' }, 
	function( data ){ 
		$('#scroller1').empty();
		$( '#scroller1').append( data );
	});
		
}
perioodiliselt_tehtav();
</script>