<?php include "assets/header.html";?>
<html>
<body>
	<form method="post">
<label>Ваш логин:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
    </p>
<p>
    <label>Ваш пароль:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
    </p>
<p>
    <input type="submit" name="submit" value="Зарегистрироваться">
</p></form>
    </body>
    </html>
   <?php
    $conn = mysqli_connect("localhost", "root", "root", "web-php", 3307);
    if($_POST["login"] and $_POST["password"]){
    	$login = $_POST["login"];
    $password = $_POST["password"];
    $result = mysqli_query(
            $conn,
            "INSERT INTO users (`id`, `login`,`password`) VALUES (NULL,'$login', '$password')"
    );
}
?>