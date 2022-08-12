<?php
session_start();
// connect to database
$conn = mysqli_connect("localhost", "root", "", "blogsystem");

if (!$conn) {
	die("Error connecting to database: " . mysqli_connect_error());
}

define('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://localhost/blogsystem/');
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">