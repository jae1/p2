<?php 
include 'items.php'; 

define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

if (isset($_REQUEST['act'])) {
	$myAction = (trim($_REQUEST['act']));
} else {
	$myAction = "";
}

switch ($myAction) 
{//check 'act' for type of process
	case "display": # 2)Display user's name!
	 	showData();
	 	break;
	default: # 1)Ask user to enter their name 
	 	showForm();
}

function showForm()
{# shows form so user can enter their name.  Initial scenario
	global $config;
	
	echo '
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';
  
    
		foreach($config->items as $item)
          {
            //echo "<p>ID:$item->ID  Name:$item->Name</p>"; 
            //echo '<p>Taco <input type="text" name="item_1" /></p>';
              
              echo '<p>' . $item->Name . ' <input type="text" name="item_' . $item->ID . '" /></p>';
              
			/* if the array of extras is greater than zero, 
			consider adding a new set of elements, i.e. checkboxes 
			checkboxes
			<checkbox name="extra_1" value="cheese">Cheese<br />
			
			*/
          }       
 
          echo '
				<p>
					<input type="submit" value="Please Enter Your Name"><em>(<font color="red"><b>*</b> required field</font>)</em>
				</p>
		<input type="hidden" name="act" value="display" />
	</form>
	';

}

function showData()
{#form submits here we show entered name
	
    //dumpDie($_POST);
	
	foreach($_POST as $name => $value)
    {//loop the form elements
        
        //if form name attribute starts with 'item_', process it
        if(substr($name,0,5)=='item_')
        {
            //explode the string into an array on the "_"
            $name_array = explode('_',$name);

            //id is the second element of the array
			//forcibly cast to an int in the process
            $id = (int)$name_array[1];
			
			//kd - check if the value is numeric
			if(is_numeric($value)){
				$value = (int)$value; //kd - cast to integer so they can't order a half item
				
				//kd - check if input is non-negative
				if($value >= 0){

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
					
				echo "<p>You ordered " .$value." of item number $id</p>";
				
				}else{
					//kd - show error for negative value input
					echo "<p>You must put a positive number in the box for item number $id</p>";
				}
				
            }else{
				//kd - show error for non-numeric input
				echo "<p>You must put a number in the box for item number $id</p>";
			}
        }
    }	
	echo '<p><a href="' . THIS_PAGE . '">RESET</a></p>';
}
?>