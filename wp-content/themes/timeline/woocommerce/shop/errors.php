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
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $errors ) return;
if(is_product()){?>
	<div class="ss-row page-no-date zindex-up">
        <div class="time-dot"></div> 
        <div class="ss-full">
            <div class="arrow-up"></div>     
            <div class="container-border">
            	<div class="gray-container"> 
                    <ul class="woocommerce-error">
                        <?php foreach ( $errors as $error ) : ?>
                            <li><?php echo wp_kses_post( $error ); ?></li>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div>
        </div>
    </div><?php
}else{ ?>
<ul class="woocommerce-error">
	<?php foreach ( $errors as $error ) : ?>
		<li><?php echo wp_kses_post( $error ); ?></li>
	<?php endforeach; ?>
   
</ul> <?php
};?>
