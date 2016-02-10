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
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;
 $attachment_countb   = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );

?>
<div class="images">
	<div class="product-img <?php if ( $attachment_countb != 1 ) { ?>no-prodict-border<?php }?>">
        <div class="hover-effect h-style"><?php
                if ( has_post_thumbnail() ) {
                    $attachment_ids = $product->get_gallery_attachment_ids();
                    $image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
                    $image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
                    $image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
                    $attachment_count   = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );
                    if ( $attachment_count != 1 ) {
                        $gallery = '[product-gallery]';
                    } else {
                        $gallery = '';
                    }
                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" title="%s"  rel="prettyPhotoImages' . $gallery . '">%s<div class="mask"><span class="img-rollover"></span></div>
                                                            </a>', $image_link, $image_title, $image ), $post->ID );
        
                } else {
                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );
                }?>
        </div>
	</div>
<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>