<?php
/*
Plugin Name: Mediamaster RSS Reader
Plugin Script: mediamaster_rd_rss.php
Plugin URI: http://ulmdesign.mediamaster.eu/mediamaster-reader-rss/
Description: Reader rss for your Wordpress site
Version: 2.0
License: GPL
Author: Francesco De Stefano
Author URI: http://www.mediamaster.eu

=== RELEASE NOTES ===
2013-01-23 - v1.0 - first version
2014-05-04 - v1.1
2014-05-10 - v1.1.1
2014-05-30 - v1.1.2
2015-12-03 - v2.0

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// mediamaster_rd_rss parameters 

function mediamaster_rd_rss($content) {
    $return = $content;
    $return .= '<div id="container"><div id="newsviewer"></div></div>';
    return $return;
}

add_shortcode( 'rssAnimated', 'mediamaster_rd_rss' );
add_filter('the_content', 'do_shortcode', 'mediamaster_rd_rss');
add_filter('widget_text', 'do_shortcode', 'mediamaster_rd_rss');
add_filter('wp_list_pages', 'do_shortcode', 'mediamaster_rd_rss');





//setting options
function aRSS_activate_set_default_options() {
    add_option('aRSS_animate_mode', 'scroller');
	add_option('aRSS_input_apikey', '');
	add_option('aRSS_input_pause', '3000');
	add_option('aRSS_social_user', '');
    add_option('aRSS_input_url', '');
	add_option('aRSS_source_media', '');
    add_option('aRSS_speed_animate', '30');
	add_option('aRSS_target_link', '_blank');
    add_option('aRSS_max_items', '10');
    add_option('aRSS_date_visible', 'true');
    add_option('aRSS_input_paginate', '1');
    add_option('headline_color', '');
    add_option('pub_date', '');
    add_option('title_feeds', '');
    add_option('background_box_color', '');
}
 
register_activation_hook( __FILE__, 'aRSS_activate_set_default_options');

// register setting
function aRSS_register_options_group() {
    register_setting('aRSS_options_group', 'aRSS_animate_mode');
	register_setting('aRSS_options_group', 'aRSS_input_apikey');
	register_setting('aRSS_options_group', 'aRSS_input_pause');
	register_setting('aRSS_options_group', 'aRSS_social_user');
	register_setting('aRSS_options_group', 'aRSS_input_url');
    register_setting('aRSS_options_group', 'aRSS_source_media');
	register_setting('aRSS_options_group', 'aRSS_speed_animate');
	register_setting('aRSS_options_group', 'aRSS_target_link');
	register_setting('aRSS_options_group', 'aRSS_max_items');
	register_setting('aRSS_options_group', 'aRSS_date_visible');
	register_setting('aRSS_options_group', 'aRSS_input_paginate');
    register_setting('aRSS_options_group', 'headline_color');
    register_setting('aRSS_options_group', 'pub_date');
    register_setting('aRSS_options_group', 'title_feeds');
    register_setting('aRSS_options_group', 'background_box_color');
}


add_action('admin_init', 'aRSS_register_options_group');

//page with form
function am_update_rss_options_form() {
   ?>
   <script src="<?php echo WP_PLUGIN_URL . '/mediamaster-reader-rss/js/jscolor.js'?>"></script>
    <div class="wrap">
    	<div class="icon32" id="icon-options-general"></div><br>
    	<h3> <img width="40" name="RSS Reader Animated" title="Get You Favourite Feeds for your Web Site" src="<?php echo  WP_PLUGIN_URL . '/mediamaster-reader-rss/img/arss.png'?>" /> Setting Animated RSS</h3>
    	<a href="http://ulmdesign.mediamaster.eu/mediamaster_rss_reader/upgrade.html" target="_blank"><img style="border:1px solid #9c9c9c; border-radius:10px;" src="<?php echo WP_PLUGIN_URL . '/mediamaster-reader-rss/img/rssreaderpro.png'?>" alt="Get your RSS reader PRO" /></a>
    	<form method="post" action="options.php"><?php settings_fields('aRSS_options_group'); ?>
    	    <p>
              <label for="aRSS_animate_mode">Animate Mode:</label>
              <p><input style="width:70%" type="text" value="<?php echo get_option('aRSS_animate_mode'); ?>" id="aRSS_animate_mode"  name="aRSS_animate_mode"/></p>
               <span>Options: scroller / rotate / paginate</span>
            </p>
            <hr/>
    		<p>
    		  <label for="aRSS_input_apikey">App ID and Api Key Facebook:</label>
    		  <p><input style="width:70%" type="text" value="<?php echo get_option('aRSS_input_apikey'); ?>" id="aRSS_input_apikey"  name="aRSS_input_apikey"/></p>
    		  <span>This option is to configure the pick of the feeds from a facebook page. It should be an app that logs on developers.facebook.com and then enter the AppID and Appkey providing you with the service. I will quote an example: 12345678912345|ABCde1fGHilm1XO2AbcfeghILMn</span>
    		</p>
    		<hr/>
    		<p>
              <label for="aRSS_input_pause">Set Pause:</label>
              <p><input style="width:70%" type="text" value="<?php echo get_option('aRSS_input_pause'); ?>" id="aRSS_input_pause"  name="aRSS_input_pause"/></p>
              <span>Waiting time between a feed and another during the scroller or rotate. The default value is recommended</span>  
            </p>
            <hr/>
    		<p>
    		  <label for="aRSS_social_user">Username social</label>
    		  <p><input style="width: 70%" type="text" value="<?php echo get_option('aRSS_social_user'); ?>" id="aRSS_social_user"  name="aRSS_social_user"/></p>
    		  <span>For facebook and twitter you must enter the username. You need to introduce your Flickr ID which you can find on idgettr.com</span>
    		</p>
    		<hr/>
    		<p>
              <label for="aRSS_source_media">Media Source</label>
              <p><input style="width: 70%" type="text" value="<?php echo get_option('aRSS_source_media'); ?>" id="aRSS_source_media"  name="aRSS_source_media"/></p>
              <span>Resources from which you can get the feeds are: rss / facebook / twitter / flickr</span>  
            </p>
            <hr/>
            <p>
              <label for="aRSS_input_url">RSS Source</label>
              <p><input style="width: 70%" type="text" value="<?php echo get_option('aRSS_input_url'); ?>" id="aRSS_input_url"  name="aRSS_input_url"/></p>
              <span>If your source media is rss copy and paste the url below in the input here "RSS Source", otherwise leave blank</span>
              <p><?php echo WP_PLUGIN_URL .'/mediamaster-reader-rss/rss.php'?></p>
            </p>
            <hr/>
            <p>
              <label for="aRSS_speed_animate">Speed Animate</label>
              <p><input type="text" value="<?php echo get_option('aRSS_speed_animate'); ?>" id="aRSS_speed_animate"  name="aRSS_speed_animate"/></p>
              <span>Speed ​​of feeds. The default value is recommended</span> 
            </p>
            <hr/>
            <p>
              <label for="aRSS_target_link">Target Link</label>
              <p><input type="text" value="<?php echo get_option('aRSS_target_link'); ?>" id="aRSS_target_link"  name="aRSS_target_link"/></p>
              <span>Options target link:  _blank / _self. </span>
            </p>   
            <hr/>         
            <p>
              <label for="aRSS_max_items">Max Items</label>
              <p><input type="text" value="<?php echo get_option('aRSS_max_items'); ?>" id="aRSS_max_items"  name="aRSS_max_items"/></p>
              <span>You can enter the value you want. Need a number to display the maximum number of items you want to show on your site</span>
            <p>
            <hr/>
            <p>
              <label for="aRSS_date_visible">Date Visible</label>
              <p><input type="text" value="<?php echo get_option('aRSS_date_visible'); ?>" id="aRSS_date_visible"  name="aRSS_date_visible"/></p>
              <span>Options: true / false</span>
            <p>
            <hr/>
            <p>
              <label for="aRSS_input_paginate">Numbers per Page</label>
              <p><input style="width: 70%" type="text" value="<?php echo get_option('aRSS_input_paginate'); ?>" id="aRSS_input_paginate"  name="aRSS_input_paginate"/></p>
              <span>If the "Animated Mode" is set to paginate, you can specify the number of pages you want to introduce to reformat feeds</span>  
            </p>
            <hr/> 
            <h3>Custome Style font Color</h3>
            <p>
                <label for="title_feeds">Title Feeds Color</label>
                <p><input class="color" style="width: 70%" type="text" value="<?php echo get_option('title_feeds'); ?>" id="title_feeds"  name="title_feeds"/></p>
            </p> 
            <p>
                <label for="headline_color">Body RSS Color</label>
                <p><input class="color" style="width: 70%" type="text" value="<?php echo get_option('headline_color'); ?>" id="headline_color"  name="headline_color"/></p>
            </p>
            <p>
                <label for="pub_date">Color Date</label>
                <p><input class="color" style="width: 70%" type="text" value="<?php echo get_option('pub_date'); ?>" id="pub_date"  name="pub_date"/></p>
            </p>
            <p>
                <label for="background_box_color">Background Box RSS Color</label>
                <p><input class="color" style="width: 70%" type="text" value="<?php echo get_option('background_box_color'); ?>" id="background_box_color"  name="background_box_color"/></p>
            </p>
    		<p><input type="submit" class="button-primary" id="submit" name="submit" value="<?php _e('Save Changes'); ?>"/></p>
    		<legend>For to see Feed insert in your post or widget text or page this shortcode: [rssAnimated]</legend>
    	</form>
    	<hr/>
    	<p>
    	    <h4>Instructions for changing the url of the xml file to update feeds</h4>
    	    <span>1) Click on "edit" in the plugins section in the administration, in correspondence of my plugins, as shown in the screenshot</span>
    	    <img width="70%" name="RSS Reader Animated" title="Get You Favourite Feeds for your Web Site" src="<?php echo  WP_PLUGIN_URL . '/mediamaster-reader-rss/img/listplugins.png'?>" />
    	</p>
    	<p>
            <legend>2) Edit file rss php and change url RSS Source</legend>
            <img width="95%" name="RSS Reader Animated" title="Get You Favourite Feeds for your Web Site" src="<?php echo  WP_PLUGIN_URL . '/mediamaster-reader-rss/img/screenedit.png'?>" />
        </p>
    	<hr/>
    	Plugin Developer: Francesco De Stefano <a target="_blank" href="http://ulmdesign.mediamaster.eu">UlmDesign &copy; 2013 - 2015</a>
    </div>
    <?php
}

// custom menu admin
function aggregator_rd_rss_opt_page() {
    add_menu_page('AnimatedRSS', 'AnimatedRSS', 'administrator', 'ard_rss-option-page', 'am_update_rss_options_form');
}

add_action('admin_menu', 'aggregator_rd_rss_opt_page');
function aRSS_dinamic_style() {
    ?>
        <style>
            #newsviewer .headline {color: #<?php echo get_option('headline_color'); ?> !important;}
            #newsviewer .publication-date {color: #<?php echo get_option('pub_date'); ?> !important;}
            #newsviewer h4 a {color:  #<?php echo get_option('title_feeds'); ?> !important;}
            div#container {background-color: #<?php echo get_option('background_box_color'); ?> !important;}
        </style>
    <?php
}
add_action('wp_head', 'aRSS_dinamic_style');
function aRSS_print_javascript_var(){
    ?>
<link rel="stylesheet" type="text/css" href="<?php echo WP_PLUGIN_URL . '/mediamaster-reader-rss/style/jquery.newsviewer.css'?>"/>
<script src="<?php echo WP_PLUGIN_URL . '/mediamaster-reader-rss/js/jquery.newsviewer.min.js'?>"></script>
       <script type="text/javascript">
               jQuery(document).ready(function($) {
                    $("#newsviewer").newsviewer({
                        mode: '<?php echo get_option('aRSS_animate_mode'); ?>', 
                        access_token: '<?php echo get_option('aRSS_input_apikey'); ?>', 
                        pause: <?php echo get_option('aRSS_input_pause'); ?>, 
                        param: '<?php echo get_option('aRSS_social_user'); ?>', 
                        dataSource: '<?php echo get_option('aRSS_source_media'); ?>', 
                        speed: <?php echo get_option('aRSS_speed_animate') ?>, 
                        url:'<?php echo get_option('aRSS_input_url'); ?>', 
                        target: '<?php echo get_option('aRSS_target_link'); ?>',  
                        maxItems: <?php echo get_option('aRSS_max_items')?>, 
                        includeDate: <?php echo get_option('aRSS_date_visible')?>, 
                        numPerPage: <?php echo get_option('aRSS_input_paginate'); ?>
                        })
                 });
       </script>
<?php

}
                    

add_action('wp_footer', 'aRSS_print_javascript_var');
?>