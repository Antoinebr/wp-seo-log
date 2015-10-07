<h1>Analyse </h1>
<?php require ('wpseolog-analytics.class.php');

$analytics = new wpseologanalytics(10);

$crawledUrls = $analytics->get_new_urls_crawled();

foreach($crawledUrls as $crawledUrl){
  echo 'URL '.$crawledUrl->url.'</br>';
  echo 'RESCODE '.$crawledUrl->rescode.'</br>';
  echo 'NBCRAWL '.$crawledUrl->nbcrawl.'</br>';
  if($crawledUrl->seovisited > 1){ echo 'SEOACTIVE : TRUE </br>';}else{echo 'SEOACTIVE : FALSE </br>';}
  echo "<hr>";
}

?>

<h2>Nb URL Actives <?= $analytics->nbActiveUrl; ?></h2>

<h2>Nb Total URL <?= $analytics->nbTotalUrl; ?></h2>

<h2>Active rate <?= $analytics->rateActiveSeoUrl; ?> %</h2>

<h2>NB Total code 200 : <?= $analytics->nbTotalGoogle200; ?></h2>

<h2>NB Total code 301 : <?= $analytics->nbTotalGoogle301; ?></h2>

<h2>NB Total code 302 : <?= $analytics->nbTotalGoogle302; ?></h2>

<h2>NB Total code 404 : <?= $analytics->nbTotalGoogle404; ?></h2>

<h2>NB Total code 500 : <?= $analytics->nbTotalGoogle500; ?></h2>
