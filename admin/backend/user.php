<?php
    require_once '../dbconfig.php';
    require_once '../functions/users.php';

    if(count($_POST)>0){
        if($_POST['type']==1){
            $fullname=$_POST['fullname'];
            $username=$_POST['username'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $confirmPassword=$_POST['confirmPassword'];
            $status = 1;

            //validation
            if(!validEmail($email)){
                echo json_encode(array("statusCode"=>500, "title"=>"Invalid email.")); //"Invalid email.";
            }else if(!pwdMatch($password, $confirmPassword)){
                echo json_encode(array("statusCode"=>500, "title"=>"Mismatch password.")); //"Mismatch password.";
            }else if(isEmailExist($conn, $email, $username)){
                echo json_encode(array("statusCode"=>500, "title"=>"Email or username already exist.")); //"Email or username already exist.";
            }else{
                $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

                sendVerificationCode($email, $username, $verification_code);

                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `tbluser`( `fullname`,`username`,`email`,`password`, `status`, `verification_code`, `email_verified_at`) 
                VALUES ('$fullname','$username','$email','$hashedPwd', '$status', '$verification_code', NULL)";
                if (mysqli_query($conn, $sql)) {
                    echo json_encode(array("statusCode"=>200));
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        }
    }

    if(count($_POST)>0){
        if($_POST['type']==2){
            $id=$_POST['id'];
            $status=$_POST['status'];
            
            $sql = "UPDATE `tbluser` SET `status`='$status' WHERE id=$id";
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
            $email=$_POST['email'];
            $password=$_POST['password'];

            loginUser($conn, $email, $password);
        }
    }
?>