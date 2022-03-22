<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/ceres/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Drivers</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newDriverModal">
                New Driver
            </button>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Liscense #</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn,"SELECT * FROM tbldriver");
                    $i=1;
                    while($row = mysqli_fetch_array($result)) {
                ?>
                    <tr id="<?php echo $row["id"]; ?>">
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["liscenseNum"]; ?></td>
                        <td>
                            <a href="#driverEditModal" class="btn btn-sm btn-warning driverUpdate"
                                data-id="<?php echo $row["id"]; ?>" data-name="<?php echo $row["name"]; ?>"
                                data-liscenseNum="<?php echo $row["liscenseNum"]; ?>" data-toggle="modal">Edit</a>
                            <a href="#driverDeleteModal" class="btn btn-sm btn-danger driverDelete"
                                data-id="<?php echo $row["id"]; ?>" data-toggle="modal">Delete</a>
                        </td>
                    </tr>
                    <?php
				    $i++;
				    }
				?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- New Bus Modal -->
<div class="modal fade" id="newDriverModal" tabindex="-1" aria-labelledby="newBusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="driver_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="newBusModalLabel">New Driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="type">

                    <div class="form-group">
                        <label>Fullname</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Liscense Num</label>
                        <input type="text" id="liscenseNum" name="liscenseNum" class="form-control" required>
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
<div class="modal fade" id="driverEditModal" tabindex="-1" aria-labelledby="driverEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit_driver_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="driverEditModalLabel">Edit Driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="2" name="type">
                    <input type="hidden" id="id_u" name="id" class="form-control" required>

                    <div class="form-group">
                        <label>Fullname</label>
                        <input type="text" id="name_u" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Liscense #</label>
                        <input type="text" id="liscenseNum_u" name="liscenseNum" class="form-control" required>
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
<div id="driverDeleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete_driver_form">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Driver</h4>
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

$("#driver_form").submit(function(event) {
    event.preventDefault();
    var data = $("#driver_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/driver.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $("#newDriverModal").modal("hide");
                alert("New driver added successfully!");
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult);
            }
        },
    });
});

$(document).on("click", ".driverUpdate", function(e) {
    var id = $(this).attr("data-id");
    var name = $(this).attr("data-name");
    var liscenseNum = $(this).attr("data-liscenseNum");
    $("#id_u").val(id);
    $("#name_u").val(name);
    $("#liscenseNum_u").val(liscenseNum);
});

$("#edit_driver_form").submit(function(event) {
    event.preventDefault();
    var data = $("#edit_driver_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/driver.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $("#driverEditModal").modal("hide");
                alert("Driver updated successfully!");
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult);
            }
        },
    });
});

$(document).on("click", ".driverDelete", function() {
    var id = $(this).attr("data-id");
    $("#id_d").val(id);
});

$("#delete_driver_form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        cache: false,
        data: {
            type: 3,
            id: $("#id_d").val(),
        },
        type: "post",
        url: "backend/driver.php",
        success: function(dataResult) {
            alert("Driver deleted successfully!");
            $("#driverDeleteModal").modal("hide");
            $("#" + dataResult).remove();
        },
    });
});
</script>