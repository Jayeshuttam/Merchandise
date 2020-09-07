<?php

if (!isset($index_loaded)) {
    //prevent loading tools.php
    die('Direct Access to this file is forbidden');
}

class Products
{
    public function Product_display()
    {
        $product = ['id' => 0,
    'name' => 'Black dress',
     'description' => 'Beautiful dress for womens',
     'price' => 99.99,
    ];
        $page = new Webpage();
        $page->title = 'Product Description -'.$product['name'];

        $page->content .= array_to_table($product);
        $page->render();
    }

    public function Product_List()
    {
        $products = [
            [
                'id' => 0,
                'name' => 'Red Jersey',
                'description' => 'Manchester United Home Jersey, red, sponsored by Chevrolet',
                'price' => 59.99,
                'pic' => 'red_jersey.jpg',
                'qty_in_stock' => 200,
            ],
            [
                'id' => 1,
                'name' => 'White Jersey',
                'description' => 'Manchester United Away Jersey, white, sponsored by Chevrolet',
                'price' => 49.99,
                'pic' => 'white_jersey.jpg',
                'qty_in_stock' => 133,
            ],
            [
                'id' => 2,
                'name' => 'Black Jersey',
                'description' => 'Manchester United Extra Jersey, black, sponsored by Chevrolet',
                'price' => 54.99,
                'pic' => 'black_jersey.jpg',
                'qty_in_stock' => 544,
            ],
            [
                'id' => 3,
                'name' => 'Blue Jacket',
                'description' => 'Blue Jacket for cold and raniy weather',
                'price' => 129.99,
                'pic' => 'blue_jacket.jpg',
                'qty_in_stock' => 14,
            ],
            [
                'id' => 4,
                'name' => 'Snapback Cap',
                'description' => 'Manchester United New Era Snapback Cap- Adult',
                'price' => 24.99,
                'pic' => 'cap.jpg',
                'qty_in_stock' => 655,
            ],
            [
                'id' => 5,
                'name' => 'Champion Flag',
                'description' => 'Manchester United Champions League Flag',
                'price' => 24.99,
                'pic' => 'champion_league_flag.jpg',
                'qty_in_stock' => 321,
            ],
            [
                'id' => 6,
                'name' => 'Champion Flag',
                'description' => 'Manchester United Champions League Flag',
                'price' => 24.99,
                'pic' => 'champion_league_flag.jpg',
                'qty_in_stock' => 321,
            ],
        ];
        $page = new Webpage();
        $page->title = 'Product List';
        $page->description = 'Table of products we sell.';

        $page->content = array_to_ProductTable($products);
        $page->render();
    }

    public function Product_Catalogue($result = [], $prev_value = '', $error_message = '')
    {
        if ($result == [] && $error_message == '') {
            $page = new Webpage();
            $page->title = 'Product Catalogue ';
            $page->description = 'The list of currently available products';
            $DB = new db_pdo();
            $products = $DB->querySelect('Select * from products ');
            $page->content = <<<HTML
            <form action="index.php?op=6" method="POST">
            <input type="text" name="search" placeholder="Search">
            <input type="submit" value="search">
            </form>
            HTML;
            $page->content .= array_to_div($products);
            $page->render();
        } elseif ($error_message != '') {
            $page = new Webpage();
            $page->title = 'Product Catalogue ';
            $page->description = 'The list of currently available products';

            $page->content = $error_message;
            $page->render();
        } else {
            $page = new Webpage();
            $page->title = 'Product Catalogue ';
            $page->description = 'The list of currently available products';

            $page->content = <<<HTML
            <form action="index.php?op=6" method="POST">
            <input type="text" name="search" placeholder="Search" value="{$prev_value}">
            <input type="submit" value="search">
            </form>
            HTML;
            $page->content .= array_to_div($result);
            $page->render();
        }
    }

    public function search_products()
    {
        $result = [];
        $DB = new db_pdo();
        $search_query = '';
        $query = false;
        if (isset($_POST['search'])) {
            $search_query = $_POST['search'];
            $query = true;
        }
        $error_message = '';
        if ($query == true) {
            $result = $DB->querySelect("select * from products where description like '%$search_query%' OR name like '%$search_query%'");
            // echo "$DB->querySelect('select * from products where description like '$search_query%' OR name like '$search_query%'')";

            if ($result == []) {
                $error_message = 'Product not found';
            }
        }

        $page = new Webpage();
        $page->title = 'Search Results';

        $this->Product_Catalogue($result, $search_query, $error_message);
        // $page->content = array_to_div($result);
            // $page->render();
    }
}
