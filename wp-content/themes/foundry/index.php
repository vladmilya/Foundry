<?php
get_header(); 
?>

<?php //main posts
$args = array(   
    'showposts'=>-1,
    'category_name' => 'main'
); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $img =wp_get_attachment_url( get_post_thumbnail_id($query->post->ID) );
        $meta = get_post_meta($query->post->ID);
        $aMainPosts[$query->post->post_name]['id'] = $query->post->ID;
        $aMainPosts[$query->post->post_name]['name'] = $query->post->post_name;
        $aMainPosts[$query->post->post_name]['title'] = $query->post->post_title;
        $aMainPosts[$query->post->post_name]['header'] = $meta['header'][0];
        $aMainPosts[$query->post->post_name]['content'] = $query->post->post_content;
        $aMainPosts[$query->post->post_name]['img'] = $img;
    }
}
$numPosts = count($aMainPosts);
//dump($aMainPosts);
wp_reset_postdata();
?>

<!-- Start navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
  	<div class="row">
	  <div class="container">
		  <div class="row">
		  
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="fa-bars"><img src="<?php echo get_template_directory_uri()?>/images/icon-bars.png" alt="" /></span>
				<span class="fa-times"><img src="<?php echo get_template_directory_uri()?>/images/icon-times.png" alt="" /></span>
			  </button>
			  <a class="navbar-brand" href="<?php echo site_url('/'); ?>"><img src="<?php echo get_template_directory_uri()?>/images/logo-foundry.png" alt="" /></a>
			</div>
		
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    <?php if(!empty($aMainPosts)){?>
                            <ul class="nav navbar-nav navbar-right hash-nav">
                                <?php 
                                $n = 1;
                                foreach($aMainPosts as $slug=>$post){?>
                                <li><a href="#<?php echo $slug?>"><?php echo $post['title']?></a><?php if($n < $numPosts){?><font>|</font><?php }?></li>
                                <?php $n++;}?>
			  </ul>
                            <?php }?>
			</div>
			
		  </div>
	  </div>
	 </div>
  </div>
</nav>
<!-- Stop navigation -->

<?php //top block - main page content
if ( have_posts() ){
    while ( have_posts() ){ 
        the_post();
        $cover_img =wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        ?>
<!-- Start section 1 -->
<script src="<?php echo get_template_directory_uri()?>/js/yt.js"></script>
<section class="parallax-section player1" id="section-1" data-speed="" data-type="background" data-property="{videoURL:'https://www.youtube.com/watch?v=L8-AlEshUNg&feature=youtu.be',containment:'#section-1', quality:'large', autoPlay:true, mute:true, opacity:1}" style="/*background-image:url(<?php echo $cover_img?>);*/background-color:#000">
	<div class="table-section">
		<div class="td-section">
		
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-10 col-sm-10 col-xs-12">
						<h1><?php the_title()?></h1>

						<?php the_content()?>

					</div>
				</div>
			</div>

			<div class="time-inc-block">
				<div class="container">
					<div class="row">	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="pull-left">
								<a class="ar-d" href="#news" title=""><img src="<?php echo get_template_directory_uri()?>/images/icon-add.png" alt="" /></a>
							</div>
							<div class="pull-right">			
								<div class="time-inc">A division of <span><img src="<?php echo get_template_directory_uri()?>/images/time-inc-logo.png" alt="Time Inc" /></span></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</section>
<script>
jQuery(document).ready(function () {
    if(jQuery(window).width() > 1024){
		jQuery(".player1").mb_YTPlayer();
    }else{
        jQuery(".player1").css('backgroundImage','url(<?php echo $cover_img?>)');
    }
});
</script>
<!-- Stop section 1 -->
    <?php }
}?>



