<?php
// config.php - Database connection
$db_host = 'sql103.infinityfree.com';        
$db_user = 'if0_42712004';                 
$db_pass = 'PMGOChampion';
$db_name = 'if0_42712004_animal_adoption_db'; 

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection failed. Please try again later.");
}

mysqli_set_charset($conn, "utf8mb4");
?>