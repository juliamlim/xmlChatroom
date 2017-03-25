<?php
session_start();

if(isset($_POST["chat"])) {
    $_SESSION["chat"] = $_POST["chat"];
    $_SESSION["xml"] = $_POST["xml"];
}

$page_title = $_SESSION["chat"];
require_once "includes/header.php";

require_once "classes/Chat.php";
$chat = new Chat($_SESSION["xml"]);

$messages = $chat->getMessages();

if (isset($_SESSION["user"])){
?>
        <section id="messages">
        
        <?php
            foreach($messages as $m) {
                $user = $m->user->username;
            ?>
            <div class="clear list-group<?php echo ($m->user->username == $_SESSION["user"]["username"]) ? ' pull-right' : ' pull-left';?>">
                <p <?php if($m->user->username == $_SESSION["user"]["username"]){echo "style='text-align: right; margin:0'";}?>><?php echo $user?></p>
                <p class="list-group-item<?php if($m->user->username == $_SESSION["user"]["username"]){echo ' active';}?>"><?php echo $m->text;?></p>
            </div>
            <?php
            }?>
        </section>
<?php
    include "includes/message.php";
}
require_once "includes/footer.php";
?>