<?php
    //Turn on error reporting
    ini_set('display_errors', 'On');

    //Connects to the database
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu","kuenstir-db","4jgIGJ2KQMnNGthS","kuenstir-db");

?>

<!DOCTYPE html>

<html>
<head>
 
	<title>Meal Creator</title>

	<link rel="stylesheet" type="text/css" href="style.css" /> 
   
</head>

<body>
	
	<div id="pageDiv">
	
		<h1>
		Meal Decision Engine
		</h1>
	
	

	</div>

 
<p>
<div id="bgDivScroll">
	<div id="center">
	<h2> My Created Meals </h2>
		<table id="table">
			<tr>
			<th>Recipe ID</th>
				<th>Recipes</th>
				<th>Meal Type</th>
			</tr>
			
		<?php
		if(!($stmt = $mysqli->prepare("SELECT Recipes.id, Recipes.name, Meal_Types.name FROM Recipes INNER JOIN Meal_Types ON Meal_Types.id = Recipes.Type_ID"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($id, $name, $type)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		while($stmt->fetch()){
		 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $type . "\n</td>\n</tr>\n";
		}
		$stmt->close();
		?>
		</table>

<p>

		</div>
	</div>

 
<p>
	
<!-- ADD ATTRIBUTES TO DATABASE -->
<!-- ADD CUISINE -->
<p>

<div id="bgDivLong">
	<div id="center">
	<h2> Add to Database </h2>

<div>
	<form method="post" action="addcuisine.php"> 

		<fieldset>
			<legend>Cuisine</legend>
			<p>Cuisine Name: <input type="text" name="name" /></p>
			
			
		
		<p><div id="center">
					<input class="button" type="submit" value="Add Cuisine">
				</div>
		</fieldset>
	</form>
</div>
	

<!-- ADD MEAL TYPE -->
<p>
<div>
	<form method="post" action="addtype.php"> 

		<fieldset>
			<legend>Meal Type</legend>
			<p>Type Name: <input type="text" name="name" /></p>
			
		<p><div id="center">
					<input class="button" type="submit" value="Add Type">
				</div></p>
		</fieldset>
	</form>
</div>


<!-- ADD STARCH -->
<p>
<div>
	<form method="post" action="addstarch.php"> 

		<fieldset>
			<legend>Starch</legend>
			<p>Starch Name: <input type="text" name="name" /></p>
			<p>Calories per 100g: <input type="text" name="calories" /></p>
			
		<p><div id="center">
					<input class="button" type="submit" value="Add Starch">
				</div></p>
		</fieldset>
	</form>
</div>

<!-- ADD PROTEIN -->
<p>
<div>
	<form method="post" action="addprotein.php"> 

		<fieldset>
			<legend>Protein</legend>
			<p>Protein Name: <input type="text" name="name" /></p>
			<p>Calories per 100g: <input type="text" name="calories" /></p>
			
		<p><div id="center">
					<input class="button" type="submit" value="Add Protein">
				</div></p>
		</fieldset>
	</form>
</div>

		</div>
	</div>
	
<p>


<!-- ADD NEW MEAL -->

<div id="bgDivMid">
	<div id="center">
	<h2> Add New Meal </h2>

<div>
	<form method="post" action="addmeal.php"> 

		<fieldset>
			<legend>Basics</legend>
			<p>Recipe Name: <input type="text" name="name" /></p>
			
			<p>Primary Protein: <select name="protein">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM Proteins"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
			
			
			<p>Primary Starch: <select name="starch">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM Starches"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
			
			
		</fieldset>

		<fieldset>
			<legend>Advanced Options</legend>	
			<table id ="table">
					
					
					<tr>
						<td>
						<label>Vegetarian:	</label>
						<input type='hidden' value='0' name="vegetarian">
						<input type="checkbox" name="vegetarian" value="1"/>
						<p />
						</td>
						
						<td>
						<label>Cold: </label>
						<input type='hidden' value='0' name="cold">
						<input type="checkbox" name="cold" value="1"/>
						<p />
						</td>
					</tr>
					
					<tr>
						<td>
						<label>For a crowd:	</label>
						<input type='hidden' value='0' name="crowd">
						<input type="checkbox" name="crowd" value="1"/>
						<p />
						</td>
					
						<td>
						<label>Quick: </label>
						<input type='hidden' value='0' name="quick">
						<input type="checkbox" name="quick" value="1"/>
						<p />
						</td>
					</tr>
					
					</table>
			
			
		</fieldset>

		<fieldset>
			<legend>Meal Type</legend>
			<select name="type">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM Meal_Types"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		

		<fieldset>
			<legend>Cuisine</legend>
			<select name="cuisine">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM Cuisines"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		<p><div id="center">
					<input class="button" type="submit" value="Add New Meal">
				</div></p>
	</form>
</div>

		</div>
	</div>

<p>

<!-- AVAILABLE INGREDIENTS display all ingredients -->
<div id="bgDivScroll">
	<div id="center">
	<h2> Available Ingredients </h2>
		<table id="table">
			<tr>
			<th>Proteins</th>
				<th>Starches</th>
				<th>Used in Recipe #</th>
			</tr>
			
		<?php
		if(!($stmt = $mysqli->prepare("SELECT Proteins.name, Starches.name, Recipes.id FROM Recipes INNER JOIN Proteins ON Recipes.Protein_ID = Proteins.id
		INNER JOIN Starches ON Recipes.Starch_ID = Starches.id"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($name, $pname, $sname)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		while($stmt->fetch()){
		 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $pname . "\n</td>\n<td>\n" . $sname . "\n</td>\n</tr>\n";
		}
		$stmt->close();
		?>
		</table>

<p>

		</div>
	</div>
	<p>
	
<!-- DELETE AND UPDATE -->
<div id="bgDivMidPlus">
	<div id="center">
	<h2> Delete and Update </h2>

	<!-- DELETE RECIPE -->
<div>
	<form method="post" action="delete.php">
	<p>
		<fieldset>
			<legend>Delete Recipe</legend>
				Choose Recipe: <select name="recipeID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM Recipes"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $pname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				
				<p>
		
		<div id="center">
					<input class="button" type="submit" value="Delete">
				</div>
		<p>
		</fieldset>
	</form>
</div>
<p>

<!-- DELETE MEAL TYPE -->
<div>
	<form method="post" action="deletetype.php">
	<p>
		<fieldset>
			<legend>Delete Meal Type</legend>
				Choose Meal Type: <select name="recipeID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM Meal_Types"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $pname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				
				<p>
		
		<div id="center">
					<input class="button" type="submit" value="Delete">
				</div>
		<p>
		</fieldset>
	</form>
</div>
<p>



<!-- UPDATE RECIPE NAME -->
<div>
	<form method="post" action="updaterecipe.php">
		<fieldset>
			<legend>Update Recipe Name</legend>
				Choose Recipe: <select name="recipeID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM Recipes"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $pname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<p>				
				
			<fieldset>
			<legend>New Recipe Name</legend>
			<p>Recipe Name: <input type="text" name="recipeName" /></p>
			
			
		</fieldset>
		
		<p>
				<div id="center">
					<input class="button" type="submit" value="Update">
				</div>
	</form>
</div>

		</div>
	</div>

<p>

<!-- MEAL FILTERS -->
<div id="bgDivStub">
	<div id="center">
	<h2> Meal Filters </h2>

<div>
	<form method="post" action="filter.php">
	<p>
		<fieldset>
			<legend>Filter By Cuisine</legend>
				<select name="cuisineID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM Cuisines"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $pname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<p>
		
		<div id="center">
					<input class="button" type="submit" value="Get Meals by Cuisine">
				</div>
		<p>
		</fieldset>
	</form>
</div>
<p>
<div>
	<form method="post" action="filter2.php">
		<fieldset>
			<legend>Filter By Meal Type</legend>
				<select name="type">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM Meal_Types"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $pname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<p>
		
		<div id="center">
					<input class="button" type="submit" value="Get Meals By Type">
				</div>
		<p>
		</fieldset>
	</form>
</div>

		</div>
	</div>
	<p>

<!-- MEAL SELECTOR -->
		<div id="bgDivShort">
		
		
			
			<form method="post" action="mealselector.php">
				<div id="center">
				
				<h2> Meal Selector </h2>
					
					<b>I'm in the mood for:<br></b>
					<p>
					
					<label>Meal Type:	</label>
					<select name="Type_ID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM Meal_Types"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $pname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				
					<p>
					<label>Cuisine:	</label>
					<select name="Cuisine_ID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM Cuisines"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $pname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
					<p>
					
					
					<b>Made with:<br></b>
					
			<p>Primary Protein: <select name="Protein_ID">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM Proteins"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
			
			
			<p>Primary Starch: <select name="Starch_ID">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM Starches"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
					<p />
					
					
					<table id ="table">
					
					
					<tr>
						<td>
						<label>Vegetarian:	</label>
						<input type='hidden' value='0' name="vegetarian">
						<input type="checkbox" name="vegetarian" value="1"/>
						<p />
						</td>
						
						<td>
						<label>Cold: </label>
						<input type='hidden' value='0' name="cold">
						<input type="checkbox" name="cold" value="1"/>
						<p />
						</td>
					</tr>
					
					<tr>
						<td>
						<label>For a crowd:	</label>
						<input type='hidden' value='0' name="crowd">
						<input type="checkbox" name="crowd" value="1"/>
						<p />
						</td>
					
						<td>
						<label>Quick: </label>
						<input type='hidden' value='0' name="quick">
						<input type="checkbox" name="quick" value="1"/>
						<p />
						</td>
					</tr>
					
					</table>
					
				</div>
		
				<div id="center">
					<input class="button" type="submit" value="Get Meal">
				</div>
		
			</form>

		</div>
		
<p>
<!-- MEAL STATS -->
<div id="bgDivFat">
	<div id="center">
	<h2>Meal Stats At-A-Glance:</h2>
		<table id="table">
			<tr>
				<th>Recipes</th>
				<th>Quick to Prep?</th>
				<th>Feeds a Crowd?</th>
				<th>Vegetarian?</th>
				<th>No-Cook?</th>
				<th>Meal Type</th>
				<th>Cuisine</th>
			</tr>
			
		<?php
		if(!($stmt = $mysqli->prepare("SELECT Recipes.name, Recipes.quick, Recipes.crowd, Recipes.vegetarian, Recipes.cold, Meal_Types.name, Cuisines.name FROM Recipes INNER JOIN Meal_Types ON Meal_Types.id = Recipes.Type_ID
		INNER JOIN Cuisines ON Cuisines.id = Recipes.Cuisine_ID"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($name, $quick, $crowd, $vegetarian, $cold, $type, $cuisine)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		while($stmt->fetch()){
		 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $quick . "\n</td>\n<td>\n" . $crowd . "\n</td>\n<td>\n" . $vegetarian . "\n</td>\n<td>\n"  . $cold . "\n</td>\n<td>\n" . $type .  "\n</td>\n<td>\n" . $cuisine . "\n</td>\n</tr>\n";
		}
		$stmt->close();
		?>
		</table>

<p>

		</div>
	</div>


</body>
</html>