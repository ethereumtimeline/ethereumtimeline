<?php
/*
* Theme Name: Timeline eCommerce Theme
*
* Description: Timeline eCommerce Theme is a clean and minimal wordpress theme, 
* intended to showcase your work, events, blog, shop or interests in an unique modern way, 
* using the trendy timeline look.
*
* Version: 2.0 
*/
?>

<?php get_header();?>
<script>
jQuery(document).ready(function($) {	
	$('.embedvideo').each( function() {
		var url = $(this).attr("src")
		$(this).attr({
			"src" : url.replace('?rel=0', '')+"?wmode=transparent",
			"wmode" : "Opaque"
		})
	});
});
</script>
<?php
//BEGIN LOOP
//=====================================================
if(have_posts()) : ?><?php while(have_posts()) : the_post(); 

	//the_meta();
	$id = get_the_ID();
		$post_meta_data = get_post_custom($post->ID);
		include('functions/post-settings.php');	
		
	
	//JAVASCRIPT FOR FLEX SLIDER AND FADE IN
	//=====================================================
    if($post_bgimage != ''){
		$srcsliderfa = wp_get_attachment_image_src( $post_bgimage, 'full', true );
		?>
    	<script>
			jQuery.vegas('stop');
			jQuery.vegas({
					src:'<?php echo  $srcsliderfa[0]; ?>', 
					fade:2000, 
					valign:'<?php echo of_get_option('background-valign-1'); ?>', 
					align:'<?php echo of_get_option('background-halign-1'); ?>' 
			
			})('overlay', {
			  src:'<?php echo get_template_directory_uri(); ?>/images/overlays/<?php echo of_get_option('background-overlays', 'no entry' ); ?>.png'
			});
		</script>
   <?php } ?>
    <script>   
		jQuery( document ).ready( function($){	
	   		$('.add-opacity-fx').animate({opacity:1}, 1500);
		});
		//javascript:history.go(-1)
	</script>
	<script>
		jQuery( document ).ready( function($){			 					 
		  $('#flexslider-<?php echo $id;?>').flexslider({
			animation: "fade",
			controlNav: false,
			slideshow: <?php echo $post_img_slideshow; ?>
			
		  });
		
		});
	</script><?php
    //ROW BODY
	//=====================================================?>
	<div id="davidim" class="ss-row-f add-opacity-fx <?php if($post_showdate == "hide"){?> page-no-date <?php } ?>">
    	<?php if($post_showdate != "hide"){?>
		<div class="time-dot-date">
			<div class="arrow-date-border"></div>
			<div class="arrow-date"></div>
			<div class="container-border">
				<div class="gray-container">
					<?php echo get_the_date(); ?>
				</div>
			</div>
		</div>
        <?php }; ?>
		<div class="time-dot"></div>
		<div class="ss-full"><?php 
			if(apply_filters( 'the_content', get_the_content()) !='' || $post_showtitle == 'hide' ){ ?>
                <div class="arrow-up"></div>
                <div class="arrow-side"></div>
                <div class="container-border">
                    <div class="gray-container single-page-t"> <?php 
                        if(has_post_thumbnail() || $post_embed_video_yt !='' || $post_embed_video_vm !='') {	
							$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,405, ), true );
							$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full', true );
							
								if($img_badge =='new'){?>
									<div class="badge badge-1 badge-top-padding"></div><?php
								}
								if($img_badge =='hot'){?>
									<div class="badge-hot badge-hot-top-padding"></div><?php
								}
							
							if($custom_repeatable[0] != ''){?>
								<div id="flexslider-<?php echo $id;?>" class="flexslider">
									<ul class="slides">
										<li>
											<div class="hover-effect h-style"><?php 
												if($img_title && $post_embed_video_yt =='' && $post_embed_video_vm =='' || $img_content && $post_embed_video_yt =='' && $post_embed_video_vm ==''){ ?>
													<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
													<div class="mask"><?php 
														if($img_title){ ?>
															<h2><?php echo $img_title; ?></h2> <?php 
														}; ?>
														<p><?php echo $img_content; ?></p><?php
														 if($img_link){ ?>
															<a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
														 }; ?>
													</div><?php 
												}else{ 
													if ($post_embed_video_yt !='') {?>
                                                                <iframe class="embedvideo"  width="100%" height="190px" src="http://www.youtube.com/embed/<?php echo $post_embed_video_yt;?>" frameborder="0" allowfullscreen></iframe><?php
                                                        }else if ($post_embed_video_vm !=''){?>
                                                                <iframe src="http://player.vimeo.com/video/<?php echo $post_embed_video_vm;?>?title=0&amp;byline=0&amp;portrait=0"  width="100%" height="190px" class="embedvideo" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe><?php
                                                        }else{?>
                                                            <a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/> 
                                                                <div class="mask">
                                                                    <span class="img-rollover"></span>
                                                                </div>
                                                            </a><?php 
															}
													};?>
											</div>
										</li> <?php
										foreach ($custom_repeatable as $string) {
											$srcslider = wp_get_attachment_image_src( $string, array( 720,405, ), true );
											$srcsliderf = wp_get_attachment_image_src( $string, 'full', true );?>
											<li>
												<div class="hover-effect h-style">
													<a href="<?php echo $srcsliderf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $srcslider[0]; ?>" class="clean-img"/> 
														<div class="mask">
															<span class="img-rollover"></span>
														</div>
													</a>
												</div>
											</li> <?php 
										};?>
									</ul>
								</div> <?php
							}else{?>
								<div class="hover-effect h-style"><?php 
									if($img_title && $post_embed_video_yt =='' && $post_embed_video_vm =='' || $img_content && $post_embed_video_yt =='' && $post_embed_video_vm ==''){ ?>
										<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
										<div class="mask"><?php 
											if($img_title){ ?>
												<h2><?php echo $img_title; ?></h2><?php  
											}; ?>
											<p><?php if($img_content) echo $img_content; ?></p><?php 
											if($img_link){ ?>
												<a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
											}; ?>
										</div><?php 
									}else{
										if ($post_embed_video_yt !='') {?>
													<iframe class="embedvideo" width="100%" height="190px" src="http://www.youtube.com/embed/<?php echo $post_embed_video_yt;?>" frameborder="0" allowfullscreen></iframe><?php
												}else if ($post_embed_video_vm !=''){?>
													<iframe src="http://player.vimeo.com/video/<?php echo $post_embed_video_vm;?>?title=0&amp;byline=0&amp;portrait=0" width="100%" height="190px" class="embedvideo" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe><?php
												}else{;?>
                                        	<a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/>
                                            	<div class="mask">
                                                	<span class="img-rollover"></span>
                                    			</div>
                                            </a><?php
												};
								 		};?>
								</div><?php 
							};
						};
						if(apply_filters ('the_title', get_the_title()) !=''  ) {
							if($post_showtitle != 'hide'){?>                         	
								<h1 class="content-title <?php if(has_post_thumbnail()) {?> content-title-no-img<?php };?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1> <?php 
							};
                        };
                        the_content();  
                        
                        if($post_showcategory != "hide"){ ?>
                            <div class="icon-soc-container">
                                <div class="share-btns">
                                    <?php
                                    $category = get_the_category(); ?> 
                                    <div class="single-page-cat"><div class="icon-s category-ico"></div><a href="<?php echo get_category_link( $category[0]->term_id );?>"><?php echo $category[0]->cat_name;?></a>
                                    </div> 
                                    <div class="single-page-cat"><div class="icon-s user-ico"></div><?php  the_author(); ?> 
                                    </div> 
									<div class="single-page-cat"><div class="icon-s comments-ico"></div><a href="<?php comments_link(); ?>"> <?php comments_number( '0', '1', '%' ); ?></a>
                                    </div>
                                    <div class="navigation empty-right"><?php 	
       								 	previous_post_link('<strong>&larr;</strong> %link') ?> | <?php next_post_link(' %link <strong>&rarr;</strong>')?>
    								</div>
                                </div>   
                            </div><?php
                        };?>
                    </div>
                        
                </div><?php
                
                if($post_showsoc == "show"){
                
               		if( of_get_option('fb-link') !='' || of_get_option('tw-link') !='' || of_get_option('li-link') !='' || of_get_option('yt-link') !='' || of_get_option('vm-link') !='' || of_get_option('fl-link') !='' || of_get_option('da-link') !='' || of_get_option('su-link') !='' || of_get_option('di-link') !=''){?>
                        <div class="icon-soc-container-alone ">
                            <div class="container-border">
                                <div class="gray-container " > 
                                    <ul ><?php 
                                        if(of_get_option('fb-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('fb-link-tooltip');?>" target="_blank" rel="tooltip"  href="<?php echo of_get_option('fb-link');?>"><div class="icon-soc facebook-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('tw-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('tw-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('tw-link');?>"><div class="icon-soc twitter-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('li-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('li-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('li-link');?>"><div class="icon-soc linkedin-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('yt-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('yt-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('yt-link');?>"><div class="icon-soc youtube-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('vm-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('vm-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('vm-link');?>"><div class="icon-soc vimeo-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('fl-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('fl-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('fl-link');?>"><div class="icon-soc flickr-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('da-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('da-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('da-link');?>"><div class="icon-soc devianart-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('su-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('su-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('su-link');?>"><div class="icon-soc stumbleupon-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('di-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('di-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('di-link');?>"><div class="icon-soc digg-ico"></div></a></li><?php
                                        };?>
                                   </ul>
                                </div>	
                            </div>
                        </div> <?php   
                    };
                };
            }; ?> 
        </div>
	</div>
    
	<?php  if ( $post_showfbcomments == 'on' ){?>  
    <div class="ss-row page-no-date">
		<div class="time-dot"></div> 
		<div class="ss-full">
    		<div class="arrow-up"></div>
        	<div class="container-border">
            	<div class="gray-container">
                    <div id="fb-root"></div>
                    <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="2" data-width="470" <?php if(of_get_option('color-scheme', 'no entry' ) == 'blackbody'){ ?> data-colorscheme="dark" <?php }; ?>></div>
                </div> 
            </div> 
        </div> 
	</div> 
    <?php };
	comments_template(); ?>
<?php endwhile; ?>
<?php endif; ?>
<?php get_sidebar(); ?>	
<?php get_footer(); ?>