<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/ceres/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bus</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newBusModal">
                New Bus
            </button>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bus #</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn,"SELECT * FROM tblbus");
                    $i=1;
                    while($row = mysqli_fetch_array($result)) {
                ?>
                    <tr id="<?php echo $row["id"]; ?>">
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $row["bus_num"]; ?></td>
                        <td>
                            <a href="#busEditModal" class="btn btn-sm btn-warning busUpdate"
                                data-id="<?php echo $row["id"]; ?>" data-bus_num="<?php echo $row["bus_num"]; ?>"
                                data-toggle="modal">Edit</a>
                            <a href="#busDeleteModal" class="btn btn-sm btn-danger busDelete"
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
<div class="modal fade" id="newBusModal" tabindex="-1" aria-labelledby="newBusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="bus_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="newBusModalLabel">New Bus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="type">

                    <div class="form-group">
                        <label>Bus #</label>
                        <input type="text" id="bus_num" name="bus_num" class="form-control" required>
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
<div class="modal fade" id="busEditModal" tabindex="-1" aria-labelledby="busEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit_bus_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="busEditModalLabel">Edit Bus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="2" name="type">
                    <input type="hidden" id="id_u" name="id" class="form-control" required>

                    <div class="form-group">
                        <label>Bus #</label>
                        <input type="text" id="bus_num_u" name="bus_num" class="form-control" required>
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
<div id="busDeleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete_bus_form">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Bus</h4>
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

$("#bus_form").submit(function(event) {
    event.preventDefault();
    var data = $("#bus_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/bus.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $("#newBusModal").modal("hide");
                alert("New bus added successfully!");
                location.reload();
            } else {
                alert(dataResult.title);
            }
        },
    });
});

$(document).on("click", ".busUpdate", function(e) {
    var id = $(this).attr("data-id");
    var bus_num = $(this).attr("data-bus_num");
    $("#id_u").val(id);
    $("#bus_num_u").val(bus_num);
});

$("#edit_bus_form").submit(function(event) {
    event.preventDefault();
    var data = $("#edit_bus_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/bus.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $("#busEditModal").modal("hide");
                alert("Bus updated successfully!");
                location.reload();
            } else {
                alert(dataResult.title);
            }
        },
    });
});

$(document).on("click", ".busDelete", function() {
    var id = $(this).attr("data-id");
    $("#id_d").val(id);
});

$("#delete_bus_form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        cache: false,
        data: {
            type: 3,
            id: $("#id_d").val(),
        },
        type: "post",
        url: "backend/bus.php",
        success: function(dataResult) {
            alert("Bus deleted successfully!");
            $("#busDeleteModal").modal("hide");
            $("#" + dataResult).remove();
        },
    });
});
</script>