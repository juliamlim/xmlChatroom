<?php 
$page_name = "Chatroom";
session_start();
$_SESSION["username"] = "user1234";

include_once "classes/Chat.php";
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>XML <?php echo $page_name;?></title>
    </head>

    <body>
        <h1><?php echo $page_name;?></h1>
        <p>Welcome back <?php echo $_SESSION["username"]?>!</p>
    </body>
</html>