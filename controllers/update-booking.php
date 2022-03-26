<?php
    include('db.php');
    $database = new Database();
    $conn = $database->getConnection();

    if(count($_POST)>0){
        if($_POST['type']==2){
            $id=$_POST['id'];
            $payment_status=$_POST['payment_status'];
            
            $sql = "UPDATE `tblbook` SET `payment_status`='$payment_status' WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
?>