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
<?php
// Add the Meta Box
function add_custom_meta_box() {
    add_meta_box(
		'custom_meta_box', // $id
		'Post Settings', // $title 
		'show_custom_meta_box', // $callback
		'post', // $page
		'normal', // $context
		'high'); // $priority
	add_meta_box(
		'custom_meta_box2', // $id
		'Page Settings', // $title 
		'show_custom_meta_box2', // $callback
		'page', // $page
		'normal', // $context
		'high'); // $priority
	 add_meta_box(
		'custom_meta_box3', // $id
		'Product Settings', // $title 
		'show_custom_meta_box3', // $callback
		'product', // $page
		'normal', // $context
		'high'); // $priority
}
add_action('add_meta_boxes', 'add_custom_meta_box');


// Field Array
$prefix = 'custom_';
$custom_meta_fields = array(
	array(
		'label'	=> ' Select content position',
		'desc'	=> '',
		'id'	=> $prefix.'select_row_position',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Left',
				'value'	=> 'left',
				'imgtoselect' => get_template_directory_uri()."/images/options/post-left.png"
			),
			'two' => array (
				'label' => 'Right',
				'value'	=> 'right',
				'imgtoselect' => get_template_directory_uri()."/images/options/post-right.png"
			),
			'three' => array (
				'label' => 'Center',
				'value'	=> 'center',
				'imgtoselect' => get_template_directory_uri()."/images/options/post-center.png"
			)
		)
	),
	array(
		'label'	=> ' Show or hide date',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_date',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide title',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_title',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide category and comments',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_category',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide social icons',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_soc',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
			
		)
	),
	array(
		'label'	=> ' On / Off facebook comments',
		'desc'	=> '',
		'id'	=> $prefix.'select_fb_comments',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'On',
				'value'	=> 'on'
			),
			'two' => array (
				'label' => 'Off',
				'value'	=> 'off'
			)
			
		)
	),
	array(
		'label'	=> 'Select image position',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_position',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Left',
				'value'	=> 'leftimg',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgpos-left.png"
			),
			'two' => array (
				'label' => 'Right',
				'value'	=> 'rightimg',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgpos-right.png"
			),
			'three' => array (
				'label' => 'Indside',
				'value'	=> 'inside',
				'imgtoselect' => get_template_directory_uri()."/images/options/post-right.png"
			)
		)
	),
	array(
		'label'	=> 'Select image style',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_style',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Default',
				'value'	=> 'default',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgstyle-def.png"
				
			),
			'two' => array (
				'label' => 'Square',
				'value'	=> 'square',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgstyle-sqr.png"
			),
			'three' => array (
				'label' => 'Circle',
				'value'	=> 'circle',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgstyle-circ.png"
			)
		)
	),
	
	array(
		'label'	=> 'Select image size',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_size',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Big',
				'value'	=> 'big',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgsiz-big.png"
				
			),
			'two' => array (
				'label' => 'Medium',
				'value'	=> 'medium',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgstyle-def.png"
			),
			'three' => array (
				'label' => 'Small',
				'value'	=> 'small',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgsiz-small.png"
			)
		)
	),
	array(
		'label'	=> 'Add Youtube video id',
		'desc'	=> '* adding Youtube video id will replace featured image with embedet video',
		'id'	=> $prefix.'embed_video_yt',
		'type'	=> 'img_title'
	),
	array(
		'label'	=> 'Add Vimeo video id',
		'desc'	=> '* adding Vimeo video id will replace featured image with embedet video',
		'id'	=> $prefix.'embed_video_vm',
		'type'	=> 'img_title'
	),


	array(
		'label'	=> 'Select image badge',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_badge',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Select badge',
				'value'	=> 'non'
				
			),
			'two' => array (
				'label' => 'Hot',
				'value'	=> 'hot'
			),
			'three' => array (
				'label' => 'New',
				'value'	=> 'new'
			)
		)
	),
	
	array(
		'label'	=> 'Add image title',
		'desc'	=> '* if you add title you will swich to <br>"image content mode"  ( disable full size link ) ',
		'id'	=> $prefix.'img_title',
		'type'	=> 'img_title'
	),

	array(
		'label'	=> 'Add image content',
		'desc'	=> '* if you add content you will swich to "image content mode"  ( disable full size link ) ',
		'id'	=> $prefix.'img_content',
		'type'	=> 'img_content'
	),
	array(
		'label'	=> 'Add button link',
		'desc'	=> '',
		'id'	=> $prefix.'img_link',
		'type'	=> 'img_title'
	),
	array(
		'label'	=> 'Add image button title',
		'desc'	=> '',
		'id'	=> $prefix.'img_buttontitle',
		'type'	=> 'img_buttontitle'
	),
	array(
		'label'	=> 'Repeatable',
		'desc'	=> '',
		'id'	=> $prefix.'repeatable',
		'type'	=> 'repeatable'
	),
	array(
		'label'	=> ' Images slideshow',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_slideshow',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'On',
				'value'	=> 'true'
			),
			'two' => array (
				'label' => 'Off',
				'value'	=> 'false'
			)
		)
	),
	array(
		'label'	=> 'Image',
		'desc'	=> 'Select background image',
		'id'	=> $prefix.'image',
		'type'	=> 'image'
	)
	
);

