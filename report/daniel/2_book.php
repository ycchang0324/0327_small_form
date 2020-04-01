 //表單內容
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
　學號：<input type="text" name="studentId"><br>
　購買書的數目：<input type="text" name="amount"><br>
  一本書的價格：<input type="text" name="price"><br>
　<input type="submit" value="送出表單"><br>
    
</form>


<?php

//todo


?>