<?php //news
$args = array(   
    'showposts'=>1,
    'category_name' => 'news'
); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $img =wp_get_attachment_url( get_post_thumbnail_id($query->post->ID) );
        $meta = get_post_meta($query->post->ID);
        $aNews[0]['id'] = $query->post->ID;
        $aNews[0]['name'] = $query->post->post_name;
        $aNews[0]['title'] = $query->post->post_title;
        $aNews[0]['date'] = date("F j, Y", strtotime($meta['date'][0]));
        $aNews[0]['excerpt'] = $query->post->post_excerpt;
        $aNews[0]['content'] = $query->post->post_content;
        $aNews[0]['img'] = $img;
    }
}
//dump($aNews);
wp_reset_postdata();    
?>
<!-- Start section 2 -->
<a id="<?php echo $aMainPosts['news']['name']?>"></a>
<section class="parallax-section" id="section-2">
<div class="table-section">
	<div class="td-section">
		
		<div class="glyphicon-plus-page">
			<div class="container">
				<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span><font><?php echo $aMainPosts['news']['title']?></font>
                        </div>
		</div>

                <?php if(isset($aNews[0])){?>
                <div class="table-s2">
                        <div class="td-s1" style="background-image:url(<?php echo $aNews[0]['img']?>);"></div>	
                        <div class="td-s2">
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <div class="row">
                            <div class="max-width">
                                <h2><?php echo $aNews[0]['title']?></h2>
                                <div class="data"><?php echo $aNews[0]['date']?></div>
                                <p><?php echo $aNews[0]['excerpt']?></p>
                            </div>
                            </div>
                        </div>
                        </div>
                </div>
                <?php }?>	
	</div>
</div>
</section>

<!-- START News -->
<div class="modal fade" id="myModal<?php echo $aNews[0]['name']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	
	<!-- Start close popup -->
	<div class="close-popup-block">
		<div class="close-fix">
			<div type="button" class="close-popup" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true"><img src="<?php echo get_template_directory_uri()?>/images/icon-close.png" alt="" /></span>
			</div>
		</div>
	</div>
	<!-- Stop close popup -->
	
	<div class="popup-container" role="document">

		<!-- Start popup-content -->
		<div class="popup-content">
			
			<!-- Start block-p1 Popup -->
			<a name="<?php echo $aNews[0]['name']?>"></a>
			<div class="block-p1 news-p1" style="background-image:url(<?php echo $aNews[0]['img']?>);"><!-- added class news-p1 -->
				<div class="block-p1-content">
					
					<h2>		
						<div class="glyphicon-plus-news">
							<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span><font><?php echo $aMainPosts['news']['title']?></font>
						</div>
						<span><?php echo $aNews[0]['title']?></span>
					</h2>
					
					<div class="clearfix"></div>
					
					<div class="text-p1"><?php echo $aNews[0]['date']?></div>							

				</div>
			</div>
			<!-- Stop block-p1 Popup -->
			
			<!-- Start description-block Popup -->
			<div class="description-block news-description"><!-- added class news-description -->
			
				<div class="container">
					<div class="row">
					
						<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">						
							<?php echo $aNews[0]['content']?>
						</div>
						
						<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
						
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							
							<!-- Start social-description -->
							<div class="social-description">
								<a href="<?php echo facebookShareLink(site_url('/').'#open/'.$aMainPosts['news']['name'], $aNews[0]['name'], $aNews[0]['excerpt'], $aNews[0]['img'])?>" title="" target="_blank"><img src="<?php echo get_template_directory_uri()?>/images/icon-facebook.png" alt="" /></a>
								<a href="<?php echo twitterShareLink($aNews[0]['title'], site_url('/').'#open/'.$aMainPosts['news']['name'])?>" title="" target="_blank"><img src="<?php echo get_template_directory_uri()?>/images/icon-twitter.png" alt="" /></a>
								<a href="<?php echo emailLink($aNews[0]['title'], $aNews[0]['content'], site_url('/').'#open/'.$aMainPosts['news']['name'])?>" title=""><img src="<?php echo get_template_directory_uri()?>/images/icon-email.png" alt="" /></a>
							</div>
							<!-- Stop social-description -->
							
							<!-- Start form-1 -->
							<div class="form-1">
                                                                <?php if ( is_active_sidebar( 'news' ) ) : ?>
                                                                    <?php dynamic_sidebar( 'news' ); ?>
                                                                <?php endif ?>
							</div>
							<!-- Stop form-1 -->
						
						</div>
						
					</div>
				</div>
				
			</div>
			<!-- Stop description-block Popup -->
		
		</div>
		<!-- Stop popup-content -->
		
	</div>
</div>	
<!-- STOP News -->
<!-- Stop section 2 -->


