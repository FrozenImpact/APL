<?php
class Comment {
	private $sisu;
	private $autor;
	private $kuup2ev;
	private $skoor;
	
	public function __construct ($sisu, $author, $date, $score) {
	$this->sisu = $sisu;
	if ($sisu == ""){
		$this->sisu = "-";
	}
	$this->autor = $author;
	$this->kuup2ev = $date;
	$this->skoor = $score;
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