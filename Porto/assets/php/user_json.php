<?php
 
require_once __DIR__ .  '/rest/dao/UserDao.class.php';

$userDao = new UserDao();

$user= $UserDao->get_users_new();
// Convert the result to JSON
$jsonData = json_encode($user);

// Output the JSON data
echo $jsonData;
?>