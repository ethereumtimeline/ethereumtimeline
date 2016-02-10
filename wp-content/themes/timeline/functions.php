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

//Add support for WordPress 3.0's custom menus
add_action( 'init', 'register_my_menu' );

//Register area for custom menu
function register_my_menu() {
	register_nav_menu( 'primary-menu', 'Primary Menu');
}
$theme  = wp_get_theme();
//Code for custom background support

add_theme_support( 'custom-background'); 

//Enable post and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// Enable post thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size(520, 250, true);

/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 */
if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = false) {
		
		$optionsframework_settings = get_option('optionsframework');
		
		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];
		
		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}
			
		if ( isset($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}

//Register javascripts and css
function my_scripts_method() {
	wp_register_script('prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js');
	wp_enqueue_script('prettyPhoto');
	wp_register_script('allfunctions', get_template_directory_uri().'/js/all-functions.js');
	wp_enqueue_script('allfunctions');
	wp_register_script('easing', get_template_directory_uri().'/js/jquery.easing.1.3.js');
	wp_enqueue_script('easing');
	wp_register_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider.js');
	wp_enqueue_script('flexslider');
	wp_register_script('ddsmoothmenu', get_template_directory_uri().'/js/ddsmoothmenu.js');
	wp_enqueue_script('ddsmoothmenu');
	wp_register_script('modernizr', get_template_directory_uri().'/js/modernizr.custom.79639.js');
	wp_enqueue_script('modernizr');
	wp_register_script('move', get_template_directory_uri().'/js/move.js');
	wp_enqueue_script('move');
	wp_register_script('vegas', get_template_directory_uri().'/js/jquery.vegas.js');
	wp_enqueue_script('vegas');	
	wp_register_script('jquery-migrate', get_template_directory_uri().'/js/jquery-migrate-1.0.0.js');
	wp_enqueue_script('jquery-migrate');	
	wp_register_script('selectnav', get_template_directory_uri().'/js/selectnav.js');
	wp_enqueue_script('selectnav');
	wp_register_script('dropkick', get_template_directory_uri().'/js/jquery.dropkick-1.0.0.js');
	wp_enqueue_script('dropkick');
	
	wp_register_script('fbcomments', 'http://connect.facebook.net/en_EN/all.js#xfbml=1');
	wp_enqueue_script('fbcomments');
	
	wp_register_script('cdropdowna', get_template_directory_uri().'/js/jquery.dd.js');
	wp_enqueue_script('cdropdowna');
	wp_enqueue_style( 'cdropdownacss', get_template_directory_uri().'/functions/adminanddropdown.css' );
	
	if(of_get_option('active-backgroud-video', 'no entry' ) == '1' ){
		wp_register_script('imagesloaded', get_template_directory_uri().'/js/jquery.imagesloaded.min.js');
		wp_enqueue_script('imagesloaded');	
		wp_register_script('bigvideo', get_template_directory_uri().'/js/bigvideo.js');
		wp_enqueue_script('bigvideo');	
		wp_register_script('videoto', 'http://vjs.zencdn.net/c/video.js');
		wp_enqueue_script('videoto');	
		wp_register_script('transit', get_template_directory_uri().'/js/jquery.transit.min.js');
		wp_enqueue_script('transit');
		wp_register_script('modernizr-2.5.3', get_template_directory_uri().'/js/modernizr-2.5.3.min.js');
		wp_enqueue_script('modernizr-2.5.3');
	}
	if(of_get_option('active-header', 'no entry' ) == '1' ){
		wp_register_script('camera', get_template_directory_uri().'/homeslider/camera.js');
		wp_enqueue_script('camera'); 
	
	};
	
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

// Javascript functions for admin settings
function admin_js() { ?>
    <script type="text/javascript">
		jQuery(function($) {
			jQuery('#media-items').bind('DOMNodeInserted',function(){
				jQuery('input[value="Insert into Post"]').each(function(){
						jQuery(this).attr('value','Use This Image');
				});
			});
			jQuery('.custom_upload_image_button').live("click", function() {
				window.restore_send_to_editor = window.send_to_editor;
				formfield = jQuery(this).siblings('.custom_upload_image');
				preview = jQuery(this).siblings('.custom_preview_image');
				tb_show('', 'media-upload.php?type=image&TB_iframe=true');
				window.send_to_editor = function(html) {
					imgurl = jQuery('img',html).attr('src');
					classes = jQuery('img', html).attr('class');
					id = classes.replace(/(.*?)wp-image-/, '');
					formfield.val(id);
					preview.attr('src', imgurl);
					tb_remove();
					window.send_to_editor = window.restore_send_to_editor;
				}
				return false;
			});
		
			jQuery('.custom_clear_image_button').click(function() {
							
				var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
				jQuery(this).parent().siblings('.custom_upload_image').val('');
				jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
				return false;
			});
		
			jQuery('.repeatable-add').click(function() {
				field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
				fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
				jQuery('input.custom_upload_image', field).val('').attr('name', function(index, name) {
					return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});

			})
			jQuery('.custom_preview_image', field).attr('src', '');
			field.insertAfter(fieldLocation, jQuery(this).closest('td'))
			return false;
		});
		
		jQuery('.repeatable-remove').click(function(){

			jQuery(this).parent().remove();
			return false;
		});
	});
	</script><?php 
}
if(is_admin()) {
	//wp_enqueue_script( 'jquery-ui-accordion' );
	add_action('admin_head', 'admin_js');
}
$is_black = of_get_option('color-scheme', 'no entry' );

