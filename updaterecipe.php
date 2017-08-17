<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$newa = new mysqli("oniddb.cws.oregonstate.edu","kuenstir-db","4jgIGJ2KQMnNGthS","kuenstir-db");

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

		<p><div id="center">
		<form action="http://web.engr.oregonstate.edu/~kuenstir/HTMLexample.php">
					<input class="button" type="submit" value="Back to Meal Decision Engine">
					</form>
				</div>

<?php
if(!($stmt = $newa->prepare("UPDATE Recipes SET Recipe.name = ? WHERE Recipes.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("si",$_POST['recipeName', $_POST['recipeID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $newa->connect_errno . " " . $newa->connect_error;
}
else{
	echo "Updated " . $stmt->affected_rows . " row from Recipes.";
}

$stmt->close();
?>
</div>
</div>

</body>
</html>