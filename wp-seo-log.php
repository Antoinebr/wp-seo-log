<?php
/**
* Plugin Name: WP SEO LOG
* Plugin URI: http://antoinebrossault.com
* Description: Ce plugin permet de suivre le passage de googlebot
* Version: 0.1
* Author: Antoine Brossault
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly Go to hell scripts kiddies
}

add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page() {
  add_menu_page( 'WPSEOLOG', 'Wpseolog', 'manage_options', 'wp-seo-log/admin.php', '', 'dashicons-awards', 6 );
}


require ('wpseolog.class.php');

$log = new wpseolog();

$log->record_crawl();
#var_dump($log->is_google_bot());
//
// echo "new url "; var_dump($log->isNewUrl);
// echo "current URL ".$log->currentUrlID;
// echo $log->currentDate;
