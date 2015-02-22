<?php

class Phonebook {

private $header = '<body id="top">

<div id="header-wrapper">
	<div id="header-wrapper-2">
		<div class="center-wrapper">

			<div id="header">

				<div id="logo">
					<h1 id="site-title"><a href="#">Freshmade <span>Software</span></a></h1>
					<h2 id="site-slogan">Another Free Website Template</h2>
				</div>

				<div id="help-wrapper">
					<div id="help">

						<a href="#">Contact us</a> <span class="text-separator">|</span> <a href="#">F.A.Q</a> <span class="text-separator">|</span> <a href="#">Sitemap</a>

					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<div id="navigation-wrapper">
	<div id="navigation-wrapper-2">
		<div class="center-wrapper">
	
			<div id="navigation">

				<ul class="tabbed">
					<li><a href="index.html">Home</a></li>
					<li><a href="product_details.html">Product Details</a></li>
					<li><a href="blog_post.html">Blog Post</a></li>
					<li><a href="archives.html">Archives</a></li>
					<li><a href="style_demo.html">Style Demo</a></li>
					<li class="current_page_item"><a href="empty_page.html">Empty Page</a></li>
				</ul>

				<div class="clearer">&nbsp;</div>

			</div>

		</div>
	</div>
</div>

<div id="content-wrapper">
	<div class="center-wrapper">
		
		<div class="content">

			<div id="main">';

		
private $footer = '			</div>

		</div>

	</div>
</div>

<div id="footer-wrapper">

	<div class="center-wrapper">

		<div id="footer">

			<div class="left">
				<a href="index.html">Home</a> <span class="text-separator">|</span> <a href="product_details.html">Product Details</a> <span class="text-separator">|</span> <a href="blog_post.html">Blog Post</a> <span class="text-separator">|</span> <a href="archives.html">Archives</a> <span class="text-separator">|</span> <a href="style_demo.html">Style Demo</a> <span class="text-separator">|</span> <a href="empty_page.html">Empty Page</a>
			</div>

			<div class="right">
				<a href="#">Top ^</a>
			</div>
			
			<div class="clearer">&nbsp;</div>

		</div>

	</div>

</div>

<div id="bottom">

	<div class="center-wrapper">

		<div class="left">
			&copy; 2009 Website.com - Your Website Slogan <span class="text-separator">|</span> <a href="#">Privacy Policy</a> <span class="text-separator">|</span> <a href="#">Terms of Use</a> 
		</div>

		<div class="right">
			<a href="http://templates.arcsin.se/">Website template</a> by <a href="http://arcsin.se/">Arcsin</a> 
		</div>
		
		<div class="clearer">&nbsp;</div>

	</div>

</div>

</body>';
		
public function teeheader() {
echo $this->header;
}

public function teefooter() {
echo $this->footer;
}




}

?>