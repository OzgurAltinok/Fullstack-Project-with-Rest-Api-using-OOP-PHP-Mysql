<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "./database_config.php";
include_once "./models/Product.php";


$database = new Database();
$db = $database->getConnection();
$myData = $database->getDataFromTable();

$productExample = new Product("123", 456, "ozgur");  

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     //  echo json_encode($productExample->printAsJson());
     echo json_encode($myData);
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
     echo json_encode("post");
}