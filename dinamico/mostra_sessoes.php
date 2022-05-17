<?php 

session_start();

echo "<pre>";
print_r($_SESSION['frete']);
echo "</pre>";

echo "////////////////////////////////////////////////////";

echo "<br>";

foreach ($_SESSION['frete'] as $key => $value) {

    echo $key."<br>";

}


?>