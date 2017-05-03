<?php
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
* @author
* @see 
* @todo none
*/

//items4.php

$myItem = new Item(1,"Taco","Our Tacos are awesome!",4.95);
$myItem->addExtra("Sour Cream");
$myItem->addExtra("Cheese");
$myItem->addExtra("Guacamole");
$config->items[] = $myItem;

$myItem = new Item(2,"Sundae","Our Sundaes are awesome!",3.95);
$myItem->addExtra("Sprinkles");
$myItem->addExtra("Chocolate Sauce");
$myItem->addExtra("Nuts");
$config->items[] = $myItem;

$myItem = new Item(3,"Salad","Our Salads are awesome!",5.95);
$myItem->addExtra("Croutons");
$myItem->addExtra("Bacon");
$myItem->addExtra("Lemon Wedges");
$myItem->addExtra("Avacado");
$config->items[] = $myItem;


//create a counter to load the ids...
//$items[] = new Item(1,"Taco","Our Tacos are awesome!",4.95);
//$items[] = new Item(2,"Sundae","Our Sundaes are awesome!",3.95);
//$items[] = new Item(3,"Salad","Our Salads are awesome!",5.95);

/*
echo '<pre>';
var_dump($items);
echo '</pre>';
die;
*/


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











