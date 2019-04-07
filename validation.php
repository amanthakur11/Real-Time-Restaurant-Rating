<?php
$name = $city = $state = $cusine = $price = $des = $target="";
$response=array();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //name Validation
    if(empty(trim($_POST['name']))){
         $response = array(
                "type" => "error",
                "message" => "Please Enter Restaurant Name."
            );
        } else{
            $sql = "SELECT id FROM bussines WHERE name = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_name);
                $param_name = trim($_POST['name']);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) >= 1 && empty($response)){
                        $response = array(
                            "type" => "error",
                            "message" => "Restaurant name is already in our Database."
                        );
                    } else{
                        $name = trim($_POST['name']);
                    }
                } else if(empty($response)){
                    $response = array(
                        "type" => "error",
                        "message" => "Oops! Something went wrong. Please try again later."
                    );
                }
            }
        }
    //city validation
    if(empty(trim($_POST['city'])) && empty($response)){
         $response = array(
                "type" => "error",
                "message" => "Please Enter City."
            );
        } else{
            $city =trim($_POST['city']);
        }
    //state validation
    if(empty(trim($_POST['state'])) && empty($response)){
         $response = array(
                "type" => "error",
                "message" => "Please Enter State."
            );
        } else{
            $state =trim($_POST['state']);
        }
    //cusine validation
    if(empty(trim($_POST['cusine'])) && empty($response)){
         $response = array(
                "type" => "error",
                "message" => "Please Enter Cusine."
            );
        } else{
            $cusine =trim($_POST['cusine']);
        }
    //price validation
    if(empty(trim($_POST['price'])) && empty($response)){
         $response = array(
                "type" => "error",
                "message" => "Please Enter Price."
            );
        } else{
            $price =trim($_POST['price']);
        }
    //description validation
    if(empty(trim($_POST['des'])) && empty($response)){
         $response = array(
                "type" => "error",
                "message" => "Please Enter Description."
            );
        } else{
            $des =trim($_POST['des']);
        }

    //image Validataion
    $fileinfo = @getimagesize($_FILES['file-input']['tmp_name']);
        $width = $fileinfo[0];
        $height = $fileinfo[1];
        
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
        
        // Get image file extension
        $file_extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        
        // Validate file input to check if is not empty
        if (! file_exists($_FILES['avatar']['tmp_name']) && empty($response)) {
            $response = array(
                "type" => "error",
                "message" => "Choose image file to upload."
            );
        }    // Validate file input to check if is with valid extension
        else if (! in_array($file_extension, $allowed_image_extension) && empty($response)) {
            $response = array(
                "type" => "error",
                "message" => "Upload valiid images. Only PNG and JPEG are allowed."
            );
        } else {
            $target = "images/" . basename($_FILES['avatar']['name']);
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target) && empty($response)) {
                $response = array(
                    "type" => "error",
                    "message" => "Problem in uploading image files."
                );
            }
        }
}

?>
