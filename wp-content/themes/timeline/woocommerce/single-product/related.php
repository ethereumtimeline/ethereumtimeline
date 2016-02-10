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
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product, $post_showcategory;
if($post_showcategory != "hide"){ ?>
                <div class="icon-soc-container">
                    <div class="share-btns">
                        <div class="empty-right">
                         <span><?php if ( $rating_html = $product->get_rating_html() ) { echo $rating_html;}else{?><div class="star-rating" title="Rated 0.00 out of 0"><span class="no-rating"><strong class="rating">0.00</strong> out of 0</span></div>
<?php }?></span>              
                        <div class="icon-s comments-ico"></div><a href="<?php comments_link(); ?>"> <?php comments_number( '0', '1', '%' ); ?></a>
                        </div><?php
                        $category = get_the_category(); ?> 
                        <div class="empty-left">
                       		<div class="icon-s category-ico"></div><a href="<?php echo get_category_link( $category[0]->term_id );?>"><?php   echo $product->get_categories();?></a>
                        </div> 
                    </div>   
                </div><?php
            };
			//This 4 divs close product row?>
			</div>
		</div>
	</div>
</div>
<?php

//REVIEW SECTION
//=====================================================
global $woocommerce, $product, $post;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( comments_open() ) : ?><div id="reviews"><?php
	echo '<div id="comments">';
	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
	
		$count = $product->get_rating_count();
		if ( $count > 0 ) {
			$average = $product->get_average_rating();
			echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';?>
            <div class="ss-full page-no-date"> 
                <div class="container-border">
                    <div class="gray-container"><?php
						echo '<div class="star-rating" style="font-size:19px!important;  color:#7b6cb2; padding-right:10px;"  title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating" >'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
						echo '<h3 style="text-align:left;">'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h3>';
						echo '</div>';?>
            		</div>
				</div>
			</div><?php
		} else {?>
            <div class="ss-full page-no-date">
                <div class="container-border">
                    <div class="gray-container"><?php
                    echo '<h2>'.__( 'Reviews', 'woocommerce' ).'</h2>';
                    echo '<p class="noreviews">'.__( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'woocommerce' ).'</p>';?>
                    </div>
                </div>
            </div><?php
		}
	} else {?>
        <div class="ss-full page-no-date">
        	<div class="container-border">
				<div class="gray-container"><?php
				echo '<h2>'.__( 'Reviews', 'woocommerce' ).'</h2>';?>
            	</div>
			</div>
 		</div><?php
	}
	$title_reply = '';
	if ( have_comments() ) :
		global $scramble;
		$scramble = '1';
		echo '<ol>';
			wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );
		echo '</ol>';
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<div class="ss-row comments-add-new">
                <div class="ss-full"> 
                <div class="time-dot"></div>
                <div class="arrow-up"></div>
                    <div class="container-border">
                        <div class="gray-container">
                            <div class="icon-soc-container">
                            	<div class="share-btns">
                                    <nav id="comment-nav-below" >
                                        <div >
                                            <div class="nav-previous empty-left"  ><?php previous_comments_link( __( '&larr; Older Comments', 'twentyeleven' ) ); ?></div>
                                            <div class="nav-next empty-right" ><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyeleven' ) ); ?></div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
						</div>
					</div>
        		</div>
			</div><?php 
		endif;
		//echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button" title="' . __( 'Add Your Review', 'woocommerce' ) . '">' . __( 'Add Review', 'woocommerce' ) . '</a></p>';
		$title_reply = __( 'Add a review', 'woocommerce' );
	else :
		$title_reply = __( 'Be the first to review', 'woocommerce' ).' &ldquo;'.$post->post_title.'&rdquo;';
		//echo '<p class="noreviews">'.__( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'woocommerce' ).'</p>';
	endif;

	$commenter = wp_get_current_commenter();?>
    </div>
	<div class="ss-row page-no-date">
            <div class="time-dot"></div> 
            <div class="ss-full">
                <div class="arrow-up"></div>     
                <div class="container-border">
                    <div class="gray-container"> 
                    <div id="review_form_wrapper">
                        <div id="review_form"><?php
                        $comment_form = array(
                            'title_reply' => $title_reply,
                            'comment_notes_before' => '',
                            'comment_notes_after' => '',
                            'fields' => array(
                                'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>' .
                                            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
                                'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>' .
                                            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
                            ),
                            'label_submit' => __( 'Submit Review', 'woocommerce' ),
                            'logged_in_as' => '',
                            'comment_field' => ''
                        );
                    
                        if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
							
                            $comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . __( 'Rating', 'woocommerce' ) .'</label><select name="rating" id="rating">
                                <option value="">'.__( 'Rate&hellip;', 'woocommerce' ).'</option>
                                <option value="5">'.__( 'Perfect', 'woocommerce' ).'</option>
                                <option value="4">'.__( 'Good', 'woocommerce' ).'</option>
                                <option value="3">'.__( 'Average', 'woocommerce' ).'</option>
                                <option value="2">'.__( 'Not that bad', 'woocommerce' ).'</option>
                                <option value="1">'.__( 'Very Poor', 'woocommerce' ).'</option>
                            </select></div>';
                    
                        }
                    
                        $comment_form['comment_field'] .= '<div class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>' . $woocommerce->nonce_field('comment_rating', true, false);
                    
                        comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );?>
                    
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
    <div class="clear"></div>
</div>
<?php endif; 





//ASLO LIKE SECTION
//=====================================================
global $product, $woocommerce, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = array();
$meta_query[] = $woocommerce->query->visibility_meta_query();
$meta_query[] = $woocommerce->query->stock_status_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<div class="upsells products">
  		<div class="ss-row page-no-date">
            <div class="time-dot"></div> 
            <div class="ss-full">
                <div class="arrow-up"></div>     
                <div class="container-border">
                    <div class="gray-container"> 
						<h3><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h3>
					</div>
				</div>
			</div>
		</div>
		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();



global $product, $woocommerce_loop;

$related = $product->get_related();

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<div class="related products">
        <div class="ss-row page-no-date">
            <div class="time-dot"></div> 
            <div class="ss-full">
                <div class="arrow-up"></div>     
                <div class="container-border">
                    <div class="gray-container"> 
                    	<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>
                    </div>
				</div>
			</div>
		</div>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
