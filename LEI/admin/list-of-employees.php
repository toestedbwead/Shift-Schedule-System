<?php

require_once("/xampp/htdocs/LEI/connections.php");

// Check if the delete_employee form is submitted
if (isset($_POST['delete_employee'])) {
    // Get the employee ID to delete
    $emp_id = $_POST['emp_id'];
    
    // Construct the SQL query to delete the employee
    $delete_query = "DELETE FROM employee_table WHERE emp_id = $emp_id";
    
    // Execute the query
    if (mysqli_query($connections, $delete_query)) {
        $success_message = "Employee deleted successfully.";
    } else {
        $error_message = "Error deleting employee: " . mysqli_error($connections);
    }
}

// Check if the save_changes form is submitted
if (isset($_POST['save_changes'])) {
    // Get the updated employee information
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $emp_status = $_POST['emp_status'];
    $emp_role = $_POST['emp_role'];
    $emp_department = $_POST['emp_department'];
    
    // Construct the SQL query to update the employee
    $update_query = "UPDATE employee_table SET emp_name='$emp_name', emp_status='$emp_status', emp_role='$emp_role', emp_department='$emp_department' WHERE emp_id=$emp_id";
    
    // Execute the query
    if (mysqli_query($connections, $update_query)) {
        $success_message = "Employee updated successfully.";
    } else {
        $error_message = "Error updating employee: " . mysqli_error($connections);
    }
}

// Retrieve the list of employees
$query = "SELECT * FROM employee_table";
$result = mysqli_query($connections, $query);

//VIEW MORE FUNCTION

$limit = 5;

// Get the current page number from the URL, default to 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the query
$offset = ($page - 1) * $limit;

// Construct the SQL query to fetch employees with pagination
$query = "SELECT * FROM employee_table LIMIT $limit OFFSET $offset";
$result = mysqli_query($connections, $query);

// Check if there are more records beyond the current page
$has_more_records = mysqli_num_rows($result) === $limit;

// Check if the view_more form is submitted
if (isset($_POST['view_more'])) {
    // Increment the page number to fetch the next set of records
    $page++;
    // Redirect back to the same page with updated page number
    header("Location: {$_SERVER['PHP_SELF']}?page=$page");
    exit;
}

