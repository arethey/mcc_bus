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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="Pending-tab" data-toggle="tab" href="#Pending" role="tab" aria-controls="Pending" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Confirmed-tab" data-toggle="tab" href="#Confirmed" role="tab" aria-controls="Confirmed" aria-selected="false">Confirmed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Cancelled-tab" data-toggle="tab" href="#Cancelled" role="tab" aria-controls="Cancelled" aria-selected="false">Cancelled</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="Pending" role="tabpanel" aria-labelledby="Pending-tab">
                        <div class="row">
                            <?php
                                foreach ($bookings as &$row)
                                {
                                    if($row['payment_status'] == 'pending')
                                    {
                                        $route_from = $new_location->getById($row['route_from']);
                                        $route_to = $new_location->getById($row['route_to']);

                                        ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="border bg-light">
                                                    <div id="<?php echo 'print_'.$row['book_id'] ?>">
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
                                                                <span class="font-weight-bold text-uppercase badge badge-info"><?php echo $row['payment_status'] ?></span>
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

                                                    <div class="p-3">
                                                        <button class="btn btn-sm btn-danger" onclick="cancelBook('<?php echo $row['book_id'] ?>')">Cancel</button>
                                                        <button class="btn btn-sm btn-outline-primary" onclick="PrintElem('<?php echo 'print_'.$row['book_id'] ?>')">Print</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="Confirmed" role="tabpanel" aria-labelledby="Confirmed-tab">
                        <div class="row">
                            <?php
                                foreach ($bookings as &$row)
                                {
                                    if($row['payment_status'] == 'confirmed')
                                    {
                                        $route_from = $new_location->getById($row['route_from']);
                                        $route_to = $new_location->getById($row['route_to']);

                                        ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="border bg-light">
                                                    <div id="<?php echo 'print_'.$row['book_id'] ?>">
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
                                                                <span class="font-weight-bold text-uppercase badge badge-success"><?php echo $row['payment_status'] ?></span>
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

                                                    <div class="p-3">
                                                        <button class="btn btn-sm btn-outline-primary" onclick="PrintElem('<?php echo 'print_'.$row['book_id'] ?>')">Print</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="Cancelled" role="tabpanel" aria-labelledby="Cancelled-tab">
                        <div class="row">
                            <?php
                                foreach ($bookings as &$row)
                                {
                                    if($row['payment_status'] == 'cancel')
                                    {
                                        $route_from = $new_location->getById($row['route_from']);
                                        $route_to = $new_location->getById($row['route_to']);

                                        ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="border bg-light">
                                                    <div id="<?php echo 'print_'.$row['book_id'] ?>">
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
                                                                <span class="font-weight-bold text-uppercase badge badge-danger"><?php echo $row['payment_status'] ?></span>
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
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade bg-white p-3 border-right border-left border-bottom" id="settings" role="tabpanel" aria-labelledby="settings-tab">setings</div>
        </div>
    </div>
</main>

<script>
    function PrintElem(divId)
    {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = "<html><head><title></title></head><body><div style='margin: auto; max-width: 500px'>" + printContents + "</div></body>";
        window.print();
        document.body.innerHTML = originalContents;
    }

    function cancelBook(id)
    {
        if(confirm("Are you sure to cancel this booking?")){
            console.log('cancelBook', id)
            $.ajax({
                cache: false,
                data: {
                    type: 2,
                    id,
                    payment_status: 'cancel'
                },
                type: "post",
                url: "controllers/update-booking.php",
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        alert("Booking cancelled successfully.");
                        location.reload();
                    } else {
                        alert(dataResult.title);
                    }
                },
            });
        }
    }
</script>

<?php include('includes/scripts.php')?>
<?php include('includes/layout-footer.php')?>