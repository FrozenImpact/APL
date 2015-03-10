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
	<j1>Matemaatiline analüüs</j1><br/><br/>
	
	<?php
		include_once '_Post.php';

		$data = file('...posts.txt');
		foreach ($data as $entryData) {
			$entryParts = explode(';', $entryData);
			foreach ($entryParts as $comm) {
		
				if ($comm != ''){
					$post = new Post($comm);
					$post->draw_post();
				}
			}
		}
	?>
	
	
  
</div>
</div>