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

function showForm() { // shows form so user can place an order
	global $config;
	
	echo '<form action="'.THIS_PAGE.'" method="post">';
	foreach ($config->items as $item) {
		//echo "<p>ID:$item->ID  Name:$item->Name</p>"; 
		//echo '<p>Taco <input type="text" name="item_1" /></p>';
		echo '<h2>' . $item->name . '</h2>';
		echo '<h5>Price: $' . $item->price . '</h5>';
//		echo '<h5>Quantity: <input type="number" min="0" max="10" name="item_' . $item->id . '"/></h5>';
		
		echo '<select name="item_'.$item->id.'">';
			for ($i = 0; $i <= 10; $i++) {
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
		echo '</select>';


		echo '<p>' . $item->description . '</p>';
		
		
		/*  if the array of extras is greater than zero, 
			consider adding a new set of elements, i.e. checkboxes 
			checkboxes
			<checkbox name="extra_1" value="cheese">Cheese<br /> */
		if (count($item->extras) > 0) {
			echo '<p>Add your choice of toppings.</p>';
			foreach ($item->extras as $extra) {
				echo '<input type="checkbox" name="extra_" />' . $extra . '<br />';
			}
		}
		echo '<hr />';
	}   
	echo '	
			<input type="submit" value="Order">
			<input type="hidden" name="act" value="display" />
		</form>
	';
}

function showData() { // shows what user submitted
//    echo '<pre>';
// 	  dumpdie($_POST);
//    echo '</pre>';
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
			$thisItem = getItem($id, $value);

            if ($value > 0) { 
//				echo '<pre>';
//				var_dump ($items[1]);
//				echo '</pre>';
				echo $thisItem;
			}
        }
    }	
	echo '<p><a href="' . THIS_PAGE . '">Clear</a></p>';
}


function getItem($id, $value) {
	global $config;

	$itemName = $config->items[$id - 1]->name;
	$itemPrice = $config->items[$id - 1]->price;
	$subtotal = $value * (float)$itemPrice;
	$total = round(($subtotal * 1.101), 2); // 10.1% Seattle sales tax
	
	return "
		<p>You ordered $value $itemName.</p>
		<p>Your subtotal is $$subtotal.</p>
		<p>Your total after tax is $$total.</p>";
}


?>