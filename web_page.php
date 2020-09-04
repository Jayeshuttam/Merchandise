<?php
/**
 * Class WebPAge is used to output the HTML\CSS page.
 */
if (!isset($index_loaded)) {
    //prevent loading tools.php
    die('Direct Access to this file is forbidden');
}
require_once 'global_defines.php';
require_once 'index.php';
class Webpage
{
    public $title = PAGE_DEFAULT_TITLE;
    public $description = '';
    public $author = 'Jayesh Uttam';
    public $lang = 'en-CA';
    public $icon = 'my-icon.jpg';
    public $css = 'css\styless.css';
    /// public $content = '<h2>Welcome to Electric scooters.com </h2>';
    public $content = '';

    /**
     * the constructor.
     */
    public function __construct()
    {
    }

    public function render()
    {
        if ($this->content == '') {
            //errr,,for checking if there is content in the page
            http_response_code(500);

            //  mail(ADMIN_EMAIL, 'Error in the web page', 'No content set in function render()');
            die('Sorry we have a problem !!');
        } else {
            $this->title .= ' - '.COMPANY_NAME;
            if ($this->lang == 'en-CA') {
                require_once 'template.php';
            } elseif ($this->lang == 'fr-CA') {
                require_once 'template.php';
            } else {
                crash(400, 'Language not supoorted');
            }

            die(); ?>

<?php
die(); //Stop program
        }
    }
}
