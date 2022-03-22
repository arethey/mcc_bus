<?php
    include('../controllers/db.php');
    include('../controllers/schedule.php');
    include('../controllers/route.php');
    include('../controllers/location.php');

    $database = new Database();
    $db = $database->getConnection();
    
    $new_schedule = new Schedule($db);
    $schedules = $new_schedule->getAll();

    $new_location = new Location($db);
?>

<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/ceres/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Schedules</li>
        </ol>
    </nav>

    <div class="text-right mb-3">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newScheduleModal">
            New Schedule
        </button>
    </div>

    <div class="row">
        <?php
            foreach ($schedules as &$row) {
                $new_route = new Route($db);
                $route = $new_route->getById($row["id"]);
                
                $location_from = $new_location->getById($route["route_from"]);
                $location_to = $new_location->getById($route["route_to"]);

                $status = null;

                if($row["status"] === 'waiting'){
                    $status = '<span class="badge badge-primary">WAITING</span>';
                }else if($row["status"] === 'arrived'){
                    $status = '<span class="badge badge-success">ARRIVED</span>';
                }else if($row["status"] === 'cancelled'){
                    $status = '<span class="badge badge-danger">CANCELLED</span>';
                }else if($row["status"] === 'in-transit'){
                    $status = '<span class="badge badge-info">IN-TRANSIT</span>';
                }

                ?>
                <div class="col-md-3">
                    <div class="bg-white shadow-sm">
                        <div class="p-3 bg-primary text-white">
                            <h4 class="mb-0 text-center">
                                <?php echo $location_from["location_name"].' &#x2192; '.$location_to["location_name"] ?>
                            </h4>
                        </div>
                        <div class="p-3">
                            <p class="d-flex align-items-center justify-content-between mb-0">
                                <span class="text-muted d-block">Date:</span>
                                <strong><?php echo date_format(date_create($row['schedule_date']),'F j, Y') ?></strong>
                            </p>
                            <p class="d-flex align-items-center justify-content-between mb-0">
                                <span class="text-muted d-block">Departure Time:</span>
                                <strong><?php echo date_format(date_create($row['departure']), 'g:i A') ?></strong>
                            </p>
                            <p class="d-flex align-items-center justify-content-between mb-0">
                                <span class="text-muted d-block">Arrival Time:</span>
                                <strong><?php echo date_format(date_create($row['arrival']), 'g:i A') ?></strong>
                            </p>
                            <p class="d-flex align-items-center justify-content-between mb-0">
                                <span class="text-muted d-block">Fare:</span>
                                <strong><?php echo $row['fare'] ?></strong>
                            </p>
                            <p class="d-flex align-items-center justify-content-between mb-0">
                                <span class="text-muted d-block">Status:</span>
                                <strong class="text-uppercase"><?php echo $status ?></strong>
                            </p>

                            <div class="mt-3">
                                <button class="btn btn-sm btn-info">View</button>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</div>

<!-- New Bus Modal -->
<div class="modal fade" id="newScheduleModal" tabindex="-1" aria-labelledby="newScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="schedule_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="newScheduleModalLabel">New Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="type">
                    <input type="hidden" value="waiting" name="status">

                    <div class="form-group">
                        <label>Route</label>
                        <select class="form-control" id="routeId" name="routeId" required>
                            <option value="">Select route</option>
                            <?php
                                $route_result = mysqli_query($conn,"SELECT * FROM tblroute");
                                while($route_row = mysqli_fetch_array($route_result)) {
                                $location_from = $new_location->getById($route_row["route_from"]);
                                $location_to = $new_location->getById($route_row["route_to"]);
                            ?>
                                <option value="<?php echo $route_row["id"]; ?>">
                                    <?php echo $location_from["location_name"]." - ".$location_to["location_name"]; ?>
                                </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Departure Date & Time</label>
                        <input type="datetime-local" id="departure" name="departure" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Arrival Date & Time</label>
                        <input type="datetime-local" id="arrival" name="arrival" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Bus</label>
                        <select class="form-control" id="busId" name="busId" required>
                            <option value="">Select bus</option>
                            <?php
                            $bus_result = mysqli_query($conn,"SELECT * FROM bustbl");
                            while($bus_row = mysqli_fetch_array($bus_result)) {
                        ?>
                            <option value="<?php echo $bus_row["id"]; ?>"><?php echo $bus_row["busNum"]; ?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Driver</label>
                        <select class="form-control" id="driverId" name="driverId" required>
                            <option value="">Select driver</option>
                            <?php
                            $driver_result = mysqli_query($conn,"SELECT * FROM drivertbl");
                            while($driver_row = mysqli_fetch_array($driver_result)) {
                        ?>
                            <option value="<?php echo $driver_row["id"]; ?>"><?php echo $driver_row["name"]; ?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Conductor</label>
                        <select class="form-control" id="conductorId" name="conductorId" required>
                            <option value="">Select conductor</option>
                            <?php
                            $conductor_result = mysqli_query($conn,"SELECT * FROM conductortbl");
                            while($conductor_row = mysqli_fetch_array($conductor_result)) {
                        ?>
                            <option value="<?php echo $conductor_row["id"]; ?>"><?php echo $conductor_row["name"]; ?>
                            </option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btn-add" type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Bus Modal -->
<div class="modal fade" id="scheduleEditModal" tabindex="-1" aria-labelledby="scheduleEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit_schedule_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleEditModalLabel">Edit Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="2" name="type">
                    <input type="hidden" value="pending" name="status">
                    <input type="hidden" id="id_u" name="id" class="form-control" required>

                    <div class="form-group">
                        <label>Route</label>
                        <select class="form-control" id="routeId_u" name="routeId" required>
                            <option value="">Select route</option>
                            <?php
                            $route_result = mysqli_query($conn,"SELECT * FROM routes");
                            while($route_row = mysqli_fetch_array($route_result)) {
                        ?>
                            <option value="<?php echo $route_row["id"]; ?>">
                                <?php echo $route_row["routeFrom"]." - ".$route_row["routeTo"]; ?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Departure Date & Time</label>
                        <input type="datetime-local" id="departure_u" name="departure" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Arrival Date & Time</label>
                        <input type="datetime-local" id="arrival_u" name="arrival" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Bus</label>
                        <select class="form-control" id="busId_u" name="busId" required>
                            <option value="">--- Select bus ---</option>
                            <?php
                            $bus_result = mysqli_query($conn,"SELECT * FROM bustbl");
                            while($bus_row = mysqli_fetch_array($bus_result)) {
                        ?>
                            <option value="<?php echo $bus_row["id"]; ?>"><?php echo $bus_row["busNum"]; ?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Driver</label>
                        <select class="form-control" id="driverId_u" name="driverId" required>
                            <option value="">Select driver</option>
                            <?php
                            $driver_result = mysqli_query($conn,"SELECT * FROM drivertbl");
                            while($driver_row = mysqli_fetch_array($driver_result)) {
                        ?>
                            <option value="<?php echo $driver_row["id"]; ?>"><?php echo $driver_row["name"]; ?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Conductor</label>
                        <select class="form-control" id="conductorId_u" name="conductorId" required>
                            <option value="">Select conductor</option>
                            <?php
                            $conductor_result = mysqli_query($conn,"SELECT * FROM conductortbl");
                            while($conductor_row = mysqli_fetch_array($conductor_result)) {
                        ?>
                            <option value="<?php echo $conductor_row["id"]; ?>"><?php echo $conductor_row["name"]; ?>
                            </option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btn-update" type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bus Delete Modal HTML -->
<div id="scheduleDeleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete_schedule_form">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_d" name="id" class="form-control">
                    <p class="mb-0">Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="submit" class="btn btn-danger" id="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#myTable').DataTable();

$("#schedule_form").submit(function(event) {
    event.preventDefault();
    var data = $("#schedule_form").serialize();
    console.log({
        data
    })
    $.ajax({
        data: data,
        type: "post",
        url: "backend/schedule.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $("#newScheduleModal").modal("hide");
                alert("New schedule added successfully!");
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult);
            }
        },
    });
});

$(document).on("click", ".scheduleUpdate", function(e) {


    var id = $(this).attr("data-id");
    var busId = $(this).attr("data-busId");
    var driverId = $(this).attr("data-driverId");
    var conductorId = $(this).attr("data-conductorId");
    var routeId = $(this).attr("data-routeId");
    var departure = $(this).attr("data-departure");
    var arrival = $(this).attr("data-arrival");
    $("#id_u").val(id);
    $("#busId_u").val(busId);
    $("#driverId_u").val(driverId);
    $("#conductorId_u").val(conductorId);
    $("#routeId_u").val(routeId);
    $("#departure_u").val(formatDateTimeLocal(departure));
    $("#arrival_u").val(formatDateTimeLocal(arrival));
});

function formatDateTimeLocal(mydate) {
    const now = new Date(mydate);
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    return now.toISOString().slice(0, 16);
}

$("#edit_schedule_form").submit(function(event) {
    event.preventDefault();
    var data = $("#edit_schedule_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/schedule.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $("#scheduleEditModal").modal("hide");
                alert("Schedule updated successfully!");
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult);
            }
        },
    });
});

$(document).on("click", ".scheduleDelete", function() {
    var id = $(this).attr("data-id");
    $("#id_d").val(id);
});

$("#delete_schedule_form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        cache: false,
        data: {
            type: 3,
            id: $("#id_d").val(),
        },
        type: "post",
        url: "backend/schedule.php",
        success: function(dataResult) {
            alert("Schedule deleted successfully!");
            $("#scheduleDeleteModal").modal("hide");
            $("#" + dataResult).remove();
        },
    });
});
</script>