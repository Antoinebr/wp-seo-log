<?php

class wpseologanalytics{

  private $table;
  public $nbActiveUrl;
  public $nbTotalUrl;
  public $rateActiveSeoUrl;
  public $nbTotalGoogle200;
  public $nbTotalGoogle301;
  public $nbTotalGoogle302;
  public $nbTotalGoogle404;
  public $nbTotalGoogle500;
  public $fromNbDaysInt;

  // le constructeur prend en paramètre un INT correspondant au nombre de jours entre maintenant et x
  public function __construct($fromNbDaysInt){

    $this->fromNbDaysInt = $fromNbDaysInt;

    $this->set_table();

    $this->set_nb_active_url();
    $this->set_nb_total_url();
    $this->set_active_seo_url_rate();

    $this->set_nb_200_google();
    $this->set_nb_301_google();
    $this->set_nb_302_google();
    $this->set_nb_404_google();
    $this->set_nb_500_google();
  }

  private function set_table(){
    global $wpdb;
    $this->table = $wpdb->prefix."wpseolog";
  }

  // renvoit un Array contenant les urls crawlés par Google entre maintenent et $fromNbDaysInt
  public function get_new_urls_crawled(){
    global $wpdb;
    $result = $wpdb->get_results( "SELECT * FROM $this->table WHERE nbcrawl > 0 AND date > (NOW() - INTERVAL $this->fromNbDaysInt DAY)");
    return $result;
  }

  private function set_nb_active_url(){
    global $wpdb;
    $this->nbActiveUrl = $wpdb->get_var("SELECT COUNT(id) FROM  $this->table WHERE nbcrawl > 0 AND seovisited > 0 AND date > (NOW() - INTERVAL $this->fromNbDaysInt DAY)");
  }

  private function set_nb_total_url(){
    global $wpdb;
    $this->nbTotalUrl = $wpdb->get_var("SELECT COUNT(id) FROM  $this->table WHERE date > (NOW() - INTERVAL $this->fromNbDaysInt DAY)");
  }

  private function set_active_seo_url_rate(){
    $this->rateActiveSeoUrl = $this->nbActiveUrl / $this->nbTotalUrl;
  }

  private function set_nb_200_google(){
    $this->nbTotalGoogle200 = $this->check_res_code('200');
  }

  private function set_nb_301_google(){
    $this->nbTotalGoogle301 = $this->check_res_code('301');
  }

  private function set_nb_302_google(){
    $this->nbTotalGoogle302 = $this->check_res_code('302');
  }

  private function set_nb_404_google(){
    $this->nbTotalGoogle404 = $this->check_res_code('404');
  }

  private function set_nb_500_google(){
    $this->nbTotalGoogle500 = $this->check_res_code('500');
  }

  private function check_res_code($rescode){
    global $wpdb;
    return $wpdb->get_var( "SELECT COUNT(*) FROM $this->table WHERE date < (NOW() - INTERVAL 1 DAY) AND rescode = $rescode");
  }


}
