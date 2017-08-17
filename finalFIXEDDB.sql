/*Clear out the needed table names*/
SET foreign_key_checks = 0;
DROP TABLE IF EXISTS `Starches`;
DROP TABLE IF EXISTS `Proteins`;
DROP TABLE IF EXISTS `Recipes`;
DROP TABLE IF EXISTS `Cuisines`;
DROP TABLE IF EXISTS `Meal_Types`;
DROP TABLE IF EXISTS `Recipe_Meals`;
SET foreign_key_checks = 1;


/*Make new tables*/
CREATE TABLE Starches(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	calories INT(11)
)ENGINE=InnoDB;

CREATE TABLE Proteins(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	calories INT(11)
)ENGINE=InnoDB;

CREATE TABLE Cuisines(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE Recipes(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	cold BOOL,
	vegetarian BOOL,
	crowd BOOL,
	quick BOOL,
	Protein_ID INT(6),
	Starch_ID INT(6),
	Type_ID INT(6),
	Cuisine_ID INT(6),
	FOREIGN KEY (Cuisine_ID) REFERENCES Cuisines(id) ON DELETE CASCADE,
	FOREIGN KEY (Protein_ID) REFERENCES Proteins(id) ON DELETE CASCADE,
	FOREIGN KEY (Starch_ID) REFERENCES Starches(id) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE Meal_Types(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE Recipe_Meals(
	RecipeID INT(6),
	MealID INT(6),
	PRIMARY KEY (RecipeID, MealID),
	FOREIGN KEY (RecipeID) REFERENCES Recipes(id) ON DELETE CASCADE,
	FOREIGN KEY (MealID) REFERENCES Meal_Types(id) ON DELETE CASCADE
)ENGINE=InnoDB;


/*Some example values*/
INSERT INTO Starches VALUES (NULL, "none", 0);
INSERT INTO Starches VALUES (NULL, "Potatoes", 0);
INSERT INTO Proteins VALUES (NULL, "none", 0);
INSERT INTO Proteins VALUES (NULL, "Steak", 0);
INSERT INTO Starches VALUES (NULL, "any", 0);
INSERT INTO Proteins VALUES (NULL, "any", 0);
INSERT INTO Meal_Types VALUES (NULL, "Breakfast");
INSERT INTO Meal_Types VALUES (NULL, "Lunch");
INSERT INTO Meal_Types VALUES (NULL, "Dinner");
INSERT INTO Cuisines VALUES (NULL, "American");
INSERT INTO Cuisines VALUES (NULL, "Japanese");
INSERT INTO Cuisines VALUES (NULL, "Mexican");

/*Create example meal - Lasagna*/
INSERT INTO Cuisines VALUES (NULL, "Italian");
INSERT INTO Starches VALUES (NULL, "Pasta", 0);
INSERT INTO Proteins VALUES (NULL, "Ground Beef", 0);
INSERT INTO Recipes VALUES (NULL, "Lasagna", 0, 0, 1, 0, 4, 4, 3, 4);
INSERT INTO Recipe_Meals VALUES (1, 3);

/*Create example meal - Chicken Curry*/
INSERT INTO Cuisines VALUES (NULL, "Indian");
INSERT INTO Starches VALUES (NULL, "Rice", 0);
INSERT INTO Proteins VALUES (NULL, "Chicken", 0);
INSERT INTO Recipes VALUES (NULL, "Chicken Curry", 0, 0, 1, 0, 5, 5, 3, 5);
INSERT INTO Recipe_Meals VALUES (2, 3);

/*Create example meal - Steak burrito*/
INSERT INTO Cuisines VALUES (NULL, "Mexican");
INSERT INTO Starches VALUES (NULL, "Tortilla", 140);
INSERT INTO Recipes VALUES (NULL, "Steak Burrito", 0, 0, 1, 0, 2, 6, 3, 3);
INSERT INTO Recipe_Meals VALUES (3, 3);