$custom_meta_fields2 = array(
	array(
		'label'	=> ' Show or hide date',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_date',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			),
			'two' => array (
				'label' => 'Show',
				'value'	=> 'show'
			)
		)
	),
	array(
		'label'	=> ' Show or hide title',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_title',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide category and comments',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_category',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			),
			'two' => array (
				'label' => 'Show',
				'value'	=> 'show'
			)
		)
	),
	array(
		'label'	=> ' Show or hide social icons',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_soc',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			),
			'two' => array (
				'label' => 'Show',
				'value'	=> 'show'
			)
			
		)
	),
	
	array(
		'label'	=> ' On / Off facebook comments',
		'desc'	=> '',
		'id'	=> $prefix.'select_fb_comments',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'On',
				'value'	=> 'on'
			),
			'two' => array (
				'label' => 'Off',
				'value'	=> 'Off'
			)
			
		)
	),
	array(
		'label'	=> 'Add Youtube video id',
		'desc'	=> '* adding Youtube video id will replace featured image with embedet video',
		'id'	=> $prefix.'embed_video_yt',
		'type'	=> 'img_title'
	),
	array(
		'label'	=> 'Add Vimeo video id',
		'desc'	=> '* adding Vimeo video id will replace featured image with embedet video',
		'id'	=> $prefix.'embed_video_vm',
		'type'	=> 'img_title'
	),	
	
	array(
		'label'	=> 'Select image badge',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_badge',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Select badge',
				'value'	=> ''
				
			),
			'two' => array (
				'label' => 'Hot',
				'value'	=> 'hot'
			),
			'three' => array (
				'label' => 'New',
				'value'	=> 'new'
			)
		)
	),
	
	array(
		'label'	=> 'Add image title',
		'desc'	=> '* if you add title you will swich to <br>"image content mode"  ( disable full size link ) ',
		'id'	=> $prefix.'img_title',
		'type'	=> 'img_title'
	),

	array(
		'label'	=> 'Add Image content',
		'desc'	=> '* if you add content you will swich to "image content mode"  ( disable full size link ) ',
		'id'	=> $prefix.'img_content',
		'type'	=> 'img_content'
	),
	array(
		'label'	=> 'Add button link',
		'desc'	=> '',
		'id'	=> $prefix.'img_link',
		'type'	=> 'img_title'
	),
	array(
		'label'	=> 'Add image button title',
		'desc'	=> '',
		'id'	=> $prefix.'img_buttontitle',
		'type'	=> 'img_buttontitle'
	),
	array(
		'label'	=> 'Repeatable',
		'desc'	=> '',
		'id'	=> $prefix.'repeatable',
		'type'	=> 'repeatable'
	),
	array(
		'label'	=> ' Images slideshow',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_slideshow',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'On',
				'value'	=> 'true'
			),
			'two' => array (
				'label' => 'Off',
				'value'	=> 'false'
			)
		)
	),
	array(
		'label'	=> 'Image',
		'desc'	=> 'Select background image',
		'id'	=> $prefix.'image',
		'type'	=> 'image'
	)
	
);

