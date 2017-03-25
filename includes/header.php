<?php 
$page_name = "XML Chatroom";

require_once "classes/Chat.php";
$user = new Chat("xml/Users.xml");

if(isset($_POST["login"])) {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        
        //function to create array of info from xml and check if passwords match
        $login = $user->getUser($_POST["username"], $_POST["password"]);
        
        if ($login["log"]) {
            $_SESSION["user"] = $login;
            echo "<meta http-equiv='refresh' content='0'>";
            exit;
        } else {
            $loginErr = "Invalid username or password.";
        }
    } else {
        $loginErr = "Invalid username or password.";
    }
}
if(isset($_POST["register"])) {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        //this sets the new user and also returns an array of information
        $newUser = $user->newUser($_POST["username"], $_POST["password"]);
        $_SESSION["user"] = $newUser;
        echo "<meta http-equiv='refresh' content='0'>";
        exit;
    } else {
        $loginErr = "Invalid username or password.";
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page_title." | ".$page_name;?></title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <style>
            h2 {
                color: <?php echo $_SESSION["user"]["color"];?>;
            }
            #main .btn-info {
                margin-top: 15px;
                background-color: <?php echo $_SESSION["user"]["color"];?>;
                border-color: <?php echo $_SESSION["user"]["color"];?>;
            }
            #messages {
                overflow-y: scroll;
            }
            #messages .active {
                background-color: <?php echo $_SESSION["user"]["color"];?>;
                border-color: <?php echo $_SESSION["user"]["color"];?>;
            }
            .clear {
                clear: both;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><?php echo $page_name;?></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION["user"])) {?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <?php echo $_SESSION["user"]["username"]?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="settings.php">Settings</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="includes/logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php }?>
                </ul>
            </nav>  
        </header>
        <main class="container-fluid">
            <div class="col-xs-1 col-sm-2 col-md-3"></div>
            <div id="main" class="col-xs-12 col-sm-8 col-md-6">
    <?php 
    if (!isset($_SESSION["user"])){
        $page_title = "Login";
    ?>
        <h2><?php echo $page_title;?></h2>
    <?php
        include_once "includes/login.php";
    } else {
        echo "<h2>".$page_title."</h2>";
    }?>
    