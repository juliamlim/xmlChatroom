<?php 
session_start();

$page_title = "Settings";
require_once "includes/header.php";
require_once "classes/Chat.php";
$update;
if (isset($_SESSION["user"]["username"])){
    if(isset($_POST["update"])){
        $update = $user->userUpdate($_SESSION["user"]["username"],$_POST["password"],$_POST["color"]);
        
        $_SESSION["user"] = $user->getUser($_SESSION["user"]["username"],$_POST["password"]);
        echo "<meta http-equiv='refresh' content='0'>";
        exit;
    }
?>
        <form action="settings.php" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-xs-4 control-label">Username</label>
                <div class="col-xs-6">
                    <p class="form-control-static"><?php echo $_SESSION["user"]["username"];?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-xs-4 control-label">Password</label>
                <div class="col-xs-6">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter a new password">
                </div>
            </div>
            <div class="form-group">
                <label for="color" class="col-xs-4 control-label">Color</label>
                <div class="col-xs-6">
                    <input type="color" class="form-control" id="color" name="color" value="<?php echo $_SESSION["user"]["color"];?>">
                </div>
            </div>
            <input class="btn btn-default pull-right clear" type="submit" name="update" value="Update" />
        </form><br><br>
<?php
        if(!empty($update)){echo "<p class='label label-success pull-right clear'>".$_POST['update_success']."</p>";}
}
require_once "includes/footer.php";
?>