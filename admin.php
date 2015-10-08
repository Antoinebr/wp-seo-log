<h1>WP SEO LOG  </h1>
<?php
require ('wpseolog-analytics.class.php');
require ('utils/listtable.class.php');
require ('utils/wpseolog-listable.class.php');
require ('utils/tabs.php');

$analytics = new wpseologanalytics(10);


// Tabs
$tab = (!empty($_GET['tab']))? esc_attr($_GET['tab']) : 'Crawllog';
page_tabs($tab);

if($tab == 'crawllog' ) {
  require('analytics-tabs/crawls.php');
}
else {
  require('analytics-tabs/kpi.php');
}





?>
