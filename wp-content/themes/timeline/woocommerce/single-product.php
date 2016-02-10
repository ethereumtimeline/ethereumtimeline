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
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>
   	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		//do_action('woocommerce_before_main_content');
	?>
	<?php while ( have_posts() ) : the_post(); 
		$id = get_the_ID();
		$post_meta_data = get_post_custom($post->ID);
		include(get_template_directory( __FILE__ ).'/functions/post-settings.php');
		if($post_bgimage != ''){
			$srcsliderfa = wp_get_attachment_image_src( $post_bgimage, 'full', true );
		?>
    	<script>
			jQuery.vegas('stop');
			jQuery.vegas({
					src:'<?php echo  $srcsliderfa[0]; ?>', 
					fade:2000, 
					valign:'<?php echo of_get_option('background-valign-1'); ?>', 
					align:'<?php echo of_get_option('background-halign-1'); ?>' 
			
			})('overlay', {
			  src:'<?php echo get_template_directory_uri(); ?>/images/overlays/<?php echo of_get_option('background-overlays', 'no entry' ); ?>.png'
			});
		</script><?php 
		};
   
	$woocommerce->show_messages();?> 
	<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
    <?php  if ( $post_showfbcomments == 'on' ){?>  
    <div class="ss-row page-no-date">
		<div class="time-dot"></div> 
		<div class="ss-full">
    		<div class="arrow-up"></div>
        	<div class="container-border">
            	<div class="gray-container">
                    <div id="fb-root"></div>
                    <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="2" data-width="470" <?php if(of_get_option('color-scheme', 'no entry' ) == 'blackbody'){ ?> data-colorscheme="dark" <?php }; ?>></div>
                </div> 
            </div> 
        </div> 
	</div> 
    <?php }; ?> 

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>
 
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>

<?php get_footer('shop'); ?>