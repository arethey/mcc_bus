<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/styles.css" />

    <title>OBRS</title>
  </head>
  <body class="bg-light">

  <!-- Just an image -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="assets/images/icon-bus.png" style="width: 40px" alt="">
      Online Bus Reservation System
    </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <?php
        if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){
            ?>
              <li class="nav-item">
                <a class="nav-link" href="account.php">My Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            <?php
        }else{
            ?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Sign in</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="register.php">Sign Up</a>
              </li>
            <?php
        }
      ?>
    </ul>
  </div>
  </div>
</nav>