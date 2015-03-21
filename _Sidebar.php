<?php
class Sidebar {
private $username;

	public function __construct ($username) {
	$this->username = $username;
}

public function draw_login_form (){
echo '
		<div class="upUp">
		
			<div class="upUpLeft">			
				<a href="index.php"><img class="pic" src="img/logo.png" width="104" height="104"/></a><br/><br/>
			</div>	
			
			</br>
			</br>
			<div class="upUpRight">		
			
				<form method="POST" id="login_form" style="display: inline;">
					<input type="text" size="15" maxlength="15" value="" placeholder="Kasutajanimi" style="color:black" id="Username" name="login_username" ><br/>
					<input type="password" size="15" maxlength="15" value="" placeholder="Parool" style="color:black" name="login_password" ><br/>	
					<a><input class="n2 rightLink" style="width:137px" type="submit" name="login_button" id="login_button" value="Logi sisse"></a>
				
				</form>	

			</div>

			</div>			
		';	

		
		echo'
		<div class="upDown" id="upDown">
		
			<div class="upDownLeft">
		
				<a href="index.php?settings=true"><input class="n2 rightLink" type="button" name="settings" id="settings" value="Sätted"></a>
		
			</div>
					
					
			<div class="upDownRight">
				<a><input class="n2 rightLink" type="button" name="facebook" id="facebook" value="Facebook"></a>
			</div>

			<div class="upDownRight">
				<a href="index.php?kontoloomine=true"><button class="n2 rightLink" type="button">Looge konto</button></a>
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
						<a class="n1" href="index.php?profile=' .$this->username. '"><b>'.$this->username.'</b></a>
					</div>
					<div class="upUpRightBoxT"></div>
					<div class="upUpRightBox">
						<a class="n1" href="index.php?profile=' .$this->username. '"><b>Postitusi: 54</a></b>
					</div>
					<div class="upUpRightBoxT"></div>
					<div class="upUpRightBox">
						<a class="n1" href="index.php?profile=' .$this->username. '"><b>Kommentaare: 172</b></a>
					</div>
				</div>
				<div class="upUpRightRight">				
				</div>
			</div>					
		</div>
		
		
		
		<form method="POST" style="display: inline;">
		<div class="upDown">
		
		
			<div class="upDownLeft">
			<a href="index.php?settings=true"><input class="n2 rightLink" type="button" name="settings" id="settings" value="Sätted"></a>
							
		</div>

		<div class="upDownRight">
			<a><input class="n2 rightLink" type="submit" name="logout_button" value="Logi välja"></a>
				
		</div>	
		</div></form>';
}

public function draw_sidebar_bot (){
	echo'
	<form method="post">
		<input type="search2" value="" onkeyup="submit" name="class_search_entry" id="class_search_entry" size="15" maxlength="15">
	</form>
	';
}




	
}
?>