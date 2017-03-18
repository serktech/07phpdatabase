<?php
//filename:function-library.php
include "function-library.php";

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "employeedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//url 01.readdatabase.php?lastname=J
//url 01.readdatabase.php
//url 01.readdatabase.php?lastname=J&age32

$lname = getOption("lastname", '');
$age = getOption("age", 0);
if (isset($_GET["lastname"])) {
    $lname = $_GET["lastname"];
}


if ($lname == "") {
    $where = "1 = 1";
} else {
    $where = "lastname like '$lname%'";
}

$where = $where . " AND age >=$age";

$sql = "SELECT id, firstname, age, lastname 
        FROM employees
        where $where
        ORDER by lastname";
echo $sql;

$result = $conn->query($sql);
echo '<hr>';
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]
            . " - Name: "
            . $row["firstname"]
            . " "
            . $row["lastname"]
            . " "
            . $row["age"]
            . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>