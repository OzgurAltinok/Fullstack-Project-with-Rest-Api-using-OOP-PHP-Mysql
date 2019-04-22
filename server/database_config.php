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

    public function getDataFromTable()
    {
        $con=mysqli_connect("localhost", "root", "", "example");
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // Perform queries
        $result = mysqli_query($con, "SELECT * FROM mytable");
        // mysqli_query($con,"INSERT INTO Persons (FirstName,LastName,Age)
        // VALUES ('Glenn','Quagmire',33)");

        $arr = array();

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($arr, array(
                'sku' => $row['sku'],
                'name' => $row['name'],
                'price' => $row['price'],
            ));
        }
        return $arr;
        mysqli_close($con);
    }
}
