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


$pre = "INSERT INTO book (studentId, amount, price) VALUES (?, ?, ?)";
$sql = $conn->prepare($pre);
$sql->bind_param("sss", $studentId, $amount, $price);


if ($sql->execute() === TRUE){
  echo "書籍數量 " . $amount . "本總共價格 " . $amount*$price . "元";
}else{
  echo "Error:" . $sql . "<br>" . $conn->error;
}

$conn->close();
// 你第45行應該要改成$sql->execute() === TRUE而不是$pre->execute()，因為實際插入資料的是$sql這個變數
// 我希望能夠統計加上這次統計後所有書籍的數量，這部分還可以去寫寫看
    ?>
</body>
</html>
