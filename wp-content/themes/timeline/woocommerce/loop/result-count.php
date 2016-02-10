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
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( ! woocommerce_products_will_display() )
	return;

if ( is_active_sidebar('homepage-sidebar') ) {?>
<div class="ss-row-f page-no-date comments-add-new">
	<div class="ss-full">
    	<div class="arrow-up"></div>
        <div class="time-dot"></div> 
        <div class="container-border">
            <div class="gray-container">
                <p class="woocommerce-result-count">                  
                    <div class="woo-widgets">
                    	<?php dynamic_sidebar ('homepage-sidebar'); ?>
                    </div>
            	</p>
        	</div>
        </div>
    </div>
</div>
<?php 
} 