<?php
class Sidebar {
private $username;

	public function __construct ($username) {
	$this->username = $username;
}

public function kirjuta (){
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
		
			<a href="profile.php"><button type="button">Settings</button></a>
			
			
			<form method="POST">
			<a href="profile.php"><button type="button">Log Out</button></a>
			</form>

		</div>


';
}	
}
?>