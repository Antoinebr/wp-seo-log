<?php

class wpseologinstall{

  private $table;

  public function __construct(){
    $this->set_table();
  }

  private function set_table(){
    global $wpdb;
    $this->table = $wpdb->prefix."wpseolog";
  }

  public function install_table(){
    global $wpdb;
    // Create the Database table if its not all ready their.
    if($wpdb->get_var("show tables like '".$this->table) != $this->table) {

      $charset_collate = $wpdb->get_charset_collate();

      $sql = "CREATE TABLE $this->table (
        id int(11) NOT NULL AUTO_INCREMENT,
        url varchar(455) NOT NULL,
        date datetime NOT NULL,
        rescode int(3) NOT NULL,
        nbcrawl int(11) NOT NULL,
        seovisited varchar(255) NOT NULL,
        PRIMARY KEY (id)
      ) $charset_collate;";

      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    }
  }

  public function uninstall_table(){
    global $wpdb;
  #  if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
    $wpdb->query( "DROP TABLE IF EXISTS $this->table" );
    //delete_option("my_plugin_db_version");
  }

}
