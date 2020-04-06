 //表單內容
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
　學號：<input type="text" name="studentId"><br>
　購買書的數目：<input type="text" name="amount"><br>
  一本書的價格：<input type="text" name="price"><br>
　<input type="submit" value="送出表單"><br>
    
</form>


<?php



$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*
// Create database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
*/
/*
// Create table
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
studentId VARCHAR(10) NOT NULL,
price INT(6),
amount INT(6),

reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "ALTER TABLE MyGuests ADD total_amount INT(6)";
if( $conn -> query($sql) === TRUE ){
}
*/



$studentId = $_POST["studentId"];
$amount = $_POST["amount"];
$price = $_POST["price"];
// prepare and bind
$stmt = $conn->prepare("INSERT INTO MyGuests (studentId, price, amount) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $studentId, $amount, $price);

$stmt -> execute();
$last_total_price_and_amount = $conn->query("SELECT total_amount, total_price FROM MyGuests");
$sql = "UPDATE MyGuests SET total_amount=($last_total_price_and_amount["total_amount"] + $amount) WHERE id= $conn->insert_id ";

$conn->query($sql);

echo "New records created successfully"<br> "Total_amount:" . $conn->query("SELECT total_amount, total_price FROM MyGuests");;




$stmt->close();



$conn->close();

?>

