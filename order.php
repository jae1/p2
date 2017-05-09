<?php 
/**
 * order.php displays a menu of items and allows the user to place an order
 * 
 *
 * @package SP17_ITC250
 * @subpackage FOOD_TRUCK
 * @author Mariam Abdelmohsen
 * @author Amy Bartolotta
 * @author Kevin Daniel
 * @author Jaewon Jeong <7904001@gmail.com>
 * @version 1.0 2017/05/08
 * @link https://jaewonjeong.com/scc/itc250/p2/food-truck.php
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see items.php
 * @todo none
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

/**
 * function showForm() shows a form so users can place an order
 *
 * uses global $config->items to pass in parameters
 *
 * <code>
 * showForm();
 * </code>
 *
 * @param global $config->items
 * @return none
 * @todo none
 */
function showForm() {
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

/**
 * function showData() shows the user's order 
 *
 * <code>
 * showData();
 * </code>
 *
 * @param none
 * @return none
 * @todo none
 */
function showData() {	
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
	$total = calcTotal($tax);
	
	echo '<h3>Your order has been placed.</h3>';
	echo '<p>' . $thisItem . '</p><hr />';
	echo '<p>Subtotal: $' . $subtotal . '</p>';
	echo '<p>Tax: $' . $tax . '</p>';
	echo '<p>Total: $' . $total . '</p>';
	echo '<p><a href="' . THIS_PAGE . '">Clear</a></p>';
}

/**
 * function getItem() gets item information
 *
 * <code>
 * $thisItem = getItem($id, $value);
 * </code>
 *
 * @param $id - the id of the item
 * @param $value - the number of that item ordered
 * @return string
 * @todo none
 */
function getItem($id, $value) {
	global $config;
	
	$id -= 1; // since array index is 1 smaller
	$itemName = $config->items[$id]->name;
	$itemPrice = $config->items[$id]->price;
	
	return $itemName . ' x ' . $value . ' - $' . $itemPrice . '<br />';
}

/**
 * function calcSubtotal($id, $value) calculates the subtotal of each item ordered
 *
 * <code>
 * $subtotal = calcSubtotal($id, $value);
 * </code>
 *
 * @param $id - the id of each item
 * @param $value - the number of each item ordered
 * @return $subtotal
 * @todo none
 */
function calcSubtotal ($id, $value) {
	global $config;
	
	$id -= 1; // since array index is 1 smaller
	$itemPrice = $config->items[$id]->price;
	$subtotal = number_format(($value * $itemPrice), 2);
	
	return $subtotal;
}

/**
 * function calcTax($subtotal) calculates the sales tax of subtotal
 *
 * <code>
 * $tax = calcTax($subtotal);
 * </code>
 *
 * @param $subtotal - subtotal of the order
 * @return $tax
 * @todo none
 */
function calcTax ($subtotal) {
	$tax = number_format(($subtotal * 0.101), 2);
	return $tax;
}


/**
 * function calcTotal($subtotal) calculates the total by adding sales tax to the subtotal
 *
 *
 * <code>
 * $total = calcTotal($subtotal, $tax);
 * </code>
 *
 * @param $subtotal - subtotal of the order
 * @param $tax - tax of the subtotal
 * @return $total
 * @todo none
 */
function calcTotal ($subtotal, $tax) {
	$total = number_format(($subtotal + $tax), 2); // 10.1% Seattle sales tax, round total to 2 decimal places
	
	return $total;
}

?>