<?php

/**
 * @package online_text_ops
 * @version 1.0
 **/

/**
Plugin Name: Online Text Ops
Plugin URI: https://sdardour.com/lab
Description: Shortcode: [online-text-ops] | Place it inside any WordPress post or page | Demo: https://sdardour.com/lab/2020/online-text-ops/ | Based on Bootstrap and requires, therefore, the Bootstrap Plugin: https://sdardour.com/lab/2020/bootstrap-inside-wordpress-plugin/
Author: lab@sdardour.com
Version: 1.0
Author URI: https://sdardour.com/lab
**/

/* --- */

if (!function_exists("add_action")) {

    exit;

}

/* --- */

define("ONLINE_TEXT_OPS_URL", plugin_dir_url(__FILE__));
define("ONLINE_TEXT_OPS_DIR", plugin_dir_path(__FILE__));

/* --- */

$ONLINE_TEXT_OPS_CAN_BE_LOADED = 0;

function ONLINE_TEXT_OPS_TEMPLATE_REDIRECT()
{
    global $ONLINE_TEXT_OPS_CAN_BE_LOADED;

    if ((is_page() or is_single()) and (strpos(get_post(get_the_ID())->post_content, "[online-text-ops]") !== false)) {

        $ONLINE_TEXT_OPS_CAN_BE_LOADED = 1;

    }

}

add_action("template_redirect", "ONLINE_TEXT_OPS_TEMPLATE_REDIRECT");

/* --- */

function ONLINE_TEXT_OPS_WP_ENQUEUE_SCRIPTS()
{

    global $ONLINE_TEXT_OPS_CAN_BE_LOADED;

    if ($ONLINE_TEXT_OPS_CAN_BE_LOADED === 1) {

        wp_enqueue_script("jquery");

        wp_enqueue_script(
            "smartquotes",
            ONLINE_TEXT_OPS_URL . "assets/smartquotes/smartquotes.min.js"
        );

        wp_enqueue_script(
            "text",
            ONLINE_TEXT_OPS_URL . "assets/text.js"
        );

        wp_enqueue_script(
            "online-email-extractor",
            ONLINE_TEXT_OPS_URL . "assets/appl.js",
            array("jquery", "smartquotes", "text")
        );

        wp_enqueue_style(
            "online-email-extractor",
            ONLINE_TEXT_OPS_URL . "assets/appl.css"
        );

    }

}

add_action("wp_enqueue_scripts", "ONLINE_TEXT_OPS_WP_ENQUEUE_SCRIPTS");

/* --- */

function ONLINE_TEXT_OPS_HTM($atts)
{

    global $ONLINE_TEXT_OPS_CAN_BE_LOADED;

    if ($ONLINE_TEXT_OPS_CAN_BE_LOADED === 1) {

        return @file_get_contents(ONLINE_TEXT_OPS_DIR . "assets/appl.htm");

    } else {

        return "";

    }

}

add_shortcode("online-text-ops", "ONLINE_TEXT_OPS_HTM");

/* --- */
