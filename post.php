<?php
// kirjuta comment tekstfaili
function save ($dataArray) {
	$fp = fopen('...comments.txt', 'a+');
	fwrite($fp, $dataArray['name']);
	
	if(isset($_SESSION['login_user'])){
		fwrite($fp, ';'.$_SESSION['login_user'].';');
	}
	else{
		fwrite($fp, ';Anon;');
	}
	
	fwrite($fp, time());
	fwrite($fp, ''. PHP_EOL .'');  	//reavahetus
	fclose($fp);
	return true;
}


include_once '_Post.php';

$post = new Post($_GET['lehekylg'], $_GET['lecture']);
$post->draw_post();

// sample andmed
echo '
	<div class="selfPost">
		<font color="white"> tiitel ütleb kõik, aitäh! </font>
	</div>


	<div class="selfComment">	
			<form method="POST">
				<input type="hidden" name="action" value="new_entry"/>
				<textarea rows="6" cols="68" value="" name="name" id="comment" style="color: white; background-color: #1E1E1E" ></textarea><br><br/>			
				<input class="rightLink" type="submit" value="Reply"/>
			</form>	
	</div>';


if (isset($_POST['action'])) {
		if (isset( $_SESSION['login_user'] )){
			save($_POST);
			echo "<script type='text/javascript'>$.removeCookie('example');</script>";
		}

		else{
			echo '<script>window.location.href = "logon.php?lecture=' .$_GET['lecture']. '&lehekylg=' .$_GET['lehekylg']. '";</script>';
		}


}
include_once '_Comment.php';

// failist lugemine
$data = file('...comments.txt');
foreach ($data as $entryData) {
	$entryParts = explode(';', $entryData);
	if ( isset($entryParts[0]) && isset($entryParts[1]) && isset($entryParts[2]) ){
	
		$comm = $entryParts[0];
		$author = $entryParts[1];
		$date = $entryParts[2];
			
		$comment = new Comment($comm, $author, $date);
		$comment->draw_comment();
	}
}

?>