<?php //The Work
//categories
$work_category = get_category_by_slug('the-work');
$cat_args = array('parent' => $work_category->cat_ID );
$childCats = get_categories($cat_args);
$aWorkSubCats = array();
if(!empty($childCats)){
    foreach($childCats as $cat){
        $cat_meta = get_option( "category_".$cat->cat_ID);
        $aWorkSubCats[$cat->slug]['id'] = $cat->cat_ID;
        $aWorkSubCats[$cat->slug]['slug'] = $cat->slug;
        $aWorkSubCats[$cat->slug]['name'] = $cat->name;
        $aWorkSubCats[$cat->slug]['description'] = $cat->description;
        $aWorkSubCats[$cat->slug]['short_description'] = $cat_meta['short_description'];
        //projects
        $args = array(   
            'showposts'=>-1,
            'category_name' => $cat->slug
        ); 
        $query = new WP_Query( $args );
        $aProjects=array();
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $img =wp_get_attachment_url( get_post_thumbnail_id($query->post->ID) );
                $meta = get_post_meta($query->post->ID);                
                $aProjects[$query->post->ID]['id'] = $query->post->ID;
                $aProjects[$query->post->ID]['name'] = $query->post->post_name;
                $aProjects[$query->post->ID]['title'] = $query->post->post_title;
                $aProjects[$query->post->ID]['content'] = $query->post->post_content;
                $aProjects[$query->post->ID]['logo'] = wp_get_attachment_url($meta['logo'][0]);
                $aProjects[$query->post->ID]['img'] = $img;
                $aProjects[$query->post->ID]['header'] = $meta['header'][0];
                $aProjects[$query->post->ID]['subheader'] = $meta['subheader'][0];
                $aProjects[$query->post->ID]['client'] = $meta['client'][0];
                $aProjects[$query->post->ID]['vertical'] = $meta['vertical'][0];
                $aProjects[$query->post->ID]['media'] = $meta['media'][0];
                $aProjects[$query->post->ID]['year'] = $meta['year'][0];
                $aProjects[$query->post->ID]['website'] = $meta['website'][0];
            }
            $aWorkSubCats[$cat->slug]['projects'] = $aProjects;
        }
        wp_reset_postdata();
    }
}
$numWorkCat = count($aWorkSubCats);
//dump($aWorkSubCats);
?>
<!-- Start section 3 -->
<a id="<?php echo $aMainPosts['the-work']['name']?>"></a>
<section class="parallax-section" id="section-3" data-speed="" data-type="background" style="background-image:url(<?php echo $aMainPosts['the-work']['img']?>);">
<div class="table-section">
	<div class="td-section">
		
		<div class="glyphicon-plus-page">
			<div class="container">
				<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span><font><?php echo $aMainPosts['the-work']['title']?></font>			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-1 col-xs-12"></div>
				<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 text-center">
					<h2><?php echo $aMainPosts['the-work']['header']?></h2>		
				</div>
				<div class="col-lg-2 col-md-2 col-sm-1 col-xs-12"></div>
			</div>
		</div>
				
		<div class="clearfix"></div>
				
		<div class="container">
			<div class="row">
                            
				<?php if(!empty($aWorkSubCats)){?>
                                <?php
                                foreach($aWorkSubCats as $slug=>$workcat){?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<!-- Start Popup -->
					<button type="button" class="popup-work" data-toggle="modal" id="open-the-work-<?php echo $slug?>" data-target="#myModal<?php echo $workcat['id']?>">
						<div align="center" class="popup-work-content">
							<div class="popup-work-icon">
                                                            <div class="icon-container">
                                                                    <span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span>
                                                                    <h5>
                                                                           <?php echo $workcat['name']?>
                                                                    </h5>
                                                            </div>								
							</div>
							<p>
								<?php echo nl2br($workcat['short_description'])?>
							</p>
							<span class="see">See Case Studies</span>
						</div>
					</button>
					<!-- Stop Popup -->
				</div>
                                <?php }?>
                                <?php }?>				
			
				
			</div>
		</div>
	</div>
</div>
</section>

