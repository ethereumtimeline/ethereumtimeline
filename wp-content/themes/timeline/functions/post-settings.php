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
global $img_badge, $row_position, $img_syle, $img_position, $img_size, $img_title, $img_content, $img_link, $img_buttontitle, $img_badge, $post_showsoc, $post_showtitle, $post_showcategory , $post_showdate, $post_showfbcomments, $post_bgimage, $post_img_slideshow, $post_embed_video_yt, $post_embed_video_vm  ;
if(isset($post_meta_data['custom_repeatable'][0]) ){
			$custom_repeatable = unserialize($post_meta_data['custom_repeatable'][0]); 
		}	
		if(isset( $post_meta_data['custom_select_row_position'][0])){
			$row_position = $post_meta_data['custom_select_row_position'][0];
		}else{ 
			$row_position = "center";
			$img_position = "inside";
			$post_showtitle = "show";
			$post_showcategory = "hide";
			$post_showsoc = "hide";
			
		}
		if(isset($post_meta_data['custom_select_img_style'][0]))
		 	$img_syle = $post_meta_data['custom_select_img_style'][0];
		else $img_syle ='';
		if(isset($post_meta_data['custom_select_img_position'][0])){
			if($post_meta_data['custom_select_img_position'][0] == "leftimg"){
				$img_position = "left";
			}else if($post_meta_data['custom_select_img_position'][0] == "rightimg"){
				$img_position = "right";
			}else{
				$img_position = $post_meta_data['custom_select_img_position'][0];
			}
		}else{ 
			$img_position ='';
		};
		if(isset($post_meta_data['custom_select_img_size'][0]))
			$img_size = $post_meta_data['custom_select_img_size'][0];
		else $img_size ='';
		if(isset($post_meta_data['custom_img_title'][0]))
			$img_title = $post_meta_data['custom_img_title'][0];
		else $img_title ='';
		if(isset($post_meta_data['custom_img_content'][0]))
			$img_content = $post_meta_data['custom_img_content'][0];
		else $img_content ='';
		if(isset($post_meta_data['custom_img_link'][0]))
			$img_link = $post_meta_data['custom_img_link'][0];
		else $img_link='';
		if(isset($post_meta_data['custom_img_buttontitle'][0]))
			$img_buttontitle = $post_meta_data['custom_img_buttontitle'][0];
		else $img_buttontitle ='';
		if(isset($post_meta_data['custom_select_img_badge'][0]))
			$img_badge = $post_meta_data['custom_select_img_badge'][0];
		else $img_badge='';
        if(isset($post_meta_data['custom_select_show_soc'][0]))
			$post_showsoc = $post_meta_data['custom_select_show_soc'][0];
		else $post_showsoc ='';
		if(isset($post_meta_data['custom_select_show_title'][0]))
			$post_showtitle = $post_meta_data['custom_select_show_title'][0];
		else $post_showtitle = '';
		if(isset($post_meta_data['custom_select_show_category'][0]))
			$post_showcategory = $post_meta_data['custom_select_show_category'][0];
		else $post_showcategory = "hide";
		if(isset($post_meta_data['custom_select_show_date'][0]))
			$post_showdate = $post_meta_data['custom_select_show_date'][0];
		else $post_showdate = '';
		if(isset($post_meta_data['custom_select_fb_comments'][0]))
			$post_showfbcomments = $post_meta_data['custom_select_fb_comments'][0];
		else $post_showfbcomments = '';
		if(isset($post_meta_data['custom_image'][0]))
			$post_bgimage = $post_meta_data['custom_image'][0];
		else $post_bgimage = '';
		if(isset($post_meta_data['custom_select_img_slideshow'][0]))
			$post_img_slideshow = $post_meta_data['custom_select_img_slideshow'][0];
		else $post_img_slideshow = 'false';
		if(isset($post_meta_data['custom_embed_video_yt'][0]))
			$post_embed_video_yt = $post_meta_data['custom_embed_video_yt'][0];
		else $post_embed_video_yt = '';
		if(isset($post_meta_data['custom_embed_video_vm'][0]))
			$post_embed_video_vm = $post_meta_data['custom_embed_video_vm'][0];
		else $post_embed_video_vm = '';
		?>