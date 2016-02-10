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
function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {
	$slider_fx = array(
		'random' => __('Random', 'options_check'),
		'simpleFade' => __('Simple Fade', 'options_check'),
		'curtainTopLeft' => __('Curtain Top Left', 'options_check'),
		'curtainTopRight' => __('Curtain Top Right', 'options_check'),
		'curtainBottomLeft' => __('Curtain Bottom Left', 'options_check'),
		'curtainBottomRight' => __('Curtain Bottom Right', 'options_check'),
		'curtainSliceLeft' => __('Curtain Slice Left', 'options_check'),
		'curtainSliceRight' => __('Curtain Slice Right', 'options_check'),
		'blindCurtainTopLeft' => __('Blind Curtain Top Left', 'options_check'),
		'blindCurtainTopRight' => __('Blind Curtain Top Right', 'options_check'),
		'blindCurtainBottomLeft' => __('Blind Curtain Bottom Left', 'options_check'),
		'blindCurtainBottomRight' => __('Bblind Curtain Bottom Right', 'options_check'),
		'blindCurtainSliceBottom' => __('Blind Curtain Slice Bottom', 'options_check'),
		'blindCurtainSliceTop' => __('Blind Curtain Slice Top', 'options_check'),
		'stampede' => __('Stampede', 'options_check'),
		'mosaic' => __('Mosaic', 'options_check'),
		'mosaicReverse' => __('Mosaic Reverse', 'options_check'),
		'mosaicRandom' => __('Mosaic Random', 'options_check'),
		'mosaicSpiral' => __('Mosaic Spiral', 'options_check'),
		'mosaicSpiralReverse' => __('Mosaic Spiral Reverse', 'options_check'),
		'topLeftBottomRight' => __('Top Left Bottom Right', 'options_check'),
		'bottomRightTopLeft' => __('Bottom Right Top Left', 'options_check'),
		'bottomLeftTopRight' => __('Bottom Left Top Right', 'options_check')
	);
	
	$slider_play = array(
		'true' => __('Yes', 'options_check'),
		'false' => __('No', 'options_check')
	);
	
	$background_valign = array(
		'top' => __('Top', 'options_check'),
		'center' => __('Center', 'options_check'),
		'bottom' => __('Bottom', 'options_check')
	);
	$background_halign = array(
		'left' => __('Left', 'options_check'),
		'center' => __('Center', 'options_check'),
		'right' => __('Right', 'options_check')
	);
	
	$scroll_effect = array(
		'noeffect' => __('No effect', 'options_check'),
		'fade' => __('Fade', 'options_check'),
		'fadeside' => __('Fade from side', 'options_check'),
		'perspective1' => __('Perspective 1', 'options_check'),
		'perspective2' => __('Perspective 2', 'options_check')
	);
	
	$date_bubble = array(
		'hide' => __('Hide', 'options_check'),
		'date' => __('Date', 'options_check'),
		'price' => __('Price', 'options_check'),
		'rating' => __('Rating', 'options_check')
	);
	$pagination_display = array(
		'infinite' => __('Infinite Scroll', 'options_check'),
		'pagination' => __('Pagination', 'options_check')
	);
	
	

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	$options_categories['all'] = 'All';
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;

	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('General', 'options_check'),
		'type' => 'heading');
	
	
	$options[] = array(
		'name' => "Select color scheme",
		'desc' => "Change theme color scheme.",
		'id' => "color-scheme",
		'std' => "white",
		'type' => "images",
		'options' => array(
			'white' => $imagepath . 'white-theme.png',
			'blackbody' => $imagepath . 'dark-theme.png'
			)
	);
	
		
	$options[] = array(
		'name' => __('Order posts by', 'options_check'),
		'desc' => __('Show or hide category container ', 'options_check'),
		'id' => 'order-posts',
		'std' => 'lf',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'lf' => __('Last added is first', 'options_check'),
			'll' => __('Last added is last', 'options_check')
			)
		);
	$options[] = array(
		'name' => __('Posts in future', 'options_check'),
		'desc' => __('Enable this option if you want to use timeline template for events or something else that requaers posts with future date to be displayed', 'options_check'),
		'id' => 'future-posts',
		'std' => 'off',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'on' => __('On', 'options_check'),
			'off' => __('Off', 'options_check')
			)
		);
		
	$options[] = array(
		'name' => __('Hide older posts', 'options_check'),
		'desc' => __('Enable this option will automaticaly hide posts after post date has past', 'options_check'),
		'id' => 'older-posts',
		'std' => 'off',
		'type' => 'select',
		'class' => 'tiny', //mini, tiny, small
		'options' => array(
			'off' => __('Disabled', 'options_check'),
			'frontend' => __('Hide from front-end', 'options_check'),
			'backend' => __('Hide from front-end and back-end', 'options_check')
			)
		);
		
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select category for which hide older posts is valid', 'options_check'),
		'id' => 'hide-categories',
		'type' => 'select',
		'class' => 'tiny', 
		'options' => $options_categories
		);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add +/- days from now to hide posts (example: "+1 day", "-2 day" or "now")', 'options_check'),
		'id' => 'hide-post-date',
		'std' => 'now',
		'class' => 'mini', 
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Select pagination', 'options_check'),
		'desc' => __('Select how to display pages', 'options_check'),
		'id' => 'def-pagination-display',
		'std' => 'infinite',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $pagination_display);
	$options[] = array(
		'name' => __('Select scroll effect ', 'options_check'),
		'desc' => __('Change scroll effect ', 'options_check'),
		'id' => 'scroll-effect',
		'std' => 'perspective1',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $scroll_effect);
	
	$options[] = array(
		'name' => __('Scroll effect on mobile', 'options_check'),
		'desc' => __('on/off ( disable scroll is recommended )', 'options_check'),
		'id' => 'scroll-effect-mobile',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Select logo', 'options_check'),
		'desc' => __('Select Logo (200x100)', 'options_check'),
		'id' => 'logo-img',
		'class' => 'small', 
		'type' => 'upload');
		
		
	$options[] = array(
		'name' => "Select default content position",
		'desc' => "*Select default image position: left, right or center. You can change this option for every single post",
		'id' => "content-position",
		'std' => "center",
		'type' => "images",
		'options' => array(
			'left' => $imagepath . 'options/post-left.png',
			'right' => $imagepath . 'options/post-right.png',
			'center' => $imagepath . 'options/post-center.png',
			
			)
	);
	$options[] = array(
		'name' => "Select default image position",
		'desc' => "*Select default image position: left, right or inside. You can change this option for every single post",
		'id' => "img-position",
		'std' => "inside",
		'type' => "images",
		'options' => array(
			'left' => $imagepath . 'options/imgpos-left.png',
			'right' => $imagepath . 'options/imgpos-right.png',
			'inside' => $imagepath . 'options/post-right.png',
			
			)
	);
	$options[] = array(
		'name' => "Select default image style",
		'desc' => "*Select default image style: default, square or circle. You can change this option for every single post",
		'id' => "img-style",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'options/imgstyle-def.png',
			'square' => $imagepath . 'options/imgstyle-sqr.png',
			'circle' => $imagepath . 'options/imgstyle-circ.png',
			)
	);
	
	$options[] = array(
		'name' => "Select default image size",
		'desc' => "*Select default image size: big, medium or small. You can change this option for every single post",
		'id' => "img-size",
		'std' => "big",
		'type' => "images",
		'options' => array(
			'big' => $imagepath . 'options/imgsiz-big.png',
			'medium' => $imagepath . 'options/imgstyle-sqr.png',
			'small' => $imagepath . 'options/imgsiz-small.png',
			)
	);
	$options[] = array(
		'name' => __('Select other default settings ', 'options_check'),
		'desc' => __('Show or hide date buble', 'options_check'),
		'id' => 'show-date',
		'std' => 'show',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'show' => __('Show', 'options_check'),
			'hide' => __('Hide', 'options_check')
			)
		);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Show or hide title', 'options_check'),
		'id' => 'show-titile',
		'std' => 'show',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'show' => __('Show', 'options_check'),
			'hide' => __('Hide', 'options_check')
			)
		);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Show or hide category container ', 'options_check'),
		'id' => 'show-category',
		'std' => 'show',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'show' => __('Show', 'options_check'),
			'hide' => __('Hide', 'options_check')
			)
		);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Show or hide social icon container ', 'options_check'),
		'id' => 'show-soc',
		'std' => 'hide',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'show' => __('Show', 'options_check'),
			'hide' => __('Hide', 'options_check')
			)
		);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Images slideshow', 'options_check'),
		'id' => 'img-slideshow',
		'std' => 'false',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'true' => __('On', 'options_check'),
			'false' => __('Off', 'options_check')
			)
		);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('On / off facebook comments', 'options_check'),
		'id' => 'show-fb-comments',
		'std' => 'off',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'on' => __('On', 'options_check'),
			'off' => __('Off', 'options_check')
			)
		);
	
	$options[] = array(
		'name' => __('Rollover images effect', 'options_check'),
		'desc' => __('Image rotate', 'options_check'),
		'id' => 'rollover-rotate',
		'std' => '10',
		'class' => 'mini', 
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Image scale', 'options_check'),
		'id' => 'rollover-scale',
		'std' => '2',
		'class' => 'mini', 
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Duration (in seconds)', 'options_check'),
		'id' => 'rollover-duration',
		'std' => '1',
		'class' => 'mini', 
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Rollout images effect', 'options_check'),
		'desc' => __('Image rotate', 'options_check'),
		'id' => 'rollout-rotate',
		'std' => '0',
		'class' => 'mini', 
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Image scale', 'options_check'),
		'id' => 'rollout-scale',
		'std' => '1',
		'class' => 'mini', 
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Duration (in seconds)', 'options_check'),
		'id' => 'rollout-duration',
		'std' => '1',
		'class' => 'mini', 
		'type' => 'text');	
	$options[] = array(
		'name' => __('Social Icons', 'options_check'),
		'desc' => __('Add Facebook link.', 'options_check'),
		'id' => 'fb-link',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add Facebook tooltip.', 'options_check'),
		'id' => 'fb-link-tooltip',
		'std' => 'Facebook',
		'class' => 'mini', 
		'type' => 'text');
	
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('<br>Add Twitter link.', 'options_check'),
		'id' => 'tw-link',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add Twitter tooltip.', 'options_check'),
		'id' => 'tw-link-tooltip',
		'std' => 'Twitter',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('<br>Add Linkedin link.', 'options_check'),
		'id' => 'li-link',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add Linkedin tooltip.', 'options_check'),
		'id' => 'li-link-tooltip',
		'std' => 'Linkedin',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('<br>Add Youtube link.', 'options_check'),
		'id' => 'yt-link',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add Youtube tooltip.', 'options_check'),
		'id' => 'yt-link-tooltip',
		'std' => 'Youtube',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('<br>Add Vimeo link.', 'options_check'),
		'id' => 'vm-link',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add Vimeo tooltip.', 'options_check'),
		'id' => 'vm-link-tooltip',
		'std' => 'Vimeo',
		'class' => 'mini',
		
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('<br>Add Flickr link.', 'options_check'),
		'id' => 'fl-link',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add Flickr tooltip.', 'options_check'),
		'id' => 'fl-link-tooltip',
		'std' => 'Flickr',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('<br>Add Devianart link.', 'options_check'),
		'id' => 'da-link',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add Devianart tooltip.', 'options_check'),
		'id' => 'da-link-tooltip',
		'std' => 'Devianart',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('<br>Add Stumbleupon link.', 'options_check'),
		'id' => 'su-link',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add Stumbleupon tooltip.', 'options_check'),
		'id' => 'su-link-tooltip',
		'std' => 'Stumbleupon',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('<br>Add Digg link.', 'options_check'),
		'id' => 'di-link',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add Digg tooltip.', 'options_check'),
		'id' => 'di-link-tooltip',
		'std' => 'Digg',
		'class' => 'mini',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Footer', 'options_check'),
		'desc' => __('Activate footer.', 'options_check'),
		'id' => 'example_showhidden',
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array(

		'desc' => __('Add footer content', 'options_check'),
		'id' => 'example_text_hidden',
		'std' => '<p><strong>Copyright 2012 <?php bloginfo("name"); ?> | All Rights Reserved. </a> </strong> Designed by <a href="http://yoursite.com">Your Name</a></p>',
		'class' => 'hidden',
		'type' => 'textarea');
	

	//Header Slider
    //==================================================
	$options[] = array(
		'name' => __('Image slider', 'options_check'),
		'type' => 'heading');
	$options[] = array(
		'name' => __('Header Slider Settings', 'options_check'),
		'desc' => __('Activate Header Slider', 'options_check'),
		'id' => 'active-header',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Home slider height', 'options_check'),
		'desc' => __('Add home page slider height in pixels.', 'options_check'),
		'id' => 'header-height-home',
		'std' => '300',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('Inner page slider height', 'options_check'),
		'desc' => __('Add inner page slider height in pixels.', 'options_check'),
		'id' => 'header-height',
		'std' => '70',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Slider effect', 'options_check'),
		'desc' => __('Select slider effect', 'options_check'),
		'id' => 'slider_fx',
		'std' => 'random',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $slider_fx);
	$options[] = array(
		'name' => __('Slideshow', 'options_check'),
		'desc' => __('Auto play slideshow', 'options_check'),
		'id' => 'slider_play',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $slider_play);
	
	
	$options[] = array(
		'name' => __('Select images', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'header-img-1',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add title', 'options_check'),
		'id' => 'header-img-1-title',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add subtitle', 'options_check'),
		'id' => 'header-img-1-subtitle',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'header-img-2',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add title', 'options_check'),
		'id' => 'header-img-2-title',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add subtitle', 'options_check'),
		'id' => 'header-img-2-subtitle',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'header-img-3',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add title', 'options_check'),
		'id' => 'header-img-3-title',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add subtitle', 'options_check'),
		'id' => 'header-img-3-subtitle',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'header-img-4',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add title', 'options_check'),
		'id' => 'header-img-4-title',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add subtitle', 'options_check'),
		'id' => 'header-img-4-subtitle',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'header-img-5',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add title', 'options_check'),
		'id' => 'header-img-5-title',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Add subtitle', 'options_check'),
		'id' => 'header-img-5-subtitle',
		'std' => '',
		'type' => 'text');	
	
	//Background slideshow
    //==================================================
	$options[] = array(
		'name' => __('Background slideshow', 'options_check'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Background Slideshow Settings', 'options_check'),
		'desc' => __('Activate Background Slideshow', 'options_check'),
		'id' => 'active-background',
		'std' => '0',
		'type' => 'checkbox');
	$options[] = array(
		'name' => __('Slideshow delay', 'options_check'),
		'desc' => __('Add slideshow delay in miliseconds', 'options_check'),
		'id' => 'background-slideshow',
		'std' => '7000',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => "Select background overlays",
		'desc' => "Change theme color scheme.",
		'id' => "background-overlays",
		'std' => "01",
		'type' => "images",
		'options' => array(
			'01' => $imagepath . 'adminico/p-01.jpg',
			'02' => $imagepath . 'adminico/p-02.jpg',
			'03' => $imagepath . 'adminico/p-03.jpg',
			'04' => $imagepath . 'adminico/p-04.jpg',
			'05' => $imagepath . 'adminico/p-05.jpg',
			'06' => $imagepath . 'adminico/p-06.jpg',
			'07' => $imagepath . 'adminico/p-07.jpg',
			'08' => $imagepath . 'adminico/p-08.jpg',
			'09' => $imagepath . 'adminico/p-09.jpg',
			'10' => $imagepath . 'adminico/p-10.jpg',
			'11' => $imagepath . 'adminico/p-11.jpg',
			'12' => $imagepath . 'adminico/p-12.jpg',
			'13' => $imagepath . 'adminico/p-13.jpg',
			'14' => $imagepath . 'adminico/p-14.jpg',
			'15' => $imagepath . 'adminico/p-15.jpg',
			'16' => $imagepath . 'adminico/p-16.png'
			)
	);
	$options[] = array(
		'name' => __('Select images', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'background-img-1',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Fade in miliseconds', 'options_check'),
		'id' => 'background-fade-1',
		'std' => '4000',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Vertical alignment', 'options_check'),
		'id' => 'background-valign-1',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_valign);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Horizontal alignment', 'options_check'),
		'id' => 'background-halign-1',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_halign);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'background-img-2',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Fade in miliseconds', 'options_check'),
		'id' => 'background-fade-2',
		'std' => '4000',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Vartical alignment', 'options_check'),
		'id' => 'background-valign-2',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_valign);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Horizontal alignment', 'options_check'),
		'id' => 'background-halign-2',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_halign);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'background-img-3',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Fade in miliseconds', 'options_check'),
		'id' => 'background-fade-3',
		'std' => '4000',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Vartical alignment', 'options_check'),
		'id' => 'background-valign-3',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_valign);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Horizontal alignment', 'options_check'),
		'id' => 'background-halign-3',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_halign);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'background-img-4',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Fade in miliseconds', 'options_check'),
		'id' => 'background-fade-4',
		'std' => '4000',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Vartical alignment', 'options_check'),
		'id' => 'background-valign-4',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_valign);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Horizontal alignment', 'options_check'),
		'id' => 'background-halign-4',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_halign);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'background-img-5',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Fade in miliseconds', 'options_check'),
		'id' => 'background-fade-5',
		'std' => '4000',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Vartical alignment', 'options_check'),
		'id' => 'background-valign-5',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_valign);
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Horizontal alignment', 'options_check'),
		'id' => 'background-halign-5',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $background_halign);
	
	//Background Video
    //==================================================
	$options[] = array(
		'name' => __('Background video', 'options_check'),
		'type' => 'heading');
	$options[] = array(
		'name' => __('Background Video Settings', 'options_check'),
		'desc' => __('Activate Background Video', 'options_check'),
		'id' => 'active-backgroud-video',
		'std' => '0',
		'type' => 'checkbox');
	$options[] = array(
		'name' => __('Select image ', 'options_check'),
		'desc' => __('Select image', 'options_check'),
		'id' => 'background-video-image',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Select video (videos must be with same name)', 'options_check'),
		'desc' => __('Select mp4 video', 'options_check'),
		'id' => 'background-video-mp4',
		'type' => 'upload');
	$options[] = array(
		'name' => __('', 'options_check'),
		'desc' => __('Select ogv video', 'options_check'),
		'id' => 'background-video-ogv',
		'type' => 'upload');
	
	//Woocommerce settings
    //==================================================
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$options[] = array(
			'name' => __('Woocommerce Settings', 'options_check'),
			'type' => 'heading');
	
	$options[] = array(
		'name' => __('Select Pagination', 'options_check'),
		'desc' => __('Select how to display pages', 'options_check'),
		'id' => 'pagination-display',
		'std' => 'infinite',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $pagination_display);
	$options[] = array(
		'name' => __('Select Date Bubble To Display', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'date-bubble',
		'std' => 'date',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $date_bubble);
	}
	return $options;
	
}