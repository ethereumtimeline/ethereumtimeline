<?php
/*
 * Plugin Name: Oldest To Newest Redux
 * Plugin URI: http://www.ryanyockey.com
 * Description: Take the oldest post and make it the newest post if there has not been a new post in 24 hours, thereby changing the order on home page and other lists. The number of hours may be adjusted with a simple edit. This should only be activated after you have multiple posts on the website. Updated for wordpress 2.7. Original at http://ryowebsite.com/?cat=11, by: Rich Hamilton
 * Author: Ryan Yockey 
 * Version: 1.2
 * Author URI: http://www.ryanyockey.com
 */

/*

Version 1.0:	Works for me!
Version 1.1:	Added pingout to ping sites (Pingomatic) for posts that were over 6 months old
				Changed rotation to take place only if there has not been a new post during the
				preceding period. This allows new posts to remain at the top for a full rotation,
				recycling older material only if there is not something new.
Version 1.2:	Fixed the generic ping for wordpress 2.7

*/
function ryo_old2new() {
	global $wpdb;
	$hours = 24;	/*
					 * Set number of hours after which oldest will be made the newest
					 * If you have a lot of posts, a daily rotation may be okay. Otherwise we suggest you
					 * adjust this to a matter of days, weeks, or months.
					 * Note: If you are caching with WP_Cache updates may not be immediately visible at time expiration.
					 */



	// *** You Should Have No Need To Change Anything Below Here ***

	$now  = abs(strtotime(current_time('mysql')));
	$newestposttime = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE post_date != '0000-00-00 00:00:00' AND post_status = 'publish' ORDER BY post_date DESC LIMIT 1");
	if ($newestposttime && ($now - abs(strtotime($newestposttime)) > ($hours * 3600))) {
		$oldpost = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_date != '0000-00-00 00:00:00' AND post_status = 'publish' ORDER BY post_date LIMIT 1");
		if ($oldpost) {
			$timestamp = current_time('mysql');
			$gmtstamp = get_gmt_from_date($timestamp);
			$oldposttime = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE ID = $oldpost LIMIT 1");
			$wpdb->query("UPDATE $wpdb->posts SET post_date='$timestamp', post_date_gmt='$gmtstamp' WHERE ID='$oldpost'");
			generic_ping($oldpost);
		}
	}
}

ryo_old2new();
?>