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
		echo '';
		
		
		echo '<a href="http://www.reddit.com/"><img src="up.png" width="20" height="20" alt="" />';

		echo '<a>' .$this->sisu. '</a>';
	
		echo '<a href="http://www.reddit.com/"><img src="up.png" width="20" height="20" alt="" />';
		
		echo '<br /><a>'.$this->autor.' </a>';
		echo '<a>'.$this->skoor.' </a>';
		echo '<a>'.$this->kuup2ev.'</a>';
		echo '<br /><br />';
		
		
		
	}

}

?>