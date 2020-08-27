<?php

require_once 'web_page.php';
$home_page = new Webpage();
// $home_page->title = 'ElectricScooter.com-Welcome!';
 $home_page->content = '<h2> Welcome my friends</h2>';
$home_page->render();
