<?php

/**
 * Plugin Name: Are You Paying Attention Quiz
 * Description: Are You Paying Attention Quiz
 * Version: 1.0
 * Author: Jaya
 */

if (!defined("ABSPATH")) {
    exit;
}

class AreYouPayingAttentionQuiz
{
    function __construct()
    {
        add_action("init", array($this, "admin_assets"));
    }

    function admin_assets()
    {
        // register js
        wp_register_script("our_new_block_type", plugin_dir_url(__FILE__) . "/build/index.js", array("wp-blocks", "wp-element")); //load array before our file
        // register block type
        register_block_type(
            "our-plugin/are-paying-attention", // name space
            [
                "editor_script" => "our_new_block_type",
                "render_callback" => array($this, "the_HTML") // returning html
            ] // array of options
        );
    }

    function the_HTML($attributes)
    {
        return "<h2>Today the sky " . $attributes["sky_color"] . " and the grass is " . $attributes["grass_color"] . ".</h2>";
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


if (class_exists("AreYouPayingAttentionQuiz")) {
    // initialize class
    $quiz = new AreYouPayingAttentionQuiz();
}

/**
 * Activation
 * @param __FILE__ : this file
 * @param array (class, function)
 */
register_activation_hook(__FILE__, array($quiz, 'activate'));

/**
 * Deactivation
 * @param __FILE__ : this file
 * @param array (class, function)
 */
register_deactivation_hook(__FILE__, array($quiz, 'deactivate'));
