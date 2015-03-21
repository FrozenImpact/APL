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


	public function draw_post (){
		echo '
			<div class="postBoxRow">
		<div class="vertIcon">
		</div>
		<div class="postBox">	
			<div class="voteBox">
				<a class="s1" href="http://www.reddit.com/"><img class="mid"" src="img/upV.png" width="50" height="50" alt="" /></a>
				
			</div>
			<div class="postDataBox">	
				<div class="postDataBoxUp">	
					<a class="s1" href="post.php?lehekylg=' .$this->tiitel. '">' .$this->tiitel. '</a>
					
				</div>
				<div class="postDataBoxDown">
					<div class="dataComments">	
						<h>Replies: 16</h>
						
					</div>
					<div class="dataScore">	
						<i1>78</i1>
						
					</div>				
					<div class="dataDate">	
						<h>16.02.2015</h>
						
					</div>
				</div>			
			</div>			
			<div class="voteBox">
				<a class="s1" href="http://www.reddit.com/"><img class="mid" src="img/downV.png" width="50" height="50" alt=""/></a>
				
			</div>				
		</div>	
	</div>
		';
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