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
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product, $post_showdate , $img_badge;
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="ss-row-f  <?php if($post_showdate == "hide"){?> page-no-date <?php } ?>">
    	<?php if($post_showdate != "hide"){?>
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
        <?php }; ?>
		<div class="time-dot"></div>
		<div class="ss-full">
         <div class="arrow-up"></div>
                <div class="arrow-side"></div>
                <div class="container-border">
                    <div class="gray-container "><?php 	
					if ($product->is_on_sale() && $img_badge != 'new' && $img_badge != 'hot'){?> 
                   		<div class="badge badge-sale badge-woo"></div><?php 
					}
					if($img_badge =='new'){?>
                        <div class="badge badge-1 badge-woo"></div><?php
                    }
                    if($img_badge =='hot'){?>
                        <div class="badge-hot badge-woo-hot"></div><?php
                    }?>
                    	
              
	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>


</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
