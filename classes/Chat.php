<?php
class Chat {
    
    private $filename, $xml;
    
    public function __construct($filename) {
        $this->filename = $filename;
        // ------ For DOM
        ///*
        $this->xml = new DOMDocument('1.0','UTF-8'); 
        
        $this->xml->preserveWhiteSpace = false;
        $this->xml->formatOutput = true;
        //*/
        // ------ For simplexml 
        //$this->xml = simplexml_load_file($filename);
    }
    public function newArticle($article,$link,$author,$pubDate,$description) {
        // ------ For DOM
        ///*
        //loading the xml
        $this->xml->load($this->filename);
        //getting the channel node
        $channel = $this->xml->getElementsByTagName("channel")->item(0);
        //creating new item element
        $item = $this->xml->createElement("item");
        //adding nodes to item element
        $article = $this->xml->createElement("article", $article);
        $item->appendChild($article);
        $link = $this->xml->createElement("link", $link);
        $item->appendChild($link);
        $author = $this->xml->createElement("author", $author);
        $item->appendChild($author);
        $pubDate = $this->xml->createElement("pubDate", $pubDate);
        $item->appendChild($pubDate);
        $description = $this->xml->createElement("description", $description);
        $item->appendChild($description);
        
        //adding item node to channel
        $channel->appendChild($item);
        
        //limiting to 5 items
        $items = $this->xml->getElementsByTagName("item");
        $itemCount = $items->length;
        
        while ($itemCount > 5) {
            $oldItem = $items->item(0);
            $oldItem->parentNode->removeChild($oldItem);
            $itemCount = $items->length;
        }
        
        //saving the xml file
        $this->xml->save($this->filename);
        //*/
        
        // ------ For simpleXML
        /*
        $xml = $this->xml;
        
        //creating new item element
        $item = $xml->channel->addChild("item");
        
        //adding nodes to item element
        $item->addChild("article", $article);
        $item->addChild("link", $link);
        $item->addChild("author", $author);
        $item->addChild("pubDate", $pubDate);
        $item->addChild("description", $description);
        
        //limiting to 5 items
        $itemCount = count($xml->channel->item);

        while($itemCount > 5){
            unset($xml->channel[0]->item[0]);
            $itemCount = count($xml->channel->item);
        }
        
        //saving the xml file
        $xml->saveXML($this->filename);
        */
    }
}
?>