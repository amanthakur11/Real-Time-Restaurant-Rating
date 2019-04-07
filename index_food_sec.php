<?php
session_start();
include 'config.php';
 
          $city=$_SESSION['city'];
    
        // Prepare a select statement
        $sql = "SELECT id, name, city, state, price,cusine,updateprice,target FROM bussines WHERE city = '$city';";
        
           if($link->query($sql)==true){
        $result = $link->query($sql); //$result = mysqli_result object
        //var_dump($result);
    
    }
    error_reporting(E_ERROR);
     $_SESSION['id']=0;   
     $_SESSION['id']=$_POST["detail"];
    if($_SESSION['id']!=0) {
            header("location: details_show.php");
        }
?>