 //表單內容
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
　學號：<input type="text" name="studentId"><br>
　姓名：<input type="text" name="name"><br>
  星座：<input type="text" name="constellation"><br>
　<input type="submit" value="寄信"><br>
    
</form>


<?php
require( dirname( __FILE__ ) . './text.php' );    //寄信的內容，可自行更改
require( dirname( __FILE__ ) . './3_mail.php');

$studentId = $name = $constellation = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $studentId = test_input($_POST["studentId"]);
    $name = test_input($_POST["name"]);
    $constellation = test_input($_POST["constellation"]);
}

if(!empty($studentId)){
$mail->addAddress($studentId . "@ntu.edu.tw", $name);
$text = "你是" . $constellation . "座";
$mail->Body = $text;
$mail->AltBody = $text;

if(!$mail->send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
echo $studentId . '@ntu.edu.tw成功寄信';
  }
}
//試著直接引用3_mail.php的寄信程式，利用輸入的學號+"@ntu.edu.tw"當作email收件信箱寄信，內容須包括"你是XX座(星座)"

?>

