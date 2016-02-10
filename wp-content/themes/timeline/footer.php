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
		<?php if(of_get_option('example_showhidden', 'no entry' ) =='1'){ ?>
		<div id="footer">
        	<?php echo of_get_option('example_text_hidden', 'no entry' ); ?>                      
        </div><?php
         }; ?>
         <?php wp_footer();?>
  
    	</div>
    </div>    
</div>
<!--Scroll back to top-->

<div class="back-to-top" id="back-top">
<a href="javascript:void(0)" class="back-to-top">Top</a>
</div>		
<script type="text/javascript">
jQuery(function ($) {
    $("#back-top").hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 150) {
            $('#back-top').fadeIn();
        } else {
            $('#back-top').fadeOut();
        }
    });
});
jQuery('.back-to-top').click(function () {
    jQuery('html, body').animate({
        scrollTop: 0
    }, 'slow');
});
</script>
<!--end of Scroll back to top-->
<div class="inifiniteLoader">
	<div class="container-border">
    	<div class="gray-container">
        	<div class="infinite-text">LOADING CONTENT</div>
            <div class="inifiniteLoader-content"></div>
		</div>
	</div>
</div>

</body>
</html>