 //表單內容
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
$dbname = "mydb";

///////////////////////////////////////////////////////////////////////////////////////
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
///////////////////////////////////////////////////////////////////////////////////////

/*
// sql to create table "book"
$sql = "CREATE TABLE book (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
studentId VARCHAR(30) NOT NULL,
amount INT(6) NOT NULL,
price INT(6) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table \"book\" created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
*/




// prepare and bind
$stmt = $conn->prepare("INSERT INTO book (studentId, amount, price) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $studentId, $amount, $price);

// set parameters and execute
$studentId = $_POST["studentId"];
$amount = $_POST["amount"];
$price = $_POST["price"];

$stmt->execute();

// echo "New records created successfully";


// return the value of total_amount and total_price
// modified from mysql tutorial_8.php

$sql = "SELECT amount, price FROM book";
$result = $conn->query($sql);
$total_amount = 0;
$total_price = 0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $total_amount += $row["amount"];
        $total_price += $row["amount"] * $row["price"];
    }
    echo "書籍數量" . $total_amount . "本總共價格" . $total_price . "元" ;
} else {
    echo "書籍數量0本總共價格0元";
}



$stmt->close();
$conn->close();
?>

