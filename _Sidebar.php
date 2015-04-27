<?php

class Sidebar {
private $username;
private $fbUser;
private $posts;
private $comments;

public function __construct ($username, $fbUser) {
	$this->username = $username;
	$this->fbUser = $fbUser;
	
}

public function setPosts($posts){
	$this->posts = $posts;
	
}

public function setComments($comments){
	$this->comments = $comments;
	
}


public function getLecture(){
	if (isset($_GET['lecture'])){
		return '&lecture='.$_GET['lecture'].'';
	}
	else{
		return '';
	}
}

public function draw_login_form (){
	echo '	
		<div class="upUp">
		
			<div class="upUpLeft">			
				<a href="index.php"><img class="pic" src="img/logo.png" alt="" width="104" height="104"/></a><br/><br/>
			</div>	
		
			<div class="upUpRight">						
				<div class="upUpRightLeft2" id="upUpRightLeft2">
				
					<form method="POST" id="login_form" style="display: inline;">
							<input class="loginField" type="text" size="12" maxlength="15" value="" placeholder="Kasutajanimi" id="Username" name="login_username" ><br/>
							<input class="loginField" type="password" size="12" maxlength="15" value="" placeholder="Parool" name="login_password" ><br/>
							<input class="rightLink" type="submit" name="login_button" id="login_button" value="Log in"><br/><br/>
					</form>	
					
						<a class="rightLink" id="facebook" >Facebook</a>
				</div>
				
				<div class="upUpRightRight">				
				</div>
			</div>

		</div>			
		';	

		
	echo'
		<div class="upDown" id="upDown">
		
				<div class="upDownLeft">
					<a href="index.php?newpost=true'.$this->getLecture().'" class="rightLink" id="newpost">New post</a>								
				</div>
					

			<div class="upDownRight">
				<a href="index.php?kontoloomine=true" class="rightLink" id="makeacc">Looge konto</a>
			</div>
		</div>
					
';
		
}

public function draw_sidebar_top (){
	
	if ($this->fbUser){
		$fbIcon = '<img src="img/facebook-icon.png" alt="" width="15" height="15"/>';
		$userNameDotsInsteadOfSpaces = str_replace(" ", ".", $this->username);
		$userImageUrl = 'http://graph.facebook.com/'.$userNameDotsInsteadOfSpaces.'/picture?type=large';
	}
	else{
		$fbIcon = '';
		$userImageUrl = "img/pic.jpeg";
	}
	
echo'
		<div class="upUp">
			<div class="upUpLeft">			
				<a href="index.php?username=' .$this->username. '"><img class="pic" src="'.$userImageUrl.'" alt="" width="104" height="104"/></a><br/><br/>
				
			</div>	
			<div class="upUpRight">		
				<div class="upUpRightLeft">	
					<div class="upUpRightBox">
						<a class="m1" href="index.php?profile=' .$this->username. '"><b>'.$fbIcon.''.$this->username.'</b></a>
					</div>
					<div class="upUpRightBoxT"></div>
					<div class="upUpRightBox">
						<a class="m1" href="index.php?profile=' .$this->username. '"><b>Posts: '.$this->posts.'</a></b>
					</div>
					<div class="upUpRightBoxT"></div>
					<div class="upUpRightBox">
						<a class="m1" href="index.php?profile=' .$this->username. '"><b>Comments: '.$this->comments.'</b></a>
					</div>
				</div>
				<div class="upUpRightRight">				
				</div>
			</div>					
		</div>
		
		<form method="POST" style="display: inline;">
		
			<div class="upDown">
				<div class="upDownLeft">
					<a href="index.php?newpost=true'.$this->getLecture().'" class="rightLink" id="newpost">New post</a>								
				</div>
				
				<div class="upDownRight">
					<input class="rightLink" type="submit" name="logout_button" value="Log Out">					
				</div>	
				
			</div>
		</form>';
}

}
?>