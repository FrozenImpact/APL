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
$post = new Post($_GET['post_id'], $_GET['lehekylg'], $_GET['lecture'], $post_data[0]['Posted'], $post_data[0]['Upvote']-$post_data[0]['Downvote']);
$post->draw_post();


echo '
	<div class="selfPost">
		<font color="white"> ' .$post_data[0]['Description']. ' </font>
	</div>';
?>

<div class="selfComment">	
	<form method="POST">
		<input type="hidden" name="action" value="new_entry"/>
		<textarea rows="6" cols="68" value="" name="name" id="comment" style="color: white; background-color: #1E1E1E" ></textarea><br><br/>			
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
include_once '_Comment.php';

// failist lugemine
//$data = file('...comments.txt');
// foreach ($data as $entryData) {
	// $entryParts = explode(';', $entryData);
	// if ( isset($entryParts[0]) && isset($entryParts[1]) && isset($entryParts[2]) ){
	
		// $comm = $entryParts[0];
		// $author = $entryParts[1];
		// $date = $entryParts[2];
			
		// $comment = new Comment($comm, $author, $date);
		// $comment->draw_comment();
	// }
// }

$data = getAllComments($_GET['post_id']);

foreach ($data as $row) {
    $user = getUserById($row['User_ID']);
	$comment = new Comment($row['Content'], $user, $row['Posted'], $row['Upvote']-$row['Downvote']);
	$comment->draw_comment();
	
}

?>