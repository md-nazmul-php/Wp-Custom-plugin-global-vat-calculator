<?php if ( ! defined( 'WPINC' ) ) { die;}
/**
* Global Vat Calculator
* @package           global-vat-calculator
* @author            Md Nazmul
* @copyright         2021 Md Nazmul
* @license           GPL-2.0
* @wordpress-plugin
* Plugin Name:       Global Vat Calculator
* Plugin URI:        https://github.com/md-nazmul-php/global-vat-calculator
* Description:       Description of the plugin.
* Version:           1.0.0
* Requires at least: 5.2
* Requires PHP:      7.4
* Author:            Md Nazmul
* Author URI:        https://github.com/md-nazmul-php
* Text Domain:       global-vat-calculator
* License:           GPL v2 or later
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*========================================= Start Plugin ==========================*/

register_activation_hook( __FILE__, 'globalvatcalculator');
define( 'PLUGIN_DIR', dirname(__FILE__).'/' );

function globalvatcalculator_scripts() {
wp_enqueue_style('style', plugin_dir_url( __FILE__ ) . '/assets/css/style.css');
wp_enqueue_script('js', plugin_dir_url( __FILE__ ) . '/assets/js/gbl-vat.js');
}
add_action( 'wp_enqueue_scripts', 'globalvatcalculator_scripts' );

function globalvatcalculator_admin_scripts(){
    wp_register_style( 'adminstyle', plugin_dir_url( __FILE__ ) . '/assets/css/adminstyle.css');
    wp_enqueue_style( 'adminstyle' );

}
add_action('admin_enqueue_scripts', 'globalvatcalculator_admin_scripts');

//Activation Calback function
function globalvatcalculator() {
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix.'globalvatcalculator';

$sql = "CREATE TABLE $table_name (
`id` int(11) NOT NULL AUTO_INCREMENT,
`country` varchar(220) DEFAULT NULL,
`vat` FLOAT(9,2) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1
";
if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);
}
}
// Add Admin menu page
add_action('admin_menu', 'globalvatcalculatorAdmin');
function globalvatcalculatorAdmin() {
add_menu_page(
'global-vat-calculator',
'VAT Calculator',
'manage_options' ,
__FILE__,
'globalvatcalculator_admin_cbl',
'dashicons-buddicons-bbpress-logo');
}

function globalvatcalculator_admin_cbl() {

include "inc/gbl-vat-admin.php";	
}
require_once plugin_dir_path( __FILE__ ) . 'inc/gbl-vat-view.php';