 //表單內容
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
　學號：<input type="text" name="studentId"><br>
　姓名：<input type="text" name="name"><br>
 星座：<input type="text" name="constellation"><br>
　<input type="submit" value="寄信"><br>
    
</form>


<?php
    require( dirname( __FILE__ ) . './text.php' );    //寄信的內容，可自行更改



//試著直接引用3_mail.php的寄信程式，利用輸入的學號+"@ntu.edu.tw"當作email收件信箱寄信，內容須包括"你是XX座(星座)"


// variables
$studentId = $_POST["studentId"];
$constellation = $_POST["constellation"];

//設定time out
set_time_limit(120);
//echo !extension_loaded('openssl')?"Not Available":"Available";
 
$parentDirName = dirname(dirname(dirname(__FILE__)));  //回到根目錄的根目錄

require_once("$parentDirName/src/PHPMailer-5.2-stable/PHPMailerAutoload.php"); //記得引入檔案 
require("text.php");  //內文檔案，可自行更改

$mail = new PHPMailer;

//$mail->SMTPDebug = 3; // 開啟偵錯模式

$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'mail.ntu.edu.tw'; // Specify main and backup SMTP servers(台大的smtp)

$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'b08901097@ntu.edu.tw'; // SMTP username
$mail->Password = ''; // 信箱密碼(自己測試就好，記得上傳時要把密碼刪掉)
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to

$mail->setFrom('b08901097@ntu.edu.tw', '二手書網站'); //寄件的Gmail
$mail->addAddress( $studentId . '@ntu.edu.tw', 'XXX'); // 收件的信箱



$mail->isHTML(true); // Set email format to HTML

// todo begin
$text = '你是' . $constellation . '座';
// todo end

$mail->Subject = '二手書網站';
$mail->Body = $text;
$mail->AltBody = $text;

if(!$mail->send()) {
 echo 'Message could not be sent.';
 echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
 echo 'Message has been sent';
}

?>

