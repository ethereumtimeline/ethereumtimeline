jQuery(document).ready(function($){
	$('a').live('touchend', function(e) {
		var el = $(this);
		var link = el.attr('href');
	});
});

jQuery(document).ready(function($){		
	var targets = $( '[rel~=tooltip]' ),
		target	= false,
		tooltip = false,
		title	= '';

	targets.bind( 'mouseenter', function()
	{
		target	= $( this );
		tip		= target.attr( 'title' );
		tooltip	= $( '<div id="tooltip"></div>' );
		tooltipb	= $( '<div id="tooltip:before"></div>' );

		if( !tip || tip == '' )
			return false;

		target.removeAttr( 'title' );
		
		tooltip.css( 'opacity', 0 )
			   .html( tip )
			   .appendTo( 'body' );

		var init_tooltip = function()
		{
			if( $( window ).width() < tooltip.outerWidth() * 1.5 )
				tooltip.css( 'max-width', $( window ).width() / 2 );
				
			else
				tooltip.css( 'max-width', 140 );
				if(target.outerWidth()==0){
					var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2-15),
					pos_top	 = target.offset().top - tooltip.outerHeight() - 20;
				}else{
					var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
					pos_top	 = target.offset().top - tooltip.outerHeight() - 20;
				}
				tooltip.removeClass( 'left' );

			if( pos_left + tooltip.outerWidth() > $( window ).width() )
			{
				pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
				tooltip.addClass( 'right' );
			}
			else
			tooltip.removeClass( 'right' );
			
			if( pos_top < 0 )
			{
				var pos_top	 = target.offset().top + target.outerHeight();
				tooltip.addClass( 'top' );
			}
			else
				tooltip.removeClass( 'top' );
			
			tooltip.css( { left: pos_left, top: pos_top } )
				   .animate( { top: '+=10', opacity: 1 }, 150 );
		};
		
		init_tooltip();
		$( window ).resize( init_tooltip );

		var remove_tooltip = function()
		{
			tooltip.animate( { top: '-=10', opacity: 0 }, 50, function()
			{
				$( this ).remove();
			});

			target.attr( 'title', tip );
		};

		target.bind( 'mouseleave', remove_tooltip );
		tooltip.bind( 'click', remove_tooltip );
	});
});

//pretty Photo settings( ! Don't change )
//==================================================
jQuery(document).ready(function($){
	$("a[rel^='prettyPhoto']").prettyPhoto({allow_resize: false});	 
});

jQuery(document).ready(function($){
	$("a[rel^='prettyPhotoImages']").prettyPhoto({theme: 'pp_default',allow_resize: true});
});

//Img roll over effect settings
//==================================================
jQuery(document).ready(function($){
	 if(Modernizr.csstransforms3d != false){
	var imgholder = document.getElementsByClassName("hover-effect");
	
	for(var i = 0, j=imgholder.length; i<j; i++){
		imgholder[i].addEventListener("mouseover", function(){
			var imgtoanimate = this.getElementsByTagName("img")[0];							   
			move(imgtoanimate)
			.rotate(10)
			.scale(2.0)
			.duration('1s')
			.end();
		});
	
		imgholder[i].addEventListener("mouseout", function(){
			var imgtoanimate = this.getElementsByTagName("img")[0];						   
			move(imgtoanimate)
			.rotate(0)
			.scale(1.0)
			.duration('1s')
			.end();
		});
	}
	 }
});

//Contact form
//==================================================
jQuery(document).ready(function($){
	$('form#contactForm').submit(function() {
		$('form#contactForm .error').remove();
		var hasError = false;
		$('.requiredField').each(function() {
			if(jQuery.trim($(this).val()) == '') {
				var labelText = $(this).prev('label').text();
				$(this).parent().append('<span class="error">You forgot to enter your '+labelText+'.</span>');
				hasError = true;
			} else if($(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim($(this).val()))) {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">You entered an invalid '+labelText+'.</span>');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			$('form#contactForm li.buttons button').fadeOut('normal', function() {
				$(this).parent().append('<img src="wp-content/themes/fb-timeline/images/loader.gif" alt="Loading&hellip;" height="31" width="31" />');
			});
			var formInput = $(this).serialize();
			$.post($(this).attr('action'),formInput, function(data){
				$('form#contactForm').slideUp("fast", function() {				   
					$(this).before('<p class="thanks"><strong>Thanks!</strong> Your email was successfully sent. </p>');
				});
			});
		}
		
		return false;
		
	});
});




