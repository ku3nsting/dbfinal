<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$newx = new mysqli("oniddb.cws.oregonstate.edu","kuenstir-db","4jgIGJ2KQMnNGthS","kuenstir-db");

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
			<td>Filtered Meals</td>
		</tr>
		<tr>
			<td>Meal Name</td>
			<td>Cold?</td>
			<td>Quick?</td>
		</tr>
		
<?php
if(!($stmt = $newx->prepare("SELECT Recipes.name, Recipes.cold, Recipes.quick FROM Recipes INNER JOIN Cuisines ON Cuisines.id = Recipes.Cuisine_ID WHERE Cuisines.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['cuisineID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $newx->connect_errno . " " . $newx->connect_error;
}
if(!$stmt->bind_result($name, $cold, $quick)){
	echo "Bind failed: "  . $newx->connect_errno . " " . $newx->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $cold . "\n</td>\n<td>\n" . $quick . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

				<p><div id="center">
		<form action="http://web.engr.oregonstate.edu/~kuenstir/HTMLexample.php">
					<input class="button" type="submit" value="Back to Meal Decision Engine">
					</form>
				</div>
				
				</div>

</body>
</html>