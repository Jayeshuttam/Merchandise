<?php

$index_loaded = true;

require_once 'web_page.php';
require_once 'tools.php';
require_once 'products.php';
require_once 'users.php';
// $op = $_GET['op'];
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = 0;
}

switch ($op) {
    case 0:HomePage();
    break;
case 1:
    $user = new users();
    $user->LoginPageDisplay();
break;
case 2:
    $user = new users();
    $user->LoginPageVerify();
break;

    case 100:
        $products = new Products();
        $products->Product_display();
    break;
    case 110:
        $products = new Products();
        $products->Product_List();
    break;
    case 111:
        $products = new Products();
        $products->Product_Catalogue();
    break;
    case 7:
        header('Content-type:application/msword');
        header('Content-Disposition:attachment;filename="my-icon.jpg"');
    break;
    case 50:
        DisplayServerErrorLog();
    break;
    case 3:
        $user = new users();
        $user->CreateRegistrationForm();
    break;

    default:
    crash(400, 'Invalid op code in index.php');
//     // header('HTTp/1.0 400 invalid op code');
//     //     // http_response_code(400);
//     //     echo 'invalid op code in index.php';
//     //     die();
// header('location:index.php'); //redirects to Homepage
break;
}

//display home page
function HomePage()
{
    $home_page = new Webpage();
    $home_page->title = 'Welcome!';
    $home_page->content = '<h2> Welcome my friends</h2>';
    $home_page->render();
}
/*
     * LoginPageDisplay.
     */

function DisplayServerErrorLog()
{
    $page = new webpage();
    $page->title = 'Server error log';
    $page->content = '';
    $page->content = file_get_contents('logs/errors.log');
    $page->render();
}
