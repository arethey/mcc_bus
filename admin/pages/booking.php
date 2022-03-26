<?php
    include('../controllers/db.php');
    $database = new Database();
    $db = $database->getConnection();

    include('../controllers/book.php');
    $new_book = new Book($db);
    $bookings = $new_book->getAll();

    include('../controllers/location.php');
    $new_location = new Location($db);
?>

<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/ceres/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
        </ol>
    </nav>

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
                                            <div class="bg-primary text-white p-3">
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
                                                    <span class="font-weight-bold text-uppercase badge badge-info"><?php echo $row["payment_status"] ?></span>
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
                                            <button class="btn btn-sm btn-primary" onclick="confirmBook('<?php echo $row['book_id'] ?>')">Confirm</button>
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
                                            <div class="bg-primary text-white p-3">
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
                                            <div class="bg-primary text-white p-3">
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

<script>
    function confirmBook(id)
    {
        if(confirm("Are you sure to confirm this booking?")){
            $.ajax({
                cache: false,
                data: {
                    type: 2,
                    id,
                    payment_status: 'confirmed'
                },
                type: "post",
                url: "../controllers/update-booking.php",
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        alert("Booking confirmed successfully.");
                        location.reload();
                    } else {
                        alert(dataResult.title);
                    }
                },
            });
        }
    }
</script>