$custom_meta_fields3 = array(
	array(
		'label'	=> ' Select content position',
		'desc'	=> '',
		'id'	=> $prefix.'select_row_position',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Left',
				'value'	=> 'left',
				'imgtoselect' => get_template_directory_uri()."/images/options/post-left.png"
			),
			'two' => array (
				'label' => 'Right',
				'value'	=> 'right',
				'imgtoselect' => get_template_directory_uri()."/images/options/post-right.png"
			),
			'three' => array (
				'label' => 'Center',
				'value'	=> 'center',
				'imgtoselect' => get_template_directory_uri()."/images/options/post-center.png"
			)
		)
	),
	array(
		'label'	=> ' Show or hide date',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_date',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide title',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_title',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide category and comments',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_category',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide social icons',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_soc',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
			
		)
	),
	array(
		'label'	=> ' On / Off facebook comments',
		'desc'	=> '',
		'id'	=> $prefix.'select_fb_comments',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'On',
				'value'	=> 'on'
			),
			'two' => array (
				'label' => 'Off',
				'value'	=> 'off'
			)
			
		)
	),
	array(
		'label'	=> 'Select image position',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_position',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Left',
				'value'	=> 'leftimg',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgpos-left.png"
			),
			'two' => array (
				'label' => 'Right',
				'value'	=> 'rightimg',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgpos-right.png"
			),
			'three' => array (
				'label' => 'Indside',
				'value'	=> 'inside',
				'imgtoselect' => get_template_directory_uri()."/images/options/post-right.png"
			)
		)
	),
	array(
		'label'	=> 'Select image style',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_style',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Default',
				'value'	=> 'default',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgstyle-def.png"
				
			),
			'two' => array (
				'label' => 'Square',
				'value'	=> 'square',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgstyle-sqr.png"
			),
			'three' => array (
				'label' => 'Circle',
				'value'	=> 'circle',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgstyle-circ.png"
			)
		)
	),
	
	array(
		'label'	=> 'Select image size',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_size',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Big',
				'value'	=> 'big',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgsiz-big.png"
				
			),
			'two' => array (
				'label' => 'Medium',
				'value'	=> 'medium',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgstyle-def.png"
			),
			'three' => array (
				'label' => 'Small',
				'value'	=> 'small',
				'imgtoselect' => get_template_directory_uri()."/images/options/imgsiz-small.png"
			)
		)
	),

	array(
		'label'	=> 'Select image badge',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_badge',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'Select badge',
				'value'	=> 'non'
				
			),
			'two' => array (
				'label' => 'Hot',
				'value'	=> 'hot'
			),
			'three' => array (
				'label' => 'New',
				'value'	=> 'new'
			)
		)
	),
	
	array(
		'label'	=> 'Add image title',
		'desc'	=> '* if you add title you will swich to <br>"image content mode"  ( disable full size link ) ',
		'id'	=> $prefix.'img_title',
		'type'	=> 'img_title'
	),

	array(
		'label'	=> 'Add image content text',
		'desc'	=> '* if you add content you will swich to "image content mode"  ( disable full size link ) add shortcode: [add_to_cart id="" sku=""] to display price and add to catr button',
		'id'	=> $prefix.'img_content',
		'type'	=> 'img_content'
	),
	array(
		'label'	=> 'Add button link',
		'desc'	=> '',
		'id'	=> $prefix.'img_link',
		'type'	=> 'img_title'
	),
	array(
		'label'	=> 'Add image button title',
		'desc'	=> '',
		'id'	=> $prefix.'img_buttontitle',
		'type'	=> 'img_buttontitle'
	),
	array(
		'label'	=> ' Images slideshow',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_slideshow',
		'type'	=> 'select_dropdown',
		'options' => array (
			'one' => array (
				'label' => 'On',
				'value'	=> 'true'
			),
			'two' => array (
				'label' => 'Off',
				'value'	=> 'false'
			)
		)
	),

	array(
		'label'	=> 'Image',
		'desc'	=> 'Select background image',
		'id'	=> $prefix.'image',
		'type'	=> 'image'
	)
	
);

