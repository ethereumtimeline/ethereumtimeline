<?php

/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/

if (!function_exists('fland_one_third')) {
	function fland_one_third( $atts, $content = null ) {
	   return '<div class="fland-one-third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_one_third', 'fland_one_third');
}

if (!function_exists('fland_one_third_last')) {
	function fland_one_third_last( $atts, $content = null ) {
	   return '<div class="fland-one-third fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_one_third_last', 'fland_one_third_last');
}

if (!function_exists('fland_two_third')) {
	function fland_two_third( $atts, $content = null ) {
	   return '<div class="fland-two-third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_two_third', 'fland_two_third');
}

if (!function_exists('fland_two_third_last')) {
	function fland_two_third_last( $atts, $content = null ) {
	   return '<div class="fland-two-third fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_two_third_last', 'fland_two_third_last');
}

if (!function_exists('fland_one_half')) {
	function fland_one_half( $atts, $content = null ) {
	   return '<div class="fland-one-half">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_one_half', 'fland_one_half');
}

if (!function_exists('fland_one_half_last')) {
	function fland_one_half_last( $atts, $content = null ) {
	   return '<div class="fland-one-half fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_one_half_last', 'fland_one_half_last');
}

if (!function_exists('fland_one_fourth')) {
	function fland_one_fourth( $atts, $content = null ) {
	   return '<div class="fland-one-fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_one_fourth', 'fland_one_fourth');
}

if (!function_exists('fland_one_fourth_last')) {
	function fland_one_fourth_last( $atts, $content = null ) {
	   return '<div class="fland-one-fourth fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_one_fourth_last', 'fland_one_fourth_last');
}

if (!function_exists('fland_three_fourth')) {
	function fland_three_fourth( $atts, $content = null ) {
	   return '<div class="fland-three-fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_three_fourth', 'fland_three_fourth');
}

if (!function_exists('fland_three_fourth_last')) {
	function fland_three_fourth_last( $atts, $content = null ) {
	   return '<div class="fland-three-fourth fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_three_fourth_last', 'fland_three_fourth_last');
}

if (!function_exists('fland_one_fifth')) {
	function fland_one_fifth( $atts, $content = null ) {
	   return '<div class="fland-one-fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_one_fifth', 'fland_one_fifth');
}

if (!function_exists('fland_one_fifth_last')) {
	function fland_one_fifth_last( $atts, $content = null ) {
	   return '<div class="fland-one-fifth fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_one_fifth_last', 'fland_one_fifth_last');
}

if (!function_exists('fland_two_fifth')) {
	function fland_two_fifth( $atts, $content = null ) {
	   return '<div class="fland-two-fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_two_fifth', 'fland_two_fifth');
}

if (!function_exists('fland_two_fifth_last')) {
	function fland_two_fifth_last( $atts, $content = null ) {
	   return '<div class="fland-two-fifth fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_two_fifth_last', 'fland_two_fifth_last');
}

if (!function_exists('fland_three_fifth')) {
	function fland_three_fifth( $atts, $content = null ) {
	   return '<div class="fland-three-fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_three_fifth', 'fland_three_fifth');
}

if (!function_exists('fland_three_fifth_last')) {
	function fland_three_fifth_last( $atts, $content = null ) {
	   return '<div class="fland-three-fifth fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_three_fifth_last', 'fland_three_fifth_last');
}

if (!function_exists('fland_four_fifth')) {
	function fland_four_fifth( $atts, $content = null ) {
	   return '<div class="fland-four-fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_four_fifth', 'fland_four_fifth');
}

if (!function_exists('fland_four_fifth_last')) {
	function fland_four_fifth_last( $atts, $content = null ) {
	   return '<div class="fland-four-fifth fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_four_fifth_last', 'fland_four_fifth_last');
}

if (!function_exists('fland_one_sixth')) {
	function fland_one_sixth( $atts, $content = null ) {
	   return '<div class="fland-one-sixth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_one_sixth', 'fland_one_sixth');
}

if (!function_exists('fland_one_sixth_last')) {
	function fland_one_sixth_last( $atts, $content = null ) {
	   return '<div class="fland-one-sixth fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_one_sixth_last', 'fland_one_sixth_last');
}

if (!function_exists('fland_five_sixth')) {
	function fland_five_sixth( $atts, $content = null ) {
	   return '<div class="fland-five-sixth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_five_sixth', 'fland_five_sixth');
}

if (!function_exists('fland_five_sixth_last')) {
	function fland_five_sixth_last( $atts, $content = null ) {
	   return '<div class="fland-five-sixth fland-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('fland_five_sixth_last', 'fland_five_sixth_last');
}


/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/

if (!function_exists('fland_button')) {
	function fland_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'url' => '#',
			'target' => '_self',
			'style' => 'grey',
			'size' => 'small',
			'type' => 'round'
	    ), $atts));
		
	   return '<a target="'.$target.'" class="fland-button '.$size.' '.$style.' '. $type .'" href="'.$url.'">' . do_shortcode($content) . '</a>';
	}
	add_shortcode('fland_button', 'fland_button');
}


/*-----------------------------------------------------------------------------------*/
/*	Alerts
/*-----------------------------------------------------------------------------------*/

if (!function_exists('fland_alert')) {
	function fland_alert( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'style'   => 'white'
	    ), $atts));
		
	   return '<div class="fland-alert '.$style.'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('fland_alert', 'fland_alert');
}


/*-----------------------------------------------------------------------------------*/
/*	Toggle Shortcodes
/*-----------------------------------------------------------------------------------*/

if (!function_exists('fland_toggle')) {
	function fland_toggle( $atts, $content = null ) {
	    extract(shortcode_atts(array(
			'title'    	 => 'Title goes here',
			'state'		 => 'open'
	    ), $atts));
	
		return "<div data-id='".$state."' class=\"fland-toggle\"><span class=\"fland-toggle-title\">". $title ."</span><div class=\"fland-toggle-inner\">". do_shortcode($content) ."</div></div>";
	}
	add_shortcode('fland_toggle', 'fland_toggle');
}


/*-----------------------------------------------------------------------------------*/
/*	Tabs Shortcodes
/*-----------------------------------------------------------------------------------*/

if (!function_exists('fland_tabs')) {
	function fland_tabs( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		STATIC $i = 0;
		$i++;
		
		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		if( count($tab_titles) ){
		    $output .= '<div id="fland-tabs-'.  $i .'" class="fland-tabs"><div class="fland-tab-inner">';
			$output .= '<ul class="fland-nav fland-clearfix">';
			
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#fland-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div></div>';
		} else {
			$output .= do_shortcode( $content );
		}
		
		return $output;
	}
	add_shortcode( 'fland_tabs', 'fland_tabs' );
}

if (!function_exists('fland_tab')) {
	function fland_tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		return '<div id="fland-tab-'. sanitize_title( $title ) .'" class="fland-tab">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'fland_tab', 'fland_tab' );
}

?>