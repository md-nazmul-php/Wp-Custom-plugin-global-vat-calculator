<?php if ( ! defined( 'WPINC' ) ) { die;}


if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}globalvatcalculator");