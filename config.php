<?php
// config.php - Database connection
$db_host = '.infinityfree.com';        
$db_user = 'UserName';                 
$db_pass = 'Password';
$db_name = 'if00xx_animal_adoption_db'; 

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection failed. Please try again later.");
}

mysqli_set_charset($conn, "utf8mb4");
?>
