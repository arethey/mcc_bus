<?php
    include '../dbconfig.php';

    if(count($_POST)>0){
        if($_POST['type']==1){
            $busId=$_POST['busId'];
            $driverId=$_POST['driverId'];
            $conductorId=$_POST['conductorId'];
            $routeId=$_POST['routeId'];
            $departure=$_POST['departure'];
            $arrival=$_POST['arrival'];
            $status=$_POST['status'];
            
            $sql = "INSERT INTO `schedulestbl`( `busId`, `driverId`, `conductorId`, `routeId`, `departure`, `arrival`, `status`) 
            VALUES ('$busId', '$driverId', '$conductorId', '$routeId', '$departure', '$arrival', '$status')";
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
            $busId=$_POST['busId'];
            $driverId=$_POST['driverId'];
            $conductorId=$_POST['conductorId'];
            $routeId=$_POST['routeId'];
            $departure=$_POST['departure'];
            $arrival=$_POST['arrival'];
            $status=$_POST['status'];
            
            $sql = "UPDATE `schedulestbl` SET `busId`='$busId', `driverId`='$driverId', `conductorId`='$conductorId', `routeId`='$routeId', `departure`='$departure', `arrival`='$arrival' WHERE id=$id";
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
            $sql = "DELETE FROM `schedulestbl` WHERE id=$id ";
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