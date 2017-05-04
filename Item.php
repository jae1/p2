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

/*
class Item
{
    public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
    public $Extras = array();
    
    public function __construct($ID,$Name,$Description,$Price)
    {
        $this->ID = (int)$ID; //kd - cast to integer
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = (float)$Price; //kd - cast to float
        
    }#end Item constructor
    
    public function addExtra($extra)
    {
        $this->Extras[] = $extra;
        
    }#end addExtra()

}#end Item class
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
