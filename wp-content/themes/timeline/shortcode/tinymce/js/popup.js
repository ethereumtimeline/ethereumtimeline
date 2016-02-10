
// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
    var zillas = {
    	loadVals: function()
    	{
    		var shortcode = $('#_zilla_shortcode').text(),
    			uShortcode = shortcode;
    		
    		// fill in the gaps eg {{param}}
    		$('.zilla-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('zilla_', ''),		// gets rid of the zilla_ prefix
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_zilla_ushortcode').remove();
    		$('#zilla-sc-form-table').prepend('<div id="_zilla_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
    	cLoadVals: function()
    	{
    		var shortcode = $('#_zilla_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';
    		
    		// fill in the gaps eg {{param}}
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.zilla-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('zilla_', '')		// gets rid of the zilla_ prefix
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_zilla_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_zilla_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = $('#_zilla_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		
    		// add updated parent shortcode
    		$('#_zilla_ushortcode').remove();
    		$('#zilla-sc-form-table').prepend('<div id="_zilla_ushortcode" class="hidden">' + pShortcode + '</div>');
    	},
    	children: function()
    	{
    		// assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		
    		// remove button
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			else
    			{
    				alert('You need a minimum of one row');
    			}
    			
    			return false;
    		});
    		
    		// assign jUI sortable
    		$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'
				
			});
    	},
    	resizeTB: function()
    	{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				zillaPopup = $('#zilla-popup');

            tbWindow.css({
                height: zillaPopup.outerHeight() + 50,
                width: zillaPopup.outerWidth(),
                marginLeft: -(zillaPopup.outerWidth()/2)
            });

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,
				height: (tbWindow.outerHeight()-47),
				overflow: 'auto', // IMPORTANT
				width: zillaPopup.outerWidth()
			});
			
			$('#zilla-popup').addClass('no_preview');
    	},
    	load: function()
    	{
    		var	zillas = this,
    			popup = $('#zilla-popup'),
    			form = $('#zilla-sc-form', popup),
    			shortcode = $('#_zilla_shortcode', form).text(),
    			popupType = $('#_zilla_popup', form).text(),
    			uShortcode = '';
    		
    		// resize TB
    		zillas.resizeTB();
    		$(window).resize(function() { zillas.resizeTB() });
    		
    		// initialise
    		zillas.loadVals();
    		zillas.children();
    		zillas.cLoadVals();
    		
    		// update on children value change
    		$('.zilla-cinput', form).live('change', function() {
    			zillas.cLoadVals();
    		});
    		
    		// update on value change
    		$('.zilla-input', form).change(function() {
    			zillas.loadVals();
    		});
    		
    		// when insert is clicked
    		$('.zilla-insert', form).click(function() {    		 			
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#_zilla_ushortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    // run
    $('#zilla-popup').livequery( function() { zillas.load(); } );
});