<!-- START POPUPS BLOCKS -->
<?php if(!empty($aWorkSubCats)){?>
    <?php foreach($aWorkSubCats as $catkey =>$workcat){?>
<div class="modal fade" id="myModal<?php echo $workcat['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	
	<!-- Start close popup -->
	<div class="close-popup-block">
		<div class="close-fix">
			<div type="button" class="close-popup" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true"><img src="<?php echo get_template_directory_uri()?>/images/icon-close.png" alt="" /></span>
			</div>
		</div>
	</div>
	<!-- Stop close popup -->
	
	<div class="popup-container" role="document">

		<!-- Start popup-content -->
		<div class="popup-content">
		
			<!-- Start Header Popup -->
			<div class="header-popup text-center">
			
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h2><?php echo $workcat['name']?></h2>
						</div>
					</div>
				</div>
				
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<p>
								<?php echo $workcat['description']?>
							</p>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
					</div>
					<?php if ($workcat['name'] === 'Enterprise Solutions') : ?>
						<div class="enterprise-solutions-row">
							<div class="enterprise-solutions-item">
								Content AOR
							</div>
							<div class="enterprise-solutions-item">
								Digital Newsroom
							</div>
							<div class="enterprise-solutions-item">
								Content Programming &amp; Licensing
							</div>
							<div class="enterprise-solutions-item">
								Managed Services
							</div>
							<div class="enterprise-solutions-item">
								Loyalty &amp; CRM/CLM
							</div>
						</div>
					<?php endif; ?>
				</div>
			
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="header-popup-links">
								<?php if(!empty($workcat['projects'])){?>
                                                                <span>Case Studies:</span>                                                               
								<ul>
                                                                    <?php foreach($workcat['projects'] as $pid=>$project){?>
								    <li><a href="#<?php echo $project['name']?>" title=""><font><?php echo $project['title']?></font></a></li>
                                                                    <?php }?>
								</ul>
                                                                <?php }?>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<!-- Stop Header Popup -->
			
			<!-- Start block-p1 Popup -->
                        <?php if(!empty($workcat['projects'])){?>
                            <?php foreach($workcat['projects'] as $pid=>$project){?>
			<a name="<?php echo $project['name']?>"></a>
			<div class="block-p1" style="background-image:url(<?php echo $project['img']?>);">
				<div class="block-p1-content">
                                        <?php if(!empty($project['logo'])){?>
					<div class="banner-p1">
                                            <img src="<?php echo $project['logo']?>" alt="" />
					</div>
                                        <?php }?>
							
					<div class="popup-work-icon">
                                            <div class="icon-container">
						<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span>
						<h5>
							<?php echo $workcat['name']?>
						</h5>
                                            </div>
					</div>
					
					<h2>
						<span><?php echo $project['header']?></span>
					</h2>
					
					<div class="clearfix"></div>					
					<?php /*<div class="text-p1"><?php echo $project['subheader']?></div> */?>					

				</div>
			</div>
			<!-- Stop block-p1 Popup -->
			
			<!-- Start description-block Popup -->
			<div class="description-block">
			
				<div class="container">
					<div class="row">
					
						<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
						<?php if(!empty($project['subheader'])){?>
                            <h2><?php echo $project['subheader']?></h2>	
                        <?php }?>                            
							<?php echo $project['content']?>
							
						</div>
						
						<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
						
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						    <?php if(!empty($project['website'])){?>
							<div class="visit-website">
                                                            <a href="<?php echo $project['website']?>" title="" target="_blank"><img src="<?php echo get_template_directory_uri()?>/images/icon-angle-site.png" alt="" /> visit website</a>
							</div>
                                                    <?php }?>	
							<!-- Start info-description-block -->
							<div class="info-description-block">
								<?php if(!empty($project['client'])){?>
								<div class="info-description">
									<span>CLIENT</span>
									<font><?php echo $project['client']?></font>
								</div>
                                                                <?php }?>
								
                                                                <?php if(!empty($project['vertical'])){?>
								<div class="info-description">
									<span>Vertical</span>
									<font><?php echo $project['vertical']?></font>
								</div>
                                                                <?php }?>
                                                                
                                                                <?php if(!empty($project['media'])){?>
								<div class="info-description">
									<span>Media</span>
									<font><?php echo $project['media']?></font>
								</div>
                                                                <?php }?>
                                                                
                                                                <?php if(!empty($project['year'])){?>
								<div class="info-description">
									<span>Year</span>
									<font><?php echo $project['year']?></font>
								</div>
                                                                <?php }?>
								
							</div>
							<!-- Stop info-description-block -->
							
							<!-- Start social-description -->
							<div class="social-description">
								<a href="<?php echo facebookShareLink(site_url('/').'#open/'.$aMainPosts['the-work']['name'].'-'.$catkey.'/'.$project['name'], $project['header'], $project['content'], $project['img'])?>" title="" target="_blank"><img src="<?php echo get_template_directory_uri()?>/images/icon-facebook.png" alt="" /></a>
								<a href="<?php echo twitterShareLink($project['header'], site_url('/').'#open/'.$aMainPosts['the-work']['name'].'-'.$catkey.'/'.$project['name'])?>" title="" target="_blank"><img src="<?php echo get_template_directory_uri()?>/images/icon-twitter.png" alt="" /></a>
								<a href="<?php echo emailLink($project['header'], $project['content'], site_url('/').'#open/'.$aMainPosts['the-work']['name'].'-'.$catkey.'/'.$project['name'])?>" title=""><img src="<?php echo get_template_directory_uri()?>/images/icon-email.png" alt="" /></a>
							</div>
							<!-- Stop social-description --> 
						
						</div>
						
					</div>
				</div>
				
			</div>
                            <?php }?>
                        <?php }?>
			<!-- Stop description-block Popup -->
<?php 
$prevCat = getAdjascentKey( $catkey, $aWorkSubCats, -1 ); 
if(empty($prevCat)){
    $prevCat = end(array_keys($aWorkSubCats));
}
    
$nextCat = getAdjascentKey( $catkey, $aWorkSubCats, +1 );
if(empty($nextCat)){
    $nextCat = reset(array_keys($aWorkSubCats));
}  
?>
						
			<!-- Start Pagination Popup -->
			<div class="pagination-popup">
				<div class="pagination-popup-table">
					<div class="pagination-popup-td">
						<div class="td-1" onclick="launch_modal('myModal<?php echo $aWorkSubCats[$prevCat]['id']?>');">
							<a href="#" title="">
								<span><img src="<?php echo get_template_directory_uri()?>/images/icon-angle-left.png" alt="" /></span>
								<font><?php echo $aMainPosts['the-work']['title']?></font>
								<h2><?php echo $aWorkSubCats[$prevCat]['name']?></h2> 
							</a>
						</div>
						<div class="td-2" onclick="launch_modal('myModal<?php echo $aWorkSubCats[$nextCat]['id']?>');">
							<a href="#" title="">
								<span><img src="<?php echo get_template_directory_uri()?>/images/icon-angle-right.png" alt="" /></span>
								<font><?php echo $aMainPosts['the-work']['title']?></font>
								<h2><?php echo $aWorkSubCats[$nextCat]['name']?></h2>
							</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Start Pagination Popup -->

			<!-- Start footer -->
			<section class="footer">
				<div class="container text-center">
                                        <?php $cd = getdate()?>
					&copy; <?php echo $cd['year']?> Time Inc. The Foundry. All rights reserved.
				</div>
			</section>
			<!-- Stop footer -->
		
		</div>
		<!-- Stop popup-content -->
		
	</div>
</div>	
    <?php }?>
<?php }?>
<!-- STOP POPUPS BLOCKS Innovation Studio -->
<!-- Stop section 3 -->


