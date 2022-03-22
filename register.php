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

    if(isset($_POST["sign-up-submit"])){
        $new_passenger = new Passenger($db);
        
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $password = $_POST["password"];

        $new_passenger->create($first_name, $last_name, $email, $address, $password);
    }
?>

<main>
    <div class="container mt-5">
        <div class="w-100 m-auto bg-white shadow-sm" style="max-width: 500px">
            <div class="bg-primary p-3">
                <h1 class="text-center">Create an Account</h1>
            </div>

            <div class="p-3">
                <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "emailExist"){
                            echo '<div class="alert alert-danger" role="alert">
                            Email already exist.
                          </div>';
                        }else if($_GET["error"] == "stmtfailed"){
                            echo '<div class="alert alert-danger" role="alert">
                            Error on creating an account.
                          </div>';
                        }
                    }
                ?>

                <form method="POST" action="">
                    <div class="form-row mb-3">
                        <div class="col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required />
                        </div>
                        <div class="col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                    <button type="submit" class="btn btn-block btn-dark" name="sign-up-submit">Register</button>

                    <div class="text-center">
                        <span>Already have an account? </span>
                        <a href="login.php">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('includes/scripts.php')?>
<?php include('includes/layout-footer.php')?>