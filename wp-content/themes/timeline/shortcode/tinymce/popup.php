<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new zilla_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="zilla-popup">

	<div id="zilla-shortcode-wrap">
		
		<div id="zilla-sc-form-wrap">
		
			<div id="zilla-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
			
			</div>
			<!-- /#zilla-sc-form-head -->
			
			<form method="post" id="zilla-sc-form">
			
				<table id="zilla-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary zilla-insert">Insert Shortcode</a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#zilla-sc-form-table -->
				
			</form>
			<!-- /#zilla-sc-form -->
		
		</div>
		<!-- /#zilla-sc-form-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#zilla-shortcode-wrap -->

</div>
<!-- /#zilla-popup -->

</body>
</html>