<?php //capabilities
$capability_category = get_category_by_slug('capabilities');
$aCapabilityCategory['name'] = $capability_category->name;
$aCapabilityCategory['description'] = $capability_category->description;
$args = array(   
    'showposts'=>-1,
    'category__in' => $capability_category->cat_ID
); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $img =wp_get_attachment_url( get_post_thumbnail_id($query->post->ID) );
        //$meta = get_post_meta($query->post->ID);  
        $aCapability[$query->post->post_name]['id'] = $query->post->ID;
        $aCapability[$query->post->post_name]['name'] = $query->post->post_name;
        $aCapability[$query->post->post_name]['title'] = $query->post->post_title;
        $aCapability[$query->post->post_name]['content'] = $query->post->post_content;
        $aCapability[$query->post->post_name]['img'] = $img;
    }    
}
//dump($aCapabilityCategory);
//dump($aCapability);
wp_reset_postdata();
?>
<!-- Start section 4 -->
<a id="<?php echo $aMainPosts['capabilities']['name']?>"></a>
<section class="parallax-section" id="section-4">
	<div class="table-section">
		<div class="td-section">
			
			<div class="glyphicon-plus-page">
				<div class="container">
					<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span><font><?php echo $aMainPosts['capabilities']['title']?></font>
				</div>
			</div>
						
			<div class="container">
				<div class="row">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 text-center">
						<h2>
                                                    <span><?php echo $aMainPosts['capabilities']['header']?></span>
						</h2>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
				</div>
			</div>
					
			<div class="clearfix"></div>
						
			<?php echo $aMainPosts['capabilities']['content']?>
			
		</div>
	</div>
