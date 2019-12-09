<?php

$link = mysqli_connect("localhost", "root", "", "mealplanner");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$food = mysqli_real_escape_string($link, $_REQUEST['food']);
$meal= mysqli_real_escape_string($link, $_REQUEST['meal']);
$calories = mysqli_real_escape_string($link, $_REQUEST['calories']);
$purpose = mysqli_real_escape_string($link, $_REQUEST['purpose']);
$preferences = mysqli_real_escape_string($link, $_REQUEST['preferences']);

 

$sql = "INSERT INTO foods (food, meal, calories, purpose, preferences ) VALUES ('$food','$meal', '$calories','$purpose','$preferences')";
if(mysqli_query($link, $sql)){

	header("location: homepage.html");
    //echo "Records added successfully.";

	
} else{
   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	
}
 

mysqli_close($link);
?>




