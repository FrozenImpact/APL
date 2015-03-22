<?php
class Comment {
	private $sisu;
	private $autor;
	private $skoor;
	private $kuup2ev;
	
	public function __construct ($sisu, $author, $date) {
	$this->sisu = $sisu;
	$this->autor = $author;
	$this->skoor = rand ( 1 , 20 );
	$this->kuup2ev = date("d.m.Y H:i:s", (int)$date); //''.rand ( 1 , 31 ).'.'.rand ( 1 , 12 ).'.'.rand ( 1994 , 2015 ).'';
}
 






	public function draw_comment (){
		echo '
		<div class="postBox">	
			<div class="voteBox">
				<a class="s1" href="#"><img class="mid"" src="img/upV.png" width="30" height="30" alt="" /></a>
			</div>
		
			<div class="postDataBox">
				<div class="postDataBoxUp">	
					<font color="white">' .$this->sisu. '</font>
				</div>
				
				<div class="postDataBoxDown">
					<div class="dataComments">	
						<a class="n1" href="index.php?profile='.$this->autor.'">'.$this->autor.' </a>
					</div>
					<div class="dataScore">	
						<i1>'.$this->skoor.'</i1>
					</div>				
					<div class="dataDate">	
						<h>'.$this->kuup2ev.'</h>
					</div>
				</div>					
			</div>		
			
			<div class="voteBox">
				<a class="s1" href="#"><img class="mid" src="img/downV.png" width="30" height="30" alt=""/></a>
			</div>
				
	</div><br/><br/>';

	}

}

?>