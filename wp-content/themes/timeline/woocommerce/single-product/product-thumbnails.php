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

/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;?>
<script>
jQuery( document ).ready( function($){
	jQuery('.product-thumb ').flexslider({
		animation: "slide",
		controlNav: false,
    	itemWidth: 116,
		mousewheel: false, 
		animationLoop: true
	});		
});
</script>
<?php
$attachment_ids = $product->get_gallery_attachment_ids();
if ( $attachment_ids ) {?>
	<div class="product-thumb flexslider">
    	<ul class="slides"><?php
			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	
			foreach ( $attachment_ids as $attachment_id ) {
	
				$classes = array( 'zoom' );
	
				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';
	
				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';
	
				$image_link = wp_get_attachment_url( $attachment_id );
	
				if ( ! $image_link )
					continue;
	
				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
				$image_class = esc_attr( implode( ' ', $classes ) );
				$image_title = esc_attr( get_the_title( $attachment_id ) );
			?><li><div class="hover-effect h-style"  ><?php
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" title="%s"  rel="prettyPhotoImages[product-gallery]">%s<div class="mask"><span class="img-rollover"></span></div></a>', $image_link, $image_title, $image ), $attachment_id, $post->ID );
				?></div>
				</li><?php
	
				$loop++;
			}?>
		</ul>
	</div><?php
}