<?php
class Chat {
    
    private $filename, $xml;
    
    public function __construct($filename) {
        $this->filename = $filename;
        $this->xml = simplexml_load_file($filename);
    }
    
    public function getMessages() {        
        $xml = simplexml_load_file($this->filename);
        $xml->saveXML($this->filename);
        //set variable for messages 
        $messages = $xml->message;
        
        return $messages;
    }
    public function newMessage($text, $username) {
        $date = date(r);
        
        $xml = simplexml_load_file($this->filename);
        
        //creating new message element
        $message = $xml->addChild("message");
        $message->addAttribute("id","");
        
        //creating new user element
        $user = $message->addChild("user");
        $user->addAttribute("id","");
        
        $user->addChild("username", $username);
        
        //adding nodes to message element
        $message->addChild("text", $text);
        $message->addChild("time", $date);
        
        //saving the xml file
        $xml->saveXML($this->filename);
        
        echo "<meta http-equiv='refresh' content='0'>";
    }
    public function getUser($username, $password) {
        $user = $this->xml->xpath("//user[username='".$username."']");
        
        $uname = (string) $user[0]->username;
        $color = (string) $user[0]->color;
        $login = ($password == $user[0]->password) ? true : false;
        
        $userDetails = ["username" => $uname, "color" => $color, "log" => $login];
        
        return $userDetails;
    }
    
    public function newUser($username, $password) {
        $user = $this->xml->addChild("user");
        
        $uname = $user->addChild("username", $username);
        $upass = $user->addChild("password", $password);
        $uname = $user->addChild("color", "#337ab7");
        
        $this->xml->saveXML($this->filename);
        
        return $this->getUser($username, $password);
    }
    
    public function userUpdate($username, $password, $color) {
        $user = $this->xml->xpath("//user[username='".$username."']");
        
        if (!empty($password)){
            $user[0]->password = $password;   
        }
        $user[0]->color = $color;
        
        $this->xml->saveXML($this->filename);
        
        return "Updates were saved.";
    }
}
?>