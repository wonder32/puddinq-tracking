<?php


namespace PTS\Includes;


use PHPMailer\PHPMailer\Exception;

class PTS_install
{

    public static function install() {

        /** @class PTS $PTS */
        global $PTS;

        if ($PTS->getOptionPluginData() === false) {
            self::installTables();
        } else if (version_compare($PTS->getOptionPluginData()['version'], $PTS->getCurrentPluginData()['version']) >= 0) {
            self::update();
        }

    }


    private static function installTables() {

        /** @class PTS $PTS */
        global $PTS, $wpdb;

        $table_name = $wpdb->prefix . 'tracking';
        $charset_collate = $wpdb->get_charset_collate();

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        // tasks
        $table_tracking = $wpdb->prefix . 'tracking';
        $columns_tracking = <<<COLUMNS
(
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL, 
  `title` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `project_id` (`project_id`)
)
COLUMNS;

        try {
            maybe_create_table($wpdb->prefix . $table_name, "CREATE TABLE {$table_tracking} {$columns_tracking} {$charset_collate};");
        } catch (Exception $e) {
            error_log($e);
        }

        $PTS->setPluginData($PTS->getCurrentPluginData());

    }

    public function update() {
        /** @class PTS $PTS */
        global $PTS;
        $PTS->setPluginData($PTS->getCurrentPluginData());
    }

}