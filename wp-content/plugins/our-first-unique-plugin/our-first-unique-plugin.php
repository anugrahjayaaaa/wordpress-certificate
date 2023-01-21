<?php

/**
 * Plugin Name: Our First Unique Plugin
 * Description: Our First Unique Plugin
 * Version: 1.0
 * Author: Jaya
 */

class WordCountAndTimePlugin
{
    function __construct()
    {
        add_action("admin_menu", array($this, "admin_page"));
    }

    function admin_page()
    {
        add_options_page(
            "Word Count Settings", //title (head)
            "Word Count", // title (setting section)
            "manage_options", //capability
            "word-count-settings-page", //slug
            array($this, "our_HTML") //call back
        );
    }

    function our_HTML()
    {
?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
        </div>
<?php
    }

    /**
     * Add menu page
     * Flush rewrite rules
     */
    function activate()
    {
        flush_rewrite_rules();
    }

    /**
     * Flush rewrite rules
     */
    function deactivate()
    {
        flush_rewrite_rules();
    }
}

if (class_exists("WordCountAndTimePlugin")) {
    // initialize class
    $word_count = new WordCountAndTimePlugin();
}

/**
 * Activation
 * @param __FILE__ : this file
 * @param array (class, function)
 */
register_activation_hook(__FILE__, array($word_count, 'activate'));

/**
 * Deactivation
 * @param __FILE__ : this file
 * @param array (class, function)
 */
register_deactivation_hook(__FILE__, array($word_count, 'deactivate'));