</section>

<!-- START CAPABILITIES POPUPS BLOCKS -->
<div class="modal fade" id="myModalCap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

	<!-- Start close popup -->
	<div class="close-popup-block">
		<div class="close-fix">
			<div type="button" class="close-popup" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true"><img src="<?php echo get_template_directory_uri()?>/images/icon-close.png" alt="" /></span>
			</div>
		</div>
	</div>
	<!-- Stop close popup -->

	<div class="popup-container" role="document">
		
		<!-- Start popup-content -->
		<div class="popup-content">
		
			<!-- Start Header Popup -->
			<div class="header-popup text-center">
			
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h2><?php echo $aCapabilityCategory['name']?></h2>
						</div>
					</div>
				</div>
				
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<p>
								<?php echo $aCapabilityCategory['description']?>
							</p>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
					</div>
				</div>
			
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="header-popup-links">
                                                            <?php if(!empty($aCapability)){?>
								<ul>
                                                                    <?php foreach($aCapability as $slug=>$capability){?>
									<li><a href="#<?php echo $slug?>" title=""><font><?php echo $capability['title']?></font></a></li>
                                                                    <?php }?>
								</ul>
                                                            <?php }?>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<!-- Stop Header Popup -->
			
			<!-- Start WHAT WE DO -->
                        <?php if(!empty($aCapability)){?>
                            <?php foreach($aCapability as $slug=>$capability){?>
			<a name="<?php echo $slug?>"></a>		
                        <div class="container-fluid whowereach" <?php if($capability['img']){?>style="background-image:url(<?php echo $capability['img']?>);"<?php }?>>
				<div class="row">
				<div class="container">
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
						<div class="capabilities-mark">
                                                        <h5 <?php if(!$capability['img']){?>style="color: #000;"<?php }?>>
								<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus-2.png" alt="" /></span><font><?php echo $capability['title']?></font>
							</h5>
						</div>
					</div>
					
					<?php echo $capability['content']?>
                                </div>	
				</div>
			</div>
                            <?php }?>
                        <?php }?>
			<!-- Stop WHAT WE DO -->
					
			
			<!-- Start footer -->
			<section class="footer">
				<div class="container text-center">
					<?php $cd = getdate()?>
					&copy; <?php echo $cd['year']?> Time Inc. The Foundry. All rights reserved.
				</div>
			</section>
			<!-- Stop footer -->
		
		</div>
		<!-- Stop popup-content -->
		
	</div>
</div>	
<!-- STOP POPUPS BLOCKS -->	
<!-- Stop section 4 -->



<!-- Start section 5 -->
<a id="<?php echo $aMainPosts['clients']['name']?>"></a>
<section class="parallax-section" id="section-5">
	<div class="table-section">
		<div class="td-section">
		
			<div class="glyphicon-plus-page">
				<div class="container">
					<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span><font><?php echo $aMainPosts['clients']['title']?></font>
				</div>
			</div>	
					
			<div class="container">
				<div class="row">	
					<div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 text-center">
						<h2>
							<?php echo $aMainPosts['clients']['header']?>
						</h2>
					</div>
					<div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
				</div>
			</div>
					
			<div class="clearfix"></div>	
					
			<?php echo $aMainPosts['clients']['content']?>
			
		</div>
	</div>
</section>
<!-- Stop section 5 -->


