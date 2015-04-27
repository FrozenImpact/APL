<?php
	include_once '_Comment.php';
	
	$username = "";
	if (isset($_GET['profile_id'])){
		$userInfoBig = getUserById($_GET['profile_id']);
		if (isset($userInfoBig[0])){
			$userInfo = $userInfoBig[0];
		}else{
			include_once 'errorPage.php';
		}
		$username = $userInfo['Name'];
		$userInfoBig = $_GET['profile_id'];
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
		$fbIcon = '<img src="img/facebook-icon.png" alt="" width="10" height="10"/>';
		$userNameDotsInsteadOfSpaces = str_replace(" ", ".", $username);
		$userImageUrl = 'http://graph.facebook.com/'.$userNameDotsInsteadOfSpaces.'/picture?type=large';
	}
	else{
		$fbIcon = '';
		$userImageUrl = "img/pic.jpeg";
	}
	
?>
<img src='<?php echo $userImageUrl ?>' alt="" style=''><br/>

<a style="color:white;">Joined: <?php echo formatDate($userInfo['Joined']); ?> </a><br/>

<a style="color:white;">Username: <?php echo $fbIcon. '' .$username; ?><br/>
			Posts:  <?php echo numberOfPosts($userInfoBig); ?><br/>
			Comments: <?php echo numberOfComments($userInfoBig); ?><br/></a>

			
<?php 
			
	$data = getUserPostsandComments($username);
	foreach($data as $row){
		if ($row['Content'] == null){
			$category = getCategoryName($row['Category']);
			$post = new Post($row['Post_ID'], $row['Heading'], $category, $row['Posted'], $row['Upvote']-$row['Downvote']);
			$post->draw_post();
		}
		else if ($row['Description'] == null){
			$user = getUserById($row['User_ID']);
			$comment = new Comment($row['Content'], $user, $row['Posted'], $row['Upvote']-$row['Downvote']);
			$comment->draw_comment();
		}
	}

?>			
