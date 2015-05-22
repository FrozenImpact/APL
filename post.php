<script src="extended_features.js"></script>
<script src="jquery.cookie.js"></script>
<script>
function perioodiliselt_tehtav() {
	$.post( 
	'drawComments.php', 
	{ post_id: '<?php if (isset($_GET['post_id'])) echo $_GET['post_id']; ?>' }, 
	function( data ){ 
		$('#comments').empty();
		$( '#comments').append( data );
	});
}
</script>
<?php
// kirjuta comment tekstfaili
function save ($dataArray) {
	
	if(isset($_SESSION['login_user'])){
		addComment($_SESSION['login_user_id'], $_GET['post_id'], $dataArray['name']);
	}
	else{
	}
	return true;
}


include_once '_Post.php';

$post_data = getPost($_GET['post_id']);
$post = new Post($_GET['post_id'], $post_data[0]['Heading'], $_GET['lecture'], $post_data[0]['Posted'], $post_data[0]['Upvote']-$post_data[0]['Downvote']);
$post->draw_post();


echo '
	<div class="selfPost">
		<a class="w"> ' .$post_data[0]['Description']. ' </a>
	</div>';
?>

<div class="selfComment">	
	<form method="POST">
		<input type="hidden" name="action" value="new_entry"/>
		<textarea rows="6" cols="68" name="name" id="comment" class="largeTextEntry" ></textarea><br><br/>			
		<input class="rightLink" type="submit" value="Reply"/>
	</form>	
</div>

<?php
if (isset($_POST['action'])) {
	if (isset( $_SESSION['login_user'] )){
		save($_POST);
		echo "<script type='text/javascript'>$.removeCookie('example');</script>";
	}

	else{
		echo '<script>window.location.href = "logon.php?lecture=' .$_GET['lecture']. '&lehekylg=' .$_GET['lehekylg']. '&post_id=' .$_GET['post_id']. '";</script>';
	}
}
?>
<div id="comments">
<?php
include_once 'drawComments.php';
?>
</div>

