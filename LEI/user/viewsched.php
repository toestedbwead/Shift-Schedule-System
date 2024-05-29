<?php
require_once("/xampp/htdocs/LEI/connections.php");

$success_message = "";
$error_message = "";

// SEARCH FUNCTIONALITY
$search_query = "";
if (isset($_POST['search_query'])) {
    $search_query = mysqli_real_escape_string($connections, $_POST['search_query']); // Escape the input to prevent SQL injection
}

// PAGINATION
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM shift_table";
if (!empty($search_query)) {
    $query .= " WHERE shift_id LIKE '%$search_query%' OR employeeName LIKE '%$search_query%' OR shift_type LIKE '%$search_query%' OR date LIKE '%$search_query%' OR notes LIKE '%$search_query%'";
}
$query .= " LIMIT $limit OFFSET $offset";

$result = mysqli_query($connections, $query);
if (!$result) {
    $error_message = "Error executing query: " . mysqli_error($connections);
} else {
    $has_more_records = mysqli_num_rows($result) === $limit;
}

if (isset($_POST['view_more'])) {
    $page++;
    header("Location: {$_SERVER['PHP_SELF']}?page=$page");
    exit;
}

if (isset($_POST['back'])) {
    $page = max($page - 1, 1);
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
                    <a class="navbar-brand" href="#">Schedule</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- <form class="d-flex ms-auto">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> -->
                        <!-- <div class="dropdown ms-3">
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
                <div class="container">

                    <!-- Display success or error messages -->
                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $success_message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error_message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Search Form -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search_query" class="form-control" placeholder="Search by any field" value="<?php echo htmlspecialchars($search_query); ?>" onkeypress="if(event.keyCode == 13) { this.form.submit(); return false; }">
                        </div>
                    </form>

                    <!-- Table to display employees -->
                    <table id="documentsTable" class="table table-striped table-bordered mx-auto custom-table">
                                <tr>
                                    <td>Employee ID</td>
                                    <td>Employee Name</td>
                                    <td>Shift Type</td>
                                    <td>Shift Time</td>
                                    <td>Date</td>
                                    <td>Day</td>
                                    <td>Notes</td>
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
                                    </tr>

                                    <?php } ?>
                    </table>

                    <!-- Pagination buttons -->
                    <div class="d-flex justify-content-between">
                        <form method="post" action="">
                            <button type="submit" name="back" class="btn btn-secondary" <?php echo $page <= 1 ? 'disabled' : ''; ?>>Back</button>
                        </form>

                        <form method="post" action="">
                            <button type="submit" name="view_more" class="btn btn-primary" <?php echo !$has_more_records ? 'disabled' : ''; ?>>View More</button>
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