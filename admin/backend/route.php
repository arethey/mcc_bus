<?php
    include '../dbconfig.php';

    if(count($_POST)>0){
        if($_POST['type']==1){
            $route_from=$_POST['route_from'];
            $route_to=$_POST['route_to'];
            $distance=$_POST['distance'];
            
            $sql = "INSERT INTO `tblroute`( `route_from`, `route_to`, `distance`) 
            VALUES ('$route_from', '$route_to', '$distance')";
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
            $route_from=$_POST['route_from'];
            $route_to=$_POST['route_to'];
            $distance=$_POST['distance'];
            
            $sql = "UPDATE `tblroute` SET `distance`='$distance', `route_from`='$route_from', `route_to`='$route_to' WHERE id=$id";
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
            $sql = "DELETE FROM `tblroute` WHERE id=$id ";
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