<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-6 col-sm-4 col-md-3 mb-3">
            <div class="bg-white shadow border-top p-3 border-primary rounded h-100">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="50px"
                        viewBox="0 0 24 24" width="50px" fill="#000000">
                        <rect fill="none" height="50" width="50" />
                        <path
                            d="M17,4H7V3h10V4z M17,21H7v-1h10V21z M17,1H7C5.9,1,5,1.9,5,3v18c0,1.1,0.9,2,2,2h10c1.1,0,2-0.9,2-2V3C19,1.9,18.1,1,17,1 L17,1z M7,6h10v12H7V6z M16,11V9.14C16,8.51,15.55,8,15,8H9C8.45,8,8,8.51,8,9.14l0,1.96c0.55,0,1,0.45,1,1c0,0.55-0.45,1-1,1 l0,1.76C8,15.49,8.45,16,9,16h6c0.55,0,1-0.51,1-1.14V13c-0.55,0-1-0.45-1-1C15,11.45,15.45,11,16,11z M12.5,14.5h-1v-1h1V14.5z M12.5,12.5h-1v-1h1V12.5z M12.5,10.5h-1v-1h1V10.5z" />
                    </svg>
                    <div class="text-center w-100">
                        <p class="mb-0">Total Bookings</p>
                        <h1>
                            <?php
                    $q = mysqli_query($conn,"SELECT * from tblbook");
                    $num_rows = mysqli_num_rows($q);
                    echo $num_rows;
                ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-3">
            <div class="bg-white shadow border-top p-3 border-primary rounded h-100">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 0 24 24" width="50px"
                        fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M7 11h2v2H7v-2zm14-5v14c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2l.01-14c0-1.1.88-2 1.99-2h1V2h2v2h8V2h2v2h1c1.1 0 2 .9 2 2zM5 8h14V6H5v2zm14 12V10H5v10h14zm-4-7h2v-2h-2v2zm-4 0h2v-2h-2v2z" />
                    </svg>
                    <div class="text-center w-100">
                        <p class="mb-0">Total Schedules</p>
                        <h1>
                            <?php
                    $q = mysqli_query($conn,"SELECT * from tblschedule");
                    $num_rows = mysqli_num_rows($q);
                    echo $num_rows;
                ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-3">
            <div class="bg-white shadow border-top p-3 border-primary rounded h-100">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 0 24 24" width="50px"
                        fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z" />
                        <circle cx="12" cy="9" r="2.5" />
                    </svg>
                    <div class="text-center w-100">
                        <p class="mb-0">Total Routes</p>
                        <h1>
                            <?php
                    $q = mysqli_query($conn,"SELECT * from tblroute");
                    $num_rows = mysqli_num_rows($q);
                    echo $num_rows;
                ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-3">
            <div class="bg-white shadow border-top p-3 border-primary rounded h-100">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 0 24 24" width="50px"
                        fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z" />
                        <circle cx="12" cy="9" r="2.5" />
                    </svg>
                    <div class="text-center w-100">
                        <p class="mb-0">Total Locations</p>
                        <h1>
                            <?php
                    $q = mysqli_query($conn,"SELECT * from tbllocation");
                    $num_rows = mysqli_num_rows($q);
                    echo $num_rows;
                ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-3">
            <div class="bg-white shadow border-top p-3 border-primary rounded h-100">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 20 20" height="50px"
                        viewBox="0 0 20 20" width="50px" fill="#000000">
                        <g>
                            <rect fill="none" height="20" width="20" x="0" />
                        </g>
                        <g>
                            <g />
                            <g>
                                <polygon points="8,5 11,5 11,8 12,8 12,4 7,4 7,7 4,7 4,16 5,16 5,8 8,8" />
                                <rect height="1" width="1" x="6" y="9" />
                                <rect height="1" width="1" x="9" y="6" />
                                <rect height="1" width="1" x="6" y="11" />
                                <rect height="1" width="1" x="6" y="13" />
                                <path
                                    d="M15.11,9.34C15.05,9.14,14.85,9,14.64,9H9.36C9.15,9,8.95,9.14,8.89,9.34L8,12v2v0.5V15v0.5C8,15.78,8.22,16,8.5,16 S9,15.78,9,15.5V15h6v0.5c0,0.28,0.22,0.5,0.5,0.5s0.5-0.22,0.5-0.5V15v-0.5V14v-2L15.11,9.34z M9.72,10h4.56l0.67,2H9.05L9.72,10 z M9.5,14C9.22,14,9,13.78,9,13.5S9.22,13,9.5,13s0.5,0.22,0.5,0.5S9.78,14,9.5,14z M14.5,14c-0.28,0-0.5-0.22-0.5-0.5 s0.22-0.5,0.5-0.5s0.5,0.22,0.5,0.5S14.78,14,14.5,14z" />
                            </g>
                        </g>
                    </svg>
                    <div class="text-center w-100">
                        <p class="mb-0">Total Bus</p>
                        <h1>
                            <?php
                    $q = mysqli_query($conn,"SELECT * from tblbus");
                    $num_rows = mysqli_num_rows($q);
                    echo $num_rows;
                ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-3">
            <div class="bg-white shadow border-top p-3 border-primary rounded h-100">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 0 24 24" width="50px"
                        fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 9c2.7 0 5.8 1.29 6 2v1H6v-.99c.2-.72 3.3-2.01 6-2.01m0-11C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
                    </svg>
                    <div class="text-center w-100">
                        <p class="mb-0">Total Drivers</p>
                        <h1>
                            <?php
                    $q = mysqli_query($conn,"SELECT * from tbldriver");
                    $num_rows = mysqli_num_rows($q);
                    echo $num_rows;
                ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-3">
            <div class="bg-white shadow border-top p-3 border-primary rounded h-100">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 0 24 24" width="50px"
                        fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 9c2.7 0 5.8 1.29 6 2v1H6v-.99c.2-.72 3.3-2.01 6-2.01m0-11C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
                    </svg>
                    <div class="text-center w-100">
                        <p class="mb-0">Total Conductors</p>
                        <h1>
                            <?php
                    $q = mysqli_query($conn,"SELECT * from tblconductor");
                    $num_rows = mysqli_num_rows($q);
                    echo $num_rows;
                ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-3">
            <div class="bg-white shadow border-top p-3 border-primary rounded h-100">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 0 24 24" width="50px"
                        fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 9c2.7 0 5.8 1.29 6 2v1H6v-.99c.2-.72 3.3-2.01 6-2.01m0-11C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
                    </svg>
                    <div class="text-center w-100">
                        <p class="mb-0">Total Passengers</p>
                        <h1>
                            <?php
                    $q = mysqli_query($conn,"SELECT * from tblpassenger");
                    $num_rows = mysqli_num_rows($q);
                    echo $num_rows;
                ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>