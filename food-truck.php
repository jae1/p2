<style>
	@import url('https://fonts.googleapis.com/css?family=Roboto:300,400');
	
	body {
		font-family: 'Roboto', sans-serif;
	}
	
	h2,h3,h4,h5,h6 {
		font-weight: 400;
	}
	
	input[type=number] {
		width: 50px;
	} 
</style>

<?php 
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
	
	echo '
		<form action="'.THIS_PAGE.'" method="post">';
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
//    echo '<pre>';
// 	  dumpdie($_POST);
//    echo '</pre>';
	
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

			/*
				Here is where you'll do most of your work
				Use $id to loop your array of items and return 
				item data such as price.
				
				Consider creating a function to return a specific item 
				from your items array, for example:
				
				$thisItem = getItem($id);
				
				Use $value to determine the number of items ordered 
				and create subtotals, etc.
			*/

			if ($value > 0) {
				$thisItem .= getItem($id, $value);
				$subtotal += calcSubtotal($id, $value);
			}
        }
    }
	$total = calcTotal($subtotal);
	
	echo '<h3>Your order has been placed.</h3>';
	echo '<p>' . $thisItem . '</p><hr />';
	echo '<p>Subtotal: $' . $subtotal . '</p>';
	echo '<p>Tax: $' . number_format(($subtotal * 0.101), 2) . '</p>';
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
	$subtotal = $value * (float)$itemPrice;
	
	return $subtotal;
}

// calculates total price and returns result
function calcTotal ($subtotal) {
	$total = number_format(($subtotal * 1.101), 2); // 10.1% Seattle sales tax, round total to 2 decimal places
	
	return $total;
}

?>