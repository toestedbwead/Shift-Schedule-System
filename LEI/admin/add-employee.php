<?php

    require_once("/xampp/htdocs/LEI/connections.php");

    //declaring variables for error and success messages
    $success_message = '';
    $error_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $emp_name = $_POST['emp_name'];
        $emp_status = $_POST['emp_status'];
        $emp_role = $_POST['emp_role'];
        $emp_department = $_POST['emp_department'];

        $sql = "INSERT INTO employee_table (emp_name, emp_status, emp_role, emp_department)
                VALUES ('$emp_name', '$emp_status', '$emp_role', '$emp_department')";

        if (mysqli_query($connections, $sql)) {
            $success_message = "Employee added succesfully!";
        }
        else {
            $error_message = "Error: " . $sql . "<br>" . mysqli_error($connections);
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
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
                <li class="sidebar-item">
                    <a href="notification" class="sidebar-link">
                        <i class='bx bx-bell' ></i>                        
                        <span>Notification</span>
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
                    <a class="navbar-brand" href="#">Add Employee</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="d-flex ms-auto">
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
                        </div>
                    </div>
                </div>
            </nav>

            <!-- MAIN SECTION -->
            <div class="main">
            <!-- there used to be a nav search and pfp here -->


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
                <div class="container-fluid">
                    <div class="mb-3">
                    <form id="addEmployeeForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        
                        <div class="mb-3">
                            <label for="emp_name" class="form-label">Full Name:</label>
                            <input type="text" class="form-control border-secondary" id="emp_name" name="emp_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="emp_status" class="form-label">Employment Status:</label>
                            <select class="form-select border-secondary" id="emp_status" name="emp_status" required>
                                <option value="">Select Employment Status</option>
                                <option value="Full-time">Full Time</option>
                                <option value="Part-time">Part Time</option>
                                <option value="Contract">Contract</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="emp_role" class="form-label">Role/Position:</label>
                            <select class="form-select border-secondary" id="emp_role" name="emp_role" required>
                                <option value="">Select Role/Position</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Nurse">Nurse</option>
                                <option value="Surgeon">Surgeon</option>
                                <option value="Physician-assistant">Physician Assistant</option>
                                <option value="Nurse-practitioner">Nurse Practitioner</option>
                                <option value="Registered-nurse">Registered Nurse</option>
                                <option value="Licensed-practical-nurse">Licensed Practical Nurse</option>
                                <option value="Medical-assistant">Medical Assistant</option>
                                <option value="Specialist">Specialist</option>
                                <option value="Technician">Technician</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="emp_department" class="form-label">Department:</label>
                            <select class="form-select border-secondary" id="emp_department" name="emp_department" required>
                                <option value="">Select Department</option>
                                <option value="Emergency-dept">Emergency Dept</option>
                                <option value="Surgery">Surgery</option>
                                <option value="Pediatric">Pediatric</option>
                                <option value="Internal-medicine">Internal Medicine</option>
                                <option value="Gynecology">Gynecology</option>
                                <option value="Radiology">Radiology</option>
                                <option value="Cardiology">Cardiology</option>
                                <option value="Oncology">Oncology</option>
                                <option value="Neurology">Neurology</option>
                                <option value="Psychiatry">Psychiatry</option>
                            </select>
                        </div>
                        <!-- Button to trigger the modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Add Employee</button>

                        <!-- Confirmation Modal -->
                        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Employee Addition</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to add this employee?
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Close the modal if the user cancels -->
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <!-- Submit the form if the user confirms -->
                                        <button type="submit" class="btn btn-primary">Yes, Add Employee</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

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