<?php
class Post {
	private $tiitel;
	private $category;
	
	
	public function __construct ($tiitel, $category) {
	$this->tiitel = $tiitel;
	$this->category = $category;
}

	public function draw_post (){
		echo '
			<div class="postBoxRow" id="postBoxRow">
		<div class="vertIcon">
		</div>
		<div class="postBox">	
			<div class="voteBox">
				<a class="s1" href="http://www.reddit.com/"><img class="mid"" src="img/upV.png" width="50" height="50" alt="" /></a>
				
			</div>
			<div class="postDataBox">	
				<div class="postDataBoxUp">	
					<a class="s1" href="index.php?lecture=' .$this->category. '&lehekylg=' .$this->tiitel. '">' .$this->tiitel. '</a>
					
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


}

?>