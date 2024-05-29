<?php
require_once("/xampp/htdocs/LEI/connections.php");

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['approve'])) {
        $requestID = $_POST['requestID'];
        $sql = "UPDATE shift_change_requests SET status='Approved' WHERE requestID=?";
        $stmt = $connections->prepare($sql);
        $stmt->bind_param("i", $requestID);
        if ($stmt->execute()) {
            $success_message = "Shift change request approved successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['reject'])) {
        $requestID = $_POST['requestID'];
        $sql = "UPDATE shift_change_requests SET status='Rejected' WHERE requestID=?";
        $stmt = $connections->prepare($sql);
        $stmt->bind_param("i", $requestID);
        if ($stmt->execute()) {
            $success_message = "Shift change request rejected successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch data from shift_change_requests table
$pending_requests = $connections->query("SELECT * FROM shift_change_requests WHERE status='Pending'");
$approved_requests = $connections->query("SELECT * FROM shift_change_requests WHERE status='Approved'");
$rejected_requests = $connections->query("SELECT * FROM shift_change_requests WHERE status='Rejected'");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                        <i class='bx bx-user'></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="addsched.html" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#sched" aria-expanded="false" aria-controls="auth">
                        <i class='bx bx-clinic'></i>
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
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#list" aria-expanded="false" aria-controls="auth">
                        <i class='bx bx-user'></i>
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
                        <i class='bx bxs-report'></i>
                        <span>Shift Request</span>
                    </a>
                </li>

            </ul>

            <!-- LOGOUT SECTION  -->
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class='bx bx-log-out'></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>


        <!-- MAIN HEADER SECTION -->
        <div class="main">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Admin Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- <form class="d-flex ms-auto">
                            <div class="input-group mb-3">
                                <input type="text" id="search" class="form-control" placeholder="Search notifications">
                            </div>
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
                <div class="container-fluid border border-dark">
                    <div class="mt-3">
                        <h3 class="fw-bold fs-4 mb-3">Clock Records</h3>
                        <table class="table table-striped border-secondary">
                            <thead>
                                <tr>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Clock In Time</th>
                                    <th scope="col">Clock Out Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once("/xampp/htdocs/LEI/connections.php");

                                // Fetch data from clock_table
                                $sql = "SELECT userID, employeeName, clockDate, clockInTime, clockOutTime FROM clock_table";
                                $result = $connections->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . $row["userID"] . "</td>
                                                <td>" . $row["employeeName"] . "</td>
                                                <td>" . $row["clockDate"] . "</td>
                                                <td>" . $row["clockInTime"] . "</td>
                                                <td>" . $row["clockOutTime"] . "</td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container-fluid mt-5">
                    <div class="row mt-3">
                        <!-- Pending Shift Change Requests -->
                        <div class="col-md-4">
                            <h3 class="fw-bold fs-4 mb-3">Pending Requests</h3>
                            <div class="card mb-4">
                                <div class="card-body bg-primary text-light">
                                    <?php
                                    if ($pending_requests->num_rows > 0) {
                                        while ($row = $pending_requests->fetch_assoc()) {
                                            echo "<div class='mb-4'>
                                                    <h5 class='card-title'>Request ID: " . $row["requestID"] . "</h5>
                                                    <p class='card-text'><strong>Employee Name:</strong> " . $row["employeeName"] . "</p>
                                                    
                                                    <div class='d-flex justify-content-between'>
                                                        
                                                        
                                                        <a href='request?requestID=" . $row["requestID"] . "' class='btn btn-light btn-sm'>View</a>
                                                    </div>
                                                </div>";
                                        }
                                    } else {
                                        echo "<div>
                                                <h5 class='card-title'>No Pending Requests</h5>
                                                <p class='card-text'>There are currently no pending shift change requests.</p>
                                            </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Approved Shift Change Requests -->
                        <div class="col-md-4">
                            <h3 class="fw-bold fs-4 mb-3">Approved Requests</h3>
                            <div class="card mb-4">
                                <div class="card-body bg-success text-light">
                                    <?php
                                    if ($approved_requests->num_rows > 0) {
                                        while ($row = $approved_requests->fetch_assoc()) {
                                            echo "<div class='mb-4'>
                                                    <h5 class='card-title'>Request ID: " . $row["requestID"] . "</h5>
                                                    <p class='card-text'><strong>Employee Name:</strong> " . $row["employeeName"] . "</p>
                                                    
                                                    <div class='d-flex justify-content-between'>
                                                        
                                                        
                                                        <a href='request?requestID=" . $row["requestID"] . "' class='btn btn-light btn-sm'>View</a>
                                                    </div>
                                                </div>";
                                        }
                                    } else {
                                        echo "<div>
                                                <h5 class='card-title'>No Approved Requests</h5>
                                                <p class='card-text'>There are currently no approved shift change requests.</p>
                                            </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Rejected Shift Change Requests -->
                        <div class="col-md-4">
                            <h3 class="fw-bold fs-4 mb-3">Rejected Requests</h3>
                            <div class="card mb-4">
                                <div class="card-body bg-danger text-light">
                                    <?php
                                    if ($rejected_requests->num_rows > 0) {
                                        while ($row = $rejected_requests->fetch_assoc()) {
                                            echo "<div class='mb-4'>
                                                    <h5 class='card-title'>Request ID: " . $row["requestID"] . "</h5>
                                                    <p class='card-text'><strong>Employee Name:</strong> " . $row["employeeName"] . "</p>
                                                    
                                                    <div class='d-flex justify-content-between'>
                                                        
                                                        
                                                        <a href='request?requestID=" . $row["requestID"] . "' class='btn btn-light btn-sm'>View</a>
                                                    </div>
                                                </div>";
                                        }
                                    } else {
                                        echo "<div>
                                                <h5 class='card-title'>No Rejected Requests</h5>
                                                <p class='card-text'>There are currently no rejected shift change requests.</p>
                                            </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
</body>

</html>