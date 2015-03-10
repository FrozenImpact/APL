<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />


<div class="right">
<div class="up">
<?php
	session_start();
	
	include_once '_Sidebar.php';
	
	// kas sisselogimisnuppu on vajutatud
	if (isset( $_POST['login_button'] )){
		$_SESSION['login_user']= $_POST['login_username']; 
	}
	
	// kas väljalogimisnuppu on vajutatud
	if (isset( $_POST['logout_button'] )){
		unset($_SESSION['login_user']); 
	}
	
	// kas kasutaja on sisse logitud
	if (isset( $_SESSION['login_user'] )){
		$sidebar = new Sidebar($_SESSION['login_user']);
		$sidebar->draw_sidebar_top();
	}
	// kui ei siis n2ita sisselogimisnuppu
	else{
		$sidebar = new Sidebar("");
		$sidebar->draw_login_form();
	}
?>
</div>
<div class="down">					
</div>
</div>


<div class="left">

<div class="postHead">
<?php

	echo '<j1>Matemaatiline analüüs</j1><br/><br/>';
	
	include_once '_Post.php';

	$post = new Post($_GET['lehekylg']);
	$post->draw_post();
?>
	<div class="selfPost">
		<h> tiitel ütleb kõik, aitäh! </h>
	</div>


<div class="selfComment">	
		<form method="POST">
			<input type="hidden" name="action" value="new_entry"/>
			<textarea rows="6" cols="68" value="" name="name" ></textarea><br><br/>			
			<input class="button" type="submit" value="Reply"/>
		</form>	
</div>

<?php
	if (isset($_POST['action'])) {
		save($_POST);
	}

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

	include_once '_Comment.php';

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
</div>	   
</div>
</div>	
