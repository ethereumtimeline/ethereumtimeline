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
<?php /* If there are no posts to display, such as an empty archive page */ 


		//ADD SCROLL TO LOOP PAGE
		//=====================================================
		if(of_get_option('scroll-effect') == "perspective1" || of_get_option('scroll-effect') == "perspective2"){
			$perspectiveis = "true"; 
		 }else{
			$perspectiveis = "false";
		 }
		 if(of_get_option('scroll-effect') == "perspective1"){
			$perspectivef= "90"; 
		 }else if(of_get_option('scroll-effect') == "perspective2"){
			$perspectivef = "-90";
		 }else{
			 $perspectivef= "90"; 
		 }?>
         <script>
			 jQuery( document ).ready( function($){
				$sidescroll	= (function() {
						// the row elements
					var $rows			= $('div.ss-row'),
						// we will cache the inviewport rows and the outside viewport rows
						$rowsViewport, $rowsOutViewport,
						// navigation menu links
						$links			= $('.nav > li > a'),
						$linksrel = $('a[rel~=scroll-link]'), 
						// the window element
						$win			= $(window),
						// we will store the window sizes here
						winSize			= {},
						// used in the scroll setTimeout function
						anim			= false,
						// page scroll speed
						scollPageSpeed	= 2000 ,
						// page scroll easing
						scollPageEasing = 'easeInOutExpo',
						// perspective?
						hasPerspective	= <?php echo $perspectiveis; ?>,
						perspective		= hasPerspective && Modernizr.csstransforms3d,
						// initialize function
						init			= function() {
							// get window sizes
							getWinSize();
							// initialize events
							initEvents();
							// define the inviewport selector
							defineViewport();
							// gets the elements that match the previous selector
							setViewportRows();
							// if perspective add css
							if( perspective ) {
								$rows.css({  
									'-o-perspective'	 : 900, 
									'-o-perspective-origin'	: '50% 0%',  
									'-moz-perspective'	 : 900, 
									'-moz-perspective-origin'	: '50% 0%',
									'-webkit-perspective'			: 900,
									'-webkit-perspective-origin'	: '50% 0%'
								});
							}
							// show the pointers for the inviewport rows
							$rowsViewport.find('div.time-dot').addClass('time-dot-show');
							$rowsViewport.find('div.time-dot-date').addClass('time-dot-show');
							
								
							
							// set positions for each row
							placeRows();
						},
						// defines a selector that gathers the row elems that are initially visible.
						// the element is visible if its top is less than the window's height.
						// these elements will not be affected when scrolling the page.
						defineViewport	= function() {
							$.extend( $.expr[':'], {
								inviewport	: function ( el ) {
									if ( $(el).offset().top < winSize.height-300) {
										return true;
									}
									return false;
								}
							});
						},
						// checks which rows are initially visible 
						setViewportRows	= function() {
							$rowsViewport 		= $rows.filter(':inviewport');
							$rowsOutViewport	= $rows.not( $rowsViewport )
						},
						// get window sizes
						getWinSize		= function() {
							winSize.width	= $win.width();
							winSize.height	= $win.height();
						},
						// initialize some events
						initEvents		= function() {
							$linksrel.on( 'click.Scrolling', function( event ) {
								// scroll to the element that has id = menu's href
								$('html, body').stop().animate({				   
									scrollTop: $( $(this).attr('href') ).offset().top-80
								}, scollPageSpeed, scollPageEasing );
								return false;
							});
							// navigation menu links.
							// scroll to the respective section.
							$links.on( 'click.Scrolling', function( event ) {
								// scroll to the element that has id = menu's href
								$('html, body').stop().animate({
									scrollTop: $( $(this).attr('href') ).offset().top 
								}, scollPageSpeed, scollPageEasing );
								return false;
							});
							$(window).on({
								// on window resize we need to redefine which rows are initially visible (this ones we will not animate).
								'resize.Scrolling' : function( event ) {
									// get the window sizes again
									getWinSize();
									// redefine which rows are initially visible (:inviewport)
									setViewportRows();
									// remove pointers for every row
									$rows.find('div.time-dot').removeClass('div.time-dot');
									// show inviewport rows and respective pointers
									$rowsViewport.each( function() {
										$(this).find('div.ss-left')
											   .css({ left   : '0%' })
											   .end()
											   .find('div.ss-right')
											   .css({ right  : '0%' })
											   .end()
											   .find('div.ss-full')
											   .css({ left  : '0%' })
											   .end()
											   .find('div.time-dot, div.time-dot-date')
											   .addClass('time-dot-show');
									});
								},
								// when scrolling the page change the position of each row	
								'scroll.Scrolling' : function( event ) {
									// set a timeout to avoid that the 
									// placeRows function gets called on every scroll trigger
									if( anim ) return false;
									anim = true;
									setTimeout( function() {		 
										placeRows();
										anim = false;
									}, 10 );
								}
							});
						},
						// sets the position of the rows (left and right row elements).
						// Both of these elements will start with -50% for the left/right (not visible)
						// and this value should be 0% (final position) when the element is on the
						// center of the window.
						placeRows		= function() {			
								// how much we scrolled so far
							var winscroll	= $win.scrollTop(),
								// the y value for the center of the screen
								winCenter	= winSize.height / 2 + winscroll ;	
							// for every row that is not inviewport
							$rowsOutViewport.each( function(i) {
								var $row	= $(this),
									// the left side element
									$rowL	= $row.find('div.ss-left'),
									// the right side element
									$rowR	= $row.find('div.ss-right'),
									$rowF	= $row.find('div.ss-full'),
									// top value
									rowT	= $row.offset().top;
								// hide the row if it is under the viewport
								if( rowT > winSize.height + winscroll ) {
									opa		= 0;
									if( perspective ) {
										$rowL.css({
											'-moz-transform'	: 'translate3d(-75%, 0, 0) rotateY(-90deg) translate3d(-75%, 0, 0)',
											'-webkit-transform'	: 'translate3d(-75%, 0, 0) rotateY(-90deg) translate3d(-75%, 0, 0)',
											'opacity'			: 0
										});
										$rowF.css({
											'-moz-transform'	: 'translate3d(-75%, 0, 0) rotateY(-90deg) translate3d(-75%, 0, 0)',
											'-webkit-transform'	: 'translate3d(-75%, 0, 0) rotateY(-90deg) translate3d(-75%, 0, 0)',
											'opacity'			: 0
										});
										$rowR.css({
											'-moz-transform'	: 'translate3d(75%, 0, 0) rotateY(90deg) translate3d(75%, 0, 0)',
											'-webkit-transform'	: 'translate3d(75%, 0, 0) rotateY(90deg) translate3d(75%, 0, 0)',
											'opacity'			: 0
										});
										if( r >= 12){
											$row.find('div.time-dot-date').removeClass('time-dot-show');
											$row.find('div.time-dot').removeClass('time-dot-show');
										}
										if( r >= 40){
											$row.find('div.time-dot-date').removeClass('time-dot-show');
											$row.find('div.time-dot').removeClass('time-dot-show');
										}
									}
									else {
										<?php if(of_get_option('scroll-effect') != "fade"){ ?> 
										$rowL.css({ left:  '-50%;' });
										$rowF.css({ left: '-50%;' });
										$rowR.css({ right: '-50%;' });
										 <?php }; ?>
									}
								}
								// if not, the row should become visible (0% of left/right) as it gets closer to the center of the screen.
								else {
										// row's height
									var rowH	= $row.height(),
										// the value on each scrolling step will be proporcional to the distance from the center of the screen to its height
										factor 	= ( ( ( rowT + 300 / 2 ) - winCenter ) / ( winSize.height / 2 + rowH / 2 ) ),
										factoro = ( ( ( rowT - rowH / 2 ) - winCenter ) / ( winSize.height / 2 + rowH / 1 )/-0.3 ),
										// value for the left / right of each side of the row.
										
										// 0% is the limit
										val		= Math.max( factor * 50, 0 );
										opa		= Math.max( 0.1, factoro );
									if( val <= 0 ) {
										// when 0% is reached show the pointer for that row
										if( !$row.data('pointer') ) {
											$row.data( 'pointer', true );
											$row.find('div.time-dot-date').addClass('time-dot-show');
											$row.find('div.time-dot').addClass('time-dot-show');	
										}
									}
									else {
										// the pointer should not be shown
										if( $row.data('pointer') ) {
											$row.data( 'pointer', false );
											$row.find('div.time-dot-date').removeClass('time-dot-show');
											$row.find('div.time-dot').removeClass('time-dot-show');
										}	
									}
									// set calculated values
									if( perspective ) {
										var	t		= Math.max( factor * 75, 0 ),
											r		= Math.max( factor * <?php echo $perspectivef; ?>, 0 ),
											o		= Math.min( Math.abs( factor - 1 ), 1 );
											b		= Math.min( Math.abs( factor + 1 ), 1 );
										$rowL.css({
											'-moz-transform'	: 'translate3d(-' + t + '%, 0, 0) rotateY(-' + r + 'deg) translate3d(-' + t + '%, 0, 0)',
											'-webkit-transform'	: 'translate3d(-' + t + '%, 0, 0) rotateY(-' + r + 'deg) translate3d(-' + t + '%, 0, 0)',
											'opacity'			: o
										});
										$rowF.css({
											'-moz-transform'	: 'translate3d(-' + t + '%, 0, 0) rotateY(-' + r + 'deg) translate3d(-' + t + '%, 0, 0)',
											'-webkit-transform'	: 'translate3d(-' + t + '%, 0, 0) rotateY(-' + r + 'deg) translate3d(-' + t + '%, 0, 0)',
											'opacity'			: o
										});
										$rowR.css({
											'-moz-transform'	: 'translate3d(' + t + '%, 0, 0) rotateY(' + r + 'deg) translate3d(' + t + '%, 0, 0)',
											'-webkit-transform'	: 'translate3d(' + t + '%, 0, 0) rotateY(' + r + 'deg) translate3d(' + t + '%, 0, 0)',
											'opacity'			: o
										});
										if( r >= 18){
											$row.find('div.time-dot-date').removeClass('time-dot-show');
											$row.find('div.time-dot').removeClass('time-dot-show');
										}
										if( r >= 40){
											$row.find('div.time-dot-date').removeClass('time-dot-show');
											$row.find('div.time-dot').removeClass('time-dot-show');
											<?php if($perspectivef == "-90"){ ?>
										  $rowR.css({<?php echo "'opacity'"?> : b });
										  $rowL.css({<?php echo "'opacity'"?> : b });
										  $rowF.css({<?php echo "'opacity'"?> : b });
											<?php };?>
										}
									}
									else {
										
										<?php if(of_get_option('scroll-effect') != "fade"){ ?> 
										$rowL.css({ left 	: - val + '%' });
										$rowF.css({ left 	: - val + '%' });
										$rowR.css({ right 	: - val + '%' });
										<?php }; ?>
										$rowL.css({ opacity 	:  opa  });
										$rowF.css({ opacity 	:  opa  });
										$rowR.css({ opacity 	:  opa  });
									}
								}	
							});
						};
					return { init : init };
				})(jQuery);<?php
				 if(of_get_option('scroll-effect') == "noeffect"){ ?>
					$('div.time-dot-date').addClass('time-dot-show');
					$('div.time-dot').addClass('time-dot-show'); 
					if(isMobile.any() ){
						$('body').addClass('forios');
					}<?php
				 }else{ ?>
					if( !isMobile.any() ){
						$sidescroll.init() 
					}else{ 
						$('body').addClass('forios');<?php
						if(of_get_option('scroll-effect-mobile') == "1"){ ?>
							$sidescroll.init()<?php
						}else{?>
							$('div.time-dot-date').addClass('time-dot-show');
							$('div.time-dot').addClass('time-dot-show'); <?php
						}?>
					}
						
					<?php
				 }?>
			});
        </script>
   		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/all-functions.js"></script>
		<?php
