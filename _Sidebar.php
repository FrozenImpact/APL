<?php
class Sidebar {
private $username;

	public function __construct ($username) {
	$this->username = $username;
}

public function draw_login_form (){
echo '
		<form method="POST">
			<input type="text" size="15" maxlength="15" value="Username" name="login_username" ><br/>
			<input type="password" size="15" maxlength="15" value="Password" name="login_password" ><br/>
			
		<div class="upDown">
			<a><input class="settingsBut" type="submit" name="login_button" value="Log in"></a>
			<a href="#"><button class="logOutBut" type="button">Make account</button></a>
		</div>
		</form>';
}

public function draw_sidebar_top (){
echo'
		<div class="upUp">
			<div class="upUpLeft">	
			
				<a href="profile.php"><img class="pic" src="img/pic.jpeg" width="100" height="100"/></a><br/><br/>
				<h>Joined: 29.01.2015</h><br/><br/>
				<h>Last Visit: 29.01.2015</h><br/><br/>
				
			</div>
			<div class="upUpRight">	
			
				<br/><a class="n1" href="profile.php">'.$this->username.'</a><br/><br/>
				<a class="n1" href="profile.php">Posts: 54</a><br/><br/>
				<a class="n1" href="profile.php">Comments: 172</a><br/><br/>
				
			</div>
		</div>
		<div class="upDown">
		
		<form method="POST">
			<a href="profile.php"><button class="settingsBut" type="button">Settings</button></a>
			

			<a><input class="logOutBut" type="submit" name="logout_button" value="Log Out"></a>

		</form>	
		</div>	
';
}

public function draw_sidebar_bot (){
	echo'
	<form method="post">
		<input type="text" value="" onkeyup="submit" name="class_search_entry" id="class_search_entry" size="15" maxlength="15">
	</form>
	';
}




	
}
?>