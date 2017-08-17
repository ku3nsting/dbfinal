<html>
<head>
	<title>Meal Creator</title>

	<link rel="stylesheet" type="text/css" href="style.css" /> 
</head>
<body>
<div id="bgDivStub">
<div id="center">

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$conn = new mysqli("oniddb.cws.oregonstate.edu","kuenstir-db","4jgIGJ2KQMnNGthS","kuenstir-db");
if(!$conn || $conn->connect_errno){
	echo "Connection error " . $conn->connect_errno . " " . $conn->connect_error;
	}
	
if(!($stmt = $conn->prepare("INSERT INTO Recipes(name, cold, crowd, quick, vegetarian, Protein_ID, Starch_ID, Type_ID, Cuisine_ID) VALUES (?,?,?,?,?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("siiiiiiii",$_POST['name'], $_POST['cold'], $_POST['crowd'], $_POST['quick'], $_POST['vegetarian'], $_POST['protein'], $_POST['starch'], $_POST['type'], $_POST['cuisine']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to Recipes.";
}


?>


				<p><div id="center">
		<form action="http://web.engr.oregonstate.edu/~kuenstir/HTMLexample.php">
					<input class="button" type="submit" value="Back to Meal Decision Engine">
					</form>
				</div>
				
				</div>
				</div>

</body>
</html>