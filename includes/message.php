        <form class="clear" id="postMessage" action="chat.php" method="post">
            <div class="form-group">
                <label for="message">Message</label><br>
                <textarea class="form-control" id="message" name="message"></textarea>
            </div>
            <input class="btn btn-default" type="submit" name="send" value="Send">
        </form>
        <?php
        if (isset($_POST['send'])) {
            $chat->newMessage($_POST['message'],$_SESSION["user"]["username"]);
        }
        ?>