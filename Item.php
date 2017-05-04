<?php
//Item.php

/**
 * Class Item - Stores menu items
 *
 * More stuff about the class
 *
 *<code>
 * $myItem = new Item($ID,$Name,$Description,$Price);
 * $myItem->addExtra("Name of extra");
 *</code>
 *
 * @author Mariam Abdelmohsen
 * @author Amy Bartolotta
 * @author Kevin Daniel
 * @author Jaewon Jeong
 * @see 
 * @todo none
 */



class Item
{
    public $id = 0;
    public $name = '';
    public $description = '';
    public $price = 0;
    public $extras = array();
    
    public function __construct($id, $name, $description, $price)
    {
        $this->id = (int)$id;
        $this->name = $name;
        $this->description = $description;
        $this->price = (float)$price;
        
    }#end Item constructor
    
    public function addExtra($extra)
    {
        $this->extras[] = $extra;
        
    }#end addExtra()

}#end Item class
