<?php
    include('includes/layout-header.php');

    $schedule_id = isset($_GET['schedule_id']) && !empty($_GET['schedule_id']) ? $_GET['schedule_id'] : "";
    if(empty($schedule_id)){
        header('Location: index.php');
    }else{
        include('controllers/db.php');
        include('controllers/schedule.php');

        $database = new Database();
        $db = $database->getConnection();

        $new_schedule = new Schedule($db);
        $schedule = $new_schedule->getById($schedule_id);
        $fare = $schedule['fare'];

        if(empty($schedule["id"])){
            header('Location: index.php');
        }else{
            include('controllers/route.php');
            include('controllers/location.php');
            include('controllers/book.php');

            $new_route = new Route($db);
            $route = $new_route->getById($schedule["route_id"]);

            $new_location = new Location($db);
            $location_from = $new_location->getById($route["route_from"]);
            $location_to = $new_location->getById($route["route_to"]);
        }
    }
?>

<main class="mt-5">
    <div class="container">
        <div class="bg-white shadow-sm w-100 m-auto" style="max-width: 500px">
            <div class="p-3 bg-primary">
                <h4 class="mb-0 text-center">
                    <?php echo $location_from["location_name"].' &#x2192; '.$location_to["location_name"] ?>
                </h4>
            </div>
            <div class="p-3">
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Date:</span>
                    <strong><?php echo date_format(date_create($schedule['schedule_date']),'F j, Y') ?></strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Departure Time:</span>
                    <strong><?php echo date_format(date_create($schedule['departure']), 'g:i A') ?></strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Arrival Time:</span>
                    <strong><?php echo date_format(date_create($schedule['arrival']), 'g:i A') ?></strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Fare:</span>
                    <strong><?php echo $schedule['fare'] ?></strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Status:</span>
                    <strong class="text-uppercase"><?php echo $schedule['status'] ?></strong>
                </p>
                <!-- <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Passenger:</span>
                    <strong>''</strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Email:</span>
                    <strong>''</strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Address:</span>
                    <strong>''</strong>
                </p> -->
                <hr />

                <div>
                    <div class="my-3">
                        <p class="mb-0">Legend</p>
                        <div class="d-flex">
                            <div class="d-flex align-items-center mr-2">
                                <span style="height: 16px; width: 16px; background-color: #007bff; opacity: .65;" class="d-inline-block mr-2"></span>
                                <span>Reserved</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <span style="height: 16px; width: 16px;" class="bg-dark d-inline-block mr-2"></span>
                                <span>Selected</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span style="height: 16px; width: 16px; border: 2px solid black" class="d-inline-block mr-2"></span>
                                <span>Available</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-dark text-white text-center">Front</div>
                    <div class="py-2">
                    <table class="table table-borderless">
                        <tbody>
                        <?php
                            $seat_row_num = 0;

                            for ($i = 1; $i <= 10; $i++)
                            {
                                echo '<tr>';
                                for ($x = 1; $x <= 5; $x++) {
                                    if($x == 3){
                                        echo '<td>&nbsp;</td>';
                                    }else{
                                        $seat_row_num++;
                                        
                                        $new_book = new Book($db);
                                        $book = $new_book->checkSeat($schedule["id"], $seat_row_num);

                                        if(empty($book["id"])){
                                            echo '<td><button data-seat="'.$seat_row_num.'" class="btn-seat btn btn-sm btn-block btn-outline-dark">'.$seat_row_num.'</button></td>';
                                        }else{
                                            echo '<td><button class="btn btn-sm btn-block btn-primary" disabled>'.$seat_row_num.'</button></td>';
                                        }
                                    }
                                }
                                echo '</tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="bg-dark text-white text-center">Back</div>
                </div>
                
                <hr />
                <h1>Total: <span id='total'>0</span></h1>
                <hr />

                <div class="text-right">
                    <a href="index.php" class="btn btn-outline-dark">Cancel</a>
                    <button id="booked" class="btn btn-dark">Book</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('includes/scripts.php')?>

<script>
    const from ='<?php echo $location_from["location_name"] ?>';
    const to ='<?php echo $location_to["location_name"] ?>';
    const routeName = `${from.slice(0, 3)}-${to.slice(0, 3)}`

    const isVerified = '<?php echo isset($_SESSION["isVerified"]) && !empty($_SESSION["isVerified"]) ? $_SESSION["isVerified"] : false ?>';
    const schedule_id = '<?php echo isset($_GET['schedule_id']) && !empty($_GET['schedule_id']) ? $_GET['schedule_id'] : false ;?>';
    const passenger_id = '<?php echo isset($_SESSION["userId"]) && !empty($_SESSION["userId"]) ? $_SESSION["userId"] : false ;?>';
    const fare = '<?php echo $fare ;?>';
    let totalFare = 0;
    let seats = [];
    const status = '<?php echo $schedule['status'] ?>'

    $( ".btn-seat" ).click(function() {
        const seat_num = $(this).attr("data-seat");
        if(seats.includes(seat_num)){
            seats = seats.filter(el => el !== seat_num)
            $(this).removeClass("btn-dark");
            $(this).addClass("btn-outline-dark");

            handleTotal();
        }else{
            seats.push(seat_num)
            $(this).addClass("btn-dark");
            $(this).removeClass("btn-outline-dark");

            handleTotal();
        }
    });

    $( "#booked" ).click(async function() {
        if(seats.length === 0){
            alert('Please select seat number.')
            return
        }

        if(!passenger_id){
            alert('Unable to create booking. Please sign in your account.')
            return
        }

        if(!isVerified){
            alert('Unable to create booking. Please verify your account.')
            return
        }

        if(status !== 'waiting'){
            alert('Oops! Unable to book this schedule.')
            return
        }

        let promises = []
        for (let i = 0; i < seats.length; i++) {
            const seat = seats[i];

            let formData = new FormData();
            formData.append('type', 1);
            formData.append('schedule_id', schedule_id);
            formData.append('passenger_id', passenger_id);
            formData.append('total', totalFare);
            formData.append('seat_num', seat);
            formData.append('routeName', routeName);

            promises.push(
                fetch('controllers/create-booking.php', {
                    method: 'POST',
                    body: formData,
                })
            )

            // fetch('controllers/create-booking.php', {
            //         method: 'POST',
            //         body: formData,
            //     }).then(function(response) {
            //         if (response.ok) {
            //             alert("New booking added successfully!");
            //             location.reload();
            //         }
            //         return Promise.reject(response);
            //     }).then(function(data) {
            //         console.log(data);
            //     }).catch(function(error) {
            //         console.warn(error);
            //     });
        }
        try {
            const values = await Promise.all(promises);
            console.log('values', values)
            alert("New booking added successfully!");
            location.reload();
        } catch (error) {
            alert("Erro on booking.");
            location.reload();
        }
    });

    function handleTotal(){
        totalFare = seats.length * +fare;
        $("#total").text(totalFare);
    }
</script>

<?php include('includes/layout-footer.php')?>