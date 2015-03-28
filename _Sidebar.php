<?php

class Sidebar {
private $username;
	public function __construct ($username) {
	$this->username = $username;
	
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
				<a href="index.php"><img class="pic" src="img/logo.png" width="104" height="104"/></a><br/><br/>
			</div>	
		
			<div class="upUpRight">	
				<form method="POST" id="login_form" style="display: inline;">
					<div class="upUpRightLeft">	
						<input type="text" size="15" maxlength="15" value="" placeholder="Kasutajanimi" style="color:black" id="Username" name="login_username" ><br/>
						<input type="password" size="15" maxlength="15" value="" placeholder="Parool" style="color:black" name="login_password" ><br/></br>
						<a><input class="rightLink" type="submit" name="login_button" id="login_button" value="Log in"></a></br></br>
						<a class="rightLink" type="button" name="facebook" id="facebook">Facebook</a>
					</div>
				</form>	
				<div class="upUpRightRight">				
				</div>
			</div>

		</div>			
		';	

		
	echo'
		<div class="upDown" id="upDown">
		
				<div class="upDownLeft">
					<a href="index.php?newpost=true'.$this->getLecture().'"><input class="rightLink" type="button" name="newpost" id="newpost" value="New post"></a>								
				</div>
					

			<div class="upDownRight">
				<a href="index.php?kontoloomine=true"><button class="rightLink" type="button">Looge konto</button></a>
			</div>
		</div>
					
';
		
}

public function draw_sidebar_top (){
echo'
		<div class="upUp">
			<div class="upUpLeft">			
				<a href="index.php?username=' .$this->username. '"><img class="pic" src="img/pic.jpeg" width="104" height="104"/></a><br/><br/>
				
			</div>	
			<div class="upUpRight">		
				<div class="upUpRightLeft">	
					<div class="upUpRightBox">
						<a class="m1" href="index.php?profile=' .$this->username. '"><b>'.$this->username.'</b></a>
					</div>
					<div class="upUpRightBoxT"></div>
					<div class="upUpRightBox">
						<a class="m1" href="index.php?profile=' .$this->username. '"><b>Posts: 54</a></b>
					</div>
					<div class="upUpRightBoxT"></div>
					<div class="upUpRightBox">
						<a class="m1" href="index.php?profile=' .$this->username. '"><b>Comments: 172</b></a>
					</div>
				</div>
				<div class="upUpRightRight">				
				</div>
			</div>					
		</div>
		
		<form method="POST" style="display: inline;">
		
			<div class="upDown">
				<div class="upDownLeft">
					<a href="index.php?newpost=true'.$this->getLecture().'"><input class="rightLink" type="button" name="newpost" id="newpost" value="New post"></a>								
				</div>
				
				<div class="upDownRight">
					<a><input class="rightLink" type="submit" name="logout_button" value="Log Out"></a>					
				</div>	
				
			</div>
		</form>';
}

}
?>