<?php

if (!isset($index_loaded)) {
    //prevent loading tools.php
    die('Direct Access to this file is forbidden');
}
/*
 * this file contains all project constants
 */

 //WEBPAGE INFO

//Define method is always global to everyone.
//
// define('WEB_SITE_NAME', 'ElectricScooters.com');
const WEB_SITE_NAME = 'ElectricScooters.com'; //Works same as define function
define('PAGE_DEFAULT_TITLE', 'Welcome to ElectricScooters.com');
define('PAGE_DEFAULT_DESCRIPTION', 'Electric Scooters.com has the widest collections of scooters 
and bicycles ,new ,used in Montreal');
define('PAGE_AUTHOR', 'Jayesh Uttam');
define('ADMIN_EMAIL', 'ITBoss@electricScooters.com');

//COMPANY INFO
define('COMPANY_NAME', 'Electric Scooters');
define('COMPANY_PHONE', '514-790-8389');
define('COMPANY_EMAIL', 'serviceScooter@electricScooter.com');
