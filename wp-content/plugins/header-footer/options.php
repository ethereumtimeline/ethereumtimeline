<?php
if (function_exists('load_plugin_textdomain')) {
    load_plugin_textdomain('header-footer', false, 'header-footer/languages');
}

$dismissed = get_option('hefo_dismissed', array());

if (isset($_REQUEST['dismiss']) && check_admin_referer()) {
    $dismissed[$_REQUEST['dismiss']] = 1;
    update_option('hefo_dismissed', $dismissed);
}

function hefo_request($name, $default = null) {
    if (!isset($_REQUEST[$name]))
        return $default;
    return stripslashes_deep($_REQUEST[$name]);
}

function hefo_field_checkbox($name, $label = '', $tips = '', $attrs = '') {
    global $options;
    echo '<th scope="row">';
    echo '<label for="options[' . $name . ']">' . $label . '</label></th>';
    echo '<td><input type="checkbox" ' . $attrs . ' name="options[' . $name . ']" value="1" ' .
    (isset($options[$name]) ? 'checked' : '') . '/>';
    echo ' ' . $tips;
    echo '</td>';
}

function hefo_field_checkbox_only($name, $tips = '', $attrs = '', $link = null) {
    global $options;
    echo '<td><input type="checkbox" ' . $attrs . ' name="options[' . $name . ']" value="1" ' .
    (isset($options[$name]) ? 'checked' : '') . '/>';
    echo ' ' . $tips;
    if ($link) {
        echo '<br><a href="' . $link . '" target="_blank">Read more</a>.';
    }
    echo '</td>';
}

function hefo_field_text($name, $label = '', $tips = '', $attrs = '') {
    global $options;

    if (!isset($options[$name]))
        $options[$name] = '';

    echo '<th scope="row">';
    echo '<label for="options[' . $name . ']">' . $label . '</label></th>';
    echo '<td><input type="text" name="options[' . $name . ']" value="' .
    htmlspecialchars($options[$name]) . '" size="50"/>';
    echo '<br /> ' . $tips;
    echo '</td>';
}

function hefo_field_textarea($name, $label = '', $tips = '', $attrs = '') {
    global $options;

    if (!isset($options[$name]))
        $options[$name] = '';
    
    if (is_array($options[$name])) $options[$name] = implode("\n", $options[$name]);

    if (strpos($attrs, 'cols') === false)
        $attrs .= 'cols="70"';
    if (strpos($attrs, 'rows') === false)
        $attrs .= 'rows="5"';

    echo '<th scope="row">';
    echo '<label for="options[' . $name . ']">' . $label . '</label></th>';
    echo '<td><textarea style="width: 100%; height: 100px" wrap="off" name="options[' . $name . ']">' .
    htmlspecialchars($options[$name]) . '</textarea>';
    echo '<p class="description">' . $tips . '</p>';
    echo '</td>';
}

function hefo_field_textarea_enable($name, $label = '', $tips = '', $attrs = '') {
    global $options;

    if (!isset($options[$name]))
        $options[$name] = '';
    
    if (is_array($options[$name])) $options[$name] = implode("\n", $options[$name]);

    if (strpos($attrs, 'cols') === false)
        $attrs .= 'cols="70"';
    if (strpos($attrs, 'rows') === false)
        $attrs .= 'rows="5"';

    echo '<th scope="row">';
    echo '<label for="options[' . $name . ']">' . $label . '</label></th>';
    echo '<td>';
    echo '<input type="checkbox" ' . $attrs . ' name="options[' . $name . '_enabled]" value="1" ' .
    (isset($options[$name . '_enabled']) ? 'checked' : '') . '> Enable<br>';
    echo '<textarea style="width: 100%; height: 100px" wrap="off" name="options[' . $name . ']">' .
    htmlspecialchars($options[$name]) . '</textarea>';
    echo '<p class="description">' . $tips . '</p>';
    echo '</td>';
}

