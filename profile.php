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
			<div class="separator1"></div>
			
<?php 
			
	$data = getUserPostsandComments($username);
	if (!isset($_GET['page'])){
		$page=0;
	}
	else{
		$page=$_GET['page'];
	}
	
	$loendur=0;
	for($i = $page*10; $i<($page*10)+10; $i++){
		//echo '<font color="white">'.$i.'</font><br/>';
		if (isset($data[$i])){
			$loendur++;
			if ($data[$i]['Content'] == null){
				$category = getCategoryName($data[$i]['Category']);
				$post = new Post($data[$i]['id'], $data[$i]['Heading'], $category, $data[$i]['Posted'], $data[$i]['Upvote']-$data[$i]['Downvote']);
				$post->draw_post();
			}
			else if ($data[$i]['Description'] == null){
				$user = getUserById($data[$i]['User_ID']);
				$comment = new Comment($data[$i]['id'],$data[$i]['Content'], $user, $data[$i]['Posted'], $data[$i]['Upvote']-$data[$i]['Downvote']);
				$comment->setParentPostId ($data[$i]['Post_ID']);
				$comment->draw_comment();
			}
		}
	}
	if ($loendur>=10){
		$pagePlusOne=$page+1;
		echo '<br/><a href="index.php?profile='.$_GET['profile'].'&page='.$pagePlusOne.'" class="rightLink" id="nextpage">Next page</a><div class="separator1"></div>';
	}
	else if ($loendur==0){
		echo '<a style="color:white;"><br/>There seems to be nothing here...</a>';
	}
	
	


?>			