// Add specific CSS class by filter
add_filter('body_class','my_class_names');
function my_class_names($classes) {
	// add 'class-name' to the $classes array
	$classes[] = "archive post-type-archive post-type-archive-product woocommerce woocommerce-page";
	
	if(of_get_option('color-scheme', 'no entry' ) == 'blackbody'){
		$classes[] = "blackbody ";
	}
	
	// return the $classes array
	return $classes;
}
add_theme_support('custom-header'); 


// This one shows/hides the an option when a checkbox is clicked.
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
function optionsframework_custom_scripts() { ?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
		jQuery("body select").msDropDown();
			jQuery('#example_showhidden').click(function() {
				jQuery('#section-example_text_hidden').fadeToggle(400);
			});
			
			if (jQuery('#example_showhidden:checked').val() !== undefined) {
				jQuery('#section-example_text_hidden').show();
			}
			
		});
    </script><?php
}
// Search only in posts
function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
	
if (!isset( $_GET['post_type'] ) ){
	add_filter('pre_get_posts','SearchFilter');
	
}


//Send vars for AJAX infinite scroll
function wp_infinitepaginate(){
	global $wp_query;
    $loopFile        = $_POST['loop_file'];  
    $paged           = $_POST['page_no']; 
	$is_state        = $_POST['is_state'];
	$var_string      = $_POST['var_string'];
	if(of_get_option('order-posts') == "ll" ){
		$order_posts = 'ASC';
	}else{
		$order_posts = 'DESC';
	}
	if($is_state == "0"){
    	$filter_args['paged'] = $paged;
		$filter_args['order'] = $order_posts;
		$filter_args['post_status'] = 'publish';
		$args = array_merge( unserialize(stripslashes($var_string)), $filter_args );
		query_posts( $args );
	}
	if($is_state == "1"){
		$filter_args['paged'] = $paged;
		$filter_args['order'] = $order_posts;
		$filter_args['post_status'] = 'publish';
		$args = array_merge( unserialize(stripslashes($var_string)), $filter_args );
		query_posts( $args );
	}
	if($is_state == "2"){
		remove_filter('pre_get_posts','SearchFilter');
		$filter_args['paged'] = $paged;
		$filter_args['post_type'] = 'product';
		$filter_args['post_status'] = 'publish';
		
		$args = array_merge( unserialize(stripslashes($var_string)), $filter_args );
		query_posts( $args );	
	}
    get_template_part( $loopFile );
    exit;  
}
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');           // for logged in user  
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate'); 


// Template for comments
if ( ! function_exists( 'timeline_comment' ) ) :
$GLOBALS['scramble'] = '1';

