<style>
	body {
		font-family: 'Roboto', sans-serif;
	}

	h2,h3,h4,h5,h6 {
		font-weight: 400;
	}

	#content {
		border: 1px solid #e7e7e7;
		max-width: 960px;
		margin: 0 auto;
		padding: 10px;
	}
</style>

<?php 
/**
 * order.php displays a menu of items and allows the user to create an order
 * 
 *
 * @package LARGE_PIECE_OF_PROGRAM
 * @subpackage SUB_PART_OF_PROGRAM
 * @author Mariam Abdelmohsen
 * @author Amy Bartolotta
 * @author Kevin Daniel
 * @author Jaewon Jeong
 * @version 1.0 2017/05/08 
 * @link https://jaewonjeong.com/scc/itc250/p2/food-truck.php
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see items.php
 * @todo 
 */ 

include 'items.php'; 

define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

if (isset($_REQUEST['act'])) {
	$myAction = (trim($_REQUEST['act']));
} else {
	$myAction = "";
}

switch ($myAction) { // check 'act' for type of process
	case "display": #2)Display what user ordered
	 	showData();
	 	break;
	default: #1)Ask user to place an order
	 	showForm();
}

function showForm() { // shows form so users can place an order
	global $config;
	
	echo '<form action="'.THIS_PAGE.'" method="post">';
	foreach ($config->items as $item) {
		echo '<h2>' . $item->name . '</h2>';
		echo '<h4>$' . $item->price . '</h4>';
		echo '<select name="item_'.$item->id.'">';
			for ($i = 0; $i <= 10; $i++) {
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
		echo '</select>';
		echo '<p>' . $item->description . '</p>';
		
		// if extras exist
		if (count($item->extras) > 0) {
			echo '<p>Add toppings of your choice</p>';
			foreach ($item->extras as $extra) {
				echo '<input type="checkbox" name="extra_" />' . $extra . '<br />';
			}
		}
		echo '<hr />';
	}   
	echo '<input type="submit" value="Order">';
	echo '<input type="hidden" name="act" value="display" />';
	echo '</form>';
}

function showData() { // shows what user submitted	
	$subtotal = 0;
	$total = 0;
	$thisItem = '';
	
	foreach($_POST as $name => $value) { // loop the form elements
        // if form name attribute starts with 'item_', process it
		
        if (substr($name, 0, 5) == 'item_') {
            // explode the string into an array on the "_"
            $name_array = explode('_', $name);

            // id is the second element of the array
			// forcibly cast to an int in the process
            $id = (int)$name_array[1];

			if ($value > 0) {
				$thisItem .= getItem($id, $value);
				$subtotal += calcSubtotal($id, $value);
			}
        }
    }
	
	$tax = calcTax($subtotal);
	$total = calcTotal($subtotal);
	
	echo '<h3>Your order has been placed.</h3>';
	echo '<p>' . $thisItem . '</p><hr />';
	echo '<p>Subtotal: $' . $subtotal . '</p>';
	echo '<p>Tax: $' . $tax . '</p>';
	echo '<p>Total: $' . $total . '</p>';
	echo '<p><a href="' . THIS_PAGE . '">Clear</a></p>';
}

// get item information
function getItem($id, $value) {
	global $config;
	
	$id -= 1; // since array index is 1 smaller
	$itemName = $config->items[$id]->name;
	$itemPrice = $config->items[$id]->price;
	
	return $itemName . ' x ' . $value . ' - $' . $itemPrice . '<br />';
}

// calculates subtotal price and returns result
function calcSubtotal ($id, $value) {
	global $config;
	
	$id -= 1; // since array index is 1 smaller
	$itemPrice = $config->items[$id]->price;
	$subtotal = number_format(($value * $itemPrice), 2);
	
	return $subtotal;
}

// calculates tax and returns result
function calcTax ($subtotal) {
	$tax = number_format(($subtotal * 0.101), 2);
	return $tax;
}

// calculates total price and returns result
function calcTotal ($subtotal) {
	$tax = calcTax($subtotal);
	$total = number_format(($subtotal + $tax), 2); // 10.1% Seattle sales tax, round total to 2 decimal places
	
	return $total;
}


?>