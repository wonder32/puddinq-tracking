<?php
/*
* Puddinq Tracking
*
* @package           puddinq/project-tracking-system
* @author            wonder32
* @copyright         2021 Puddinq
* @license           GPL-3.0-or-later
*
* @wordpress-plugin
* Plugin Name:          Puddinq Tracking System
* Plugin URI:           https://www.puddinq.com/plugins/puddinq-tracking/
* Description:          User tracking Tool vor WordPress
* Version:              1.0.0
* Requires at least:    5.7
* Requires PHP:         7.4
* Author:               wonder32
* Author URI:           https://www.puddinq.com
* License:              GPL3
* License URI:          https://www.gnu.org/licenses/gpl-3.0.html
* Domain Path:          /languages
* Text Domain:          pts
*/

use PTS\Includes\PTS;

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'PMS_PLUGIN_FILE' ) ) {
    define( 'PMS_PLUGIN_FILE', __FILE__ );
}

require_once __DIR__ . '/vendor/autoload.php';

/************************************
 *      CONSTANTS
 ************************************/

define ('PTSDIR', plugin_dir_path(__FILE__));
define ('PTSDIRURL', plugin_dir_url(__FILE__));
define ('PTSFILE', __FILE__);

/********************** **************
 *      LOAD FILES
 ************************************/


// start the show
$GLOBALS['PTS'] = new PTS;