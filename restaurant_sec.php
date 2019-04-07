
<?php
include 'config.php';
include 'validation.php';
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($response)){
    $type="Restaurant";
    $rating=3;
    $sql = "INSERT INTO bussines (type, name, city, state, rating, cusine, price, updateprice, des, target) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "ssssssssss", $param_type, $param_name, $param_city, $param_state, $param_rating, $param_cusine, $param_price, $param_updateprice, $param_des, $param_target);
            
            $param_type = $type;
            $param_name=$name;
            $param_city=$city;
            $param_state =$state; 
            $param_rating=$rating;
            $param_cusine=$cusine;
            $param_price=$price;
            $param_updateprice=$price;
            $param_des=$des;
            $param_target=$target;

            if(mysqli_stmt_execute($stmt)){
                $name = $city = $state = $cusine = $price = $des = $target="";
                $response = array(
                "type" => "success",
                "message" => "Data uploaded successfully.");
            } else{
                $response = array(
                "type" => "error",
                "message" => "Problem in uploading Data, Try again after.");
            }
        }
     
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
}
?>
