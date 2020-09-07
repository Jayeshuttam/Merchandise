<?php

$index_loaded = true;
if (!isset($index_loaded)) {
    //prevent loading tools.php
    die('Direct Access to this file is forbidden');
}
function array_to_table($product)
{
    $ret = '';
    $ret .= '';
    $ret .= '<table style="background:palevioletred">
    <tr>
        <th>index\Key</th>
        <th>value</th>
    </tr>';
    foreach ($product as $key => $value) {
        $ret .= '<tr>
        <td style="background:white">'.$key.'</td>
        <td style="background:white">'.$value.'</td>';
        $ret .= '
    </tr>';
    }
    $ret .= '</table>';

    return $ret;
}
function array_to_ProductTable($product)
{
    $ret = '';
    $ret .= '';
    $ret .= '<table border=1 style="background:palevioletred">';

    $key = array_keys($product[0]);
    $ret .= '<tr>';
    foreach ($key as $value) {
        $ret .= '<td>'.$value.'</td>';
    }
    $ret .= '</tr>';
    foreach ($product as $key1 => $values) {
        $ret .= '<tr>';
        foreach ($values as $key2 => $value2) {
            $ret .= '
        <td style="background:white">'.$value2.'</td>';
        }
        $ret .= '</tr>';
    }
    $ret .= '</table>';

    return $ret;
}

function array_to_div($product)
{
    $ret = '';
    $ret .= '';

    foreach ($product as $key => $value) {
        if ($value['qty_in_stock'] > 0) {
            $ret .= '<div class="product">';
            $ret .= '';
            $ret .= '<img src="product_images/'.$product[$key]['pic'].'"></td></tr>';

            $ret .= '<p class ="name">'.$product[$key]['name'];
            $ret .= '<p class ="description">'.$product[$key]['description'];
            $ret .= '<p class ="price">'.$product[$key]['price'];
            $ret .= '</div>';
        }
    }

    return $ret;
}
function crash($code, $message)
{
    // http_response_code($code);
    //  mail(ADMIN_EMAIL, COMPANY_NAME.'server crashed code = '.$code, $message);
    $file = fopen('logs/errors.log', 'a+');
    fwrite($file, $message.'<br>');
    fclose($file);
    die($message);
}
/**
 * converts array into select list
 * It has 2 parameters array and name.
 */
function make_dropDown($array, $name, $prev_values = [])
{
    $out = '';

    $out .= '<select name="'.$name.' class="btn btn-secondary dropdown-toggle" id="'.$name.'">';
    foreach ($array as  $value) {
        $out .= '<option id="'.$value['id'].'" value="'.$value['code'].'">'.$value['name'].'</option>';
    }
    $out .= '</select>';

    return $out;
}
