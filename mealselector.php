<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$newy = new mysqli("oniddb.cws.oregonstate.edu","kuenstir-db","4jgIGJ2KQMnNGthS","kuenstir-db");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Meal Creator</title>

	<link rel="stylesheet" type="text/css" href="style.css" /> 
</head>
<body>
<div id="bgDivStub">
<div id="center">

	<table>
		<tr>
			<td>Based on your input, the following are good meal options for you:</td>
		</tr>
		<tr>
			<td>Meal Name</td>
		</tr>
<?php
if(!($stmt = $newy->prepare("SELECT Recipes.name FROM Recipes 
INNER JOIN Recipe_Meals ON Recipe_Meals.RecipeID = Recipes.id
INNER JOIN Meal_Types ON Recipe_Meals.MealID = Meal_Types.id
INNER JOIN Cuisines ON Recipes.Cuisine_ID = Cuisines.id 
INNER JOIN Proteins ON Proteins.id = Recipes.Protein_ID
INNER JOIN Starches ON Starches.id = Recipes.Starch_ID
WHERE (Meal_Types.id = ?
AND Cuisines.id = ?
AND Proteins.id = ?
AND Starches.id = ?
AND Recipes.vegetarian = ?
AND Recipes.cold = ?
AND Recipes.crowd = ?
AND Recipes.quick = ?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("iiiiiiii", $_POST['Type_ID'], $_POST['Cuisine_ID'], $_POST['Protein_ID'], $_POST['Starch_ID'], $_POST['vegetarian'], $_POST['cold'], $_POST['crowd'], $_POST['quick']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $newy->connect_errno . " " . $newy->connect_error;
}
if(!$stmt->bind_result($name)){
	echo "Bind failed: "  . $newy->connect_errno . " " . $newy->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
				<p><div id="center">
		<form action="http://web.engr.oregonstate.edu/~kuenstir/HTMLexample.php">
					<input class="button" type="submit" value="Back to Meal Decision Engine">
					</form>
				</div>
				
				</div>
				</div>

</body>
</html>