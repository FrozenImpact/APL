<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style.css?v=1.1" media="screen">
<title>APL</title>
</head>

<body style="background-color: #222222;">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="facebook.js"></script>	
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
			// vigane sisend
			echo '<a style="color:red;">Sisestati vale või puudulik info.</a><br/>';
		}
	}
	
	// kas fesari nuppu on vajutatud?
	if (isset($_POST['fb'])){
		if (userExists ($_POST['fb'], "") != 0){
			$_SESSION['login_user']= $_POST['fb'];
			$_SESSION['login_user_id']= userExists ($_POST['fb'], "");
		}
		else{
			addUser($_POST['fb'], "");
			$_SESSION['login_user']= $_POST['fb'];
			$_SESSION['login_user_id']= userExists ($_POST['fb'], "");
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
?>



	<a style="color:white;">Selle lehekülje nägemiseks peate olema sisse logitud.<br/></a>
	<form method="POST" id="login_form" style="display: inline;">
		<input class="loginField" type="text" size="15" maxlength="15" value="<?php if (isset($_POST['login_username'])) echo $_POST['login_username']; ?>" placeholder="Kasutajanimi" id="Username" name="login_username" ><br/>
		<input class="loginField" type="password" size="15" maxlength="15" value="<?php if (isset($_POST['login_password'])) echo $_POST['login_password']; ?>" placeholder="Parool" name="login_password" ><br/><br/>
		<input class="n2 rightLink" type="submit" name="login_button" id="login_button" value="Logi sisse">

	</form>	
	<input class="n2 rightLink" type="button" name="facebook" id="facebook" value="Facebook">
	<a href="index.php?kontoloomine=true" class="rightLink" id="makeacc">Looge konto</a>

</div>
</body>
</html>