<?php

    require_once("/xampp/htdocs/LEI/connections.php");

    $success_message = $error_message = "";

    // Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $employeeName = $_POST['employeeName'];
    $shiftType = $_POST['shiftType'];
    $date = $_POST['date'];
    $notes = mysqli_real_escape_string($connections, $_POST['notes']);
    
    // Get shift start time based on selected shift type
    $shiftTime = getShiftTime($shiftType);
    
    // Convert the date to month/day/year format
    $date = date('m/d/Y', strtotime($date));
    // Get the day corresponding to the selected date
    $day = date('l', strtotime($date));
    
    // Insert data into the database
    $sql = "INSERT INTO shift_table (employeeName, shift_type, shift_time, date, day, notes) 
            VALUES ('$employeeName', '$shiftType', '$shiftTime', '$date', '$day', '$notes')";

    if (mysqli_query($connections, $sql)) {
        $success_message = "Schedule added successfully";
    } else {
        $error_message = "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Function to get shift start time based on shift type
function getShiftTime($shiftType) {
    switch ($shiftType) {
        case 'Morning':
            return '6:00 am - 2:00 pm';
        case 'Afternoon':
            return '2:00 pm - 10:00 pm';
        case 'Evening':
            return '10:00 pm - 6:00 am'; 
        default:
            return ''; // Default value if shift type is invalid
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shift and Scheduling System</title>
    <!-- <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" /> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <div class="wrapper">

        <!-- SIDEBAR SECTION ! -->
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class='bx bx-grid-alt'></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Admin</a>
                </div>
            </div>

            <!-- LIST OF MODULES -->
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="dashboard" class="sidebar-link">
                        <i class='bx bx-user' ></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="addsched.html" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#sched" aria-expanded="false" aria-controls="auth">
                        <i class='bx bx-clinic' ></i>
                        <span>Shift & Scheduling</span>
                    </a>

                    <ul id="sched" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="schedule-table" class="sidebar-link">Schedule Table</a>
                        </li>
                    </ul>
                    <ul id="sched" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="add-schedule" class="sidebar-link">Add Schedule</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#list" aria-expanded="false" aria-controls="auth">
                        <i class='bx bx-user' ></i>
                        <span>Employees</span>
                    </a>

                    <ul id="list" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="list-of-employees" class="sidebar-link">List of Employees</a>
                        </li>
                    </ul>

                    <ul id="list" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="add-employee" class="sidebar-link">Add Employee</a>
                        </li>
                    </ul>
                </li>

                <!-- MODULE w submodules -->
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class='bx bx-heart-circle'></i>
                        <span>Module 4</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->

                <!-- CONT. OF LIST OF MODULES HERE  -->
                <li class="sidebar-item">
                    <a href="request" class="sidebar-link">
                        <i class='bx bxs-report' ></i>                        
                        <span>Shift Request</span>
                    </a>
                </li>
                
            </ul>

            <!-- LOGOUT SECTION  -->
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class='bx bx-log-out' ></i>    
                    <span>Logout</span>
                </a>
            </div>
        </aside>


        <!-- MAIN HEADER SECTION -->
        <div class="main">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Add Schedule</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- <form class="d-flex ms-auto">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <div class="dropdown ms-3">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="path/to/default/profile.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                                <strong>Profile</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <form class="px-4 py-3">
                                        <div class="mb-3">
                                            <label for="profilePicture" class="form-label">Upload Profile Picture</label>
                                            <input type="file" class="form-control" id="profilePicture">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </form>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </nav>


            <!-- MAIN SECTION -->
            <main class="content px-3 py-4">
                <div class="container-fluid">

                <div class="container mt-3">
                        <?php if (!empty($success_message)) : ?>
                            <div class="alert alert-success" role="alert"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($error_message)) : ?>
                            <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="mb-3">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Employee Name</label>
                                <input type="text" class="form-control border-secondary" id="employeeName" name="employeeName" required>
                            </div>

                            <div class="mb-3">
                                <label for="shiftType" class="form-label">Shift Type</label>
                                <select class="form-select border-secondary" id="shiftType" name="shiftType" required>
                                    <option value="Morning">Morning</option>
                                    <option value="Afternoon">Afternoon</option>
                                    <option value="Evening">Evening</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control border-secondary" id="date" name="date" required>
                            </div>


                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control border-secondary" id="notes" name="notes" rows="3"></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Schedule</button>

                            <!-- Confirmation Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirm Schedule Addition</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to add this schedule?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Yes, Add Schedule</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <!-- there used to be a table here and other cards -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                You are logging out
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-danger">
                            Are you sure you want to log out?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <a href="/LEI/login">
                                <button type="button" class="btn btn-primary">Yes</button>
                            </a>
                        </div>
                    </div>
                </div>
            </main>

            
            
            <!-- FOOTER SECTION -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-body-secondary">
                        <div class="col-6 text-start ">
                            <a class="text-body-secondary" href=" #">
                                <strong>Shift & Schedule</strong>
                            </a>
                        </div>
                        <div class="col-6 text-end text-body-secondary d-none d-md-block">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a class="text-body-secondary" href="#">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-body-secondary" href="#">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-body-secondary" href="#">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
</body>

</html>