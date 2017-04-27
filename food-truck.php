<style>
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
	case "display": # 2)Display user's name!
	 	showData();
	 	break;
	default: # 1)Ask user to enter their name 
	 	showForm();
}

function showForm() { // shows form so user can enter their name.  Initial scenario
	global $config;
	
	echo '<form action="'.THIS_PAGE.'" method="post">';
	foreach ($config->items as $item) {
		//echo "<p>ID:$item->ID  Name:$item->Name</p>"; 
		//echo '<p>Taco <input type="text" name="item_1" /></p>';
		echo '<p>' . $item->name . ' <input type="number" min="0" max="10" name="item_' . $item->id . '"/> ' . $item->price . '</p>';
		if (count($item->extras) > 0) {
			foreach ($item->extras as $extra) {
				echo '<input type="checkbox" name="extra_" />' . $extra . '<br />';
			}
		}
		/* 
		if the array of extras is greater than zero, 
		consider adding a new set of elements, i.e. checkboxes 
		checkboxes
		<checkbox name="extra_1" value="cheese">Cheese<br />

		*/
	}       
	echo '	
			<input type="submit" value="Order">
			<input type="hidden" name="act" value="display" />
		</form>
	';
}

function showData() { #form submits here we show entered name
	
    //dumpDie($_POST);
	foreach($_POST as $name => $value) { //loop the form elements
        
        //if form name attribute starts with 'item_', process it
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
				echo "<p>You ordered $value of item number $id</p>";
			} 
        }
    }	
	echo '<p><a href="' . THIS_PAGE . '">RESET</a></p>';
}



?>