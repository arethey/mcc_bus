<?php
    include '../dbconfig.php';

    if(count($_POST)>0){
        if($_POST['type']==1){
            $name=$_POST['name'];
            $liscenseNum=$_POST['liscenseNum'];
            
            $sql = "INSERT INTO `tblconductor`( `name`, `liscenseNum`) 
            VALUES ('$name', '$liscenseNum')";
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
            $name=$_POST['name'];
            $liscenseNum=$_POST['liscenseNum'];
            
            $sql = "UPDATE `tblconductor` SET `name`='$name', `liscenseNum`='$liscenseNum' WHERE id=$id";
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
            $sql = "DELETE FROM `tblconductor` WHERE id=$id ";
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