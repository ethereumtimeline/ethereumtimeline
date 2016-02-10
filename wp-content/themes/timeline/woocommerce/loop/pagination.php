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
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ( $wp_query->max_num_pages <= 1 )
	return;
if(of_get_option('pagination-display') != "infinite"){?>
<div class="ss-row comments-add-new">
	<div class="ss-full">
    	<div class="arrow-up"></div>
        <div class="time-dot"></div> 
        	<div class="container-border">
            	<div class="gray-container">
                <div class="pagination">
				<?php
						echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
							'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
							'format' 		=> '',
							'current' 		=> max( 1, get_query_var('paged') ),
							'total' 		=> $wp_query->max_num_pages,
							'prev_text' 	=> '&lsaquo;',
							'next_text' 	=> '&rsaquo;',
							'end_size'		=> 1,
							'mid_size'		=> 1
						) ) );
						?>
                </div>
			</div>
		</div>
	</div>
</div>
<?php }; ?>