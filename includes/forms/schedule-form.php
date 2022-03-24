<form class="form-inline" method="GET" action="schedule.php">
    <label class="sr-only" for="route_from">From</label>
    <select class="form-control mb-2 mr-sm-2" id="route_from" name="route_from" value="<?php echo $route_from; ?>" required>
        <option value="" <?php empty($route_from) ? 'selected' : '' ?>>Route From</option>
        <?php
            foreach ($locations as &$row){
                if($route_from == $row["location_name"]){
                    echo '<option value="'.$row["location_name"].'" selected>'.$row["location_name"].'</option>';
                }else{
                    echo '<option value="'.$row["location_name"].'">'.$row["location_name"].'</option>';
                }
            }
        ?>
    </select>

    <h3 class="mb-2 mr-sm-2 text-center">&#x2192;</h3>

    <label class="sr-only" for="route_to">To</label>
    <select class="form-control mb-2 mr-sm-2" id="route_to" name="route_to" value="<?php echo $route_to; ?>" required>
        <option value="" <?php empty($route_to) ? 'selected' : '' ?>>Route To</option>
        <?php
            foreach ($locations as &$row){
                if($route_to == $row["location_name"]){
                    echo '<option value="'.$row["location_name"].'" selected>'.$row["location_name"].'</option>';
                }else{
                    echo '<option value="'.$row["location_name"].'">'.$row["location_name"].'</option>';
                }
            }
        ?>
    </select>

    <label class="sr-only" for="schedule_date">Date</label>
    <input type="date" class="form-control mb-2 mr-sm-2" id="schedule_date" name="schedule_date" value="<?php echo $schedule_date; ?>" required>

    <button type="submit" class="btn btn-dark mb-2 text-uppercase">Find</button>
</form>

<script>
    const schedule_date = document.getElementById("schedule_date");
    schedule_date.min =new Date().toISOString().split("T")[0];
</script>