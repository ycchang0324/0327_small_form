<?php

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
$mail->Username = 'b08901049@ntu.edu.tw'; // SMTP username
$mail->Password = 'Ycchang0324'; // 信箱密碼(自己測試就好，記得上傳時要把密碼刪掉)
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to

$mail->setFrom('b08901049@ntu.edu.tw', '二手書網站'); //寄件的Gmail
$mail->addAddress('ycchang0324@gmail.com', '張原嘉'); // 收件的信箱
$mail->isHTML(true); // Set email format to HTML

/*
    內文
*/

$mail->Subject = '二手書網站測試';
$mail->Body = $text;
$mail->AltBody = $text;


if(!debug_backtrace()){ //等同python的 if name == '__main__':
  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    echo 'Message has been sent';
  }
}
//ok，但如果要執行第三題的話，必須要把debug_backtrace()刪掉
?> 