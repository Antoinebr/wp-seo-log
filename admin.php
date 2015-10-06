<h1>Analyse </h1>
<?php require ('wpseolog-analytics.class.php');

$analytics = new wpseologanalytics();

$crawledUrls = $analytics->get_new_urls_crawled();

foreach($crawledUrls as $crawledUrl){
  echo 'URL '.$crawledUrl->url.'</br>';
  echo 'RESCODE '.$crawledUrl->rescode.'</br>';
  echo 'NBCRAWL '.$crawledUrl->nbcrawl.'</br>';
  if($crawledUrl->seovisited > 1){ echo 'SEOACTIVE : TRUE </br>';}else{echo 'SEOACTIVE : FALSE </br>';}
  echo "<hr>";
}

echo $analytics->get_nb_active_url();

?>
