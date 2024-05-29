<?php
require_once("/xampp/htdocs/LEI/connections.php");

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $employeeName = $_POST['employeeName'];
    $currentShiftDate = $_POST['currentShiftDate'];
    $currentShiftType = $_POST['currentShiftType'];
    $desiredShiftDate = $_POST['desiredShiftDate'];
    $desiredShiftType = $_POST['desiredShiftType'];
    $swapEmployeeName = isset($_POST['swapEmployeeName']) ? $_POST['swapEmployeeName'] : null;

    // Prepare SQL statement
    $sql = "INSERT INTO shift_change_requests (employeeName, currentShiftDate, currentShiftType, desiredShiftDate, desiredShiftType, swapEmployeeName)
            VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $connections->prepare($sql)) {
        // Bind parameters to the statement
        $stmt->bind_param("ssssss", $employeeName, $currentShiftDate, $currentShiftType, $desiredShiftDate, $desiredShiftType, $swapEmployeeName);

        // Execute the statement
        if ($stmt->execute()) {
            $success_message = "Shift change request submitted successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $error_message = "Error: " . $connections->error;
    }

    // Close the connection
    $connections->close();
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
                    <a href="#">User</a>
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
                    <a href="viewsched" class="sidebar-link">
                        <i class='bx bx-calendar' ></i>                        
                        <span>View Schedule</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="clock" class="sidebar-link">
                        <i class='bx bx-time' ></i>                        
                        <span>Clock In / Clock Out</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="request" class="sidebar-link">
                        <i class='bx bxs-report' ></i>                        
                        <span>Request Shift Change</span>
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
                    <a class="navbar-brand" href="#">Request Change</a>
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

                <div class="container mt-3">
                    <?php if (!empty($success_message)) : ?>
                        <div class="alert alert-success" role="alert"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($error_message)) : ?>
                        <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
                         <?php endif; ?>
                </div>


                <div class="container-fluid border border-dark p-3">
                    <div class="mt-2">
                        <h3 class="fw-bold fs-4 mb-3">Request Shift Change</h3>
                        <form id="shiftChangeForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Employee Name</label>
                                <input type="text" class="form-control" id="employeeName" name="employeeName" required>
                            </div>
                            <div class="mb-3">
                                <label for="currentShiftDate" class="form-label">Current Shift Date</label>
                                <input type="date" class="form-control" id="currentShiftDate" name="currentShiftDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="currentShiftType" class="form-label">Current Shift Type</label>
                                <select class="form-select" id="currentShiftType" name="currentShiftType" required>
                                    <option value="" disabled selected>Select your current shift</option>
                                    <option value="Morning Shift">Morning</option>
                                    <option value="Afternoon Shift">Afternoon</option>
                                    <option value="Night Shift">Night</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="desiredShiftDate" class="form-label">Desired Shift Date</label>
                                <input type="date" class="form-control" id="desiredShiftDate" name="desiredShiftDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="desiredShiftType" class="form-label">Desired Shift Type</label>
                                <select class="form-select" id="desiredShiftType" name="desiredShiftType" required>
                                    <option value="" disabled selected>Select your desired shift</option>
                                    <option value="Morning Shift">Morning</option>
                                    <option value="Afternoon Shift">Afternoon</option>
                                    <option value="Night Shift">Night</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="swapEmployeeName" class="form-label">Swap with Employee (optional)</label>
                                <input type="text" class="form-control" id="swapEmployeeName" name="swapEmployeeName">
                            </div>
                            <button type="submit" class="btn btn-primary">Request Shift Change</button>
                        </form>
                    </div>
                </div>

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