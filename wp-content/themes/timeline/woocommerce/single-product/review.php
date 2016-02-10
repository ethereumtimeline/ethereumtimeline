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
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $scramble;

$rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div class="ss-row">
        <div class="time-dot-date">
            <div class="arrow-date-border"></div>
            <div class="arrow-date"></div>
            <div class="container-border">
                <div class="gray-container">
                    <?php echo get_comment_date(__( get_option('date_format'), 'woocommerce' )); ?>
                </div>
            </div>
        </div>
        <div class="time-dot"></div><?php
        if( $scramble == '1'){?>
        	<div class="ss-left empty-left"><?php
        }else{?>
            
         	<div class="ss-right empty-right"><?php
        }?>
        	<div class="arrow-side"></div>
            <div class="container-border">
                <div class="gray-container">                 
                    <div id="comment-<?php comment_ID(); ?>" class="comment_container">
                        <?php //echo get_avatar( $GLOBALS['comment'], $size='60' ); ?>
                        <div class="comment-texta">
						<?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
                            <em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em>
                        <?php else : ?>
                            <h3 class="content-title ">
                                <strong itemprop="author"><?php comment_author(); ?></strong> <?php
                                    if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
                                        if ( woocommerce_customer_bought_product( $GLOBALS['comment']->comment_author_email, $GLOBALS['comment']->user_id, $post->ID ) )
                                            echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';?>
                            </h3>
                        <?php endif; ?>
                            <div itemprop="description" class="description"><?php comment_text(); ?></div>
                            <div class="clear"></div>
                        </div>
                    	<div class="clear"></div>
					</div>
    				<div class="icon-soc-container">
                        <div class="share-btns">
                            <div class="<?php if( $scramble == '1'){?>empty-right <?php }else{ ?>empty-left <?php };?>">
                                <?php  /* translators: 1: comment author, 2: date and time */
                                printf( __( '%2$s', 'timeline' ),
                                    sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                                    sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                        esc_url( get_comment_link( $comment->comment_ID ) ),
                                        get_comment_time( 'c' ),
                                        /* translators: 1: date, 2: time */
                                        sprintf( __( '%1$s at %2$s', 'timeline' ), get_comment_date(), get_comment_time() )
                                    )
                                );?> 
                            </div>
                            <?php if ( get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>
                            <div class="<?php if( $scramble == '1'){?>empty-left <?php }else{ ?>empty-right <?php };?>">
                            	<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $rating) ?>">
       						    	<span style="width:<?php echo ( intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
       							</div>
							</div>
							<?php endif; ?> 
                        </div>   
                    </div>
				</div>
			</div>
		</div><?php
		if( $scramble == '1'){?>
            <div class="ss-right empty-right"><?php
            $scramble = '2';
        }else{?>
            <div class="ss-left empty-left"><?php
            $scramble = '1';
        }?>

            <div class="ss-long-arrow"></div>
            <div class="arrow-side rsphide"></div>
            <div class="container-border c-size-small img-padding  <?php if($scramble == '2'){?>empty-left <?php }; ?> <?php if($scramble == '1'){?>empty-right <?php }; ?> comments-big-avatar" >
                <div class="gray-container img-padding-c"><?php
            //	$avatar_size = 108;
                echo get_avatar( $GLOBALS['comment'], $size='108')
                //echo get_avatar( $comment, $avatar_size );
            ?>
                </div>
            </div> 
        </div>
    </div>
