<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/ceres/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newUserModal">
                New User
            </button>
        </div>

        <div class="card-body">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn,"SELECT * FROM tbluser");
                    $i=1;
                    while($row = mysqli_fetch_array($result)) {
                ?>
                    <tr id="<?php echo $row["id"]; ?>">
                        <th scope="row"><?php echo $i; ?></th>
                        <td>
                            <?php echo $row["fullname"]; ?>
                        </td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo date('m-d-Y', strtotime($row["date_created"])); ?></td>
                        <!-- <td><?php echo $row['status'] === '1' ? '<span class="badge badge-primary">Enable</span>' : '<span class="badge badge-danger">Disable</span>'; ?> -->
                        </td>
                        <td>
                            <?php
                            if($row['status'] === '1'){
                                ?>
                            <div class="btn-group btn-group-sm" role="group" aria-label="<?php echo $row["id"]; ?>">
                                <button class="btn btn-dark" disabled>Active</button>
                                <button class="btn btn-outline-dark"
                                    onclick="handleUserStatus(<?php echo $row['id']; ?>, '0')">Deactivate</button>
                            </div>
                            <?php
                            }else{
                                ?>
                            <div class="btn-group btn-group-sm" role="group" aria-label="<?php echo $row["id"]; ?>">
                                <button class="btn btn-outline-dark"
                                    onclick="handleUserStatus(<?php echo $row['id']; ?>, '1')">Active</button>
                                <button class="btn btn-dark" disabled>Deactivate</button>
                            </div>
                            <?php
                            }
                        ?>
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

<!-- New User Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="user_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserModalLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="type">

                    <div class="form-group">
                        <label>Fullname</label>
                        <input type="text" id="fullname" name="fullname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control"
                            required>
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

<script>
$('#myTable').DataTable();

$("#user_form").submit(function(event) {
    event.preventDefault();
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/user.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $("#newUserModal").modal("hide");
                alert("New user added successfully!");
                location.reload();
            } else {
                alert(dataResult.title);
            }
        },
    });
});

function handleUserStatus(id, status) {
    const text = status === '0' ? "Are you sure you want to deactivate this user?" :
        "Are you sure you want to activate this user?"

    if (confirm(text)) {
        $.ajax({
            data: {
                type: 2,
                id,
                status
            },
            type: "post",
            url: "backend/user.php",
            success: function(dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    $("#userStatusModal").modal("hide");
                    alert("User updated successfully!");
                    location.reload();
                } else if (dataResult.statusCode == 201) {
                    alert(dataResult);
                }
            },
        });
    }
}
</script>