// Check if the back form is submitted
if (isset($_POST['back'])) {
    // Decrement the page number to go back to the previous set of records
    $page = max($page - 1, 1);
    // Redirect back to the same page with updated page number
    header("Location: {$_SERVER['PHP_SELF']}?page=$page");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard.css">

</head>

<body>
    <div class="wrapper">
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
                    <a href="dashboard.php" class="sidebar-link">
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
                            <a href="schedule-table.php" class="sidebar-link">Schedule Table</a>
                        </li>
                    </ul>
                    <ul id="sched" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="add-schedule.php" class="sidebar-link">Add Schedule</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#list" aria-expanded="false" aria-controls="auth">
                        <i class='bx bx-clinic' ></i>
                        <span>Employees</span>
                    </a>

                    <ul id="list" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="list-of-employees.php" class="sidebar-link">List of Employees</a>
                        </li>
                    </ul>

                    <ul id="list" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="add-employee.php" class="sidebar-link">Add Employee</a>
                        </li>
                    </ul>
                </li>

                <!-- MODULE w submodules -->
                <li class="sidebar-item">
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
                </li>

                <!-- CONT. OF LIST OF MODULES HERE  -->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class='bx bx-bell' ></i>                        
                        <span>Module 5</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class='bx bx-cog' ></i>                        
                        <span>Setting</span>
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

        <div class="main">
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
                        <h3 class="fw-bold mb-4">List of Employees</h3>
                        <div class="card mt-5">
                            <table class="table table-bordered">
                                <tr>
                                    <td> Employee ID </td>
                                    <td> Name </td>
                                    <td> Employment Status </td>
                                    <td> Role Position </td>
                                    <td> Department </td>
                                    <td> Actions </td>
                                </tr>

                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $emp_id = $row['emp_id'];
                                    $emp_name = $row['emp_name'];
                                    $emp_status = $row['emp_status'];
                                    $emp_role = $row['emp_role'];
                                    $emp_department = $row['emp_department'];
                                ?>
                                    <tr>
                                        <td><?php echo $emp_id ?></td>
                                        <td><?php echo $emp_name ?></td>
                                        <td><?php echo $emp_status ?></td>
                                        <td><?php echo $emp_role ?></td>
                                        <td><?php echo $emp_department ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $emp_id ?>">Edit</button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $emp_id ?>">Delete</button>
                                            
                                        </td>
                                    </tr>
                                    
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal<?php echo $emp_id ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $emp_id ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?php echo $emp_id ?>">Edit Employee</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                        <input type="hidden" name="emp_id" value="<?php echo $emp_id ?>">
                                                        <div class="mb-3">
                                                            <label for="emp_name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="emp_name" name="emp_name" value="<?php echo $emp_name ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="emp_status" class="form-label">Employment Status</label>
                                                            <select class="form-select border-secondary" id="emp_status" name="emp_status">
                                                                <option value="">Select Employment Status</option>
                                                                <option value="Full-time" <?php if ($emp_status == 'Full-time') echo 'selected'; ?>>Full Time</option>
                                                                <option value="Part-time" <?php if ($emp_status == 'Part-time') echo 'selected'; ?>>Part Time</option>
                                                                <option value="Contract" <?php if ($emp_status == 'Contract') echo 'selected'; ?>>Contract</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="emp_role" class="form-label">Role Position</label>
                                                            <select class="form-select border-secondary" id="emp_role" name="emp_role">
                                                                <option value="">Select Role/Position</option>
                                                                <option value="Doctor" <?php if ($emp_role == 'Doctor') echo 'selected'; ?>>Doctor</option>
                                                                <option value="Nurse" <?php if ($emp_role == 'Nurse') echo 'selected'; ?>>Nurse</option>
                                                                <option value="Surgeon" <?php if ($emp_role == 'Surgeon') echo 'selected'; ?>>Surgeon</option>
                                                                <option value="Physician-assistant" <?php if ($emp_role == 'Physician-assistant') echo 'selected'; ?>>Physician Assistant</option>
                                                                <option value="Nurse-practitioner" <?php if ($emp_role == 'Nurse-practitioner') echo 'selected'; ?>>Nurse Practitioner</option>
                                                                <option value="Registered-nurse" <?php if ($emp_role == 'Registered-nurse') echo 'selected'; ?>>Registered Nurse</option>
                                                                <option value="Licensed-practical-nurse" <?php if ($emp_role == 'Licensed-practical-nurse') echo 'selected'; ?>>Licensed Practical Nurse</option>
                                                                <option value="Medical-assistant" <?php if ($emp_role == 'Medical-assistant') echo 'selected'; ?>>Medical Assistant</option>
                                                                <option value="Specialist" <?php if ($emp_role == 'Specialist') echo 'selected'; ?>>Specialist</option>
                                                                <option value="Technician" <?php if ($emp_role == 'Technician') echo 'selected'; ?>>Technician</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="emp_department" class="form-label">Department</label>
                                                            <select class="form-select border-secondary" id="emp_department" name="emp_department">
                                                                <option value="">Select Department</option>
                                                                <option value="Emergency-dept" <?php if ($emp_department == 'Emergency-dept') echo 'selected'; ?>>Emergency Dept</option>
                                                                <option value="Surgery" <?php if ($emp_department == 'Surgery') echo 'selected'; ?>>Surgery</option>
                                                                <option value="Pediatric" <?php if ($emp_department == 'Pediatric') echo 'selected'; ?>>Pediatric</option>
                                                                <option value="Internal-medicine" <?php if ($emp_department == 'Internal-medicine') echo 'selected'; ?>>Internal Medicine</option>
                                                                <option value="Gynecology" <?php if ($emp_department == 'Gynecology') echo 'selected'; ?>>Gynecology</option>
                                                                <option value="Radiology" <?php if ($emp_department == 'Radiology') echo 'selected'; ?>>Radiology</option>
                                                                <option value="Cardiology" <?php if ($emp_department == 'Cardiology') echo 'selected'; ?>>Cardiology</option>
                                                                <option value="Oncology" <?php if ($emp_department == 'Oncology') echo 'selected'; ?>>Oncology</option>
                                                                <option value="Neurology" <?php if ($emp_department == 'Neurology') echo 'selected'; ?>>Neurology</option>
                                                                <option value="Psychiatry" <?php if ($emp_department == 'Psychiatry') echo 'selected'; ?>>Psychiatry</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="checkbox" name="editConfirm" id="editConfirm" required> Are you sure you want to update?
                                                        </div>
                                                        <button type="submit" name="save_changes" class="btn btn-primary">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $emp_id ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $emp_id ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel<?php echo $emp_id ?>">Delete Employee</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this employee?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="emp_id" value="<?php echo $emp_id ?>">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="delete_employee" class="btn btn-danger">Confirm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </table>
                            
                        </div>
                    </div>

                    <!-- THIS IS THE VIEW BUTTON  -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?page=<?php echo $page; ?>">
                        <!-- Add a class to the form for styling -->
                        <button type="submit" name="view_more" class="btn btn-primary transition <?php echo $has_more_records ? '' : 'd-none'; ?>">View More</button>
                        <?php if ($page > 1): ?>
                            <button type="submit" name="back" class="btn btn-secondary transition">Back</button>
                        <?php endif; ?>
                    </form>

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
