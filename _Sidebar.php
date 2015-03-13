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
			<div class="upDownLeft">
			<a><input class="n2 rightLink" type="submit" name="login_button" value="Log in"></a>
					</div>
			<div class="upDownRight">
			<a href="#"><button class="n2 rightLink" type="button">Make account</button></a>
					</div>
		</div>
		</form>';
}

public function draw_sidebar_top (){
echo'
		<div class="upUp">
			<div class="upUpLeft">			
				<a href="http://www.reddit.com/"><img class="pic" src="img/pic.jpeg" width="100" height="100"/></a><br/><br/>
				<b>Joined: 29.01.2015</b><br/><br/>
				<b>Last Visit: 29.01.2015</b><br/><br/>
				
			</div>	
			<div class="upUpRight">		
				<div class="upUpRightLeft">	
					<div class="upUpRightBox"></div>
					<div class="upUpRightBox">
						<a class="n1" href="#1"><b>PotatoeMan</b></a>
					</div>
					<div class="upUpRightBox"></div>
					<div class="upUpRightBox">
						<a class="n1" href="#2"><b>Posts: 54</a></b>
					</div>
					<div class="upUpRightBox"></div>
					<div class="upUpRightBox">
						<a class="n1" href="#3"><b>Comments: 172</b></a>
					</div>
				</div>
				<div class="upUpRightRight">				
				</div>
			</div>					
		</div>
		<form method="POST">
		<div class="upDown">
		
		
			<div class="upDownLeft">
			<a href="profile.php"><button class="n2 rightLink" type="button">Settings</button></a>
							
		</div>

		<div class="upDownRight">
			<a><input class="n2 rightLink" type="submit" name="logout_button" value="Log Out"></a>
				
		</div>	
		</div>	
		</form>
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