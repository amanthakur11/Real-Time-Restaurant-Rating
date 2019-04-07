<?php
session_start();
include 'config.php';
$id=(int)$_SESSION['id'];
$sql = "SELECT id, count FROM search WHERE id = $id";
$sql1 = "SELECT id, price, state, cusine, rating, type, name, updateprice, city FROM bussines WHERE id =$id;";
$result = $link->query($sql); 
$row=$result->fetch_assoc();
$res=$link->query($sql1);
$rows=$res->fetch_assoc();
$count=1;
if(sizeof($row) >= 1){
    $count=$row["count"]+1;       
    $sql3="DELETE FROM search WHERE id=$id";
    $link->query($sql3);
    $sql2 = "INSERT INTO search (id, type, name, count) VALUES (?, ?, ?, ?)";
    if($stmt1 = mysqli_prepare($link, $sql2)){
        mysqli_stmt_bind_param($stmt1, "ssss", $param_id, $param_type,$param_name, $param_count);
        $param_id = $id;
        $param_type=$rows["type"];
        $param_name=$rows["name"];
        $param_count=$count;
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);
    }
     $chang=$rows["updateprice"]-$rows["price"];
     $tu=3;
     if($chang>77){
        $tu=0;
    }
    if($count%3==0)
    {
        $price=$rows["updateprice"]+$tu;
        $sql8="UPDATE bussines SET updateprice=$price WHERE id=$id";
        $link->query($sql8);
     }
} else{
    $sql2 = "INSERT INTO search (id, type, name, count) VALUES (?, ?, ?, ?)";
    if($stmt1 = mysqli_prepare($link, $sql2)){
    mysqli_stmt_bind_param($stmt1, "ssss", $param_id, $param_type,$param_name, $param_count);
    $param_id = $id;
    $param_type=$rows["type"];
    $param_name=$rows["name"];
    $param_count=1;
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);
    }
}

$sql4 = "INSERT INTO allcount (id,counts) VALUES (?, ?)";
if($stmt1 = mysqli_prepare($link, $sql4)){
    mysqli_stmt_bind_param($stmt1, "ss", $param_id, $param_count);
    $param_id = $id;
    $param_count=$count;
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);
}
$sql6="SELECT id,type,name,count from search where id<>$id";
$res2=$link->query($sql6);
while($row=$res2->fetch_assoc())
{
    $id=$row["id"];
    $count=$row["count"]; 
    if($count>0){      
        $sql3="DELETE FROM search WHERE id=$id";
        $link->query($sql3);
        $sql2 = "INSERT INTO search (id, type, name, count) VALUES (?, ?, ?, ?)";
        if($stmt1 = mysqli_prepare($link, $sql2)){
            mysqli_stmt_bind_param($stmt1, "ssss", $param_id, $param_type,$param_name, $param_count);
            $param_id = $id;
            $param_type=$row["type"];
            $param_name=$row["name"];
            $param_count=$count-1;
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);
            $chang=$rows["updateprice"]-$rows["price"];
            $k=2;
            if($chang<-30){
                $k=0;
            }
            if($count%2==0)
            {
                $price=$rows["updateprice"]-$k;
                $sql8="UPDATE bussines SET updateprice=$price WHERE id=$id";
                $link->query($sql8);
            }
        }
    }
}

$id=$_SESSION["id"];
$sql5="Select counts,times FROM allcount where id=$id;";
$res=$link->query($sql5);
$val=array();
$times=array();
while($allrow=$res->fetch_assoc()){
    array_push($val,$allrow["counts"]);
    array_push($times,$allrow["times"]);
}
$val=json_encode($val);
$times=json_encode($times);
?>