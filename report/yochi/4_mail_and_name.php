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

?>

