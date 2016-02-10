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
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : 
if(is_product()){?>
	<div class="ss-row page-no-date zindex-up">
        <div class="time-dot"></div> 
        <div class="ss-full">
            <div class="arrow-up"></div>     
            <div class="container-border">
                <div class="gray-container"> 
                <div class="woocommerce-message"><?php  echo wp_kses_post( $message ); ?></div>
             </div>
        </div>
    </div>
</div><?php
}else{ ?>
	 <div class="woocommerce-message"><?php  echo wp_kses_post( $message ); ?></div>
<?php }; ?>
<?php endforeach; ?>
