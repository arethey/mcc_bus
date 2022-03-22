<?php 
    include('includes/layout-header.php');
    include('controllers/check-auth.php');

    include('controllers/db.php');
    $database = new Database();
    $db = $database->getConnection();

    include('controllers/book.php');
    $new_book = new Book($db);
    $bookings = $new_book->getPassengersBooking($_SESSION["userId"]);

    include('controllers/location.php');
    $new_location = new Location($db);
?>

<main>
    <div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="booking" aria-selected="true">My booking</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Account settings</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade bg-white p-3 border-right border-left border-bottom show active" id="booking" role="tabpanel" aria-labelledby="booking-tab">
            <div class="row">
                <?php
                    foreach ($bookings as &$row)
                    {
                        $route_from = $new_location->getById($row['route_from']);
                        $route_to = $new_location->getById($row['route_to']);

                        ?>
                            <div class="col-md-4">
                                <div class="border bg-light">
                                    <div class="bg-primary p-3">
                                        <small><?php echo 'Distance: '.$row['distance'] ?></small>
                                        <h4 class="mb-0">
                                            <?php echo $route_from["location_name"].' &#x2192; '.$route_to["location_name"] ?>
                                        </h4>
                                    </div>

                                    <div class="p-3">
                                        <p class="mb-0 d-flex align-items-center justify-content-between">
                                            <span class="text-muted">Date:</span>
                                            <span class="font-weight-bold"><?php echo date_format(date_create($row['book_date']),'F j, Y') ?></span>
                                        </p>
                                        <p class="mb-0 d-flex align-items-center justify-content-between">
                                            <span class="text-muted">Reference:</span>
                                            <span class="font-weight-bold"><?php echo $row['book_reference'] ?></span>
                                        </p>
                                        <p class="mb-0 d-flex align-items-center justify-content-between">
                                            <span class="text-muted">Seat #:</span>
                                            <span class="font-weight-bold"><?php echo $row['seat_num'] ?></span>
                                        </p>
                                        <p class="mb-0 d-flex align-items-center justify-content-between">
                                            <span class="text-muted">Status:</span>
                                            <span class="font-weight-bold"><?php echo $row['payment_status'] ?></span>
                                        </p>
                                        <p class="mb-0 d-flex align-items-center justify-content-between">
                                            <span class="text-muted">Schedule Date:</span>
                                            <span class="font-weight-bold"><?php echo date_format(date_create($row['schedule_date']),'F j, Y') ?></span>
                                        </p>
                                        <p class="mb-0 d-flex align-items-center justify-content-between">
                                            <span class="text-muted">Departure Time:</span>
                                            <span class="font-weight-bold"><?php echo date_format(date_create($row["departure"]), 'g:i A') ?></span>
                                        </p>
                                        <p class="mb-0 d-flex align-items-center justify-content-between">
                                            <span class="text-muted">Arrival Time:</span>
                                            <span class="font-weight-bold"><?php echo date_format(date_create($row["arrival"]), 'g:i A') ?></span>
                                        </p>
                                        <p class="mb-0 d-flex align-items-center justify-content-between">
                                            <span class="text-muted">Fare:</span>
                                            <span class="font-weight-bold"><?php echo $row['fare'] ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div class="tab-pane fade bg-white p-3 border-right border-left border-bottom" id="settings" role="tabpanel" aria-labelledby="settings-tab">setings</div>
    </div>
    </div>
</main>

<?php include('includes/scripts.php')?>
<?php include('includes/layout-footer.php')?>