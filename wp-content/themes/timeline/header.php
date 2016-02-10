<?php
/*
* Theme Name: Timeline eCommerce Theme
*
* Description: Timeline eCommerce Theme is a clean and minimal wordpress theme, 
* intended to showcase your work, events, blog, shop or interests in an unique modern way, 
* using the trendy timeline look.
*
* Version: 2.2.2 
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php if ( !is_front_page() ) { echo wp_title( ' ', true, 'left' ); echo ' | '; }
	echo bloginfo( 'name' ); echo ''; bloginfo( 'description', 'display' );  ?> 
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri().'/style.css' ; ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="twitter:card" content="summary_large_image">
 <?php 
if(is_single() && has_post_thumbnail() || is_page() && has_post_thumbnail() ) {
	$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full', true );
}?>					
<meta name="twitter:image" content="<?php if(isset($srcf[0])){echo $srcf[0];} ?>">
<meta property="og:title" content="<?php if ( is_single() || is_page() ) { the_title(); }else{ bloginfo('name'); }?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php if ( is_single() || is_page() ) { the_permalink(); }else{ echo get_site_url(); }?>" /> 
<meta name="twitter:url" content="<?php if ( is_single() || is_page() ) { the_permalink(); }else{ echo get_site_url(); }?>">
<meta name="og:description" content="<?php if ( is_single() || is_page() ) { if(get_the_excerpt()!=''){echo get_the_excerpt();}else{ the_title(); }}else{bloginfo('name'); echo " - "; bloginfo('description');} ?>" />

<meta name="twitter:site" content="@flasherland">
<?php

if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script('jquery');
	wp_head();
	wp_get_archives('type=monthly&format=link');
?>
		<!--[if lte IE 7]><style>.ss-container, .header-white, .ss-nav, .ss-row-clear{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
        <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/styleIE.css" />
        <![endif]-->
        <!--[if lte IE 8]>
        	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/styleIE8.css" />
        <![endif]-->

    	<!-- prettyPhoto
  		================================================== -->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />

        <!-- Header slider
        ================================================== -->
        <?php if( of_get_option('active-header', 'no entry' ) == '1'){ ?>
        <link rel='stylesheet' id='camera-css'  href='<?php echo get_template_directory_uri(); ?>/homeslider/camera.css' type='text/css' media='all'> 
        <script>
            jQuery(document).ready(function($){
						
                jQuery('#camera_wrap_1').camera({
                    thumbnails: false,
					<?php if(!is_home()){?>height: '<?php echo of_get_option('header-height'); ?>px',<?php }else{?>height: '<?php echo of_get_option('header-height-home'); ?>px',<?php }; ?>
                  	fx: '<?php echo of_get_option('slider_fx', 'no entry' ); ?>',
					autoAdvance: <?php echo of_get_option('slider_play', 'no entry' ); ?>,
                    pagination: false,
					
                });
            });
			
        </script>
        <?php }; ?>
        
        <!-- Image slider
        ================================================== -->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css" type="text/css" media="screen" />
    	
    	<!-- Img roll over effect settings
		================================================== -->
     

        <script>
        jQuery(document).ready(function($){
		 if(Modernizr.csstransforms3d != false){

            var imgholder = document.getElementsByClassName("hover-effect");
            
            for(var i = 0, j=imgholder.length; i<j; i++){
                imgholder[i].addEventListener("mouseover", function(){
                    var imgtoanimate = this.getElementsByTagName("img")[0];							   
                    move(imgtoanimate)
                    .rotate(<?php echo of_get_option('rollover-rotate', 'no entry' ); ?>)
                    .scale(<?php echo of_get_option('rollover-scale', 'no entry' ); ?>)
                    .duration('<?php echo of_get_option('rollover-duration', 'no entry' ); ?>s')
                    .end();
                });
            
                imgholder[i].addEventListener("mouseout", function(){
                    var imgtoanimate = this.getElementsByTagName("img")[0];						   
                    move(imgtoanimate)
                    .rotate(<?php echo of_get_option('rollout-rotate', 'no entry' ); ?>)
                    .scale(<?php echo of_get_option('rollout-scale', 'no entry' ); ?>)
                    .duration('<?php echo of_get_option('rollout-duration', 'no entry' ); ?>s')
                    .end();
                });
            }
		 }
        });
        </script>
        
     
        <script>
        jQuery(document).ready(function($){
        	var oDropdown = $(".entry-summary select, .checkout select, .cart-collaterals select, .selectora select, .woocommerce-account select").msDropdown();
			 });
         </script>
      
         
         <!-- Scroll effect
		================================================== -->
        <?php if(of_get_option('scroll-effect') == "perspective1" || of_get_option('scroll-effect') == "perspective2"){
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
		var isMobile = {
				Android: function() {
					return navigator.userAgent.match(/Android/i);
				},
				BlackBerry: function() {
					return navigator.userAgent.match(/BlackBerry/i);
				},
				iOS: function() {
					return navigator.userAgent.match(/iPhone|iPad|iPod/i);
				},
				
				Opera: function() {
					return navigator.userAgent.match(/Opera Mini/i);
				},
				Windows: function() {
					return navigator.userAgent.match(/IEMobile/i);
				},
				any: function() {
					return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
				}
			};
			jQuery( document ).ready( function($){
											
				$sidescroll	= (function($) {
										
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
								winCenter	= winSize.height / 2 + winscroll;	
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
						$('body').addClass('forios');
						<?php
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
        <script>
		<?php if( of_get_option('active-backgroud-video', 'no entry' ) == '1'){ ?> 
	
			jQuery(document).ready(function($){
            var screenIndex = 1,
                numScreens = $('.screen').length,
                isTransitioning = false,
                transitionDur = 1000,
                BV,
                videoPlayer,
                isTouch = Modernizr.touch,
                $bigImage = $('.big-image'),
                $window = $(window);
            
            if (!isTouch) {
                // initialize BigVideo
                BV = new $.BigVideo({forceAutoplay:isTouch});
                BV.init();
                showVideo();
                
                BV.getPlayer().addEvent('loadeddata', function() {
                    onVideoLoaded();
                });

                // adjust image positioning so it lines up with video
                $bigImage
                    .css('position','relative')
                    .imagesLoaded(adjustImagePositioning);
                // and on window resize
                $window.on('resize', adjustImagePositioning);
            }
            
            function showVideo() {
                BV.show($('#screen-'+screenIndex).attr('data-video'),{ambient:true});
            }
            function onVideoLoaded() {
                $('#screen-'+screenIndex).find('.big-image').transit({'opacity':0},500)
            }
            function onTransitionComplete() {
                isTransitioning = false;
                if (!isTouch) {
                    $('#big-video-wrap').css('left',0);
                    showVideo();
                }
            }
            function adjustImagePositioning() {
                $bigImage.each(function(){
                    var $img = $(this),
                        img = new Image();

                    img.src = $img.attr('src');

                    var windowWidth = $window.width(),
                        windowHeight = $window.height(),
                        r_w = windowHeight / windowWidth,
                        i_w = img.width,
                        i_h = img.height,
                        r_i = i_h / i_w,
                        new_w, new_h, new_left, new_top;

                    if( r_w > r_i ) {
                        new_h   = windowHeight;
                        new_w   = windowHeight / r_i;
                    }
                    else {
                        new_h   = windowWidth * r_i;
                        new_w   = windowWidth;
                    }

                    $img.css({
                        width   : new_w,
                        height  : new_h,
                        left    : ( windowWidth - new_w ) / 2,
                        top     : ( windowHeight - new_h ) / 2
                    })

                });

            }
        }); <?php
			}?>
		</script>
        

         <!-- Background image rotator
        ================================================== -->
   		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.vegas.css" type="text/css" media="screen" charset="utf-8" />

        <!-- start infinite scroll function  -->
        <?php 	
		$st = "0";
		global $product, $woocommerce_loop;
		if(is_home()){
			$sticky = get_option( 'sticky_posts' );
			$wp_query = new WP_Query(array( 'post__in' => $sticky) );
			$st = "0";
		}else if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_woocommerce() ){
			$st = "2";
		}else{
			$st = "1";
		}
		
		global $slectloop;
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			
			 if (is_woocommerce() && of_get_option('pagination-display') == "infinite" || !is_woocommerce() && of_get_option('def-pagination-display') == "infinite"){
				 if(is_woocommerce()){
					$slectloop = 'loop-woocommerce';
				}else{
					$slectloop = 'loop';
				}
				 $goinfinite  = 1;
			 }
		}else{
			 if (of_get_option('def-pagination-display') == "infinite"){
				 
				$slectloop = 'loop';
				 $goinfinite  = 1;
			 }
			
		};
			
	if(isset($goinfinite) == 1){
		$wpqueryvarsSerialized = rawurlencode(serialize($wp_query->query_vars));
		?>
        
        
		<script>
		var slectloop = <?php echo json_encode($slectloop); ?>;
		var whait = 0;
        var count = 2;
        var total = <?php echo $wp_query->max_num_pages; ?>;
		var is_state =  <?php echo $st; ?>;
		var var_string = '<?php echo  $wpqueryvarsSerialized; ?>';
		
		jQuery(window).scroll(function($){			 
			if  (jQuery(window).scrollTop() > jQuery(document).height() - jQuery(window).height()-350){
				
            	if (count > total){
                	return false;
                }else{
					if(whait !=1){  
                   		loadArticle(count, is_state, var_string);
						whait = 1
					}else{
					   return false;
					}
				}
				count++;
			}
		}); 
		
		
        function loadArticle(pageNumber, is_state, var_string){    
        	jQuery('.inifiniteLoader').show('fast');
			
            	jQuery.ajax({
                    url: "<?php echo site_url() ?>/wp-admin/admin-ajax.php",
                    type:'POST',
                    data:"action=infinite_scroll&page_no="+ pageNumber + '&loop_file='+slectloop+'&is_state='+is_state+'&var_string='+var_string,
                    success: function(html){	
                        jQuery('.inifiniteLoader').hide('4000');
                        jQuery("#posts").append(html);
						whait = 0;
                    }
                });
			return false;
		}
		</script>
		<?php }; ?>	
        <script type="text/javascript">
            ddsmoothmenu.init({
				mainmenuid: "mainmenu", //menu DIV id
				orientation: 'h',
				classname: 'menu-menu-container', //class added to menu's outer DIV
				contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
   			 })
			 
			 
			 
			 
			 
		
			 
			
			 
			 
			 
        </script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri().'/css/responsive.css' ; ?>" />
</head>

<body <?php body_class(); ?>> 
 <?php if( of_get_option('active-backgroud-video', 'no entry' ) == '1'){ ?> 
 
 <div class="wrapper">
        <div class="screen" id="screen-1" data-video="<?php echo of_get_option('background-video-mp4'); ?>"><?php 
		if( of_get_option('background-video-image', 'no entry' ) != ''){ ?> 
            <img src="<?php echo of_get_option('background-video-image'); ?>" class="big-image" /><?php
         };?>
        </div>
    </div><?php
 };?>

<?php
	if( of_get_option('active-background', 'no entry' ) == '1'){ ?>   
    	<script>
			jQuery.vegas('slideshow', {
			delay:<?php echo of_get_option('background-slideshow'); ?>,
			backgrounds:[
				 <?php if(of_get_option('background-img-1')){?>
					{ src:'<?php echo of_get_option('background-img-1'); ?>', fade:<?php echo of_get_option('background-fade-1'); ?>, valign:'<?php echo of_get_option('background-valign-1'); ?>', align:'<?php echo of_get_option('background-halign-1'); ?>' }
				 <?php } ?>
				 
				 <?php if(of_get_option('background-img-2')){?>
					,{ src:'<?php echo of_get_option('background-img-2'); ?>', fade:<?php echo of_get_option('background-fade-2'); ?>, valign:'<?php echo of_get_option('background-valign-2'); ?>', align:'<?php echo of_get_option('background-halign-2'); ?>' }
				 <?php } ?>
				 
				  <?php if(of_get_option('background-img-3')){?>
					,{ src:'<?php echo of_get_option('background-img-3'); ?>', fade:<?php echo of_get_option('background-fade-3'); ?>, valign:'<?php echo of_get_option('background-valign-3'); ?>', align:'<?php echo of_get_option('background-halign-3'); ?>' }
				 <?php } ?>
				 
				  <?php if(of_get_option('background-img-4')){?>
					,{ src:'<?php echo of_get_option('background-img-4'); ?>', fade:<?php echo of_get_option('background-fade-4'); ?>, valign:'<?php echo of_get_option('background-valign-4'); ?>', align:'<?php echo of_get_option('background-halign-4'); ?>' },
				 <?php } ?>
				 
				  <?php if(of_get_option('background-img-5')){?>
					,{ src:'<?php echo of_get_option('background-img-5'); ?>', fade:<?php echo of_get_option('background-fade-5'); ?>, valign:'<?php echo of_get_option('background-valign-5'); ?>', align:'<?php echo of_get_option('background-halign-5'); ?>' }
				 <?php } ?>
			  ]
			})('overlay', {
			  src:'<?php echo get_template_directory_uri(); ?>/images/overlays/<?php echo of_get_option('background-overlays', 'no entry' ); ?>.png'
			});
	</script>
    	<?php }else{ if( of_get_option('active-backgroud-video', 'no entry' ) != '1'){?> <div id="site-background"></div> <?php }; };
 ?>
	<div class="header-white"></div>
	<div class="container" id="#containera"> 
    	<div class="ss-stand-alone">
        
            <div class="ss-nav">
                <div id="header-wrapper">
                    <a href="<?php echo get_site_url(); ?>" class="logohover">
                    	<div class="logo" style=" background:url( <?php echo of_get_option('logo-img', 'no entry' ); ?>) no-repeat left bottom; ">
               			</div>
                	</a> 
                    <div id="mainmenu" class="wrapper ddsmoothmenu"  >
                    	<ul class="navcal">
                        	<li id="widgets-m">
                            
                            <?php global $woocommerce; ?>
                            <div class="badgecat <?php if($woocommerce->cart->cart_contents_count != 0){ ?>showcat <?php }else{?>hidecat<?php };?>"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></div>
                            	<ul class="navcal-d">
                                	<div class="arrow"></div>
                                    <div class="navcal-p"><?php
                                		get_sidebar(); ?>	
                            		</div>
                                </ul>
                            </li>
                        </ul>
                        <?php wp_nav_menu( array( 'sort_column' => 'menu_order','container' => '', 'menu_class' => 'nav', 'menu_id' => 'nav', 'theme_location' => 'primary-menu' ) );?>
                    </div>
                </div>
            </div>
		</div>
		<script>
		jQuery(document).ready(function($){
			selectnav('nav', {
				activeclass: 'act',
				nested: true,
				label: false
			});
			jQuery('.js .selectnav').dropkick({
			  change: function (value, label) {
				 window.location = value;
			  }
			});
		});
		</script>
		<?php 
		if( of_get_option('active-header', 'no entry' ) == '1'){ ?>
			<div class="ss-row-clear header-top-p" id="headslider" style=" <?php if(!is_home() && of_get_option('header-height') == 0 ){ ?> display:none;<?php }; ?>" >
        	<div class="camera_wrap camera_indigo_skin camera-header" id="camera_wrap_1" >
            
                <!-- First Slider IMG
                ================================================== -->
            	<?php if ( of_get_option('header-img-1') ) { ?>
                    <div data-thumb="<?php echo of_get_option('header-img-1'); ?>" data-src="<?php echo of_get_option('header-img-1'); ?>">
                        <div class="fadeFromBottom" >
                            <div class="camera-title-container">
                                <?php if ( of_get_option('header-img-1-title') ) { ?>
                                    <h1 class="camera-big-title"><?php echo of_get_option('header-img-1-title', 'no entry'); ?></h1>
                                <?php } ?>
                                <?php if ( of_get_option('header-img-1-subtitle') ) { ?>
                                    <p class="camera-subtitle"><?php echo of_get_option('header-img-1-subtitle', 'no entry'); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                
                <!-- Second Slider IMG
                ================================================== -->
            	<?php if ( of_get_option('header-img-2') ) { ?>
                    <div data-thumb="<?php echo of_get_option('header-img-2'); ?>" data-src="<?php echo of_get_option('header-img-2'); ?>">
                        <div class="fadeFromBottom" >
                            <div class="camera-title-container">
                                <?php if ( of_get_option('header-img-2-title') ) { ?>
                                    <h1 class="camera-big-title"><?php echo of_get_option('header-img-2-title', 'no entry'); ?></h1>
                                <?php } ?>
                                <?php if ( of_get_option('header-img-2-subtitle') ) { ?>
                                    <p class="camera-subtitle"><?php echo of_get_option('header-img-2-subtitle', 'no entry'); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                
                <!-- Third Slider IMG
                ================================================== -->
            	<?php if ( of_get_option('header-img-3') ) { ?>
                    <div data-thumb="<?php echo of_get_option('header-img-3'); ?>" data-src="<?php echo of_get_option('header-img-3'); ?>">
                        <div class="fadeFromBottom" >
                            <div class="camera-title-container">
                                <?php if ( of_get_option('header-img-3-title') ) { ?>
                                    <h1 class="camera-big-title"><?php echo of_get_option('header-img-3-title', 'no entry'); ?></h1>
                                <?php } ?>
                                <?php if ( of_get_option('header-img-3-subtitle') ) { ?>
                                    <p class="camera-subtitle"><?php echo of_get_option('header-img-3-subtitle', 'no entry'); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                
                <!-- Fourth Slider IMG
                ================================================== -->
            	<?php if ( of_get_option('header-img-4') ) { ?>
                    <div data-thumb="<?php echo of_get_option('header-img-4'); ?>" data-src="<?php echo of_get_option('header-img-4'); ?>">
                        <div class="fadeFromBottom" >
                            <div class="camera-title-container">
                                <?php if ( of_get_option('header-img-4-title') ) { ?>
                                    <h1 class="camera-big-title"><?php echo of_get_option('header-img-4-title', 'no entry'); ?></h1>
                                <?php } ?>
                                <?php if ( of_get_option('header-img-4-subtitle') ) { ?>
                                    <p class="camera-subtitle"><?php echo of_get_option('header-img-4-subtitle', 'no entry'); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Fifth Slider IMG
                ================================================== -->
            	<?php if ( of_get_option('header-img-5') ) { ?>
                    <div data-thumb="<?php echo of_get_option('header-img-5'); ?>" data-src="<?php echo of_get_option('header-img-5'); ?>">
                        <div class="fadeFromBottom" >
                            <div class="camera-title-container">
                                <?php if ( of_get_option('header-img-5-title') ) { ?>
                                    <h1 class="camera-big-title"><?php echo of_get_option('header-img-5-title', 'no entry'); ?></h1>
                                <?php } ?>
                                <?php if ( of_get_option('header-img-5-subtitle') ) { ?>
                                    <p class="camera-subtitle"><?php echo of_get_option('header-img-5-subtitle', 'no entry'); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div><?php
                 } ?>
			</div>
            <div class="camera-header-end" style=" <?php if(!is_home()){?>margin-top:<?php echo of_get_option('header-height')-6; ?>px;<?php }else{?>margin-top:<?php echo of_get_option('header-height-home')-6; ?>px;<?php }; ?>"></div>
		</div><?php }else{?><div class="header-top-p"></div><?php };?>
        
        <header>
        	<div class="support-note"><!-- let's check browser support with modernizr -->
					<!--span class="no-cssanimations">CSS animations are not supported in your browser</span-->
					<!--span class="no-csstransforms">CSS transforms are not supported in your browser</span-->
					<!--span class="no-csstransforms3d">CSS 3D transforms are not supported in your browser</span-->
					<!--span class="no-csstransitions">CSS transitions are not supported in your browser</span-->
                <span class="note-ie"><br>We are apologize for the inconvenience but you need to download <br> more modern browser in order to be able to browse our page<br />
                    <div class="support-note-ico">
                        <a href="http://support.apple.com/kb/DL1531?viewlocale=en_US&locale=en_US"><img src="<?php echo get_template_directory_uri(); ?>/images/support/safari.png" width="50" height="50" /> <br>Download Safari
                        </a>
                        <a href="https://www.google.com/intl/en/chrome/browser/"><img src="<?php echo get_template_directory_uri(); ?>/images/support/chrome.png" width="50" height="50"  /> <br>Download Chrome
                        </a>
                        <a href="http://www.mozilla.org/en-US/firefox/new/"><img src="<?php echo get_template_directory_uri(); ?>/images/support/firefox.png" width="50" height="50"/> <br>Download Firefox
                        </a>
                        <a href="http://www.opera.com/download/"><img src="<?php echo get_template_directory_uri(); ?>/images/support/opera.png" width="50" height="50"/> <br>Download Opera
                        </a>
                    </div>
                </span>
            </div>
        </header>
       <div class="ss-stand-alone <?php if(!is_home() && of_get_option('header-height') == 0 && of_get_option('active-header', 'no entry' ) == '1'){ ?> header-top-p<?php }; ?>" >
       <div id="ss-container" class="ss-container  <?php if(!is_home() && of_get_option('header-height') == 0 && of_get_option('active-header', 'no entry' ) == '1'){ ?> pad-slider<?php }; ?>">
       <?php if ( ! isset( $content_width ) ) $content_width = 810; ?>