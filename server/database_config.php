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
            echo "Error creating table: " . $con->error;
        }
    }

    public function createAllTables($con)
    {
        $sqlCreateTable_Product = "CREATE TABLE PRODUCT(
        SKU INT(8) NOT NULL PRIMARY KEY,
        NAME VARCHAR(30) NOT NULL,
        PRICE INT(10) UNSIGNED NOT NULL
        )";

        $sqlCreateTable_Book = "CREATE TABLE BOOK(
        SKU INT(8) UNIQUE NOT NULL,
        NAME VARCHAR(30) NOT NULL,
        PRICE INT(10) UNSIGNED NOT NULL,
        WEIGHT INT(6) UNSIGNED NOT NULL,
        FOREIGN KEY(SKU) REFERENCES PRODUCT(SKU)
        )";

        $sqlCreateTable_Dvddisc = "CREATE TABLE DVDDISC(
        SKU INT(8) UNIQUE NOT NULL,
        NAME VARCHAR(30) NOT NULL,
        PRICE INT(10) UNSIGNED NOT NULL,
        SIZE INT(6) UNSIGNED NOT NULL,
        FOREIGN KEY(SKU) REFERENCES PRODUCT(SKU)
        )";

        $sqlCreateTable_Furniture = "CREATE TABLE FURNITURE(
        SKU INT(8) UNIQUE NOT NULL,
        NAME VARCHAR(30) NOT NULL,
        PRICE INT(10) UNSIGNED NOT NULL,
        DIMENSIONS VARCHAR(12) NOT NULL,
        FOREIGN KEY(SKU) REFERENCES PRODUCT(SKU)
        )";

        $this->executeCreateTable($con, $sqlCreateTable_Product);
        $this->executeCreateTable($con, $sqlCreateTable_Book);
        $this->executeCreateTable($con, $sqlCreateTable_Dvddisc);
        $this->executeCreateTable($con, $sqlCreateTable_Furniture);
    }

    public function getDataFromTable()
    {
        $con = mysqli_connect("localhost", "root", "", "example");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }


        if (mysqli_num_rows(mysqli_query($con, "SHOW TABLES LIKE 'PRODUCT'")) == 1) {
            // Table exists
        } else {
            // Create the book, dvddisc, furniture tables
            $this->createAllTables($con);
        }

        // Operate the getting data query
        $query  = "SELECT * FROM BOOK;";
        $query .= "SELECT * FROM DVDDISC;";
        $query .= "SELECT * FROM FURNITURE";

        // Create an array to handle incoming data from the server
        $arr = array();

        // Execute more than one query at once
        $result = mysqli_multi_query($con, $query);

        if ($result) {
            do {
                // If fails
                if (($result = mysqli_store_result($con)) === false && mysqli_error($con) != '') {
                    echo "Query failed: " . mysqli_error($con);
                }
                // If query works well
                else {

                    // Use this row array to push all objects added before
                    $row = mysqli_fetch_assoc($result);

                    if (array_key_exists("WEIGHT", $row)) {
                        array_push($arr, array(
                        'sku' => $row['SKU'],
                        'name' => $row['NAME'],
                        'price' => $row['PRICE'],
                        'weight' => $row['WEIGHT']
                    ));
                    } elseif (array_key_exists("SIZE", $row)) {
                        array_push($arr, array(
                        'sku' => $row['SKU'],
                        'name' => $row['NAME'],
                        'price' => $row['PRICE'],
                        'size' => $row['SIZE']
                    ));
                    } elseif (array_key_exists("DIMENSIONS", $row)) {
                        array_push($arr, array(
                        'sku' => $row['SKU'],
                        'name' => $row['NAME'],
                        'price' => $row['PRICE'],
                        'dimensions' => $row['DIMENSIONS']
                    ));
                    }
                }
            } while (mysqli_more_results($con) && mysqli_next_result($con)); // Continue until end of results
        } else {
            echo mysqli_error($con); // Failed to query
        }

        return $arr;
        mysqli_close($con);
    }

    public function insertDataToTable($sku, $name, $price)
    {
        $con = mysqli_connect("localhost", "root", "", "example");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {

            // Operate the inserting query
            $query = "INSERT INTO dvddisc (sku, name, price) VALUES ('$sku', '$name', '$price')";
            $result = mysqli_query($con, $query);
            mysqli_close($con);
        }
    }
}