<?php //Philosophy and leadership
$fl_category = get_category_by_slug('philosophy-and-leadership');
$aFLCategory['name'] = $fl_category->name;
$aFLCategory['description'] = $fl_category->description;
$args = array(   
    'showposts'=>-1,
    'category__in' => $fl_category->cat_ID
); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $img =wp_get_attachment_url( get_post_thumbnail_id($query->post->ID) );
        //$meta = get_post_meta($query->post->ID);  
        $aFL[$query->post->post_name]['id'] = $query->post->ID;
        $aFL[$query->post->post_name]['name'] = $query->post->post_name;
        $aFL[$query->post->post_name]['title'] = $query->post->post_title;
        $aFL[$query->post->post_name]['content'] = $query->post->post_content;
        $aFL[$query->post->post_name]['img'] = $img;
    }
}
wp_reset_postdata();
//leaders
$args = array(   
    'showposts'=>-1,
    'category_name' => 'leaders',
    'orderby' => 'date',
    'order'   => 'ASC'
); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $img =wp_get_attachment_url( get_post_thumbnail_id($query->post->ID) );
        $meta = get_post_meta($query->post->ID);  
        $aLeaders[$query->post->post_name]['id'] = $query->post->ID;
        $aLeaders[$query->post->post_name]['name'] = $query->post->post_name;
        $aLeaders[$query->post->post_name]['title'] = $query->post->post_title;
        //$aLeaders[$query->post->post_name]['content'] = $query->post->post_content;
        $aLeaders[$query->post->post_name]['position'] = $meta['position'][0];
        $aLeaders[$query->post->post_name]['img'] = $img;
    }
}
wp_reset_postdata();
//dump($aFLCategory);
//dump($aFL);
//dump($aLeaders);
?>
<!-- Start section 6 -->
<a id="<?php echo $aMainPosts['about-the-foundry']['name']?>"></a>
<section class="parallax-section" id="section-6">
	<div class="table-section">
		<div class="td-section">
		
			<div class="glyphicon-plus-page">
				<div class="container">
					<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus-w.png" alt="" /></span><font><?php echo $aMainPosts['about-the-foundry']['title']?></font>
				</div>
			</div>	
					
			<div class="container">
				<div class="row">
				
					<div class="col-lg-12 col-md-10 col-sm-10 col-xs-12">
						<h2><?php echo $aMainPosts['about-the-foundry']['header']?></h2>
					</div>
				
					<div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
						<p>
							<?php echo $aMainPosts['about-the-foundry']['content']?>
						</p>
					</div>
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<a class="link-buuton" href="#" title=""  data-toggle="modal" data-target="#myModalFL">OUR PHILOSOPHY AND LEADERSHIP</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- START PHILOSOPHY & LEADERSHIP POPUPS BLOCKS -->
<div class="modal fade" id="myModalFL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

	<!-- Start close popup -->
	<div class="close-popup-block">
		<div class="close-fix">
			<div type="button" class="close-popup" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true"><img src="<?php echo get_template_directory_uri()?>/images/icon-close.png" alt="" /></span>
			</div>
		</div>
	</div>
	<!-- Stop close popup -->

	<div class="popup-container" role="document">
		
		<!-- Start popup-content -->
		<div class="popup-content">
		
			<!-- Start Header Popup -->
			<div class="header-popup text-center">
			
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h2><?php echo $aFLCategory['name']?></h2>
						</div>
					</div>
				</div>
				
				<?php /*<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<p>
								<?php echo $aFLCategory['description']?>
							</p>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
					</div>
				</div>*/?>
			
				<?php /*<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="header-popup-links">
                                                            <?php if(!empty($aFL)){?>
								<ul>
                                                                    <?php foreach($aFL as $slug=>$item){?>
									<li><a href="#<?php echo $slug?>" title=""><font><?php echo $item['title']?></font></a></li>
                                                                    <?php }?>
								</ul>
                                                            <?php }?>
							</div>
						</div>
					</div>
				</div>*/?>
				
			</div>
			<!-- Stop Header Popup -->
			
			<!-- Start OUR PHILOSOPHY Popup -->
                        <?php if(isset($aFL['philosophy'])){?>
			<a name="philosophy"></a>
			<div class="description-block our-philisophy">
							
				<div class="container p-mark philisophy-mark">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h5>
								<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span><font>OUR PHILOSOPHY</font>
							</h5>
						</div>
					</div>
				</div>
							
				<div class="container text-center">
					<div class="row">
						<?php /*<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>*/?>
						<div class="col-lg-12 col-md-12 col-sm-10 col-xs-12">
							<div class="content-p4">
								<?php echo $aFL['philosophy']['content']?>
							</div>
						</div>
						<?php /*<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>*/?>
					</div>
				</div>

			</div>
			<!-- Stop OUR PHILOSOPHY Popup -->
                        <?php }?>
			
                        <?php if(isset($aFL['leadership'])){?>
			<!-- Start leadership-block Popup -->
			<a name="leadership"></a>
			<div class="leadership-block">
			
				<div class="container p-mark leadership-mark">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h5>
								<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span><font>OUR LEADERSHIP</font>
							</h5>
						</div>
					</div>
				</div>
				
				<!-- Start leadership-photo -->			
				<div class="leadership-photo">
					<div class="row">
					<?php if(!empty($aLeaders)){?>
                                            <?php foreach($aLeaders as $leader){?>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<!-- Start leadership-photo-block -->
							<div class="leadership-photo-block">
								<div class="photo-lead">
									<div class="photo-lead-table">
										<div class="photo-lead-td">
                                                                                    <?php if(!empty($leader['img'])){?>
											<img src="<?php echo $leader['img']?>" alt="<?php echo $leader['title']?>" />
                                                                                    <?php }?>
										</div>
									</div>
								</div>
								<div class="content-lead">
									<div class="content-lead-table">
										<div class="content-lead-td">
											<h6><?php echo $leader['title']?></h6>
											<p><?php echo $leader['position']?></p>
										</div>
									</div>
								</div>
							</div>
							<!-- Stop leadership-photo-block -->
						</div>
                                            <?php }?>
					<?php }?>					
					</div>
				</div>
				<!-- Stop leadership-photo -->	
				
			</div>
			<!-- Stop OUR leadership-block Popup -->
			
			<!-- Start textblock-p4 Popup -->
			<div class="textblock-p4">
							
				<div class="container text-center">
					<div class="row">
						<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<div class="textblock-p4-content">
								<?php echo $aFL['leadership']['content']?>
							</div>
						</div>
						<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
					</div>
				</div>

			</div>
			<!-- Stop textblock-p4 Popup -->
                        <?php }?>
			
			<!-- Start footer -->
			<section class="footer">
				<div class="container text-center">
					<?php $cd = getdate()?>
					&copy; <?php echo $cd['year']?> Time Inc. The Foundry. All rights reserved.
				</div>
			</section>
			<!-- Stop footer -->
		
		</div>
		<!-- Stop popup-content -->
		
	</div>
