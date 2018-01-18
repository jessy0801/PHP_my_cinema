<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="login.php" method="post" >
    <label>User :</label><input type="text" name="user" title="username">
    <label>Password :</label><input type="password" name="pass" title="password">
    <input type="submit" value="Connection">
</form>
<?php
$nd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'root', '080176');
if ($_POST['user'] != NULL && $_POST['pass'] != NULL) {
    crypt($_POST['user']);
}
    ?>
</body>
</html>
