<?php


namespace PTS\Includes;


class PTS
{

    public function __construct()
    {
        /* @see PTS::loadAssets() */
        add_action('wp_enqueue_scripts', [$this, 'loadAssets']);

        /* @see PTS::loadDebugger() */
        add_action('wp_body_open', [$this, 'loadDebugger']);

    }

    public function loadAssets() {

        $value = array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce(date('Ymd') . '-tracking')
        );

        wp_enqueue_style('puddinq-tracking-style', PTSDIRURL . 'assets/dist/css/puddinq-tracking.css', '', '', '');
        wp_enqueue_script('puddinq-tracking-script', PTSDIRURL . 'assets/dist/js/puddinq-tracking.js', array('jquery'), '', false);
        wp_localize_script('puddinq-tracking-script', 'ptsConnection', $value);
    }

    public function loadDebugger() {

        $state = wp_get_environment_type() != 'production' ? 'active' : '';
        printf('<div class="debug-tracking %s"></div>', $state);
    }
}