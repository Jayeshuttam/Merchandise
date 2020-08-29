<?php

function array_to_table($product)
{
    $ret = '';
    $ret .= '';
    $ret .= '<table border=1 style="background:palevioletred">
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
    $ret .= '<table border=1 style="background:palevioletred">
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Description</th>
        <th>price</th>
        <th>pic</th>
        <th>stock</th>
    </tr>';
    foreach ($product as $key => $value) {
        $ret .= '<tr>';
        foreach ($value as$key2 => $value2) {
            $ret .= '
        <td style="background:white">'.$value2.'</td>';
        }
        $ret .= '
    </tr>';
    }
    $ret .= '</table>';

    return $ret;
}

function array_to_div($product)
{
    $ret = '';
    $ret .= '';

    foreach ($product as $key => $value) {
        $ret .= '<div class=product>';
        $ret .= '';
        $ret .= '<img src="product_images/'.$product[$key]['pic'].'"></td></tr>';

        $ret .= '<p class ="name">'.$product[$key]['name'];
        $ret .= '<p class ="description">'.$product[$key]['description'];
        $ret .= '<p class ="price">'.$product[$key]['price'];
        $ret .= '</div>';
    }

    return $ret;
}
