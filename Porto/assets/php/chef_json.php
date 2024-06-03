<?php
 
require_once __DIR__ .  '/rest/dao/ChefDao.class.php';
// Create an instance of the ChefDao class
$chefDao = new ChefDao();

// Call the get_chefs_new function to retrieve chefs
$chefs = $chefDao->get_chefs_new();

// Convert the result to JSON
$jsonData = json_encode($chefs);

// Output the JSON data
echo $jsonData;
?>