</div>	
<!-- STOP PHILOSOPHY & LEADERSHIP POPUPS BLOCKS -->
<!-- Stop section 6 -->


<?php //contact us
$args = array(   
    'showposts'=>-1,
    'category_name' => 'contact-us'
); 
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $meta = get_post_meta($query->post->ID);
        $aContacts[$query->post->post_name]['id'] = $query->post->ID;
        $aContacts[$query->post->post_name]['name'] = $query->post->post_name;
        $aContacts[$query->post->post_name]['title'] = $query->post->post_title;
        $aContacts[$query->post->post_name]['content'] = $query->post->post_content;
        //$aContacts[$query->post->post_name]['address'] = $meta['address'][0];
        $aContacts[$query->post->post_name]['google_link'] = 'https://www.google.com/maps/place/'.urlencode($meta['address'][0]);
    }
}
wp_reset_postdata();
//dump($aContacts);
?>
<!-- Start section 7 -->
<a id="<?php echo $aMainPosts['contact-us']['name']?>"></a>
<section class="parallax-section" id="section-7" data-speed="" data-type="background" style="background-image:url(<?php echo $aMainPosts['contact-us']['img']?>);">
	<div class="table-section">
		<div class="td-section">
		
			<div class="glyphicon-plus-page">
				<div class="container">
					<span><img src="<?php echo get_template_directory_uri()?>/images/icon-plus.png" alt="" /></span><font><?php echo $aMainPosts['contact-us']['title']?></font>
				</div>
			</div>	
					
			<div class="container">
				<div class="row">
				
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<?php echo $aMainPosts['contact-us']['content']?>
					</div>
				
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<?php if(!empty($aContacts)){?>
                                                    <?php foreach($aContacts as $contact){?>
						<div class="r-s7">
							<h4><?php echo $contact['title']?></h4>
							<?php echo $contact['content']?>
							<div class="rs7-icon"><a href="<?php echo $contact['google_link']?>" title="<?php echo $contact['title']?>" target="_blank"><img src="<?php echo get_template_directory_uri()?>/images/icon-map-marker.png" alt="" /></a></div>
						</div>
                                                    <?php }?>
                                                <?php }?>
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Stop section 7 -->


<?php
get_footer();
?>
