<?php
//items3.php

//kd - this is the ITC250 Food Truck Starter Code with the item class code moved to its own file

include includes/Item.php;
include includes/Order.php;

$myItem = new Item(1,"Taco","Our Tacos are awesome!",4.95);
$myItem->addExtra("Sour Cream");
$myItem->addExtra("Cheese");
$myItem->addExtra("Guacamole");
$items[] = $myItem;

$myItem = new Item(2,"Sundae","Our Sundaes are awesome!",3.95);
$myItem->addExtra("Sprinkles");
$myItem->addExtra("Chocolate Sauce");
$myItem->addExtra("Nuts");
$items[] = $myItem;

$myItem = new Item(3,"Salad","Our Salads are awesome!",5.95);
$myItem->addExtra("Croutons");
$myItem->addExtra("Bacon");
$myItem->addExtra("Lemon Wedges");
$myItem->addExtra("Avacado");
$items[] = $myItem;


//create a counter to load the ids...
//$items[] = new Item(1,"Taco","Our Tacos are awesome!",4.95);
//$items[] = new Item(2,"Sundae","Our Sundaes are awesome!",3.95);
//$items[] = new Item(3,"Salad","Our Salads are awesome!",5.95);

echo '<pre>';
var_dump($items);
echo '</pre>';
