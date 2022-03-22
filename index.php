<?php 
    include('includes/layout-header.php');
    include('controllers/db.php');
    include('controllers/location.php');

    $route_from = isset($_GET['route_from']) && !empty($_GET['route_from']) ? $_GET['route_from'] : "";
    $route_to = isset($_GET['route_to']) && !empty($_GET['route_to']) ? $_GET['route_to'] : "";
    $schedule_date = isset($_GET['schedule_date']) && !empty($_GET['schedule_date']) ? $_GET['schedule_date'] : "";

    $database = new Database();
    $db = $database->getConnection();

    $new_location = new Location($db);
    $locations = $new_location->getAll();
    $location_from = $new_location->getByLocation($route_from);
    $location_to = $new_location->getByLocation($route_to);
?>

<main>
    <div style="background-color: #ffc432" class="d-flex align-items-center justify-content-center p-4">
        <?php include("includes/forms/schedule-form.php") ?>
    </div>
</main>

<?php include('includes/scripts.php')?>
<?php include('includes/layout-footer.php')?>