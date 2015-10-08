<?php
function page_tabs($current = 'crawllog') {
    $tabs = array(
        'crawllog'   => __("crawllog", 'plugin-textdomain'),
        'analytics'  => __("Analytics", 'plugin-textdomain')
    );
    $html =  '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ($tab == $current) ? 'nav-tab-active' : '';
        $html .=  '<a class="nav-tab ' . $class . '" href="?page=wp-seo-log%2Fadmin.php&tab=' . $tab . '">' . $name . '</a>';
    }
    $html .= '</h2>';
    echo $html;
}
