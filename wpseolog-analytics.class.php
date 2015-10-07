<?php

class wpseologanalytics{

  private $table;
  public $nbActiveUrl;
  public $nbTotalUrl;
  public $rateActiveSeoUrl;

  public function __construct(){
    $this->set_table();
    $this->get_nb_active_url();
    $this->get_nb_total_url();
    $this->get_active_seo_url_rate();
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

  private function get_nb_active_url(){
    global $wpdb;
    $this->nbActiveUrl = $wpdb->get_var("SELECT COUNT(id) FROM  $this->table WHERE nbcrawl > 0 AND seovisited > 0");
  }

  private function get_nb_total_url(){
    global $wpdb;
    $this->nbTotalUrl = $wpdb->get_var("SELECT COUNT(id) FROM  $this->table");
  }

  private function get_active_seo_url_rate(){
    $this->rateActiveSeoUrl = $this->nbActiveUrl / $this->nbTotalUrl;
  }


}