// enqueue scripts and styles, but only if is_admin


// add some custom js to the head of the page
add_action('admin_head','add_custom_scripts');
function add_custom_scripts() {
	global $custom_meta_fields, $post;
	wp_register_script('cdropdown', get_template_directory_uri().'/js/jquery.dd.js');
	wp_enqueue_script('cdropdown');
	wp_enqueue_style( 'settingscss', get_template_directory_uri().'/functions/adminanddropdown.css' );
}

// The Callback
function show_custom_meta_box() {
	global $custom_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	echo '<script>
			jQuery( document ).ready( function($){
				$("#custom_meta_box select").msDropDown();
				$(".adimg input:radio").addClass("input_hidden");
				$(".adimg label").click(function() {
					$(this).addClass("selected").siblings().removeClass("selected");
				});
			});
		  </script>';
	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		echo '<tr>
				<td>';
				switch($field['type']) {
					case 'select_row_position':
						if($field['id'] == 'custom_select_row_position'){
							echo '<h2 style="margin-top:0px;">Content Settings</h2>';
						}
						if($field['id'] == 'custom_select_img_position'){
							echo '<h2 style="margin-top:0px;">Image Settings</h2>';
						}
						echo '<span class="">'.$field['label'].'</span>';
						echo '<div class="adimg">';
						foreach ( $field['options'] as $option ) {
							if( $meta == '' &&  $field['id'] == 'custom_select_row_position'){	
								if(of_get_option('content-position') == "left"){ 						
									$meta = 'left';
								}else if(of_get_option('content-position') == "right" ){
									$meta = 'right';
								}else if(of_get_option('content-position') == "center" ){
									$meta = 'center';
								}else{
									$meta = 'center';
								}
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_position'){
								if(of_get_option('img-position') == "left"){ 						
									$meta = 'leftimg';
								}else if(of_get_option('img-position') == "right" ){
									$meta = 'rightimg';
								}else if(of_get_option('img-position') == "center" ){
									$meta = 'inside';
								}else{
									$meta = 'inside';
								}							
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_style'){
								if(of_get_option('img-style') == "default"){ 						
									$meta = 'default';
								}else if(of_get_option('img-style') == "square" ){
									$meta = 'square';
								}else if(of_get_option('img-style') == "circle" ){
									$meta = 'circle';
								}else{
									$meta = 'default';
								}								
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_size'){							
								if(of_get_option('img-size') == "big"){ 						
									$meta = 'big';
								}else if(of_get_option('img-size') == "medium" ){
									$meta = 'medium';
								}else if(of_get_option('img-size') == "small" ){
									$meta = 'small';
								}else{
									$meta = 'big';
								}				
							}else if( $meta == '' &&  $field['id'] == 'custom_select_fb_comments'){							
								if(of_get_option('show-fb-comments') == "on"){ 						
									$meta = 'on';
								}else if(of_get_option('show-fb-comments') == "off" ){
									$meta = 'off';
								}else{
									$meta = 'off';
								}			
							};
							echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ', $meta == $option['value'] ? ' checked="checked"' : '', ' />
									<label for="'.$option['value'].'"><img src="'.$option['imgtoselect'].'" alt="'.$option['value'].'" /><div style="text-align:center; margin-top:-10px;">'.$option['label'].'</div></label>';
						}
						echo '</div>';
					break;
					case 'select_dropdown':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							if( $meta == '' &&  $field['id'] == 'custom_select_show_title'){	
								if(of_get_option('show-titile') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-titile') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'show';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_show_category'){	
								if(of_get_option('show-category') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-category') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'show';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_show_soc'){	
								if(of_get_option('show-soc') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-soc') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'hide';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_show_date'){	
								if(of_get_option('show-date') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-date') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'show';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_fb_comments'){							
								if(of_get_option('show-fb-comments') == "on"){ 						
									$meta = 'on';
								}else if(of_get_option('show-fb-comments') == "off" ){
									$meta = 'off';
								}else{
									$meta = 'off';
								}
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_slideshow'){							
								if(of_get_option('img-slideshow') == "true"){ 						
									$meta = 'true';
								}else if(of_get_option('img-slideshow') == "false" ){
									$meta = 'false';
								}else{
									$meta = 'false';
								};
							};
							echo '<option ', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select> <label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
						
						if($field['id'] == 'custom_select_fb_comments'){
							echo '<div class="page-separator"></div>';
						}
						if($field['id'] == 'custom_select_img_slideshow'){
							echo '<div class="page-separator"></div>';
						}
						
					break;
					
					// text
					case 'img_title':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					case 'img_buttontitle':
						if($meta == ''){
							$meta = 'Read More';
						};
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
			
					// textarea
					case 'img_content':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<label style="margin-left:10px; margin-top:2px; position:absolute; " for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					
					// image
					case 'image':
					
						echo '<h2 style="margin-top:0px;">Other</h2>';
						$image = get_template_directory_uri().'/images/options/background-img.png';	
						echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }				
						echo	'<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
									<img src="'.$image.'" style="width:150px; height:auto;" class="custom_preview_image" alt="" /><br />
										<input class="custom_upload_image_button button" type="button" value="Choose Image" />
										<small><a href="#" class="custom_clear_image_button button" style="padding-top:8px; margin-left:10px;">-</a></small>
										<br clear="all" /><span class="description">'.$field['desc'].'</span>';
					break;
					
					// repeatable
					case 'repeatable':
					
						echo '
							  <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta) {
							$image = get_template_directory_uri().'/images/options/background-img.png';	 
							foreach($meta as $row) { $image = wp_get_attachment_image_src($row, 'medium');	$image = $image[0];
							echo '<li><span class="sort hndle"></span><input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
							<span class="custom_default_image" style="display:none">'.$image.'</span>
							<img src="'.$image.'" style="width:136px; height:auto; " class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
					
							<a class=" repeatable-remove button" style="padding-top:8px; margin-left:10px;" href="#">-</a></li>';
							$i++;
							}
						} else { 
							$image = wp_get_attachment_image_src($row, 'medium');	
							$image = $image[0];
							echo '<li><span class="sort hndle"></span>
							<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
							<img src="'.$image.'" style="width:136px; height:auto;" class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
							<a class=" repeatable-remove button" style="padding-top:8px; margin-left:10px;" href="#">-</a></li>';
						}
						echo '</ul><span class="description">'.$field['desc'].'</span>';
						echo '<a class="repeatable-add button" style="padding-top:8px;" href="#">+</a> <span class="description">Add more images</span>';
					break;
 					//end switch
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}
function show_custom_meta_box2() {
	global $custom_meta_fields2, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	echo '<script>
			jQuery( document ).ready( function($){
				$("#custom_meta_box2 select").msDropDown();
				$(".adimg input:radio").addClass("input_hidden");
				$(".adimg label").click(function() {
					$(this).addClass("selected").siblings().removeClass("selected");
				});
			});
		  </script>';
	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields2 as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		echo '<tr>
				<td>';
				switch($field['type']) {
					case 'select_row_position':
						if($field['id'] == 'custom_select_row_position'){
							echo '<h2 style="margin-top:0px;">Content Settings</h2>';
						}
						
						echo '<span class="">'.$field['label'].'</span>';
						echo '<div class="adimg">';
						foreach ( $field['options'] as $option ) {
							if( $meta == '' &&  $field['id'] == 'custom_select_row_position'){	
								if(of_get_option('content-position') == "left"){ 						
									$meta = 'left';
								}else if(of_get_option('content-position') == "right" ){
									$meta = 'right';
								}else if(of_get_option('content-position') == "center" ){
									$meta = 'center';
								}else{
									$meta = 'center';
								}
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_position'){
								if(of_get_option('img-position') == "left"){ 						
									$meta = 'leftimg';
								}else if(of_get_option('img-position') == "right" ){
									$meta = 'rightimg';
								}else if(of_get_option('img-position') == "center" ){
									$meta = 'inside';
								}else{
									$meta = 'inside';
								}							
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_style'){
								if(of_get_option('img-style') == "default"){ 						
									$meta = 'default';
								}else if(of_get_option('img-style') == "square" ){
									$meta = 'square';
								}else if(of_get_option('img-style') == "circle" ){
									$meta = 'circle';
								}else{
									$meta = 'default';
								}								
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_size'){							
								if(of_get_option('img-size') == "big"){ 						
									$meta = 'big';
								}else if(of_get_option('img-size') == "medium" ){
									$meta = 'medium';
								}else if(of_get_option('img-size') == "small" ){
									$meta = 'small';
								}else{
									$meta = 'big';
								}				
							}else if( $meta == '' &&  $field['id'] == 'custom_select_fb_comments'){							
								if(of_get_option('show-fb-comments') == "on"){ 						
									$meta = 'on';
								}else if(of_get_option('show-fb-comments') == "off" ){
									$meta = 'off';
								}else{
									$meta = 'off';
								}			
							};
							echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ', $meta == $option['value'] ? ' checked="checked"' : '', ' />
									<label for="'.$option['value'].'"><img src="'.$option['imgtoselect'].'" alt="'.$option['value'].'" /><div style="text-align:center; margin-top:-10px;">'.$option['label'].'</div></label>';
						}
						echo '</div>';
					break;
					case 'select_dropdown':
						if($field['id'] == 'custom_select_show_date'){
							echo '<h2 style="margin-top:0px;">Content Settings</h2>';
						}
						
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							if( $meta == '' &&  $field['id'] == 'custom_select_show_title'){	
								if(of_get_option('show-titile') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-titile') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'show';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_show_category'){	
								if(of_get_option('show-category') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-category') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'show';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_show_soc'){	
								if(of_get_option('show-soc') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-soc') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'hide';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_show_date'){	
								if(of_get_option('show-date') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-date') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'show';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_fb_comments'){							
								if(of_get_option('show-fb-comments') == "on"){ 						
									$meta = 'on';
								}else if(of_get_option('show-fb-comments') == "off" ){
									$meta = 'off';
								}else{
									$meta = 'off';
								}			
								
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_slideshow'){							
								if(of_get_option('img-slideshow') == "true"){ 						
									$meta = 'true';
								}else if(of_get_option('img-slideshow') == "false" ){
									$meta = 'false';
								}else{
									$meta = 'false';
								};
							};
							echo '<option ', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select> <label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
						
						if($field['id'] == 'custom_select_fb_comments'){
							echo '<div class="page-separator"></div>';
						}
						if($field['id'] == 'custom_select_img_slideshow'){
							echo '<div class="page-separator"></div>';
						}
						
					break;
					
					// text
					case 'img_title':
					if($field['id'] == 'custom_embed_video_yt'){
							echo '<h2 style="margin-top:0px;">Image Settings</h2>';
						}
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					case 'img_buttontitle':
						if($meta == ''){
							$meta = 'Read More';
						};
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
			
					// textarea
					case 'img_content':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<label style="margin-left:10px; margin-top:2px; position:absolute; " for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					
					// image
					case 'image':
					
						echo '<h2 style="margin-top:0px;">Other</h2>';
						$image = get_template_directory_uri().'/images/options/background-img.png';	
						echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }				
						echo	'<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
									<img src="'.$image.'" style="width:150px; height:auto;" class="custom_preview_image" alt="" /><br />
										<input class="custom_upload_image_button button" type="button" value="Choose Image" />
										<small><a href="#" class="custom_clear_image_button button" style="padding-top:8px; margin-left:10px;">-</a></small>
										<br clear="all" /><span class="description">'.$field['desc'].'</span>';
					break;
					
					// repeatable
					case 'repeatable':
					
						echo '
							  <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta) {
							$image = get_template_directory_uri().'/images/options/background-img.png';	 
							foreach($meta as $row) { $image = wp_get_attachment_image_src($row, 'medium');	$image = $image[0];
							echo '<li><span class="sort hndle"></span><input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
							<span class="custom_default_image" style="display:none">'.$image.'</span>
							<img src="'.$image.'" style="width:136px; height:auto; " class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
					
							<a class=" repeatable-remove button" style="padding-top:8px; margin-left:10px;" href="#">-</a></li>';
							$i++;
							}
						} else { 
							$image = wp_get_attachment_image_src($row, 'medium');	
							$image = $image[0];
							echo '<li><span class="sort hndle"></span>
							<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
							<img src="'.$image.'" style="width:136px; height:auto;" class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
							<a class=" repeatable-remove button" style="padding-top:8px; margin-left:10px;" href="#">-</a></li>';
						}
						echo '</ul><span class="description">'.$field['desc'].'</span>';
						echo '<a class="repeatable-add button" style="padding-top:8px;" href="#">+</a> <span class="description">Add more images</span>';
					break;
 					//end switch
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}


function show_custom_meta_box3() {
	global $custom_meta_fields3, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	echo '<script>
			jQuery( document ).ready( function($){
				$("#custom_meta_box3 select").msDropDown();
				$(".adimg input:radio").addClass("input_hidden");
				$(".adimg label").click(function() {
					$(this).addClass("selected").siblings().removeClass("selected");
				});
			});
		  </script>';
	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields3 as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		echo '<tr>
				<td>';
				switch($field['type']) {
					case 'select_row_position':
						if($field['id'] == 'custom_select_row_position'){
							echo '<h2 style="margin-top:0px;">Content Settings</h2>';
						}
						if($field['id'] == 'custom_select_img_position'){
							echo '<h2 style="margin-top:0px;">Image Settings</h2>';
						}
						echo '<span class="">'.$field['label'].'</span>';
						echo '<div class="adimg">';
						foreach ( $field['options'] as $option ) {
							if( $meta == '' &&  $field['id'] == 'custom_select_row_position'){	
								if(of_get_option('content-position') == "left"){ 						
									$meta = 'left';
								}else if(of_get_option('content-position') == "right" ){
									$meta = 'right';
								}else if(of_get_option('content-position') == "center" ){
									$meta = 'center';
								}else{
									$meta = 'center';
								}
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_position'){
								if(of_get_option('img-position') == "left"){ 						
									$meta = 'leftimg';
								}else if(of_get_option('img-position') == "right" ){
									$meta = 'rightimg';
								}else if(of_get_option('img-position') == "center" ){
									$meta = 'inside';
								}else{
									$meta = 'inside';
								}							
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_style'){
								if(of_get_option('img-style') == "default"){ 						
									$meta = 'default';
								}else if(of_get_option('img-style') == "square" ){
									$meta = 'square';
								}else if(of_get_option('img-style') == "circle" ){
									$meta = 'circle';
								}else{
									$meta = 'default';
								}								
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_size'){							
								if(of_get_option('img-size') == "big"){ 						
									$meta = 'big';
								}else if(of_get_option('img-size') == "medium" ){
									$meta = 'medium';
								}else if(of_get_option('img-size') == "small" ){
									$meta = 'small';
								}else{
									$meta = 'big';
								}				
							}else if( $meta == '' &&  $field['id'] == 'custom_select_fb_comments'){							
								if(of_get_option('show-fb-comments') == "on"){ 						
									$meta = 'on';
								}else if(of_get_option('show-fb-comments') == "off" ){
									$meta = 'off';
								}else{
									$meta = 'off';
								}			
							};
							echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ', $meta == $option['value'] ? ' checked="checked"' : '', ' />
									<label for="'.$option['value'].'"><img src="'.$option['imgtoselect'].'" alt="'.$option['value'].'" /><div style="text-align:center; margin-top:-10px;">'.$option['label'].'</div></label>';
						}
						echo '</div>';
					break;
					case 'select_dropdown':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							if( $meta == '' &&  $field['id'] == 'custom_select_show_title'){	
								if(of_get_option('show-titile') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-titile') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'show';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_show_category'){	
								if(of_get_option('show-category') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-category') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'show';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_show_soc'){	
								if(of_get_option('show-soc') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-soc') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'hide';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_show_date'){	
								if(of_get_option('show-date') == "show"){ 						
									$meta = 'show';
								}else if(of_get_option('show-date') == "hide" ){
									$meta = 'hide';
								}else{
									$meta = 'show';
								}
						   }else if( $meta == '' &&  $field['id'] == 'custom_select_fb_comments'){							
								if(of_get_option('show-fb-comments') == "on"){ 						
									$meta = 'on';
								}else if(of_get_option('show-fb-comments') == "off" ){
									$meta = 'off';
								}else{
									$meta = 'off';
								}			
								
							}else if( $meta == '' &&  $field['id'] == 'custom_select_img_slideshow'){							
								if(of_get_option('img-slideshow') == "true"){ 						
									$meta = 'true';
								}else if(of_get_option('img-slideshow') == "false" ){
									$meta = 'false';
								}else{
									$meta = 'false';
								};
							};
							echo '<option ', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select> <label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
						
						if($field['id'] == 'custom_select_fb_comments'){
							echo '<div class="page-separator"></div>';
						}
						if($field['id'] == 'custom_select_img_slideshow'){
							echo '<div class="page-separator"></div>';
						}
						
					break;
					
					// text
					case 'img_title':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					case 'img_buttontitle':
						if($meta == ''){
							$meta = 'Read More';
						};
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';

						
					break;
			
					// textarea
					case 'img_content':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<label style="margin-left:10px; margin-top:2px; position:absolute; " for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					
					// image
					case 'image':
					
						echo '<h2 style="margin-top:0px;">Other</h2>';
						$image = get_template_directory_uri().'/images/options/background-img.png';	
						echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }				
						echo	'<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
									<img src="'.$image.'" style="width:150px; height:auto;" class="custom_preview_image" alt="" /><br />
										<input class="custom_upload_image_button button" type="button" value="Choose Image" />
										<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
										<br clear="all" /><span class="description">'.$field['desc'].'</span>';
					break;
					
					// repeatable
					case 'repeatable':
					
						echo '
							  <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta) {
							$image = get_template_directory_uri().'/images/options/background-img.png';	 
							foreach($meta as $row) { $image = wp_get_attachment_image_src($row, 'medium');	$image = $image[0];
							echo '<li><span class="sort hndle"></span><input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
							<span class="custom_default_image" style="display:none">'.$image.'</span>
							<img src="'.$image.'" style="width:136px; height:auto; " class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
					
							<a class=" repeatable-remove button" style="padding-top:8px; margin-left:10px;" href="#">-</a></li>';
							$i++;
							}
						} else { 
							$image = wp_get_attachment_image_src($row, 'medium');	
							$image = $image[0];
							echo '<li><span class="sort hndle"></span>
							<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
							<img src="'.$image.'" style="width:136px; height:auto;" class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
							<a class=" repeatable-remove button" style="padding-top:8px; margin-left:10px;" href="#">-</a></li>';
						}
						echo '</ul><span class="description">'.$field['desc'].'</span>';
						echo '<a class="repeatable-add button" style="padding-top:8px;" href="#">+</a> <span class="description">Add more images</span><div class="page-separator"></div>';
					break;
 					//end switch
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}


function remove_taxonomy_boxes() {
	//remove_meta_box('categorydiv', 'post', 'side');
}
add_action( 'admin_menu' , 'remove_taxonomy_boxes' );

// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields;
	global $custom_meta_fields2;
	global $custom_meta_fields3;
	// verify nonce
	
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}
	
	// loop through fields and save the data
	foreach ($custom_meta_fields as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // enf foreach
	
	foreach ($custom_meta_fields2 as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // enf foreach
	
	foreach ($custom_meta_fields3 as $field) {

		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // enf foreach
	
	// save taxonomies
	$post = get_post($post_id);

}
add_action('save_post', 'save_custom_meta');

?>