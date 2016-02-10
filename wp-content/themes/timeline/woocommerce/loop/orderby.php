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
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
	return;
	
?>
<div class="ss-row comments-add-new zindex-up text-center">
    <div class="ss-full">
        <div class="arrow-up"></div>
        <div class="time-dot"></div> 
        	<div class="container-border">
            	<div class="gray-container">
          			<h3 class="content-title"><?php
					$paged    = max( 1, $wp_query->get( 'paged' ) );
					$per_page = $wp_query->get( 'posts_per_page' );
					$total    = $wp_query->found_posts;
					$first    = ( $per_page * $paged ) - $per_page + 1;
					$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
					if ( 1 == $total ) {
						_e( 'Showing the single result', 'woocommerce' );
					} elseif ( $total <= $per_page ) {
						printf( __( 'Showing all %d results', 'woocommerce' ), $total );
					} else {
						printf( _x( 'Showing %1$d–%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
					}?></h3>
                    <h3 class="content-title p-top"><?php the_widget('WC_Widget_Product_Search', $instance, $args); ?></h3>	
				<form class="selectora p-top" method="get">
					<select name="orderby" class="orderby">
						<?php
							$catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
								'menu_order' => __( 'Default sorting', 'woocommerce' ),
								'popularity' => __( 'Sort by popularity', 'woocommerce' ),
								'rating'     => __( 'Sort by average rating', 'woocommerce' ),
								'date'       => __( 'Sort by newness', 'woocommerce' ),
								'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
								'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
							) );
				
							if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
								unset( $catalog_orderby['rating'] );
				
							foreach ( $catalog_orderby as $id => $name ){
					
								echo '<option value="' . esc_attr( $id ) . '" ' . selected( $orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
								
							}
						?>
					</select>
				   <!-- <span><?php echo $namec; ?></span>-->
					<?php
						// Keep query string vars intact
						foreach ( $_GET as $key => $val ) {
							if ( 'orderby' == $key )
								continue;
							
							if (is_array($val)) {
								foreach($val as $innerVal) {
									echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
								}
							
							} else {
								echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
							}
						}
					?>
				   
				</form>
			</div>
        </div>
	</div>
</div>