<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400;300' rel='stylesheet' type='text/css'>
</head>

<?php
	$username = "";
	if (isset($_GET['profile_id'])){
		$userInfoBig = getUserById($_GET['profile_id']);
		if (isset($userInfoBig[0])){
			$userInfo = $userInfoBig[0];
		}else{
			include_once 'errorPage.php';
		}
		$username = $userInfo['Name'];
	}
	else {
		$userInfoBig = userExists($_GET['profile'], "");
		if ($userInfoBig!=0){
			$userInfo = getUserById($userInfoBig)[0];
		}
		else{
			include_once 'errorPage.php';
		}
		
		$username = $userInfo['Name'];
	}
	
	// kas on fb kasutaja
	if ($userInfo['Password'] == null){
		$fbUser = true;
	}else{
		$fbUser = false;
	}
	
			
	if ($fbUser){
		$fbIcon = '<img src="img/facebook-icon.png" width="10" height="10"/>';
		$userNameDotsInsteadOfSpaces = str_replace(" ", ".", $username);
		$userImageUrl = 'http://graph.facebook.com/'.$userNameDotsInsteadOfSpaces.'/picture?type=large';
	}
	else{
		$fbIcon = '';
		$userImageUrl = "img/pic.jpeg";
	}
	
?>
<img src='<?php echo $userImageUrl ?>' style=''><br/>

<font color="white">Joined: <?php echo formatDate($userInfo['Joined']); ?> </font><br/>

<font color="white">Username: <?php echo $fbIcon. '' .$username; ?><br>
			Posts: ??<br>
			Comments: ??<br></font>

</html>