function timeline_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'timeline' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'timeline' ), '<span class="edit-link">', '</span>' ); ?></p><?php
			break;
		default :?>
            <div class="ss-row <?php if ( '0' != $comment->comment_parent ){?>comments-c-top <?php }; ?>"><?php
			if ( '0' == $comment->comment_parent ){ ?>
                <div class="time-dot-date">
                    <div class="arrow-date-border"></div>
                    <div class="arrow-date"></div>
                    <div class="container-border">
                        <div class="gray-container">
                            <?php echo get_the_date(); ?>
                        </div>
                    </div>
                </div><?php
			};?>
				<div class="time-dot"></div><?php
				if( $GLOBALS['scramble'] == '1'){
					if ( '0' != $comment->comment_parent ){?>
                    	<div class="ss-right empty-right" ><?php
					}else{?>
						<div class="ss-left empty-left"><?php
					};
				}else{
					if ( '0' != $comment->comment_parent ){?>
                    	<div class="ss-left empty-left"><?php
					}else{?>
						<div class="ss-right empty-right"><?php
					};
				}
				if ( '0' != $comment->comment_parent ){?>
                    	<div class="arrow-up-comments"></div><?php
				};?>
                    <div class="arrow-side"></div>
                    <div class="container-border">
                        <div class="gray-container"> 
                      		<h3 class="content-title "><?php 
								printf( __( '<span class="comment-auth">%1$s</span> <span class="says">said:</span>', 'timeline' ),
									sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
									sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										get_comment_time( 'c' ),
										/* translators: 1: date, 2: time */
										sprintf( __( '%1$s at %2$s', 'timeline' ), get_comment_date(), get_comment_time() )
									)
								);?>
                            </h3>
                            <article id="comment-<?php comment_ID(); ?>" class="comment">
                                <footer class="comment-meta">
                                    <div class="comment-author vcard">
                                        <?php edit_comment_link( __( 'Edit', 'timeline' ), '<span class="edit-link">', '</span>' ); ?>
                                    </div>
                                    <?php if ( $comment->comment_approved == '0' ) : ?>
                                        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'timeline' ); ?></em>
                                        <br />
                                    <?php endif; ?>
                                </footer>
                                <div class="comment-content">
                                <div class="comment-avatarin" style=""><?php $avatar_size = 108;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 69;
						echo get_avatar( $comment, $avatar_size ); ?></div>
								
								
								
								<?php  comment_text(); ?></div>
                                <div class="reply">
                                    <?php  comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'timeline' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                                </div>
                            </article>
                            <div class="icon-soc-container">
                                <div class="share-btns">
                                    <div class="empty-right">
                                        <?php  /* translators: 1: comment author, 2: date and time */
                                        printf( __( '%2$s', 'timeline' ),
                                            sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                                            sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                                get_comment_time( 'c' ),
                                                /* translators: 1: date, 2: time */
                                                sprintf( __( '%1$s at %2$s', 'timeline' ), get_comment_date(), get_comment_time() )
                                            )
                                        );?>  
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div> 
                </div><?php
				if( $GLOBALS['scramble'] == '1'){
					if ( '0' != $comment->comment_parent ){?>
                    	<div class="ss-left empty-left"><?php
						$GLOBALS['scramble'] = '1';
					}else{?>
						<div class="ss-right empty-right"><?php
						$GLOBALS['scramble'] = '2';
					};
				}else{
					if ( '0' != $comment->comment_parent ){?>
                    	<div class="ss-right empty-right"><?php
							$GLOBALS['scramble'] = '2';
					}else{?>
						<div class="ss-left empty-left"><?php
							$GLOBALS['scramble'] = '1';
					};
				}
				?>
                <div class="ss-long-arrow"></div>
                    <div class="arrow-side rsphide"></div>
                    <div class="container-border c-size-small img-padding  <?php if($GLOBALS['scramble'] == '2'){?>empty-left <?php }; ?> <?php if($GLOBALS['scramble'] == '1'){?>empty-right <?php }; ?> <?php if ( '0' != $comment->comment_parent ){?> comments-small-avatar <?php }else{ ?>comments-big-avatar<?php };?>" >
                        <div class="gray-container img-padding-c"><?php
						$avatar_size = 108;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 69;
						echo get_avatar( $comment, $avatar_size );
					?>
                        </div>
                    </div> 
                </div>
			</div><?php
			break; 
	endswitch;
}
endif;

function has_shortcode_property($shortcode = '') {  
    $post_to_check = get_post(get_the_ID());  
    // false because we have to search through the post content first  
    $found = false;  
    // if no short code was provided, return false  
    if (!$shortcode) {  
        return $found;  
    }  
    // check the post content for the short code  
    if ( stripos($post_to_check->post_content, $shortcode) !== false ) {  
        // we have found the short code  
        $found = true;  
    }  
    // return our final results  
    return $found;  
}  

