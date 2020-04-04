// 這是範例程式碼，詳細內容可以去w3school/php/database/select data

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "northwind";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br>" . "supplier_ids: " . $row["supplier_ids"]. "  id: " . $row["id"]. "  product_code: " . $row["product_code"]. "  product_name: " . $row["product_name"]. "  description: " . $row["description"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>