if (isset($_POST['save'])) {
    if (!wp_verify_nonce($_POST['_wpnonce'], 'save'))
        die('Page expired');
    $options = hefo_request('options');
    if (empty($options['mobile_user_agents'])) {
        $options['mobile_user_agents'] = "phone\niphone\nipod\nandroid.+mobile\nxoom";
    }
    $agents1 = explode("\n", $options['mobile_user_agents']);
    $agents2 = array();
    foreach ($agents1 as &$agent) {
        $agent = trim($agent);
        if (empty($agent))
            continue;
        $agents2[] = strtolower($agent);
    }
    $options['mobile_user_agents_parsed'] = implode('|', $agents2);
    
    $script_async_handles1 = explode("\n", $options['script_async_handles']);
    $script_async_handles2 = array();
    foreach ($script_async_handles1 as $value) {
        $value = trim($value);
        if (empty($value))
            continue;
        $script_async_handles2[] = strtolower($value);
    }
    $options['script_async_handles'] = $script_async_handles2;
    
    update_option('hefo', $options);
}
else {
    $options = get_option('hefo');
}
?>
<script>
    jQuery.cookie = function (name, value, options) {
        if (typeof value != 'undefined') { // name and value given, set cookie
            options = options || {};
            if (value === null) {
                value = '';
                options.expires = -1;
            }
            var expires = '';
            if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
                var date;
                if (typeof options.expires == 'number') {
                    date = new Date();
                    date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
                } else {
                    date = options.expires;
                }
                expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
            }
            // CAUTION: Needed to parenthesize options.path and options.domain
            // in the following expressions, otherwise they evaluate to undefined
            // in the packed version for some reason...
            var path = options.path ? '; path=' + (options.path) : '';
            var domain = options.domain ? '; domain=' + (options.domain) : '';
            var secure = options.secure ? '; secure' : '';
            document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
        } else { // only name given, get cookie
            var cookieValue = null;
            if (document.cookie && document.cookie != '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = jQuery.trim(cookies[i]);
                    // Does this cookie string begin with the name we want?
                    if (cookie.substring(0, name.length + 1) == (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }
    };

    var hefo_tabs;
    jQuery(document).ready(function () {
        jQuery("textarea").focus(function () {
            jQuery("textarea").css("height", "100px");
            jQuery(this).css("height", "400px");
        });

        jQuery('#upload-image').click(function () {
            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
            return false;
        });

        window.send_to_editor = function (html) {
            var imgurl = jQuery('img', html).attr('src');
            jQuery('#og_image_default').val(imgurl);
            tb_remove();
            jQuery("#tabs").tabs();
        }

        jQuery("#tabs").tabs({
            cookie: {
                expires: 30
            }
        });
    });
</script>
<div class="wrap">

    <div id="satollo-header">
        <a href="http://www.satollo.net/plugins/header-footer" target="_blank">Get Help</a>
        <a href="http://www.satollo.net/forums" target="_blank">Forum</a>

        <form style="display: inline; margin: 0;" action="http://www.satollo.net/wp-content/plugins/newsletter/do/subscribe.php" method="post" target="_blank">
            Subscribe to satollo.net <input type="email" name="ne" required placeholder="Your email">
            <input type="hidden" name="nr" value="header-footer">
            <input type="submit" value="Go">
        </form>

        <!--
        <a href="https://www.facebook.com/satollo.net" target="_blank"><img style="vertical-align: bottom" src="http://www.satollo.net/images/facebook.png"></a>
        -->

        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5PHGDGNHAYLJ8" target="_blank"><img style="vertical-align: bottom" src="http://www.satollo.net/images/donate.png"></a>
        <a href="http://www.satollo.net/donations" target="_blank">Even <b>1$</b> helps: read more</a>

        <div style="display: inline; position: relative; top: 5px"><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.satollo.net%2Fplugins%2Fheader-footer&amp;send=false&amp;layout=button_count&amp;width=130&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=102960746539273" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:130px; height:21px;" allowTransparency="true"></iframe></div>
    </div>

    <h2>Header and Footer</h2>

    <?php if (!isset($dismissed['rate'])) { ?>
    <div class="updated"><p>
            I never asked before and I'm curious: <a href="http://wordpress.org/extend/plugins/header-footer/" target="_blank"><strong>would you rate this plugin</strong></a>?
            (takes only few seconds required - account on WordPress.org, every blog owner should have one...). <strong>Really appreciated, Stefano</strong>.
            <div class="satollo-dismiss"><a href="<?php echo wp_nonce_url($_SERVER['REQUEST_URI'] . '&dismiss=rate') ?>">Dismiss</a></div>
            <div style="clear: both"></div>
            </p>   
    </div>
    <?php } ?>

    <p>
        Check out my other useful plugins:<br>
        <a href="http://www.satollo.net/plugins/comment-plus?utm_source=hyper-cache&utm_medium=banner&utm_campaign=comment-plus" target="_blank"><img width="40" src="http://www.satollo.net/images/plugins/comment-plus-icon.png"></a>
        <a href="http://www.satollo.net/plugins/hyper-cache?utm_source=hyper-cache&utm_medium=banner&utm_campaign=hyper-cache" target="_blank"><img width="40" src="http://www.satollo.net/images/plugins/hyper-cache-icon.png"></a>
        <a href="http://www.satollo.net/plugins/include-me?utm_source=hyper-cache&utm_medium=banner&utm_campaign=include-me" target="_blank"><img width="40" src="http://www.satollo.net/images/plugins/include-me-icon.png"></a>
        <a href="http://www.thenewsletterplugin.com/?utm_source=hyper-cache&utm_medium=banner&utm_campaign=newsletter" target="_blank"><img width="40" src="http://www.satollo.net/images/plugins/newsletter-icon.png"></a>
    </p>


    <p><?php _e('PHP is allowed on textareas below.'); ?> <?php _e('If you use bbPress, read the official page.'); ?></p>

    <form method="post" action="">
        <?php wp_nonce_field('save') ?>

        <div id="tabs">
            <ul>
                <li><a href="#tabs-first"><?php _e('Page head and footer', 'header-footer'); ?></a></li>
                <li><a href="#tabs-2"><?php _e('Post content', 'header-footer'); ?></a></li>
                <li><a href="#tabs-post-mobile"><?php _e('Post content (mobile)', 'header-footer'); ?></a></li>
                <li><a href="#tabs-page"><?php _e('Page content', 'header-footer'); ?></a></li>
                <li><a href="#tabs-page-mobile"><?php _e('Page content (mobile)', 'header-footer'); ?></a></li>
                <li><a href="#tabs-4"><?php _e('Facebook', 'header-footer'); ?></a></li>
                <li><a href="#tabs-9"><?php _e('SEO', 'header-footer'); ?></a></li>
                <li><a href="#tabs-5"><?php _e('Snippets', 'header-footer'); ?></a></li>
                <li><a href="#tabs-6"><?php _e('BBPress', 'header-footer'); ?></a></li>
                <!--
                <li><a href="#tabs-6a"><?php _e('Other post types', 'header-footer'); ?></a></li>
                -->
                <li><a href="#tabs-8"><?php _e('Advanced', 'header-footer'); ?></a></li>
                <li><a href="#tabs-7"><?php _e('Notes and...', 'header-footer'); ?></a></li>
                <li><a href="#tabs-thankyou"><?php _e('Thank you', 'header-footer'); ?></a></li>
            </ul>

            <div id="tabs-first">
                <table class="form-table">
                    <tr valign="top"><?php hefo_field_textarea('head', __('Code to be added on HEAD section of every page', 'header-footer'), 'It will be added on HEAD section of the home as well', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('head_home', __('Code to be added on HEAD section of the home', 'header-footer'), '', 'rows="4"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('footer', __('Code to be added before the end of the page', 'header-footer'), 'It works if your theme has the wp_footer call. It should be just before the &lt;/body&gt; closing tag', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea_enable('body', __('Added just after the &lt;body&gt; tag', 'header-footer'), '', 'rows="10"'); ?></tr>
                </table>
            </div>



            <div id="tabs-2">
                <!--<h3>Posts and pages</h3>-->
                <table class="form-table">
                    <!--<tr valign="top"><?php hefo_field_checkbox('category', __('Enable injection on category pages', 'header-footer')); ?></tr>-->
                    <tr valign="top"><?php hefo_field_textarea('before', __('Code to be inserted before each post', 'header-footer'), '', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('after', __('Code to be inserted after each post', 'header-footer'), '', 'rows="10"'); ?></tr>
                </table>

                <h3><?php _e('Injection on excerpts', 'header-footer'); ?></h3>
                <p><?php _e('It works only on category and tag pages.', 'header-footer'); ?></p>
                <table class="form-table">
                    <tr valign="top"><?php hefo_field_textarea('excerpt_before', __('Code to be inserted before each post excerpt', 'header-footer'), '', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('excerpt_after', __('Code to be inserted after each post excerpt', 'header-footer'), '', 'rows="10"'); ?></tr>
                </table>
            </div>


            <div id="tabs-post-mobile">
                <p>
                    Please take the time to <a href="http://www.satollo.net/plugins/header-footer" target="_blank">read this page</a> to understand how the "mobile" configuration works.
                    See the "advanced tab" to configure the mobile device detection.
                </p>
                <table class="form-table">
                    <tr valign="top"><?php hefo_field_checkbox('mobile_post', __('Enable mobile detection and injection', 'header-footer')); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('mobile_before', __('Code to be inserted before each post', 'header-footer'), '', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('mobile_after', __('Code to be inserted after each post', 'header-footer'), '', 'rows="10"'); ?></tr>
                </table>
            </div>


            <div id="tabs-page">
                <table class="form-table">
                    <tr valign="top"><?php hefo_field_checkbox('page_add_tags', __('Let pages to have tags', 'header-footer')); ?></tr>
                    <tr valign="top"><?php hefo_field_checkbox('page_add_categories', __('Let pages to have categories', 'header-footer')); ?></tr>
                    <tr valign="top"><?php hefo_field_checkbox('page_use_post', __('Use the post configurations', 'header-footer')); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('page_before', __('Code to be inserted before each page', 'header-footer'), '', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('page_after', __('Code to be inserted after each page', 'header-footer'), '', 'rows="10"'); ?></tr>
                </table>
            </div>


            <div id="tabs-page-mobile">
                <p>Please take the time to <a href="http://www.satollo.net/plugins/header-footer" target="_blank">read this page</a> to understand how the "mobile" configuration works.
                    See the "advanced tab" to configure the mobile device detection.</p>
                <table class="form-table">
                    <tr valign="top"><?php hefo_field_checkbox('mobile_page', __('Enable mobile detection and injection', 'header-footer')); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('mobile_page_before', __('Code to be inserted before each page', 'header-footer'), '', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('mobile_page_after', __('Code to be inserted after each page', 'header-footer'), '', 'rows="10"'); ?></tr>
                </table>
            </div>


            <div id="tabs-4">

                <p>
                    <?php _e('If you use WordPress SEO or other plugin which already add the OpenGraph meta tag, leave these options disabled.') ?>
                </p>
                <table class="form-table">
                    <tr valign="top"><?php hefo_field_checkbox('og_enabled', __('Enable the OG metatag', 'header-footer'), __('Enable the Facebook Open Graph metatag', 'header-footer')); ?></tr>

                    <tr valign="top"><?php hefo_field_text('fb_app_id', __('Facebook application id', 'header-footer'), __('', 'header-footer')); ?></tr>
                    <tr valign="top"><?php hefo_field_text('og_type', __('Facebook page type for the generic web page', 'header-footer'), __('Usually "article" is the right choice, if empty will be skipped', 'header-footer')); ?></tr>
                    <tr valign="top"><?php hefo_field_text('og_type_home', __('Facebook page type for the home', 'header-footer'), __('Usually "blog" is a good choice, if empty will be used the generic type', 'header-footer')); ?></tr>
                    <tr valign="top"><?php hefo_field_checkbox('og_image', __('Facebook Open Graph Image', 'header-footer'), __('Adds the Facebook Open Graph metatag with a reference to the first post image', 'header-footer')); ?></tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="options[' . $name . ']"><?php _e('Facebook Open Graph default image'); ?></label>
                        </th>
                        <td>
                            <input type="text" id="og_image_default" name="options[og_image_default]" value="<?php echo htmlspecialchars($options['og_image_default']); ?>" size="50"/>
                            <input type="button" id="upload-image" value="Select/Upload an image"/>
                            <br />
                            <?php _e('If no image can be extracted from a post, that image URL will be used (if present).'); ?><br />
                            <?php _e('<strong>Warning.</strong> On some versions of WordPress after the image selection button is pressed the tabs above does not change anymore. Just save so
                        this page is reloaded (<a href="http://wordpress.org/support/topic/wp-32-thickbox-jquery-ui-tabs-conflict" target="_blank">reference</a>).'); ?>
                        </td>
                    </tr>
                </table>
            </div>


            <div id="tabs-9">
                <p>
                    <?php _e('Please, see the <a href="http://www.satollo.net/plugins/header-footer" target="_blank">Header and Footer</strong></a> page before to use those options.'); ?>
                </p>
                <p>
                    <?php _e('Note: most of these options are now available on SEO plugins.'); ?>
                </p>

                <!--<h3>SEO</h3>-->
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            Home
                        </th>
                        <?php hefo_field_checkbox_only('seo_home_paged_noindex', __('Add noindex for page 2 and up', 'header-footer')); ?>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            Search results
                        </th>
                        <?php hefo_field_checkbox_only('seo_search_noindex', __('Add noindex for search result pages', 'header-footer')); ?>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            Canonical on home
                        </th>
                        <?php hefo_field_checkbox_only('seo_home_canonical', __('Add canonical to home page', 'header-footer')); ?>
                    </tr>
                </table>
            </div>


            <div id="tabs-5">
                <p>
                    <?php _e('Common snippets that can be used in any header or footer area referring them as [snippet_N] where N is the snippet number
            from 1 to 5. Snippets are inserted before PHP evaluation.', 'header-footer'); ?><br />
                    <?php _e('Useful for social button to be placed before and after the post or in posts and pages.', 'header-footer'); ?>
                </p>
                <table class="form-table">
                    <? for ($i=1; $i<=5; $i++) { ?>
                    <tr valign="top"><?php hefo_field_textarea('snippet_' . $i, __('Snippet ' . $i, 'header-footer'), '', 'rows="10"'); ?></tr>
                    <? } ?>
                </table>
            </div>

            <div id="tabs-6">
                <p>
                    Injection points on bbPress default theme structure are not always clear to me, so consider this feature experimental.
                </p>
                <table class="form-table">
                    <tr valign="top"><?php hefo_field_textarea('bbp_template_before_single_forum', __('Before single forum', 'header-footer'), 'Hook: bbp_template_before_single_forum', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('bbp_template_before_single_topic', __('Before single topic', 'header-footer'), 'Hook: bbp_template_before_single_topic', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('bbp_template_after_single_topic', __('After single topic', 'header-footer'), 'Hook: bbp_template_after_single_topic', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('bbp_theme_before_reply_content', __('Before reply content', 'header-footer'), 'Hook: bbp_theme_before_reply_content', 'rows="10"'); ?></tr>
                    <tr valign="top"><?php hefo_field_textarea('bbp_theme_after_reply_content', __('After reply content', 'header-footer'), 'Hook: bbp_theme_after_reply_content', 'rows="10"'); ?></tr>
                </table>

            </div>
            <!--
            <div id="tabs-6s">
                <p>
                </p>
                <?php $post_types = get_post_types(array('public'=>true, '_builtin'=>false), 'objects'); ?>
                <?php foreach ($post_types as $post_type) { ?>
                <h3><?php echo esc_html($post_type->label)?> (<?php echo esc_html($post_type->name)?>)</h3>
                <table class="form-table">
                <tr><?php hefo_field_textarea($post_type->name . '_before', __('Before the content', 'header-footer'), '', 'rows="10"'); ?></tr>
                <tr><?php hefo_field_textarea($post_type->name . '_after', __('After the content', 'header-footer'), '', 'rows="10"'); ?></tr>
                </table>
                <?php } ?>
            </div>            
            -->

            <div id="tabs-8">
                <table class="form-table">
                    <tr valign="top">
                        <?php
                        hefo_field_textarea('mobile_user_agents', __('Mobile user agent strings', 'header-footer'), 'For coders: a regular expression is built with those values and the resulting code will be<br>'
                                . '<code>preg_match(\'/' . $options['mobile_user_agents_parsed'] . '/\', ...);</code><br>' .
                                '<a href="http://www.satollo.net/plugins/header-footer" target="_blank">Read this page</a> for more.', 'rows="10"');
                        ?>

                    </tr>
                </table>
                
                <h3>Web performance</h3>
                <p>
                    Some JavaScript can be marked to be loaded asynchronously, for example the comment-reply.js of WordPress.
                    Not always asynchronous load work, for example jQuery cannot usually loaded in this way. Since WordPress does 
                    not support this feature natively, here you can force thise feature on specific scripts.<br>
                    Usually you can add comment-reply, akismet-form, admin-bar.<br>
                    You can read more on <a href="http://www.satollo.net/javascript-asyn-load-for-wordpress-enqueued-scripts" target="_blank">this article</a>
                    and/or ask on my <a href="http://www.satollo.net/forums" target="_blank">forum area</a>.
                </p>
                
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            Script handle debug
                        </th>
                        <?php hefo_field_checkbox_only('script_handle_debug', __('Activate in page debug info: see the source page to find the handles', 'header-footer')); ?>
                    
                    </tr>
                    <tr valign="top">
                        <?php
                        hefo_field_textarea('script_async_handles', __('Script handles to load asynchronously', 'header-footer'), 'One per line', 'rows="10"');
                        ?>
                    </tr>
                </table>
                
                <h3>Head meta links</h3>
                <p>
                    WordPress automatically add some meta link on the head of the page, for example the RSS links, the previous and next
                    post links and so on. Here you can disable those links if not of interest.
                </p>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Disable css link id</th>
                        <?php hefo_field_checkbox_only('disable_css_id', __('Disable the id attribute on css links generated by WordPress', 'header-footer'), '', 'http://www.satollo.net/plugins/header-footer#disable_css_id'); ?>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Disable css media</th>
                        <?php hefo_field_checkbox_only('disable_css_media', __('Disable the media attribute on css links generated by WordPress, id the option above is enabled.', 'header-footer'), '', 'http://www.satollo.net/plugins/header-footer#disable_css_media'); ?>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Extra feed links</th>
                        <?php hefo_field_checkbox_only('disable_feed_links_extra', __('Disable extra feed links like category feeds or single post comments feeds', 'header-footer')); ?>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Short link</th>
                        <?php hefo_field_checkbox_only('disable_wp_shortlink_wp_head', __('Disable the short link for posts', 'header-footer')); ?>
                    </tr>
                    <tr valign="top">
                        <th scope="row">WLW Manifest</th>
                        <?php hefo_field_checkbox_only('disable_wlwmanifest_link', __('Disable the Windows Live Writer manifest', 'header-footer')); ?>
                    </tr>
                    <tr valign="top">
                        <th scope="row">RSD link</th>
                        <?php hefo_field_checkbox_only('disable_rsd_link', __('Disable RSD link', 'header-footer')); ?>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Adjacent post links</th>
                        <?php hefo_field_checkbox_only('disable_adjacent_posts_rel_link_wp_head', __('Disable adjacent post links', 'header-footer')); ?>
                    </tr>
                </table>
            </div>


            <div id="tabs-7">
                <table class="form-table">
                    <tr valign="top"><?php hefo_field_textarea('notes', __('Notes and parked codes', 'header-footer'), '', 'rows="10"'); ?></tr>
                </table>
            </div>

            <div id="tabs-thankyou">

                <ul>
                    <li><a href="https://plus.google.com/u/0/118278852301653300773">Евгений Жуков (Eugene Zhukov)</a> - Russian translation</li>
                </ul>
            </div>

        </div>
        <p class="submit"><input type="submit" class="button" name="save" value="<?php _e('save', 'header-footer'); ?>"></p>

    </form>
</div>


