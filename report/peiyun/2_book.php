<!DOCTYPE HTML>
<html>
<body>
 <?php echo "表單內容" ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
　學號：<input type="text" name="studentId"><br>
　購買書的數目：<input type="text" name="amount"><br>
  一本書的價格：<input type="text" name="price"><br>
　<input type="submit" value="送出表單"><br>
    
</form>
<?php
$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "myDB";
$studentId = $amount = $price = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $studentId = test_input($_POST["studentId"]);
  $amount = test_input($_POST["amount"]);
  $price = test_input($_POST["price"]);
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table = "CREATE TABLE book (
id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
studentId VARCHAR(10) NOT NULL,
amount TINYINT NOT NULL,
price SMALLINT NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if($conn->query($table) === TRUE) {
  echo "Table MyGuests created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

$pre = "INSERT INTO book (studentId, amount, price) VALUES (?, ?, ?)";
$sql = $conn->prepare($pre);
$sql->bind_param("sss", $studentId, $amount, $price);
$sql->execute();

if ($conn->query($pre) == TRUE){
  echo "書籍數量 " . $amount . "本總共價格 " . $amount*$price . "元";
}else{
  echo "Error:" . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
</body>
</html>
