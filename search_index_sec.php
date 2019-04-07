<?php
session_start();

$_SESSION['message']='';
  
include 'config.php';
 
// Define variables and initialize with empty values
$city=$city_err="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["city"]))){
        $city_err = 'Please enter city.';
        $_SESSION['message'] = $city_err;
    } else{
        $city = trim($_POST["city"]);
    }
    
    
    // Validate credentials
    if(empty($city_err)){
        // Prepare a select statement
        $sql = "SELECT name, city, state FROM bussines WHERE city = '$city';";
        
           if($link->query($sql)==true){
            $_SESSION['city']=$city;
            header("location: index_food.php");
       }
        else
        {
           $city_err="Oops!. No city with this name.";
           $_SESSION['message'] = $city_err;
        }
    }
    else
    {
        $city_err="Please enter City.";
        $_SESSION['message'] = $city_err;
    }
    
    mysqli_close($link);
}