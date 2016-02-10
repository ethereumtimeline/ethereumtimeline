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
?>
<div style=""><?php    posts_nav_link() ?> <?php wp_link_pages();  the_tags();
		
		global $wp_query;  
  
$total_pages = $wp_query->max_num_pages;  
  
if ($total_pages > 1){  
  
  $current_page = max(1, get_query_var('paged'));  
    
  echo '<div class="ss-row comments-add-new">
			<div class="ss-full">
			<div class="arrow-up"></div>
			<div class="time-dot"></div> 
				<div class="container-border">
					<div class="gray-container"><nav class="woocommerce-pagination">';  
    
  echo paginate_links(array(  
      'base' => get_pagenum_link(1) . '%_%',  
      'format' => '&paged=%#%',  
      'current' => $current_page,  
      'total' => $total_pages,  
      'prev_text' => 'Prev',  
      'next_text' => 'Next'  
    ));  
  
  echo '</nav>
  			</div>
		</div>
	</div>
</div>';  
    
}  
?></div>