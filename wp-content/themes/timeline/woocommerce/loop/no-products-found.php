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
 * Displayed when no products are found matching the current query.
 *
 * Override this template by copying it to yourtheme/woocommerce/loop/no-products-found.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="ss-row page-no-date">
    <div class="time-dot"></div> 
    <div class="ss-full">
        <div class="arrow-up"></div>     
        <div class="container-border">
            <div class="gray-container"> 
                <p class="woocommerce-info"><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>
			</div>
        </div>
    </div>
</div>