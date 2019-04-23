<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "./database_config.php";
include_once "./models/Product.php";


$database = new Database();
$db = $database->getConnection();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Get data from the db table
    $myData = $database->getDataFromTable();

    // Request to get all data as a json
    echo json_encode($myData);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pull the posted json 
    $content = file_get_contents('php://input');

    //If data is okay
    if ($content !== false) {
         // Decode the content data
        $json = json_decode($content, true);

        // Create a new Product instance
        $productExample = new Product($json['sku'], $json['name'], $json['price']);
        
        // Insert it in db table
        $database->insertDataToTable($productExample->getSku(), $productExample->getName(), $productExample->getPrice());

        // Request to get the data added just now as a json
        echo $content;
    } else {
        error_log("Failed to Post Data!");
    }
}
