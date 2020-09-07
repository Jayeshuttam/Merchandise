<?php ?>
<!DOCTYpe html>
<html lang="<?=$this->lang; ?>">

<head>
    <meta charset="utf-8">
    <title><?=$this->title; ?>
    </title>
    <meta name='description' value="<?=$this->description; ?>">
    <meta name="author" value="<?=$this->author; ?>">
    <link rel="icon" href="<?=$this->icon; ?>" type="image/jpeg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styless.css">
</head>

<body>
    <header>

        <h1>

            <?=WEB_SITE_NAME; ?>

        </h1>
    </header>
    <nav>


        <a href="http://w12php/index.php?op=0">Home</a>
        <a href="http://w12php/index.php?op=110">Product List</a>
        <a href="http://w12php/index.php?op=111">Product Catalogue</a>
        <?php
        if (isset($_SESSION['user_name'])) {
            echo $_SESSION['user_name'];
            echo  '<a href="http://w12php/index.php?op=5">Logout</a>';
        } else {
            echo '<a href="http://w12php/index.php?op=1">Login</a>';
        }
         ?>
        <!-- employees only -->

        <?php
        if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == 'employee' && $_SESSION['user_level'] != null) {
            echo '<a href="http://w12php/index.php?op=50">Server logs</a>';
            echo'<a href="http://w12php/index.php?op=51">List Users</a>';
        }
        ?>
        <a href="http://w12php/index.php?op=3">Register</a>



    </nav>
    <main style="overflow:auto">
        <h1>
            <?=$this->title; ?>

        </h1>
        <?="$this->content"; ?>

    </main>
    <footer>
        <h1>This is Footer</h1>
        <a href="index.php?op=7">Download Word</a>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
</script>

</html>