//Add diferent images sizes
add_image_size('ch-itema', 500, 500, $crop = true);
add_image_size('circle-big', 310, 310, $crop = true);
add_image_size('circle-small', 220, 220, $crop = true);
add_image_size('standart-image', 720, 405, $crop = true);
add_image_size('full-width-content', 720, 205, $crop = true);
if(function_exists('add_theme_support')) {
    /** Exists! So add the post-thumbnail */
    add_theme_support('post-thumbnails');
 
    /** Now Set some image sizes */
 
    /** #1 for our featured content slider */
    add_image_size( $name = 'itg_featured', $width = 500, $height = 300, $crop = true );
 
    /** #2 for post thumbnail */
    add_image_size( 'ch-item', 550, 550, $crop = true);
	
}

//Shordcode class	
class ZillaShortcodes {
    function __construct() 
    {	
    	require_once('shortcode/shortcodes.php' );
    	define('ZILLA_TINYMCE_URI', get_template_directory_uri().'/shortcode/tinymce');
		define('ZILLA_TINYMCE_DIR', get_template_directory( __FILE__ ).'/shortcode/tinymce');
		
        add_action('init', array(&$this, 'init'));
        add_action('admin_init', array(&$this, 'admin_init'));
	}
	
	/**
	 * Registers TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function init()
	{
		if( ! is_admin() )
		{
			//wp_enqueue_style( 'zilla-shortcodes', get_template_directory_uri().'/style.css' );
			wp_enqueue_script( 'jquery-ui-accordion' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'zilla-shortcodes-lib', get_template_directory_uri().'/shortcode/js/zilla-shortcodes-lib.js', array('jquery', 'jquery-ui-accordion', 'jquery-ui-tabs') );
		}
		
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );
			add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );
		}
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Defins TinyMCE rich editor js plugin
	 *
	 * @return	void
	 */
	function add_rich_plugins( $plugin_array )
	{
		$plugin_array['zillaShortcodes'] = ZILLA_TINYMCE_URI . '/plugin.js';
		return $plugin_array;
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Adds TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function register_rich_buttons( $buttons )
	{
		array_push( $buttons, "|", 'zilla_button' );
		return $buttons;
	}
	
	/**
	 * Enqueue Scripts and Styles
	 *
	 * @return	void
	 */
	function admin_init()
	{
		// css
		wp_enqueue_style( 'zilla-popup', ZILLA_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
		
		// js
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-livequery', ZILLA_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'jquery-appendo', ZILLA_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
		wp_enqueue_script( 'base64', ZILLA_TINYMCE_URI . '/js/base64.js', false, '1.0', false );
		wp_enqueue_script( 'zilla-popup', ZILLA_TINYMCE_URI . '/js/popup.js', false, '1.0', false );
		
		wp_localize_script( 'jquery', 'ZillaShortcodes', array('plugin_folder' => get_template_directory_uri().'/shortcode') );
	}
    
}
$zilla_shortcodes = new ZillaShortcodes();

//Disable read more jump
function remove_more_jump_link($link) { 
$offset = strpos($link, '#more-');
if ($offset) {
$end = strpos($link, '"',$offset);
}
if ($end) {
$link = substr_replace($link, '', $offset, $end-$offset);
}
return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

//Add custom login form
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<br><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' .  "This post is password protected. To view it please enter your password below:"  . '
	<br>Password:<br><input name="post_password" id="' . $label . '" type="password" size="20" class="password-blog" /><br><input type="submit" class="button violet" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
	</form>
	';
	return $o;
}
add_filter( 'the_password_form', 'custom_password_form' );


// Custom pagination
function t_pagination($pages = '', $range = 2)
{  
	if(of_get_option('def-pagination-display') != "infinite"){
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
		 
         echo '<div class="pagination"> <div class="ss-row comments-add-new">
				<div class="ss-full">
					<div class="arrow-up"></div>
					<div class="time-dot"></div> 
						<div class="container-border">
							<div class="gray-container">
							 <nav id="page_nav">
    </nav>';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div></div></div></div></div>\n";
     }
	};
}

include('functions/add_meta_box.php');	

//Hide older posts
add_filter( 'posts_where', 'hop_exclude_posts' );
add_filter( 'getarchives_where', 'hop_exclude_posts' );
function hop_exclude_posts( $where ) {
	if(of_get_option('older-posts') == 'frontend'){
		if( of_get_option('hide-categories') != 'all'){
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$q = $cat_obj->term_id;
			if( of_get_option('hide-categories') == $q ){
				if( !is_admin() ){
						$where .= " AND ( post_date > '".date( 'Y-m-d', strtotime( of_get_option('hide-post-date') ) )."' OR post_type NOT LIKE 'post' ) ";
				} else {
					if (defined('DOING_AJAX') && DOING_AJAX) { 
						$where .= " AND ( post_date > '".date( 'Y-m-d', strtotime( of_get_option('hide-post-date') ) )."' OR post_type NOT LIKE 'post' ) ";
					}
				}
			}
		}else{
			if( !is_admin() ){
					$where .= " AND ( post_date > '".date( 'Y-m-d', strtotime( of_get_option('hide-post-date') ) )."' OR post_type NOT LIKE 'post' ) ";
			} else {
				if (defined('DOING_AJAX') && DOING_AJAX) { 
					$where .= " AND ( post_date > '".date( 'Y-m-d', strtotime( of_get_option('hide-post-date') ) )."' OR post_type NOT LIKE 'post' ) ";
				}
			}
		}
	}
	
	
	if(of_get_option('older-posts') == 'backend'){
		if( of_get_option('hide-categories') != 'all'){
			echo $post->ID;
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$q = $cat_obj->term_id;
			if( of_get_option('hide-categories') == $q ){
						$where .= " AND ( post_date > '".date( 'Y-m-d', strtotime( of_get_option('hide-post-date') ) )."' OR post_type NOT LIKE 'post' ) ";
			}				
		}else{
				$where .= " AND ( post_date > '".date( 'Y-m-d', strtotime( of_get_option('hide-post-date') ) )."' OR post_type NOT LIKE 'post' ) ";		
		}
	}
    return $where;
}

// Add custom name to menu widget
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Menu widgets',
		'description' => 'Appears in drop down widget menu',
	
	));
}
// Add custom widget sidebar for woocommerce
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Woocommerce Shop Widgets',
			'id' => 'homepage-sidebar',
			'description' => 'Appears at top on shop page',
			'after_widget' => '<div style="padding-bottom:10px;"></div>'
		));
	}
}

