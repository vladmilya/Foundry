<?php
get_header(); 
?>
<style>
body{background-color:#000;}
</style>
<!-- Start navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
  	<div class="row">
	  <div class="container">
		  <div class="row">
		  
			<div class="navbar-header">
			  <?php /*<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="fa-bars"><img src="<?php echo get_template_directory_uri()?>/images/icon-bars.png" alt="" /></span>
				<span class="fa-times"><img src="<?php echo get_template_directory_uri()?>/images/icon-times.png" alt="" /></span>
			  </button>*/?>
			  <a class="navbar-brand" href="<?php echo site_url('/'); ?>"><img src="<?php echo get_template_directory_uri()?>/images/logo-foundry.png" alt="" /></a>
			</div>
		
			<div class="collapse navbar-collapse" >
			  <ul class="nav navbar-nav-404 navbar-right">
				<li><a href="<?php echo site_url('/'); ?>#news">News</a><font>|</font></li>
				<li><a href="<?php echo site_url('/'); ?>#the-work">The Work</a><font>|</font></li>
				<li><a href="<?php echo site_url('/'); ?>#capabilities">Capabilities</a><font>|</font></li>
				<li><a href="<?php echo site_url('/'); ?>#clients">Clients</a><font>|</font></li>
				<li><a href="<?php echo site_url('/'); ?>#about-the-foundry">About the Foundry</a><font>|</font></li>
				<li><a href="<?php echo site_url('/'); ?>#contact-us">Contact Us</a></li>
			  </ul>
			</div>
			
		  </div>
	  </div>
	 </div>
  </div>
</nav>
<!-- Stop navigation -->

<div class="container page-404" style="background-image:url(<?php echo get_template_directory_uri()?>/images/pic-404.jpg);">
<div class="row">
				
<div class="play-again">
	<a href="<?php echo site_url('/'); ?>" title="">Play Again?</a>
</div>
		
		
<div class="time-inc">A division of <span><img src="<?php echo get_template_directory_uri()?>/images/time-inc-logo.png" alt="Time Inc" /></span></div>
			

</div>
</div>

<?php
get_footer();
?>