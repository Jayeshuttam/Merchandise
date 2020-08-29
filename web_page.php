<?php
/**
 * Class WebPAge is used to output the HTML\CSS page.
 */
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
            ?>
<!DOCTYpe html>
<html lang="<?=$this->lang; ?>">

<head>
    <meta charset="utf-8">
    <title><?=$this->title; ?>
    </title>
    <meta name='description' value="<?=$this->description; ?>">
    <meta name="author" value="<?=$this->author; ?>">
    <link rel="icon" href="<?=$this->icon; ?>" type="image/jpeg">
    <link rel="stylesheet" href="css/styless.css">
</head>

<body>
    <header>

        <h1><img src="<?=$this->icon; ?>"
                alt="<?=COMPANY_NAME; ?>" style="width:3% ;">
            <?=$this->title; ?> -
            <?=WEB_SITE_NAME; ?>

        </h1>
    </header>
    <nav>

        <h1>THIS IS THE NAV BAR</h1>
    </nav>
    <main>

        <?="$this->content"; ?>

    </main>
    <footer>
        <h1>This is Footer</h1>
    </footer>
</body>

</html>
<?php
die(); //Stop program
        }
    }
}
