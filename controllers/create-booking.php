<?php
    include('db.php');
    $database = new Database();
    $conn = $database->getConnection();

    if(count($_POST)>0){
        if($_POST['type']==1){
            $schedule_id = $_POST['schedule_id'];
            $passenger_id = $_POST['passenger_id'];
            $seat_num = $_POST['seat_num'];
            $payment_status = "pending";
            $total = $_POST['total'];
            $routeName = $_POST['routeName'];
            $book_reference = $routeName."_00".$schedule_id."00".$seat_num;
            
            $sql = "INSERT INTO `tblbook`( `schedule_id`, `passenger_id`, `seat_num`, `payment_status`, `total`, `book_reference`) VALUES ('$schedule_id', '$passenger_id', '$seat_num', '$payment_status', '$total', '$book_reference')";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>201));
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
?>