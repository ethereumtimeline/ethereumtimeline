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
<div id="comments"><?php
	if(post_password_required()) : ?>
    <div class="ss-row comments-m-top">    
        <div class="ss-full"  > 
            <div class="time-dot"></div>
            <div class="arrow-up"></div>
            <div class="container-border" >
                <div class="gray-container">
                    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'timeline' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</div><?php
	return;
	endif;
	
if ( have_comments() ) :
	wp_list_comments( array( 'callback' => 'timeline_comment' ) );
endif; 
    
if( ! comments_open() && is_page() && post_type_supports( get_post_type(), 'comments' ) ){

}else{;?>                
	<div class="ss-row comments-add-new">
		<div class="ss-full"> 
        <div class="time-dot"></div>
		<div class="arrow-up"></div>
			<div class="container-border">
				<div class="gray-container">
					<div class="comments-add-c"><?php
						if( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ){?>
							<p class="nocomments"><?php _e( 'Comments are closed.', 'timeline' ); ?></p><?php
						};?>
							<?php comment_form(); ?>
						</div><?php 
						if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
							<div class="icon-soc-container">
								<div class="share-btns">
                                    <div>
                                        <nav id="comment-nav-below" >
                                            <div >
                                                <div class="nav-previous empty-left"  ><?php previous_comments_link( __( '&larr; Older Comments', 'twentyeleven' ) ); ?></div>
                                                <div class="nav-next empty-right" ><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyeleven' ) ); ?></div>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div><?php 
						endif;?>
                    </div>
                </div>
            </div>
        </div><?php 
	}; ?>
</div>