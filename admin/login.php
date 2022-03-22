<?php
    session_start();
    include 'dbconfig.php';

    if(isset($_SESSION["userId"])){
        header("location: index.php");
        exit;
    }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="icon" href="../assets/img/favicon.ico" type="image/ico">
    <title>Ceres</title>
</head>

<body>
    <div style="width: 100vw; height: 100vh" class="bg-light">
        <div class="h-100 d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="w-100 m-auto" style="max-width: 500px">
                    <h1 class="text-center mb-5">Bantayan Island Online Bus Reservation</h1>
                    <div class="bg-white rounded shadow p-3">
                        <div class="text-center mb-5">
                            <img class="img-fluid" alt="login" src="../assets/img/login.png" style="width: 300px" />
                            <h4>Login</h4>
                        </div>

                        <?php
                            if(isset($_GET["newpwd"])){
                                if($_GET["newpwd"] == "passwordUpdated"){
                                    ?>
                        <div class="alert alert-success" role="alert">
                            Password updated successfully.
                        </div>
                        <?php
                                }
                            }
                        ?>

                        <form id="login_form">
                            <input type="hidden" value="3" name="type">

                            <div class="form mb-3">
                                <input type="email" class="form__input" id="email" name="email" placeholder=" "
                                    required />
                                <label for="email" class="form__label">Email address</label>
                            </div>
                            <div class="mb-3">
                                <div class="form">
                                    <input type="password" class="form__input" id="password" name="password"
                                        placeholder=" " required />
                                    <label for="password" class="form__label">Password</label>
                                </div>
                                <a href="reset-password.php">Forgot password?</a>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/bootstrap/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/jquery.dataTables.min.js"></script>

    <script>
    $("#login_form").submit(function(event) {
        event.preventDefault();
        var data = $("#login_form").serialize();
        console.log(data)

        $.ajax({
            data: data,
            type: "post",
            url: "backend/user.php",
            success: function(dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    alert("Login successfully!");
                    window.location.replace("index.php")
                } else {
                    alert(dataResult.title);
                }
            },
        });
    });
    </script>
</body>

</html>