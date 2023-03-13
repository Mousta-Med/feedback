<?php

/**
 * Plugin Name: Feedback
 * Description: simple feedback form
 * Author: Mousta
 * Version: 1.0
 * Text Domain: Feedback
 * 
 */
if (!defined('ABSPATH')) {
    exit;
}

class feedback
{
    public function __construct()
    {
        add_action('init', array($this, 'create_feedback'));
        add_action('wp_enqueue_scripts', array($this, 'load_assets'));
        add_shortcode('feedback-form', array($this, 'load_shortcode'));
    }
    public function create_feedback()
    {
        $argm = array(
            'public' => true,
            'has_archive' => true,
            'supports' => array('title'),
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability' => 'manage_options',
            'labels' => array(
                'name' => 'Feedback Form',
                'singular_name' => 'Feedback Form Entry'
            ),
            'menu_icon' => 'dashicons-media-text',
        );
        register_post_type('Feedback_Form', $argm);
    }
    public function load_assets()
    {
        wp_enqueue_style(
            'feedback',
            plugin_dir_url(__FILE__) . 'css/feedback.css',
            array(),
            1,
            'all'
        );
        wp_enqueue_script(
            'feedback',
            plugin_dir_url(__FILE__) . 'js/feedback.js',
            array('jquery'),
            1,
            true
        );
    }
    public function load_shortcode()
    { ?>
        <div class="feedback">
            <h1>Feedback Form</h1>
            <p>pleas give us your opinion about this service</p>
            <form id="feedback" action="">
                <input type="text" name="name" class="form-control" id="" placeholder="Name">
                <input type="email" name="email" class="form-control" id="" placeholder="Email">
                <input type="tel" name="phone" class="form-control" id="" placeholder="Phone">
                <textarea name="message" class="form-control" id="" cols="30" rows="10" placeholder="Enter your message"></textarea>
                <input type="submit" class="form-control success" value="Send">
            </form>
        </div>

<?php }
}

new feedback;