global $product, $woocommerce_loop;
if(have_posts()) : 

while(have_posts()) : the_post();  global $product;

	if (is_search() && ($post->post_type=='page')) continue;
		//the_meta();
		$id = get_the_ID();
		$post_meta_data = get_post_custom($post->ID);
		include('functions/post-settings.php');	
        
		//JAVASCRIPT FOR FLEX SLIDER AND FADE IN
		//=====================================================?>
		<script>
        	 jQuery( document ).ready( function($){
        		$('.add-opacity-fx').animate({opacity:1},1500);          
			});
        </script>
		<script>
			 jQuery( document ).ready( function($){			 					 
				$('#flexslider-<?php echo $id;?>').flexslider({
					animation: "fade",
					controlNav: false,
					slideshow: <?php echo $post_img_slideshow; ?>,
					start: function(slider){
				  		$('body').removeClass('loading');
					}
			  	});
			});
		</script><?php
		
		//ROW BODY
		//=====================================================
		do_shortcode( get_the_content() );?>
		<div class="ss-row add-opacity-fx <?php 
			if($img_syle == "circle"){ 
				if($img_size == "big"){ ?>
					circle-img-3<?php 
				}else if($img_size == "medium"){ ?>
					circle-img-2<?php 
				}else if($img_size == "small"){ ?>
					circle-img-1<?php 
				};
			};?> ">
          <?php  if(of_get_option('date-bubble') != "hide" ){?>
			<div class="time-dot-date">
				<div class="arrow-date-border"></div>
                <div class="arrow-date"></div>
                <div class="container-border">
                    <div class="gray-container">
                    <?php if(of_get_option('date-bubble') == "date" ){
                  		  echo get_the_date();
                    }else if(of_get_option('date-bubble') == "price" ){?>
						<span class="price"><?php echo $product->get_price_html();  ?></span> <?php
                    }else if(of_get_option('date-bubble') == "rating" ){?>
						 <span><?php if ( $rating_html = $product->get_rating_html() ) { echo $rating_html;}else{?><div class="star-rating" title="Rated 0.00 out of 0"><span class="no-rating"><strong class="rating">0.00</strong> out of 0</span></div>
<?php }?></span> <?php
                    }else{
                  		  echo get_the_date();
                    }?>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="time-dot"></div><?php
			if(has_post_thumbnail() && $row_position != 'center' ) {
			if($img_position == 'right' || $img_position == 'left') {  
				if($img_position == 'right'){?>
                	<div class="ss-right empty-right"><?php 
            	}else if($img_position == 'left'){?>
					<div class="ss-left empty-left" ><?php
			 	}; 
             	if($img_syle == "square" || $img_syle == "circle"){ ?>
               		<div class="ss-long-arrow"></div><?php 
                };?>
                <div class="arrow-side"></div><?php 
                if($img_size == 'big') {  ?>
                	<div class="container-border <?php if($img_position == 'left'){?>empty-right <?php }; ?> <?php if($img_position == 'right'){?>empty-left <?php }; ?> <?php if($img_syle == "default"){ ?> c-size-big <?php };?><?php if($img_syle == "square"){ ?> img-padding c-size-big  <?php };?> <?php if($img_syle == "circle"){ ?> circle-img-b<?php };?> " > <?php 
               	}else if($img_size == 'medium'){ ?>
               		<div class="container-border  <?php if($img_position == 'left'){?>empty-right <?php }; ?><?php if($img_position == 'right'){?>empty-left <?php }; ?>  <?php if($img_syle == "default"){ ?> c-size-large <?php };?><?php if($img_syle == "square"){ ?> c-size-large img-padding <?php };?> <?php if($img_syle == "circle"){ ?> circle-img-b <?php };?> "  > <?php 
				}else if($img_size == 'small'){ ?>
                	<div class="container-border <?php if($img_position == 'left'){?>empty-right <?php }; ?><?php if($img_position == 'right'){?>empty-left <?php }; ?> <?php if($img_syle == "default"){ ?>c-size-small<?php };?> <?php if($img_syle == "square"){ ?> c-size-small img-padding<?php };?> <?php if($img_syle == "circle"){ ?>circle-img-b<?php };?> " ><?php 
                }; ?>
                	<div class="gray-container  <?php if($img_syle == "circle"){ ?> circle-img-c<?php };?> <?php if($img_syle == "square"){ ?> img-padding-c<?php };?>" ><?php 
                    	if ( has_post_thumbnail()) {  
							if($img_syle == "circle"){
								if($img_size == "big"){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 310,310, ), true );
								}
								if($img_size == "medium"){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 220, 220, ), true );
								}
								if($img_size == "small"){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 150, 150, ), true );
								}
							}else{
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720, 405, ), true );
									$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', true );
							}
							global $post, $product, $woocommerce;
							$attachment_ids = $product->get_gallery_attachment_ids();
							if($attachment_ids[0] != ''){
								if ($product->is_on_sale() && $img_syle != "circle" && $img_badge != 'new' && $img_badge != 'hot'){

	?> <div class="badge badge-sale <?php if($img_size != 'big' && $img_syle == "square") {  ?> m-pading <?php };?>"></div><?php 
								}
								if($img_badge =='new' && $img_syle != "circle"){?>
									<div class="badge badge-1 <?php if($img_size != 'big' && $img_syle == "square") {  ?> m-pading <?php };?>"></div><?php
								}
								if($img_badge =='hot' && $img_syle != "circle"){?>
									<div class="badge-hot <?php if($img_size != 'big' && $img_syle == "square") {  ?> b-pading <?php };?>"></div><?php
								}?>
                                	<div id="flexslider-<?php echo $id;?>" class="flexslider" >
                                    	<ul class="slides">
                                          <!--[if IE]><div style="width:340px; min-width:340px;"></div> <![endif]-->
                                        	<li> <?php
                                            	if($img_syle == "circle"){ ?>
                                                    <ul class="ch-grid">
                                                        <li>
                                                            <div class="ch-item" style="background-image: url(<?php echo $src[0]; ?>);">				
                                                                <div class="ch-info-wrap">
                                                                    <div class="ch-info">
                                                                        <div class="ch-info-front" style="background-image: url(<?php echo $src[0]; ?>);"></div>
                                                                        <div class="ch-info-back"><?php 
                                                                        if($img_title){ ?>
                                                                            <h3><?php echo $img_title; ?></h3><?php
																		}else{?>
                                                                        	<h3 class="no-border"></h3><?php
																		};?>
                                                                            <p><?php if($img_content) echo do_shortcode($img_content); ?></p>
                                                                            <?php if($img_link){ ?>
                                                                            <a href="<?php echo $img_link; ?>" ><?php echo $img_buttontitle; ?></a>
                                                                            <?php };?>
                                                                        </div>	
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul><?php
                                                }else{ ?>
                                                    <div class="hover-effect h-style"><?php 
                                                       	if($img_title || $img_content){  ?>
                                                            <img src="<?php echo $src[0]; ?>" class="clean-img"/> 
                                                            <div class="mask"><?php 
                                                                if($img_title){ ?>
                                                                    <h2><?php echo $img_title; ?></h2> <?php 
                                                                }else{?>
                                                                    <h2 class="no-border"></h2><?php
																};?>
                                                                <p><?php if($img_content) echo do_shortcode($img_content); ?></p><?php
                                                                 if($img_link){ ?>
                                                                    <a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
                                                                 }; ?>
                                                            </div><?php 
                                                        }else{ ?>
                                                      
                                                            <a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/> 
                                                                <div class="mask">
                                                                    <span class="img-rollover"></span>
                                                                </div>
                                                            </a><?php 
                                                        };?>
                                                    </div><?php
                                            	};?>
                                        	</li> <?php
											foreach ( $attachment_ids as $attachment_id ) {
													if($img_syle == "circle"){
														if($img_size == "big"){
															$srcslider = wp_get_attachment_image_src( $attachment_id, array( 310,310, ), true );
														}
														if($img_size == "medium"){
															$srcslider = wp_get_attachment_image_src( $attachment_id, array( 220, 220, ), true );
														}
														if($img_size == "small"){
															$srcslider = wp_get_attachment_image_src( $attachment_id, array( 150, 150, ), true );
														}
													}else{
															$srcslider = wp_get_attachment_image_src( $attachment_id, array( 720,405, ), true );
															$srcsliderf = wp_get_attachment_image_src( $attachment_id, 'full', true );
													}	
												$image_link = wp_get_attachment_url( $attachment_id );
									
												if ( ! $image_link )
													continue;
												$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );?>
                                                <li><?php
                                                	if($img_syle == "circle"){ ?>
                                                        <ul class="ch-grid">
                                                            <li>
                                                                <div class="ch-item" style="background-image: url(<?php echo $srcslider[0] ?>);">				
                                                                    <div class="ch-info-wrap">
                                                                        <div class="ch-info">
                                                                            <div class="ch-info-front" style="background-image: url(<?php echo $srcslider[0]; ?>);"></div>
                                                                            <div class="ch-info-back">
                                                                                <h3><?php if($img_title) echo $img_title; ?></h3>
                                                                                <p><?php if($img_content) echo do_shortcode($img_content); ?></p>
                                                                                <?php if($img_link){ ?>
                                                                                <a href="<?php echo $img_link; ?>" ><?php echo $img_buttontitle; ?></a>
                                                                                <?php };?>
                                                                            </div>	
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul><?php
                                                    }else{ ?>
                                                        <div class="hover-effect h-style">
                                                            <a href="<?php echo $image_link; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $srcslider[0];?>" class="clean-img"/> 
                                                                <div class="mask">
                                                                    <span class="img-rollover"></span>
                                                                </div>
                                                            </a>
                                                        </div><?php
                                                    };?>
                                                </li> <?php 
											};?>
										</ul>
									</div> <?php
								}else{
									if($img_syle == "circle"){ ?>
										<ul class="ch-grid">
											<li>
												<div class="ch-item" style="background-image: url(<?php echo $src[0]; ?>);">				
													<div class="ch-info-wrap">
														<div class="ch-info">
															<div class="ch-info-front" style="background-image: url(<?php echo $src[0]; ?>);"></div>
															<div class="ch-info-back">
																<h3><?php if($img_title) echo $img_title; ?></h3>
                                                                <p><?php if($img_content) echo do_shortcode($img_content);  ?></p>
                                                                <?php if($img_link){ ?>
                                                                <a href="<?php echo $img_link; ?>" ><?php echo $img_buttontitle; ?></a>
                                                                <?php };?>
															</div>	
														</div>
													</div>
												</div>
											</li>
										</ul><?php
									}else{
										if ($product->is_on_sale() && $img_syle != "circle" && $img_badge != 'new' && $img_badge != 'hot'){

	?> <div class="badge badge-sale <?php if($img_size != 'big' && $img_syle == "square") {  ?> m-pading <?php };?>"></div><?php 
								}
										if($img_badge =='new' && $img_syle != "circle"){?>
											<div class="badge badge-1 <?php if($img_size != 'big' && $img_syle == "square") {  ?> m-pading <?php };?>"></div><?php
										}
										if($img_badge =='hot' && $img_syle != "circle"){?>
											<div class="badge-hot <?php if($img_size != 'big' && $img_syle == "square") {  ?> b-pading <?php };?>"></div><?php
										}?>
										<div class="hover-effect h-style">  <?php
											if($img_title || $img_content){  ?>
												<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
												<div class="mask"><?php
													if($img_title){ ?>
														<h2><?php echo $img_title; ?></h2><?php
													}; ?>
													<p><?php echo do_shortcode($img_content); ?></p><?php	
													if($img_link){ ?>
														<a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
													}; ?>
												</div><?php 
											}else{  ?>
                                            
												<a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/>
													<div class="mask">
														<span class="img-rollover"></span>
													</div>
												</a><?php   
											};?>
										</div><?php
									};
								};	
                        	};?>
                        </div>
                    </div>
                </div><?php 
			};
        };
			
			
			if($row_position == 'left') {  ?>
        		<div class="ss-left empty-left"><?php 
        	};
			if($row_position == 'right') {?> 
				<div class="ss-right empty-right"><?php
			};
			if($row_position == 'center') {?> 
				<div class="ss-full"><?php  
			};
		
			if(apply_filters( 'the_content', get_the_content()) != '' || $post_showtitle == 'hide' && has_post_thumbnail() && $img_position == 'inside'){ ?>
                <div class="arrow-up"></div>
                <div class="arrow-side"></div>
                <div class="container-border">
                    <div class="gray-container"> <?php 
                   		if(apply_filters ('the_title', get_the_title()) !=''  ) {
							if($post_showtitle != 'hide'){?>      
                        		<h3 class="content-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php 
							};
                    	};
						if(has_post_thumbnail()) {	
							if($img_position == 'inside' || $row_position == 'center' ) {  
								if($row_position == 'center'){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,205, ), true );
									$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', true );
								}else if($img_position == 'inside'){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,405, ), true );
									$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', true );
								};
								global $post, $product, $woocommerce;
								$attachment_ids = $product->get_gallery_attachment_ids();
								
									if ($product->is_on_sale() && $img_badge != 'new' && $img_badge != 'hot'){

	?> <div class="badge badge-sale <?php if($row_position == 'center'){ ?>badge-top-padding<?php };?>"></div><?php 
								}
								if($img_badge =='new'){?>
										<div class="badge badge-1 <?php if($row_position == 'center'){ ?>badge-top-padding<?php };?>"></div><?php
									}
									if($img_badge =='hot'){?>
										<div class="badge-hot <?php if($row_position == 'center'){ ?>badge-hot-top-padding<?php };?>"></div><?php
									}
								
								if($attachment_ids[0] != ''){?>

                                	<div id="flexslider-<?php echo $id;?>" class="flexslider">
                                    	<ul class="slides">
                                        	<li>
                                        		<div class="hover-effect h-style"><?php 
													if($img_title || $img_content){ ?>
                                        				<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
														<div class="mask"><?php 
                                    						if($img_title){ ?>
                        			  							<h2><?php echo $img_title; ?></h2> <?php 
															}; ?>
                                     						<p><?php echo do_shortcode($img_content); ?></p><?php
                                      						 if($img_link){ ?>
                                      							<a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
                                      						 }; ?>
                                   						</div><?php 
													}else{  ?>
                                                  
                               			 				<a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/> 
                                                            <div class="mask">
                                                                <span class="img-rollover"></span>
                                                            </div>
														</a><?php 
													};?>
                                        		</div>
                                        	</li> <?php
											foreach ($attachment_ids as $attachment_id ) {
												if($row_position == 'center'){
													$srcslider = wp_get_attachment_image_src( $attachment_id, array( 720,205, ), true );
													$srcsliderf = wp_get_attachment_image_src( $attachment_id, 'full', true );
												}else if($img_position == 'inside'){
													$srcslider = wp_get_attachment_image_src( $attachment_id, array( 720,405, ), true );
													$srcsliderf = wp_get_attachment_image_src( $attachment_id, 'full', true );
												};
												$image_link = wp_get_attachment_url( $attachment_id );
												if ( ! $image_link )
													continue;
												$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
												
												
												?>
                                                <li>
                                                	<div class="hover-effect h-style">
                                                 		<a href="<?php echo $image_link; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $srcslider[0]; ?>" class="clean-img"/> 
                                                        
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
                                		if($img_title || $img_content){ ?>
											<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
											<div class="mask"><?php 
												if($img_title){ ?>
													<h2><?php echo $img_title; ?></h2><?php  
												}; ?>
												<p><?php  echo do_shortcode($img_content); ?></p><?php 
												if($img_link){ ?>
													<a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
												}; ?>
											</div><?php 
										}else{ ?>
                                        	<a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/>
                                            	<div class="mask">
                                                	<span class="img-rollover"></span>
                                    			</div>
                                            </a><?php
								 		};?>
                            		</div><?php 
                            	};
							};
						};
						 
                    	the_content();  
						?>  <?php
						if(apply_filters( 'the_content', get_the_content()) != ''){
							do_action( 'woocommerce_after_shop_loop_item_title' );
							do_action( 'woocommerce_after_shop_loop_item' ); 
						}
						if($post_showcategory != "hide"){ ?>
                            <div class="icon-soc-container">
                                <div class="share-btns">
                                    <div class="empty-right">
                                     <span><?php if ( $rating_html = $product->get_rating_html() ) { echo $rating_html;}else{?><div class="star-rating" title="Rated 0.00 out of 0"><span class="no-rating"><strong class="rating">0.00</strong> out of 0</span></div>
<?php }?></span>              
                                    <div class="icon-s comments-ico"></div><a href="<?php comments_link(); ?>"> <?php comments_number( '0', '1', '%' ); ?></a>
                                    </div><?php
                                    $category = get_the_category(); ?> 
                                    <div class="empty-left">
                                    	<div class="icon-s category-ico"></div><a href="<?php echo get_category_link( $category[0]->term_id );?>"><?php   echo $product->get_categories();?></a>
                                    </div> 
                                </div>   
							</div><?php
						};?>
					</div>	
				</div><?php
				
				if($post_showsoc == "show"){
				
					if( of_get_option('fb-link') !='' || of_get_option('tw-link') !='' || of_get_option('li-link') !='' || of_get_option('yt-link') !='' || of_get_option('vm-link') !='' || of_get_option('fl-link') !='' || of_get_option('da-link') !='' || of_get_option('su-link') !='' || of_get_option('di-link') !=''){?>
                    <div class="icon-soc-container-alone">
                        <div class="container-border">
                            <div class="gray-container"> 
                                <ul><?php 
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
					}
				};
			}; ?>
		</div>
	</div>
<?php endwhile; wp_reset_query() ?>
<?php else : ?>
         
    <div class="ss-row">
        <div class="ss-full s-no-result"> 
            <div class="time-dot"></div>
            <div class="arrow-up"></div>
            <div class="container-border">
                <div class="gray-container">
                    <h3 class="content-title"><?php _e( 'No more posts to show', 'timeline' ); ?></h3>
                        <p><?php _e( 'Search for something else', 'timeline' ); ?></p>
                        <?php echo get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
 <?php endif;?>
