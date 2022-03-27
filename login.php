<?php 
    include('includes/layout-header.php');
    
    if(isset($_SESSION["userId"])){
        header("location: account.php");
        exit;
    }

    include('controllers/db.php');
    include('controllers/passenger.php');

    $database = new Database();
    $db = $database->getConnection();

    if(isset($_POST["sign-in-submit"])){
        $new_passenger = new Passenger($db);

        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $new_passenger->login($email, $password);
    }
?>

<main>
    <div class="container mt-5">
        <div class="w-100 m-auto bg-white shadow-sm" style="max-width: 500px">
            <div class="bg-primary p-3">
                <h1 class="text-center">Login</h1>
            </div>

            <div class="p-3">
                <?php
                    if(isset($_GET["signUp"])){
                        if($_GET["signUp"] == "passengerCreated"){
                            echo '<div class="alert alert-success" role="alert">
                            Account created successfully.
                          </div>';
                        }
                    }else if(isset($_GET["newpwd"])){
                        if($_GET["newpwd"] == "passwordUpdated"){
                            ?>
                                <div class="alert alert-success" role="alert">
                                    Password updated successfully.
                                </div>
                            <?php
                        }
                    }else if(isset($_GET["signin"])){
                        if($_GET["signin"] == "fail"){
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Invalid email or password.
                                </div>
                            <?php
                        }
                    }
                ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required />
                        <a href="forget-password.php">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-block btn-dark" name="sign-in-submit">Login</button>

                    <div class="text-center">
                        <span>Not register yet? </span>
                        <a href="register.php">Create an account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('includes/scripts.php')?>
<?php include('includes/layout-footer.php')?>