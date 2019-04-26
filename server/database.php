<?php
class Database
{
    private $host = "localhost";
    private $db_name = "example";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public function executeCreateTable($con, $tableToCreate)
    {
        if ($con->query($tableToCreate) === true) {
            // Table Product created successfully
        } else {
            console.log("Error creating table: " . $con->error);
        }
    }

    public function createAllTables($con)
    {
        // Sql code for creating all tables
        $sqlCreateTable_Book = "CREATE TABLE BOOK(
        SKU INT(8) UNIQUE NOT NULL,
        NAME VARCHAR(30) NOT NULL,
        PRICE INT(10) UNSIGNED NOT NULL,
        WEIGHT INT(6) UNSIGNED NOT NULL
        )";

        $sqlCreateTable_Dvddisc = "CREATE TABLE DVDDISC(
        SKU INT(8) UNIQUE NOT NULL,
        NAME VARCHAR(30) NOT NULL,
        PRICE INT(10) UNSIGNED NOT NULL,
        SIZE INT(6) UNSIGNED NOT NULL
        )";

        $sqlCreateTable_Furniture = "CREATE TABLE FURNITURE(
        SKU INT(8) UNIQUE NOT NULL,
        NAME VARCHAR(30) NOT NULL,
        PRICE INT(10) UNSIGNED NOT NULL,
        DIMENSIONS VARCHAR(12) NOT NULL
        )";

        // Create tables
        $this->executeCreateTable($con, $sqlCreateTable_Book);
        $this->executeCreateTable($con, $sqlCreateTable_Dvddisc);
        $this->executeCreateTable($con, $sqlCreateTable_Furniture);
    }

    public function executeAllQueries()
    {
        $con = mysqli_connect("localhost", "root", "", "example");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // Operate the getting data query
        $query1 = "SELECT * FROM BOOK";
        $query2 = "SELECT * FROM DVDDISC";
        $query3 = "SELECT * FROM FURNITURE";

        // Run Query 1
        $result = mysqli_query($con, $query1);

        // Create an array to store products
        $arr = array();

        // After execution of queries push them all into array
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($arr, array(
                'sku' => $row['SKU'],
                'name' => $row['NAME'],
                'price' => $row['PRICE'],
                'weight' => $row['WEIGHT']
            ));
        }

        // Run Query 2
        $result = mysqli_query($con, $query2);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($arr, array(
                'sku' => $row['SKU'],
                'name' => $row['NAME'],
                'price' => $row['PRICE'],
                'size' => $row['SIZE']
            ));
        }

        // Run Query 3
        $result = mysqli_query($con, $query3);


        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($arr, array(
                'sku' => $row['SKU'],
                'name' => $row['NAME'],
                'price' => $row['PRICE'],
                'dimensions' => $row['DIMENSIONS']
            ));
        }

        return $arr;
        mysqli_close($con);
    }

    public function getDataFromTable()
    {
        $con = mysqli_connect("localhost", "root", "", "example");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }


        if (mysqli_num_rows(mysqli_query($con, "SHOW TABLES LIKE 'BOOK'")) == 1) {
            // echo "Table exists";
        } else {
            // Create the book, dvddisc, furniture tables
            $this->createAllTables($con);
        }

        return $this->executeAllQueries();
        mysqli_close($con);
    }

    public function insertDataToTable($sku, $name, $price, $lastVal, $attributeName, $tableName)
    {
        $con = mysqli_connect("localhost", "root", "", "example");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {

            // Operate the inserting query
            $query = "INSERT INTO {$tableName} (sku, name, price, {$attributeName}) VALUES ('$sku', '$name', '$price', '$lastVal')";

            $result = mysqli_query($con, $query);
            mysqli_close($con);
        }
    }

    public function deleteDataFromTable($sku, $tableName)
    {
        $con = mysqli_connect("localhost", "root", "", "example");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {

            // Operate the deleting query
            $query = "DELETE FROM {$tableName} WHERE sku = '$sku'";
            $result = mysqli_query($con, $query);
            mysqli_close($con);
        }
    }

    public function getRequest()
    {
        // Get data from the db table
        $myData = $this->getDataFromTable();

        // Request to get all data as a json
        echo json_encode($myData);
    }


    //To make request from another port
    public function enableCorsAttack()
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
        header("Content-Type: application/json; charset=UTF-8");

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            }

            exit(0);
        }
    }
}
