<?php
 if(preg_match("/^[  a-zA-Z]+/", $_REQUEST['name'])){
 $name=$_REQUEST['name'];
 
 //connect  to the database
 $db=mysql_connect  ('https://secure.oregonstate.edu', 'kuenstir-db',  '4jgIGJ2KQMnNGthS') or die ('I cannot connect to the database  because: ' . mysql_error());
 
//$servername = 'https://secure.oregonstate.edu';
//$username = 'kuenstir-db';
//$password = '4jgIGJ2KQMnNGthS';
//$dbname = 'kuenstir-db';
 
 //-select  the database to use
 $mydb=mysql_select_db('kuenstir-db');
  //-query  the database table
  $sql="SELECT  ID, name, color FROM test WHERE name LIKE '%" . $name .  "%' ";
  
   //-run  the query against the mysql query function
   $result=mysql_query($sql);
   
    //-create  while loop and loop through result set
    while($row=mysql_fetch_array($result)){
      $namedb =$row['name'];
      $ID=$row['ID'];
      $color=$row['color'];
	  
  //-display the result of the array
  echo "<ul>\n";
  echo "<li>" . "<a  href=\"search.php?id=$ID\">"   .$namedb . " " .  "</a></li>\n" ;
  echo  $color . " " .  "</a>\n";
  echo "</ul>";
}
?>