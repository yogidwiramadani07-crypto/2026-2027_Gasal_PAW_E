<?php
//Soal 1
//ini non embedded script = Soal 3
echo "Hello World".'<br> <br>';
?>

<DOCTYPE html>
<html>
<body>
	<?php
	//Soal 2
    //ini embedded script = Soal 3
    echo "Hello World".'<br> <br>';
	?>
</body>
</html>

<?php
//Soal 4
$color = "silver";
$COLOR = "white";
echo "My car is $color" . '<br>' . "My house is $COLOR" . "<br> <br>";
?>

<?php
//Soal 5
$greeting = "Hello World";
echo "$greeting <br> <br>";
?>

<?php
//Soal 6
$txt = "W3Schools.com";
echo "i love $txt ! <br> <br>";
?>

<?php
//Soal 7
$x = 5;
$y = 7;
echo "$x + $y <br> <br>";
?>

<?php
//Soal 8
$string = "Hello World!";
echo strlen($string) . "<br> <br>";
?>

<?php
//Soal 9
$string = "Hello World!";
echo str_word_count($string) . "<br> <br>";
?>

<?php
//Soal 10
$string = "Hello World!";
echo strrev($string) . "<br> <br>";
?>

<?php
//Soal 11
$string = "Hello world!";
$posisi = strpos($string, "world");
echo $posisi . "<br> <br>";
?>


<?php
//Soal 12
$string = "Hello world!";
$hasil = str_replace("world", "Dolly", $string);
echo $hasil . "<br> <br>";
?>

<?php
//Soal 13
function writeMsg() {
    echo "Hello world! <br> <br>";
}
writeMsg();
?>

<?php
//Soal 14
//function familyName($fname) {
   //echo "$fname <br>";
//}
//familyName("Jani");
//familyName("Hege");
//familyName("Stale");
//familyName("Kai Jim");
//familyName("Borge");
?>

<?php
//Soal 15
function familyName($fname, $year) {
    echo "$fname in $year <br> <br>";
}
familyName("Hege born", 1975);
familyName("Stale born", 1978);
familyName("Kai Jim born", 1983);
?>

<?php
//Soal 16
function setheight($minheight = 50) {
   echo "The height is: $minheight <br> <br>";
}
setheight();
?>

<?php
//Soal 17
function sum($x, $y) {
    $z = $x + $y;
   echo "$x + $y = $z <br>";
}
sum(5, 10);
sum(7, 13);
sum(2, 4);
?>
