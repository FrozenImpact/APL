<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />

	
<div class="right">

	<div class="up">
<?php
session_start();


	include_once '_Sidebar.php';
	
	if (isset( $_SESSION['login_user'] )){
		$sidebar = new Sidebar($_SESSION['login_user']);
		$sidebar->kirjuta();
	}
	else{
		echo '';
	}

	
	
//$_SESSION['login_user']= 'username'; 

	

?>
	</div>
	
	
	
	<div class="down">					
	</div>
</div>


<div class="left">
	
	<h1>Matemaatiline analüüs</h1><br/><br/>
	
	<?php
		include_once '_Post.php';

		$data = file('...posts.txt');
		foreach ($data as $entryData) {
			$entryParts = explode(';', $entryData);
			foreach ($entryParts as $comm) {
		
				if ($comm != ''){
					$post = new Post($comm);
					$post->kirjuta();
				}
			}
		}
	?>
	
	
  
</div>