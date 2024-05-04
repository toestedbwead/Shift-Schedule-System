<?php
    require_once("/xampp/htdocs/LEI/connections.php");
    $query = " select * from shift_table";
    $result = mysqli_query($connections,$query);
    $success_message = "";
    $error_message = "";

    // DELETE PHP CODE
    if (isset($_POST['delete_employee'])) {
        // Get the employee ID to delete
        $shift_id = $_POST['shift_id'];
        
        // Construct the SQL query to delete the employee
        $delete_query = "DELETE FROM shift_table WHERE shift_id = $shift_id";
        
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
        $employeeName = $_POST['employeeName'];
        $shift_type = $_POST['shift_type'];
        $date = $_POST['date'];
        $notes = $_POST['notes'];
        $shift_id = $_POST['shift_id'];


        
        // Construct the SQL query to update the employee
        $update_query = "UPDATE shift_table SET employeeName='$employeeName', shift_type='$shift_type', date='$date', notes='$notes' WHERE shift_id = $shift_id";
        
        // Execute the query
        if (mysqli_query($connections, $update_query)) {
            $success_message = "Employee updated successfully.";
        } else {
            $error_message = "Error updating employee: " . mysqli_error($connections);
        }
    }

    // Retrieve the list of employees
    $query = "SELECT * FROM shift_table";
    $result = mysqli_query($connections, $query);

    //VIEW MORE FUNCTION

    $limit = 5;

    // Get the current page number from the URL, default to 1
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the offset for the query
    $offset = ($page - 1) * $limit;

    // Construct the SQL query to fetch employees with pagination
    $query = "SELECT * FROM shift_table LIMIT $limit OFFSET $offset";
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


        <!-- MAIN HEADER SECTION -->
        <div class="main">
            <!-- there used to be a nav search and pfp here -->


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
                        <h3 class="fw-bold fs-4 mb-3">Schedule Table</h3>
                        <table class="table table-bordered border-secondary">
                                <tr>
                                    <td>Employee ID</td>
                                    <td>Employee Name</td>
                                    <td>Shift Type</td>
                                    <td>Shift Time</td>
                                    <td>Date</td>
                                    <td>Day</td>
                                    <td>Notes</td>
                                    <td>Actions</td>
                                </tr>

                                <?php 
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $shift_id = $row ['shift_id'];
                                    $employeeName = $row['employeeName'];
                                    $shift_type = $row['shift_type'];
                                    $shiftTime = $row['shift_time'];
                                    $date = $row['date'];
                                    $dateDay = $row['day'];
                                    $notes = $row['notes'];
                                ?>
                                    <tr>
                                        <td><?php echo $shift_id ?></td>
                                        <td><?php echo $employeeName ?></td>
                                        <td><?php echo $shift_type ?></td>
                                        <td><?php echo $shiftTime ?></td>
                                        <td><?php echo $date ?></td>
                                        <td><?php echo $dateDay ?></td>
                                        <td><?php echo $notes ?></td>
                                        <td>
                                            <div class="d-flex flex-column flex-md-row">
                                                <button type="button" class="btn btn-primary edit-btn me-2 mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $shift_id ?>">Edit</button>
                                                <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $shift_id ?>">Delete</button>
                                            </div>
                                        </td>

                                        
                                    </tr>        
                                    <!-- Edit Modal -->

                                    <div class="modal fade" id="editModal<?php echo $shift_id ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $shift_id ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel<?php echo $shift_id ?>">Add Schedule</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                                        <!-- THIS HIDDEN INPUT TYPE HELPS THE VARIABLE SHIFT_ID TO BE KNOWN EVEN THOUGH I DO NOT PROMPT THE USER TO ENTER IT -->
                                                        <input type="hidden" name="shift_id" value="<?php echo $shift_id ?>">
                                                        <input type="hidden" id="date" name="date" value="<?php echo $date ?>">
                                                        <input type="hidden" id="notes" name="notes" value="<?php echo $notes ?>">

                                                        <div class="mb-3">
                                                            <label for="employeeName" class="form-label">Employee Name</label>
                                                            <input type="text" class="form-control border-secondary" id="employeeName" name="employeeName" value="<?php echo $employeeName ?>">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="shift_type" class="form-label">Shift Type</label>
                                                            <select class="form-select border-secondary" id="shift_type" name="shift_type">
                                                                <option value="Morning" <?php if ($shift_type == 'Morning') echo 'selected'; ?>>Morning</option>
                                                                <option value="Afternoon" <?php if ($shift_type == 'Afternoon') echo 'selected'; ?>>Afternoon</option>
                                                                <option value="Evening" <?php if ($shift_type == 'Evening') echo 'selected'; ?>>Evening</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="date" class="form-label">Date</label>
                                                            <input type="date" class="form-control border-secondary" id="date" name="date" value="<?php echo $date ?>" required>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="notes" class="form-label">Notes</label>
                                                            <textarea class="form-control border-secondary" id="notes" name="notes" rows="3"></textarea>
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
                                        <div class="modal fade" id="deleteModal<?php echo $shift_id ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $shift_id ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?php echo $shift_id ?>">Delete Schedule</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this schedule?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="shift_id" value="<?php echo $shift_id ?>">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="delete_employee" class="btn btn-danger">Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
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
                                                    <a href="/LEI/login.php">
                                                        <button type="button" class="btn btn-primary">Yes</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                <?php } ?>
                            </table>
                    </div>

                    <!-- THIS IS THE VIEW BUTTON  -->
                    <div class="d-flex justify-content-center">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?page=<?php echo $page; ?>">
                            <!-- Add a class to the form for styling -->
                            <button type="submit" name="view_more" class="btn btn-primary transition<?php if (!$has_more_records) echo 'disabled'; ?>">View More</button>
                            <?php if ($page > 1): ?>
                                <button type="submit" name="back" class="btn btn-secondary transition <?php if ($page == 1) echo 'disabled'; ?>">Back</button>
                            <?php endif; ?>
                        </form>
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