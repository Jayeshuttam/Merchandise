<?php
$name = 'Jayesh Uttam';
$age = 22;
$city = 'Montreal';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Exercise - First Page</title>
</head>

<body>

    <h1>Presentation</h1>

    <p>
        Hello my name is <b>
            <?= $name; ?></b> and I <b><?= $age; ?></b> years old. <br>
        I live in the city of <b><?= $city; ?></b>.
    </p>
</body>

</html>