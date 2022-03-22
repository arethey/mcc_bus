<?php
require_once '../dbconfig.php';
require_once '../functions/bus.php';

    if(count($_POST)>0){
        if($_POST['type']==1){
            $bus_num=$_POST['bus_num'];

            if(isBusExist($conn, $bus_num, null)){
                echo json_encode(array("statusCode"=>500, "title"=>"Bus number already exist."));
                exit();
            }
            
            $sql = "INSERT INTO `tblbus`( `bus_num`) 
            VALUES ('$bus_num')";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }

    if(count($_POST)>0){
        if($_POST['type']==2){
            $id=$_POST['id'];
            $bus_num=$_POST['bus_num'];

            if(isBusExist($conn, $bus_num, $id)){
                echo json_encode(array("statusCode"=>500, "title"=>"Bus number already exist."));
                exit();
            }
            
            $sql = "UPDATE `tblbus` SET `bus_num`='$bus_num' WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }

    if(count($_POST)>0){
        if($_POST['type']==3){
            $id=$_POST['id'];
            $sql = "DELETE FROM `tblbus` WHERE id=$id ";
            if (mysqli_query($conn, $sql)) {
                echo $id;
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
?>