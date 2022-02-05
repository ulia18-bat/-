<?php include "assets/header.html";?>
<html>
<body>
	<form method="post">
<label>логин<br></label>
    <input name="login" type="text" size="15" maxlength="15">
    </p>
<p>
    <label>пароль<br></label>
    <input name="password" type="password" size="15" maxlength="15">
    </p>
<p>
    <input type="submit" name="submit" value="войти">
</p></form>
    </body>
    </html>
    <?php
    $conn = mysqli_connect("localhost", "root", "root", "web-php", 3307);
    $login = empty($_POST['login'])?false:$_POST['login'];
     $password = empty($_POST['password'])?false:$_POST['password'];
    if($login and $password){
     $result = mysqli_query($conn,"SELECT count(*) FROM users WHERE `login`='$login' and `password`='$password'");
     $count= mysqli_fetch_array($result)[0];
     if ($count==1){
     	echo "правильно";
     }
     else {
     	echo "неправильно";
     }

 }

?>