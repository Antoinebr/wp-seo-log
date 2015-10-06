<?php

class wpseolog{

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

  public function is_google_bot(){
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    return strpos($userAgent,'googlebot') !== false;
  }

  private function get_current_url(){
    $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $url;
  }

  private function get_current_date(){

    return date("Y-m-d G:i:s");
  }

  private function get_curent_url_id(){
    return $this->currentUrlID;
  }

  private function is_banned_url(){
    if(strpos($this->get_current_url(),'admin-ajax.php')){return true;}
    if(strpos($this->get_current_url(),'wp-cron.php')){return true;}
  }

  public function is_new_url(){
    global $wpdb;
    $result = $wpdb->get_results( "SELECT id, url FROM $this->table WHERE url = '".$this->get_current_url()."' ");
    if(!empty($result)){
      $this->currentUrlID = $result[0]->id;
      $this->isNewUrl = false; return false;
    }else{
      $this->isNewUrl = true; return true;
    }
  }

  public function is_seo_visit(){
    if(isset($_SERVER['HTTP_REFERER'])) $referer = $_SERVER['HTTP_REFERER'];
    return mb_eregi('www.google.', $referer);
  }

  private function record_url($fromSeo = false){
    if($this->is_banned_url()){return false;}
    global $wpdb;
    $strQuery = "INSERT INTO ".$this->table." (url, date, rescode, seovisited) VALUES ( %s, %s, %s, %s )";
    $wpdb->query( $wpdb->prepare( $strQuery, $this->get_current_url(), $this->get_current_date(), http_response_code(), $fromSeo ) );
  }

  private function update_url($from = null){
    global $wpdb;
    if($from == "googlebot"){
      $wpdb->query("UPDATE $this->table SET nbcrawl=nbcrawl+1 WHERE id = $this->currentUrlID ");
    }else{
      $wpdb->query("UPDATE $this->table SET seovisited=seovisited+1 WHERE id = $this->currentUrlID ");
    }
  }

  public function record_crawl(){
    $this->is_new_url();

    if($this->is_google_bot() && $this->isNewUrl){
      $this->record_url();
    }elseif($this->is_google_bot() && !$this->isNewUrl){
      $this->update_url('googlebot');
    }

    if(!$this->is_seo_visit() && $this->isNewUrl){
      $formSEo = true; $this->record_url($formSEo);
    }elseif(!$this->is_seo_visit() && !$this->isNewUrl){
      $this->update_url('seovisit');
    }
  }


}
