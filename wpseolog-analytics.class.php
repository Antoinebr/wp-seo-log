<?php

class wpseologanalytics{

  private $table;
  public $currentUrlID;
  public $isNewUrl;
  public $currentDate;

  public function __construct(){
    $this->set_table();
    $this->currentDate = date("Y-m-d G:i:s");

  }

  private function set_table(){
    global $wpdb;
    $this->table = $wpdb->prefix."wpseolog";
  }


  public function get_new_urls_crawled(){
    global $wpdb;
    $result = $wpdb->get_results( "SELECT * FROM $this->table WHERE nbcrawl > 0");
    return $result;
  }

  public function get_nb_active_url(){
    global $wpdb;
    #$result = $wpdb->get_results( "SELECT COUNT(*) FROM $this->table WHERE nbcrawl > 0");
    #return $result;
    $liked = $wpdb->get_var("SELECT COUNT(id) FROM  $this->table WHERE nbcrawl > 0 AND seovisited > 0");
    echo $liked;
  }




}
