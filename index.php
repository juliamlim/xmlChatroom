<?php
session_start();

$page_title = "Chatrooms";
require_once "includes/header.php";

if (isset($_SESSION["user"])){
    if(isset($_POST["createChat"])){
        $filename = uniqid();
        $newChat = fopen("xml/".$filename.".xml","w");
        fwrite($newChat, "<?xml version='1.0' encoding='UTF-8'?>");
        fwrite($newChat, "<conversation id='".$filename."'>");
        fwrite($newChat, "<name>".$_POST["chatname"]."</name>");
        fwrite($newChat, "</conversation>");
    }
?>
        <span type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#chatModal">New Chat</span>
        <div class="modal fade" id="chatModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">New Chat</h4>
                    </div>
                    <form action="index.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Chat Name</label>
                                <input class="form-control" type="text" id="chatname" name="chatname" placeholder="Give this chat a name" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="createChat" value="Create" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br>
        <?php
            $chats = glob('xml/*.xml');
            
            foreach($chats as $c) {
                $xml = simplexml_load_file($c);
                if($xml->getName() == 'users') {
                    continue;
                }
                echo "<form class='form-group' action='chat.php' method='post'><input class='btn btn-info' type='submit' name='chat' value='".$xml->name."'><input type='hidden' name='xml' value='".$c."'></form>";
            }
}
require_once "includes/footer.php";
?>