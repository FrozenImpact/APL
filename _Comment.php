<?php
class Comment {
	private $sisu;
	private $autor;
	private $skoor;
	private $kuup2ev;
	
	
	public function __construct ($sisu) {
	$this->sisu = $sisu;
	$this->autor = 'autor ';
	$this->skoor = rand ( 1 , 20 );
	$this->kuup2ev = ''.rand ( 1 , 31 ).'.'.rand ( 1 , 12 ).'.'.rand ( 1994 , 2015 ).'';
}

	public function kirjuta (){
		echo '
		
			<div class="postBox">	
		<div class="voteBox">
			<a class="s1" href="http://www.reddit.com/"><img class="mid"" src="img/upV.png" width="30" height="30" alt="" /></a>
		</div>
		<div class="postDataBox">	
			<div class="postDataBoxUp">	
				<a>' .$this->sisu. '</a>
			</div>
			<div class="postDataBoxDown">
				<div class="dataComments">	
					<a class="n1" href="profile.php">'.$this->autor.' </a>
				</div>
				<div class="dataScore">	
					<i1>'.rand ( 1 , 20 ).'</i1>
				</div>				
				<div class="dataDate">	
					<h>'.rand ( 1 , 31 ).'.'.rand ( 1 , 12 ).'.'.rand ( 1994 , 2015 ).'</h>
				</div>
			</div>			
		</div>			
		<div class="voteBox">
			<a class="s1" href="http://www.reddit.com/"><img class="mid" src="img/downV.png" width="30" height="30" alt=""/></a>
		</div>
				
	</div><br/><br/>';
	

		
		
	}

}

?>