<?php

include_once "./database.php";
include_once "./models/Product.php";
include_once "./models/Book.php";
include_once "./models/Dvddisc.php";
include_once "./models/Furniture.php";


$database = new Database();

$database->enableCorsAttack();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  // Request to get the data added as a json
    $database->getRequest();

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pull the posted json
    $content = file_get_contents('php://input', true);

    //If data is okay
    if ($content !== false) {
        //  Decode the content data
        $json = json_decode($content, true);

        if (array_key_exists("weight", $json)) {

               // Create book obj if you send Weight attribute
            $book = new Book($json['sku'], $json['name'], $json['price'], $json['weight']);

            // Insert it in Book table
            $database->insertDataToTable($book->getSku(), $book->getName(), $book->getPrice(), $book->getWeight(), "weight", "book");
        } elseif (array_key_exists("size", $json)) {

               // Create book obj if you send Size attribute
            $dvddisc = new Dvddisc($json['sku'], $json['name'], $json['price'], $json['size']);

            // Insert it in Dvddisc table
            $database->insertDataToTable($dvddisc->getSku(), $dvddisc->getName(), $dvddisc->getPrice(), $dvddisc->getSize(), "size", "dvddisc");
        } elseif (array_key_exists("dimensions", $json)) {

               // Create book obj if you send Dimensions attribute
            $furniture = new Furniture($json['sku'], $json['name'], $json['price'], $json['dimensions']);

            // Insert it in Furniture table
            $database->insertDataToTable($furniture->getSku(), $furniture->getName(), $furniture->getPrice(), $furniture->getDimensions(), "dimensions", "furniture");
        }

        // Request to get the data added just now as a json
        $database->getRequest();

    } else {
        error_log("Failed to Post Data!");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    // Get posted object via axios
    $content = file_get_contents('php://input', true);

    //If data is okay
    if ($content !== false) {

        $json = json_decode($content, true);

        //Identify which kind of data is came
        if ($json['handlerType'] == "KG") {
            $myTableName = "BOOK";
        } elseif ($json['handlerType'] == "MB") {
            $myTableName = "DVDDISC";
        } elseif ($json['handlerType'] == "Dimensions") {
            $myTableName = "FURNITURE";
        }

        //Delete an instance from the specific table
        $database->deleteDataFromTable($json['sku'], $myTableName);
        
    }
}
