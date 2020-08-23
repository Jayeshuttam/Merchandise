
<!DOCTYPE html>
<html lang="en">

<head>
    <title>First PHP</title>
</head>

<body>
<?php
echo 'Hello World';
$e = 'aiufbaioc';
$f = 10.8;
function test()
{
    echo '<br> Bye Byee World';
}
test();
$x = 25;
echo 'The value of is  $x'.'<br>';
// echo $GLOBALS[0];
//to check data type of the variables;
var_dump($e);

$arr = [12, 34, 56, 2, 34];
$arr[7] = 21;
// echo $arr[6];
$position = ['x' => 34, 'y' => 22.5, 'z' => -10, 'time' => '2h-1min-35sec']; //x,y,z co-ordinates

//statically printing array using index;
echo 'x='.$position['x'].'<br>';
echo 'y='.$position['y'].'<br>';
echo 'z='.$position['z'].'<br>';
echo 'time='.$position['time'].'<br>';
echo 'The position is an array of '.count($position).' elements<br>';
echo 'With for each loop<br>';

//printing array with user defined index
foreach ($position as $one_value) {
    echo '<br>'.$one_value;
}
/*To print index of each element of array
with user defined index as well as for standard array
*/
foreach ($position as $key => $one_value) {
    echo '<br>'.$key;
}
echo '<br>  <br>';
$position = [34, 22.5,  -10,  '2h-1min-35sec'];
//printing using standard for loop style
for ($i = 0; $i < count($position); ++$i) {
    echo $position[$i].'<br>';
}

?>
</body>

</html>