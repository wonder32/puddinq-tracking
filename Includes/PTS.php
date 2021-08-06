<?php


namespace PTS\Includes;


class PTS
{

    /**
     * @var array $currentPluginData
     */
    private $currentPluginData;

    /**
     * @var $optionPluginData
     */
    private $optionPluginData;


    public function __construct()
    {
        $this->getPluginData();
        $this->setup();

        /* @see PTS::loadAssets() */
        add_action('wp_enqueue_scripts', [$this, 'loadAssets']);

        /* @see PTS::loadDebugger() */
        add_action('wp_body_open', [$this, 'loadDebugger']);



    }

    private function getPluginData() {

        if( !function_exists('get_plugin_data') ){
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }
        $this->optionPluginData = get_option('_pms_plugin_data');
        $this->currentPluginData = \get_plugin_data(PMS_PLUGIN_FILE, false, false);

    }

    private function setup() {

        register_activation_hook( PTSFILE, array( 'PTS\Includes\PTS_Install', 'install' ) );
        add_action('upgrader_process_complete', array( 'PTS\Includes\PTS_Install', 'update' ) );
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

    /**
     * @return array
     */
    public function getCurrentPluginData()
    {
        return $this->currentPluginData;
    }

    /**
     * @return array
     */
    public function getOptionPluginData()
    {
        return $this->optionPluginData;
    }

    /**
     * @param array $currentPluginData
     */
    public function setPluginData($currentPluginData)
    {
        $this->optionPluginData = $currentPluginData;
        update_option('_pts_plugin_data', $currentPluginData);
    }
}