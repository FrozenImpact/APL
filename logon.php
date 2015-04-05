<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css?v=1.1" media="screen" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="facebook.js"></script>	

<body bgcolor="#222222">

<div class="center-wrapper_">
<?php
		session_start();
		
		include_once 'db/sql_functions.php';
		
		// kas sisselogimisnuppu on vajutatud
		if (isset( $_POST['login_button'] )){
			if (userExists ($_POST['login_username'], $_POST['login_password']) != 0){
				
				$_SESSION['login_user']= $_POST['login_username']; 
				$_SESSION['login_user_id']= userExists ($_POST['login_username'], $_POST['login_password']);
			}
			else{
				echo '<font color="red">Sisestati vale või puudulik info.</font>';
			}
		}
	
		// kas kasutaja on sisse logitud
		if (isset( $_SESSION['login_user'] )){
			if (isset($_GET['newpost'])){
				if (isset($_GET['lecture'])){
					echo '<script>window.location.href = "index.php?newpost=true&lecture=' .$_GET['lecture']. '";</script>';
				}
				else{
					echo '<script>window.location.href = "index.php?newpost=true";</script>';
				}
			}
			else if (isset($_GET['lecture']) && isset($_GET['lehekylg'])){				
				echo '<script>window.location.href = "index.php?lecture=' .$_GET['lecture']. '&lehekylg=' .$_GET['lehekylg']. '&post_id=' .$_GET['post_id']. '";</script>';
			}
			else{				
				echo '<script>window.location.href = "index.php";</script>';
			}
		}
		
		// kui ei siis n2ita sisselogimisdialoogi
		else{
			echo '
			<font color="white">Selle lehekülje nägemiseks peate olema sisse logitud.</br></font>
			<form method="POST" id="login_form" style="display: inline;">
				<input type="text" size="15" maxlength="15" value="" placeholder="Kasutajanimi" style="color:black" id="Username" name="login_username" ><br/>
				<input type="password" size="15" maxlength="15" value="" placeholder="Parool" style="color:black" name="login_password" ><br/>	
				<a><input class="n2 rightLink" type="submit" name="login_button" id="login_button" value="Logi sisse"></a>
			
			</form>	

			<a><input class="n2 rightLink" type="button" name="facebook" id="facebook" value="Facebook"></a>
			<a href="index.php?kontoloomine=true"><button class="n2 rightLink" type="button">Looge konto</button></a>
			';
		}
		
		
?>
</div>