// Refresh number of products added to woocommerce cart
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_badge');
function woocommerce_header_add_to_badge( $fragments ) {
	global $woocommerce;
	ob_start();?>
	<div class="badgecat <?php if($woocommerce->cart->cart_contents_count != 0){ ?>showcat <?php }else{?>hidecat<?php };?>"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></div><?php
	
	$fragments['div.badgecat'] = ob_get_clean();
	return $fragments;
}

// Remove theme support woocommerce notice from administration
add_theme_support( 'woocommerce' );


// Enables adding widgest with shortcodes to post
add_shortcode( 'widget', 'my_widget_shortcode' );
function my_widget_shortcode( $atts ) {
	// Configure defaults and extract the attributes into variables
	extract( shortcode_atts( 
		array( 
			'type'  => '',
			'title' => '',
			'number' => ''
		), 
		$atts 
	));
	$args = array(
		'before_widget' => '<div class="box widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	);
	ob_start();
	the_widget( $type, $atts, $args ); 
	$output = ob_get_clean();
	
	return $output;
}

if (!function_exists('woocommerce_template_loop_add_to_cart')) {
	function woocommerce_template_loop_add_to_cart() {
		global $product;
		if (!$product->is_in_stock()) return;
		woocommerce_get_template('loop/add-to-cart.php');
	}
}
// Enables posts with future date to be published instead sheduled  
if(of_get_option('future-posts', 'no entry' ) == 'on'){
	remove_action('future_post', '_future_post_hook');
	add_filter( 'wp_insert_post_data', 'futur_posts_is_on' );
	function futur_posts_is_on( $data ) {
		if ( $data['post_status'] == 'future' && $data['post_type'] == 'post' )
			$data['post_status'] = 'publish';
		return $data;
	};
}

?>